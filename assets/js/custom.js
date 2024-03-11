$(document).ready(function () {

    /* The provided code snippet is a JavaScript function that handles the increment functionality for
    a quantity input field in a product data section. Here's a breakdown of what the function does: */
    $(document).on('click', '.increment-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product-data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product-data').find('.input-qty').val(value);
        }
    });



    /* The code snippet you provided is a JavaScript function that handles the decrement functionality
    for a quantity input field in a product data section. Here's a breakdown of what the function
    does: */
    $(document).on('click', '.decrement-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product-data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product-data').find('.input-qty').val(value);
        }
    });


    /* The code snippet you provided is a JavaScript function that handles adding a product to a cart
    using AJAX when a specific button with the class `addToCartBtn` is clicked. Here's a breakdown
    of what the function does: */
    $(document).on('click', '.addToCartBtn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product-data').find('.input-qty').val();
        var prod_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                if (response == 201) {
                    alertify.success("Product Added to Cart");
                } else if (response == "existing") {
                    alertify.success("Product Already in Cart");
                } else if (response == 401) {
                    alertify.success("Login to Continue");
                } else if (response == 500) {
                    alertify.success("Something Went Wrong");
                }
            }
        });
    });

    $(document).on('click', '.addToWishListBtn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.wishlist-data').find('.input-qty').val();
        var prod_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                if (response == 201) {
                    alertify.success("Product Added to Wishlist");
                } else if (response == "existing") {
                    alertify.success("Product Already in Wishlist");
                } else if (response == 401) {
                    alertify.success("Login to Continue");
                } else if (response == 500) {
                    alertify.success("Something Went Wrong");
                }
            }
        });
    });

    /* The code snippet you provided is a JavaScript function that handles updating the quantity of a
    product in the cart using AJAX when a specific button with the class `updateQty` is clicked.
    Here's a breakdown of what the function does: */
    $(document).on('click', '.updateQty', function () {

        var qty = $(this).closest('.product-data').find('.input-qty').val();
        var prod_id = $(this).closest('.product-data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                // alert(response);
            }
        });

    });


    /* The code snippet you provided is a JavaScript function that handles deleting an item from the
    cart using AJAX when a specific button with the class `deleteItem` is clicked. Here's a
    breakdown of what the function does: */
    $(document).on('click', '.deleteItem', function () {
        var cart_id = $(this).val();
        // alert(cart_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                // alert(response);

                if (response == 200) {
                    alertify.success("Item Deleted Successfully");
                    $('#mycart').load(location.href + " #mycart");
                } else {
                    alertify.success(response);
                }
            }
        });
    });
});