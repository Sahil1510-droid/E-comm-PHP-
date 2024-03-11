<?php

include('functions/userfunctions.php');
include('includes/header.php');
?>

<style>
    h4 {
        color: black;
        text-decoration: none;
    }

    h2 {
        color: black;
    }

    p {
        color: black;
    }
</style>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    // unset the session message after displaying
                    unset($_SESSION['message']);
                }
                ?>

                <!-- Carousal -->
                <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel" loading>
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://source.unsplash.com/1600x600/?Smartphone" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Welcome to iProgrammer</h2>
                                <p>Technology News, Development and Trends</p>
                                <button class="btn btn-danger">Technology</button>
                                <button class="btn btn-primary">Web Development</button>
                                <button class="btn btn-success">Tech Fun</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://source.unsplash.com/1600x600/?Laptop" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>The Best Coding Blog</h2>
                                <p>Technology News, Development and Trends</p>
                                <button class="btn btn-danger">Technology</button>
                                <button class="btn btn-primary">Web Development</button>
                                <button class="btn btn-success">Tech Fun</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://source.unsplash.com/1600x600/?Computer" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Award winning Blog</h2>
                                <p>Technology News, Development and Trends</p>
                                <button class="btn btn-danger">Technology</button>
                                <button class="btn btn-primary">Web Development</button>
                                <button class="btn btn-success">Tech Fun</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://source.unsplash.com/1600x600/?Cart" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Award winning Blog</h2>
                                <p>Technology News, Development and Trends</p>
                                <button class="btn btn-danger">Technology</button>
                                <button class="btn btn-primary">Web Development</button>
                                <button class="btn btn-success">Tech Fun</button>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Our Products</h2>
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
                                            <img src="category-uploads/product-uploads/<?= $item['image']; ?>" alt="Product Image" class="w-100">
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
</div>



<?php
include('includes/footer.php');
?>