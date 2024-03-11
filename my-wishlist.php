<?php
include('functions/userfunctions.php');
include('includes/header.php');

include('authenticate.php');
?>



<div class="py-3 bg-primary">
    <div class="container">
        <h5 class="text-white">
            <a class="text-white" href="index.php">Home</a>
            /
            <a class="text-white" href="my-wishlist.php">Wishlist</a>
        </h5>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">

            <div class="row">
                <div class="col-md-12">
                    <div id="mywishlist">
                        <?php $items = getWishListItems();

                        if (mysqli_num_rows($items) > 0) {
                        ?>

                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h6>
                                        Product
                                    </h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>
                                        Price
                                    </h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Quantity</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Action</h6>
                                </div>
                            </div>
                            <div id="">
                                <?php
                                foreach ($items as $citem) { ?>

                                    <div class="card wishlist-data shadow-sm mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="category-uploads/product-uploads/<?= $citem['image'] ?> " alt="Image" width="130px">
                                            </div>
                                            <div class="col-md-3">
                                                <h5>
                                                    <?= $citem['name'] ?>
                                                </h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>
                                                    Rs <?= $citem['selling_price'] ?>
                                                </h5>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                                <div class="input-group mb-3" style="width: 120px">
                                                    <button class="input-group-text decrement-btn updateQty">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="<?= $citem['prod_qty'] ?>" disabled>
                                                    <button class="input-group-text increment-btn updateQty">+</button>
                                                </div>

                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger deleteItem" style="border-radius: 8px;" value="<?= $citem['cid'] ?>"><i class="fa fa-trash"></i> Remove</button>
                                                <button class="btn btn-info px-4 addToCartBtn mt-2" style="border-radius: 8px;" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2">Add To Cart</i></button>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }


                                ?>
                            </div>
                            <div class="float-end">
                                <a href="checkout.php" class="btn btn-outline-primary" style="border-radius: 9px;">Proceed to Checkout</a>
                            </div>
                        <?php
                        } else {
                        ?>

                            <div class="card card-body text-center shadow">
                                <h3 class="py-3">
                                    Your Wishlist is Empty
                                </h3>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include('includes/footer.php');
?>