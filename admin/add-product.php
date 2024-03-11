<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>


<!-- Product Form -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0px;">
                    <h4>Add Product</h4>
                    <div class="card-body" style="padding: 20px;">
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
                                                <option value="<?= $item['id']; ?>"><?= $item["name"]; ?></option>
                                        <?php
                                            }
                                        } else {
                                            echo "No categories available";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="">Name</label>
                                    <input type="text" name="name" placeholder="Enter Category Name" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="">Slug</label>
                                    <input type="text" name="slug" placeholder="Enter Slug" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="mb-0" for="">Small Description</label>
                                    <textarea name="small_description" placeholder="Enter small description" rows="3" class="form-control mb-2" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="mb-0" for="">Description</label>
                                    <textarea name="description" placeholder="Enter description" rows="3" class="form-control mb-2" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="">Original Price</label>
                                    <input type="text" name="original_price" placeholder="Enter Original Price" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="">Selling Price</label>
                                    <input type="text" name="selling_price" , placeholder="Enter Selling Price" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="mb-0" for="">Upload Image</label>
                                    <input type="file" name="image" class="form-control mb-2" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mb-0" for="">Quantity</label>
                                        <input type="number" name="qty" placeholder="Enter Quabtity" class="form-control mb-2" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="mb-0" for="">Status</label><br>
                                        <input type="checkbox" name="status">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="mb-0" for="">Trending</label><br>
                                        <input type="checkbox" name="trending">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="">SKU</label>
                                    <input type="text" name="sku" placeholder="Enter Sku" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="mb-0" for="">Meta Title</label>
                                    <input type="text" name="meta_title" placeholder="Enter Meta Title" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="mb-0" for="">Meta Description</label>
                                    <textarea rows="3" name="meta_description" placeholder="Enter Meta Description" class="form-control mb-2" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="mb-0" for="">Meta Keywords</label>
                                    <textarea rows="3" name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control mb-2" required></textarea>
                                </div>

                                <hr style="height:3px;border-width:0;color:black;background-color:black">

                                <!-- Attribute Form -->
                                <div class="container" id="product_attr_box">
                                    <div class="row" id="attr_1">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Product Attributes</h4>
                                                    <div class="card-body">
                                                        <div id="myForm">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="mb-0" for="">V Price</label>
                                                                    <input type="text" name="v_price[]" placeholder="Enter V Price" class="form-control mb-2">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="mb-0" for="">V Sale Price</label>
                                                                    <input type="text" name="v_sale_price[]" , placeholder="Enter V Sale Price" class="form-control mb-2">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="mb-0" for="">Upload V Image</label>
                                                                    <input type="file" name="v_image[]" class="form-control mb-2">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="mb-0" for="">V Description</label>
                                                                    <textarea name="v_description[]" placeholder="Enter v-description" rows="3" class="form-control mb-2"></textarea>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="mb-0" for="">V SKU</label>
                                                                    <input type="text" name="v_sku[]" placeholder="Enter V Sku" class="form-control mb-2">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="mb-0" for="">V Color</label>
                                                                    <select name="v_color_id[]" id="v_color_id" class="form-select mb-2">
                                                                        <option selected>Select V Color</option>
                                                                        <option value="Red">Red</option>
                                                                        <option value="Blue">Blue</option>
                                                                        <option value="Green">Green</option>
                                                                        <option value="Yellow">Yellow</option>
                                                                        <option value="Black">Black</option>
                                                                        <option value="White">White</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="mb-0" for="">V Size</label>
                                                                    <select name="v_size_id[]" class="form-select mb-2">
                                                                        <option selected>Select Size</option>
                                                                        <option value="S">Small</option>
                                                                        <option value="M">Medium</option>
                                                                        <option value="L">Large</option>
                                                                        <option value="XL">Xtra Large</option>
                                                                        <option value="XXL">Double Xtra large</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<button type="submit" class="btn btn-primary" onclick="cloneForm()">Add Attribute</button>


<script>
    var attr_count = 1;

    function cloneForm() {
        attr_count++;
        var html = '<div class="row" id="attr_' + attr_count + '">\
        <div class="col-md-12">\
        <hr style="height:3px;border-width:0;color:black;background-color:black">\
        <div class="card">\
        <div class="card-header">\
        <h4>Product Attributes <button type="button" class="btn btn-lg btn-danger btn-block float-end" onclick=remove_attr("' + attr_count + '")>\
        <span>Remove</span></button></h4>\
        <div class="card-body" style="padding:0px">\
        <div class="row">\
        <div class="col-md-6">\
        <label class="mb-0" for="">V Price</label>\
        <input type="text" name="v_price[]" placeholder="Enter V Price" class="form-control mb-2" required="">\
        </div>\
        <div class="col-md-6">\
        <label class="mb-0" for="">V Sale Price</label>\
        <input type="text" name="v_sale_price[]" placeholder="Enter V Sale Price" class="form-control mb-2" required="">\
        </div>\
        <div class="col-md-12">\
        <label class="mb-0" for="">Upload V Image</label>\
        <input type="file" name="v_image[]" class="form-control mb-2" required="">\
        </div>\
        <div class="col-md-12">\
        <label class="mb-0" for="">V Description</label>\
        <textarea name="v_description[]" placeholder="Enter v-description" rows="3" class="form-control mb-2" required=""></textarea>\
        </div>\
        <div class="col-md-12">\
        <label class="mb-0" for="">V SKU</label>\
        <input type="text" name="v_sku[]" placeholder="Enter V Sku" class="form-control mb-2" required="">\
        </div>\
        <div class="col-md-6">\
        <label class="mb-0" for="">V Color</label>\
        <select name="v_color_id[]" id="v_color_id" class="form-select mb-2" required="">\
        <option selected="">Select V Color</option>\
        <option value="Red">Red</option>\
        <option value="Blue">Blue</option>\
        <option value="Green">Green</option>\
        <option value="Yellow">Yellow</option>\
        <option value="Black">Black</option>\
        <option value="White">White</option>\
        </select>\
        </div>\
        <div class="col-md-6">\
        <label class="mb-0" for="">V Size</label>\
        <select name="v_size_id[]" class="form-select mb-2" required="">\
        <option selected="">Select Size</option>\
        <option value="S">Small</option>\
        <option value="M">Medium</option>\
        <option value="L">Large</option>\
        <option value="XL">Xtra Large</option>\
        <option value="XXL">Double Xtra large</option>\
        </select>\
        </div>\
        <div class="col-md-12">\
        </div>\
        </div>\
        <hr>\
        </div>\
        </div>\
        </div>\
        </div>\
        <br>\
        </div>';
        jQuery('#product_attr_box').append(html);
    }

    function remove_attr(attr_count) {
        jQuery('#attr_' + attr_count).remove();
    }
</script>

<?php include('includes/footer.php'); ?>