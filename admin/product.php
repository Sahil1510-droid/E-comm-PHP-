<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center;">ID</th>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Quantity</th>
                                <th style="text-align: center;">Edit</th>
                                <th style="text-align: center;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product = getAll("products");

                            if (mysqli_num_rows($product) > 0) {
                                foreach ($product as $item) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $item['id'] ?></td>
                                        <td style="text-align: center;"><?= $item['name'] ?></td>
                                        <td style="text-align: center;">
                                            <img src="../category-uploads/product-uploads/<?= $item['image']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $item['status'] == '0' ? "Visible" : "Hidden" ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $item['qty'] ?>
                                            <?php if ($item['qty'] <= 1) : ?>
                                                <br><b><span style="color: red;">Qty Low Message</span></b>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="edit-product.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= $item['id'] ?>">Delete</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "No Records Found";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>