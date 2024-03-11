<?php
include('functions/userfunctions.php');
include('includes/header.php');

if (isset($_GET['category'])) {
    $category_slug = $_GET['category'];
    $category_data = getSlugActive("categories", $category_slug);
    $category = mysqli_fetch_array($category_data);

    if ($category) {

        $cid = $category['id'];
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
                    <a class="text-white" href="categories.php">Home</a>
                    /
                    <a class="text-white" href="categories.php">Collections</a>
                    /
                    <?= $category['name'] ?>
                </h5>
            </div>
        </div>
        <div class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Our <?= $category['name'] ?></h2>
                        <hr>
                        <div class="row">
                            <?php
                            $products = getProdByCategory($cid);

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
    } else {
        echo "Something Went Wrong";
    }
}
?>

<?php
include('includes/footer.php');
?>