<?php
include('functions/userfunctions.php');
include('includes/header.php');

if (isset($_GET['product'])) {

    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products", $product_slug);
    $product = mysqli_fetch_array($product_data);

    if ($product) {
?>

        <div class="py-3 bg-primary">
            <div class="container">
                <h5 class="text-white">
                    <a class="text-white" href="categories.php">Home</a>
                    /
                    <a class="text-white" href="categories.php">Collections</a>
                    /
                    <?= $product['name']; ?>
                </h5>
            </div>
        </div>

        <div class="bg-light py-4">
            <div class="container mt-3 product-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="category-uploads/product-uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4><b><?= $product['name']; ?></b>
                            <span class="float-end text-danger"><?php if ($product['trending']) {
                                                                    echo "Trending";
                                                                } ?></span>
                        </h4>
                        <hr>
                        <p><?= $product['small_description']; ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5> Rs <b><span class="text-success"><?= $product['selling_price']; ?></span></b></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>
                                    Rs
                                    <s class="text-danger">
                                        <?= $product['original_price']; ?>
                                    </s>
                                </h5>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width: 120px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>

                            </div>
                        </div>

                        <br>
                        <div class="row-mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4 addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2">Add To Cart</i></button>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4 addToWishListBtn" value="<?= $product['id']; ?>"><i class="fa fa-heart me-2">Add To Wishlist</i></button>
                            </div>
                        </div>
                        <hr>
                        <h5>Product Description:</h5>
                        <p><?= $product['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php

    } else {
        echo "Product Not Found";
    }
} else {
    echo "Something Went Wrong";
} ?>

<!-- <div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Product Variants</h2>
                <hr>
                <div class="row">
                    <?php
                    $products = getAllActiveProducts('products');

                    if (mysqli_num_rows($products) > 0) {
                        foreach ($products as $item) {
                    ?>
                            <div class="col-md-3 mb-2">
                                <a href="product-view.php?product=<?= $item['slug']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <img src="category-uploads/product-uploads/<?= $item['image']; ?>" alt="Product Image" width="130px" height="130px" class="w-100">
                                            <h4 class="text-center"><?= $item['name']; ?></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo "No data available";
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div> -->




<?php
include('includes/footer.php'); ?>