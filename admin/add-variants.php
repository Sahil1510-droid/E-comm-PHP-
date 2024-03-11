<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>



<!-- Find Variants -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Find Variant</h4>
                    <input type="text" id="variant-search" class="form-control mb-2" placeholder="Enter variant name...">
                </div>
                <div class="card-body" id="variant_table">
                    <div class="table-header">
                        <h5>List of Variants:</h5>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center;">ID</th>
                                <th style="text-align: center;">Product Id</th>
                                <th style="text-align: center;">Color</th>
                                <th style="text-align: center;">Size</th>
                                <th style="text-align: center;">Sku</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: center;">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="variant-list">
                            <?php
                            $product_attributes = getAll("product_attributes");

                            if (mysqli_num_rows($product_attributes) > 0) {
                                foreach ($product_attributes as $item) {
                            ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $item['id'] ?></td>
                                        <td style="text-align: center;"><?= $item['product_id'] ?></td>
                                        <td style="text-align: center;"><?= $item['v_color_id'] ?></td>
                                        <td style="text-align: center;"><?= $item['v_size_id'] ?></td>
                                        <td style="text-align: center;"><?= $item['v_sku'] ?></td>
                                        <td style="text-align: center;">
                                            <?= $item['v_status'] == '0' ? "Visible" : "Hidden" ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <img src="../category-uploads/product-uploads/variant-uploads/<?= $item['v_image']; ?>" width="50px" height="50px">
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-sm btn-danger delete_variant_btn" value="<?= $item['id'] ?>">Delete</button>
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

<script>
    document.getElementById('variant-search').addEventListener('input', function() {
        var searchTerm = this.value.toLowerCase();
        var rows = document.querySelectorAll('#variant-list tr');

        for (var i = 0; i < rows.length; i++) {
            var skuCell = rows[i].cells[4]; // Change this line to select the SKU cell (index 4)
            var sku = skuCell.textContent.toLowerCase();

            if (sku.includes(searchTerm)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
</script>
<?php include('includes/footer.php'); ?>