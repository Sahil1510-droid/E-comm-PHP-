<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');

$cartItems = getCartItems();

if (mysqli_num_rows($cartItems) == 0) {
    header('location: index.php');
}
?>



<div class="py-3 bg-primary">
    <div class="container">
        <h5 class="text-white">
            <a class="text-white" href="index.php">Home</a>
            /
            <a class="text-white" href="checkout.php">Checkout</a>
        </h5>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/orders.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Your Full Name" class="form-control" required>
                                    <small class="text-danger name"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control" required>
                                    <small class="text-danger email"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Phone Number</label>
                                    <input type="number" name="phone" id="phone" placeholder="Enter Your Phone Number" class="form-control" required>
                                    <small class="text-danger phone"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Pin Code</label>
                                    <input type="number" name="pincode" id="pincode" placeholder="Enter Your Pin Code" class="form-control" required>
                                    <small class="text-danger pincode"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Address</label>
                                    <textarea name="address" id="address" class="form-control" rows="5" required></textarea>
                                    <small class="text-danger address"></small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <?php $items = getCartItems();
                            $totalPrice = 0;

                            foreach ($items as $citem) {

                            ?>

                                <div class="mb-1 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="category-uploads/product-uploads/<?= $citem['image'] ?> " alt="Image" width="69px" height="65px">
                                        </div>
                                        <div class="col-md-5">
                                            <label>
                                                <?= $citem['name'] ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>
                                                <?= $citem['selling_price'] ?>
                                            </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>x
                                                <?= $citem['prod_qty'] ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            <?php
                                $totalPrice +=  $citem['selling_price'] * $citem['prod_qty'];
                            }

                            ?>
                            <hr>
                            <div class="" style="text-align: center;">
                                <h5>Total Price : <span class="float-end"><b><?= $totalPrice ?></b></span> </h5>
                            </div>
                            <div class="" style="text-align: center;">
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" name="placeOrderBtn" style="border-radius: 10px;" class="btn btn-primary mb-3">Confirm and Place Order</button><br>
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include('includes/footer.php');
?>



<!-- Replace the "test" client-id value with your client-id -->
<script src="https://www.paypal.com/sdk/js?client-id=AXDCiTll6GAP4vjQam8ZlfPTC3N7sC7WjPKn8Y5M_d8LBYwd__y7M3yAgiieTUa51eA4DXq15QWTyK9d&currency=USD"></script>
<script>
    paypal.Buttons({
        onClick() {


            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var pincode = $('#pincode').val();
            var address = $('#address').val();


            if (name.length == 0) {
                $('.name').text("*This field is required");
            } else {
                $('.name').text("");
            }
            if (email.length == 0) {
                $('.email').text("*This field is required");
            } else {
                $('.email').text("");
            }
            if (phone.length == 0) {
                $('.phone').text("*This field is required");
            } else {
                $('.phone').text("");
            }
            if (pincode.length == 0) {
                $('.pincode').text("*This field is required");
            } else {
                $('.pincode').text("");
            }
            if (address.length == 0) {
                $('.address').text("*This field is required");
            } else {
                $('.address').text("");
            }

            if (name.length == 0 || email.length == 0 || phone.length == 0 || pincode.length == 0 || address.length == 0) {
                return false;
            }
        },
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $totalPrice ?>'
                    }
                }]
            });
        },

        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // console.log('Capture result', orderData, JSON.stringify($orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                // alert(`Transaction ${transaction.status}: ${transaction.id}<br><br>See console for all available details`, )

                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var pincode = $('#pincode').val();
                var address = $('#address').val();


                var data = {
                    'name': name,
                    'email': email,
                    'phone': phone,
                    'pincode': pincode,
                    'address': address,
                    'payment_mode': "Paid By PayPal",
                    'payment_id': transaction.id,
                    'placeOrderBtn': true
                };

                $.ajax({
                    method: "POST",
                    url: "functions/orders.php",
                    data: data,
                    success: function(response) {
                        if (response == 201) {
                            alertify.success("Order Placed Successfully");
                            // actions.redirect('my-orders.php');
                            window.location.href = 'my-orders.php';
                        }
                    }
                });
            });
        }
    }).render('#paypal-button-container');
</script>