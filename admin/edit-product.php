<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

// Fetch all product attributes
$product_attributes = getAllProductAttributes();

?>

<!-- Product -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = getByID('products', $id);

                if (mysqli_num_rows($product) > 0) {
                    $data = mysqli_fetch_assoc($product);

            ?>
                    <div class="card">
                        <div class="card-header" style="padding-bottom: 0.2rem;">
                            <h4>Edit Product
                                <a href="product.php" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body" style="padding-top: 0rem;">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Select Category</label>
                                        <select name="category_id" id="" class="form-select mb-2" required>
                                            <option selected>Select Category</option>
                                            <?php
                                            $categories = getAll("categories");

                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) {
                                            ?>
                                                    <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id'] ? 'selected' : '' ?>><?= $item["name"]; ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "No categories available";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                        <label class="mb-0" for="">Name</label>
                                        <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Category Name" class="form-control mb-2" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">Slug</label>
                                        <input type="text" name="slug" value="<?= $data['slug'] ?>" placeholder="Enter Slug" class="form-control mb-2" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Small Description</label>
                                        <textarea name="small_description" placeholder="Enter small description" rows="3" class="form-control mb-2" required><?= $data['small_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Description</label>
                                        <textarea name="description" placeholder="Enter description" rows="3" class="form-control mb-2" required><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">Original Price</label>
                                        <input type="text" name="original_price" value="<?= $data['original_price'] ?>" placeholder="Enter Original Price" class="form-control mb-2" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">Selling Price</label>
                                        <input type="text" name="selling_price" value="<?= $data['selling_price'] ?>" placeholder="Enter Selling Price" class="form-control mb-2" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control mb-2" id="image">
                                        <label for="">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <img src="../category-uploads/product-uploads/<?= $data['image'] ?>" height="50px" width="50px" alt="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-0" for="">Quantity</label>
                                            <input type="number" name="qty" value="<?= $data['qty'] ?>" placeholder="Enter Quabtity" class="form-control mb-2" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0" for="">Hide</label><br>
                                            <input type="checkbox" name="status" <?= $data['status'] == '0' ? '' : 'checked' ?>>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0" for="">Trending</label><br>
                                            <input type="checkbox" name="trending" <?= $data['trending'] == '0' ? '' : 'checked' ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">SKU</label>
                                        <input type="text" name="sku" value="<?= $data['sku'] ?>" placeholder="Enter Sku" class="form-control mb-2" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Meta Title</label>
                                        <input type="text" name="meta_title" value="<?= $data['meta_title'] ?>" placeholder="Enter Meta Title" class="form-control mb-2" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Meta Description</label>
                                        <textarea rows="3" name="meta_description" placeholder="Enter Meta Description" class="form-control mb-2" required><?= $data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="">Meta Keywords</label>
                                        <textarea rows="3" name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control mb-2" required><?= $data['meta_keywords'] ?></textarea>
                                    </div>

                                    <hr style="height:3px;border-width:0;color:black;background-color:black">


                                    <!-- Product Attribute -->
                                    <div class="container" id="product_attr_box">
                                        <div class="row" id="attr_1">
                                            <div class="col-md-12">
                                                <?php
                                                if (isset($_GET['id'])) {
                                                    $product_id = $_GET['id'];
                                                    $product_attributes = getByID2('product_attributes', $product_id);


                                                    if (mysqli_num_rows($product_attributes) > 0) {
                                                        $data = mysqli_fetch_assoc($product_attributes);

                                                ?>
                                                        <?php foreach ($product_attributes as $attribute) { ?>
                                                            <div class="card" id="variant_table">
                                                                <div class="card-header" style="padding-bottom: 0.2rem;">
                                                                    <h4>
                                                                        Edit Product Attribute
                                                                        <td style="text-align: center;">
                                                                            <button type="button" class="btn btn-m btn-danger delete_variant_btn float-end" value="<?= $attribute['id'] ?>">Delete</button>
                                                                        </td>
                                                                    </h4>
                                                                </div>
                                                                <div class="card-body" style="padding-top: 0rem;">
                                                                    <div id="myForm">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <input type="hidden" name="product_id" value="<?= $attribute['product_id'] ?>">
                                                                                <label class="mb-0" for="">V Price</label>
                                                                                <input type="text" name="v_price[]" value="<?= $attribute['v_price'] ?>" placeholder="Enter V Price" class="form-control mb-2" required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="mb-0" for="">V Sale Price</label>
                                                                                <input type="text" name="v_sale_price[]" value="<?= $attribute['v_sale_price'] ?>" placeholder="Enter V Sale Price" class="form-control mb-2" required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="mb-0" for="">Upload V Image</label>
                                                                                <input type="file" name="v_image[]" class="form-control mb-2">
                                                                                <label for="">Current V Image</label>
                                                                                <input type="hidden" name="old_image_2[]" value="<?= $attribute['v_image'] ?>">
                                                                                <img src="../category-uploads/product-uploads/variant-uploads/<?= $attribute['v_image'] ?>" height="50px" width="50px" alt="">
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label class="mb-0" for="">Hide</label><br>
                                                                                <input type="checkbox" name="v_status[]" <?= $attribute['v_status'] == '0' ? '' : 'checked' ?>>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label class="mb-0" for="">V Description</label>
                                                                                <textarea name="v_description[]" placeholder="Enter v-description" rows="3" class="form-control mb-2" required><?= $attribute['v_description'] ?></textarea>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label class="mb-0" for="">V SKU</label>
                                                                                <input type="text" name="v_sku[]" value="<?= $attribute['v_sku'] ?>" placeholder="Enter V Sku" class="form-control mb-2" required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="mb-0" for="">V Color</label>
                                                                                <select name="v_color_id[]" <?= $attribute['v_color_id'] ?> id="v_color_id" class="form-select mb-2" required>
                                                                                    <option selected>Select V Color</option>
                                                                                    <option value="Red" <?= $attribute['v_color_id'] == 'Red' ? 'selected' : '' ?>>Red</option>
                                                                                    <option value="Blue" <?= $attribute['v_color_id'] == 'Blue' ? 'selected' : '' ?>>Blue</option>
                                                                                    <option value="Green" <?= $attribute['v_color_id'] == 'Green' ? 'selected' : '' ?>>Green</option>
                                                                                    <option value="Yellow" <?= $attribute['v_color_id'] == 'Yellow' ? 'selected' : '' ?>>Yellow</option>
                                                                                    <option value="Black" <?= $attribute['v_color_id'] == 'Black' ? 'selected' : '' ?>>Black</option>
                                                                                    <option value="White" <?= $attribute['v_color_id'] == 'White' ? 'selected' : '' ?>>White</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="mb-0" for="">V Size</label>
                                                                                <select name="v_size_id[]" <?= $attribute['v_size_id'] ?> class="form-select mb-2" required>
                                                                                    <option selected>Select Size</option>
                                                                                    <option value="S" <?= $attribute['v_size_id'] == 'S' ? 'selected' : '' ?>>Small</option>
                                                                                    <option value="M" <?= $attribute['v_size_id'] == 'M' ? 'selected' : '' ?>>Medium</option>
                                                                                    <option value="L" <?= $attribute['v_size_id'] == 'L' ? 'selected' : '' ?>>Large</option>
                                                                                    <option value="XL" <?= $attribute['v_size_id'] == 'XL' ? 'selected' : '' ?>>Xtra Large</option>
                                                                                    <option value="XXL" <?= $attribute['v_size_id'] == 'XXL' ? 'selected' : '' ?>>Double Xtra large</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        <?php } ?>
                                                <?php
                                                    } else {
                                                        echo "Product Attribute Not Found";
                                                    }
                                                } else {
                                                    echo "Attribute Id missing from the Url";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

            <?php
                } else {
                    echo "Product Not Found";
                }
            } else {
                echo "Id missing from the Url";
            }
            ?>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>