<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>

<style>
    .card-body h4 {
        color: black;
        text-decoration: none;
    }
</style>

<div class="py-3 bg-primary">
    <div class="container">
        <h5 class="text-white">
            <a class="text-white" href="index.php">Home</a>
            / Collections
        </h5>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Our Collections</h2>
                <hr>
                <div class="row">
                    <?php
                    $categories = getAllActive('categories');

                    if (mysqli_num_rows($categories) > 0) {
                        foreach ($categories as $item) {
                    ?>
                            <div class="col-md-3 mb-2">
                                <a href="products.php?category=<?= $item['slug']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <img src="category-uploads/<?= $item['image']; ?>" alt="Category Image" class="w-100">
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