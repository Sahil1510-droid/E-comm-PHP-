<?php
include('../config/dbcon.php');
include('../functions/myfunctions.php');


// if (isset($_POST['update_product_btn'])) {
//     echo "<pre>";
//     print_r($_POST);
//     echo "</pre>";
//     die;
// }


if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "../category-uploads"; // upload path

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image)
    VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("add-category.php", "Category Added Successfully");
    } else {
        redirect("add-category.php", "Something Went Wrong");
    }
} else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../category-uploads"; // upload path

    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', 
    meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', 
    image='$update_filename' WHERE id='$category_id'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../category-uploads/" . $old_image)) {
                unlink("../category-uploads/" . $old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully");
    } else {
        redirect("edit-category.php?id=$category_id", "Something Went Wrong");
    }
} elseif (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT  * FROM categories WHERE id='$category_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_qurey = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_qurey_run = mysqli_query($con, $delete_qurey);

    if ($delete_qurey_run) {
        if (file_exists("../category-uploads/" . $image)) {
            unlink("../category-uploads/" . $image);
        }
        // redirect("category.php", "Category deleted successfully");
        echo 200;
    } else {
        // redirect("category.php", "Something Went Wrong");
        echo 500;
    }
}
// Add Product Button
if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $sku = $_POST['sku'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    // Main product image upload
    $product_image = $_FILES['image']['name'];
    $product_image_tmp = $_FILES['image']['tmp_name'];

    // Variant image upload
    $variant_images = $_FILES['v_image'];
    $variant_image_tmp = $variant_images['tmp_name'];

    // Check if main product image was uploaded successfully
    if (!empty($product_image_tmp)) {
        $product_image_ext = pathinfo($product_image, PATHINFO_EXTENSION);
        $product_filename = time() . '_' . uniqid('', true) . '.' . $product_image_ext;
        $product_upload_path = "../category-uploads/product-uploads";
        $product_upload_success = move_uploaded_file($product_image_tmp, $product_upload_path . '/' . $product_filename);
    }

    // Check if variant images were uploaded successfully
    $variant_upload_success = true;
    $variant_filenames = array();
    if (!empty($variant_image_tmp)) {
        $variant_upload_path = "../category-uploads/product-uploads/variant-uploads";
        foreach ($variant_image_tmp as $key => $tmp_name) {
            $variant_image_ext = pathinfo($variant_images['name'][$key], PATHINFO_EXTENSION);
            $variant_filename = time() . '_' . uniqid('', true) . '.' . $variant_image_ext;
            $variant_upload_success = $variant_upload_success && move_uploaded_file($tmp_name, $variant_upload_path . '/' . $variant_filename);
            $variant_filenames[] = $variant_filename;
        }
    }

    // Insert main product
    if ($product_upload_success) {
        $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price, 
            qty, sku, meta_title, meta_description, meta_keywords, status, trending, image) 
            VALUES ('$category_id','$name','$slug','$small_description','$description','$original_price','$selling_price','$qty','$sku','$meta_title',
            '$meta_description','$meta_keywords','$status','$trending','$product_filename')";

        $product_query_run = mysqli_query($con, $product_query);


        if ($product_query_run) {
            $last_insert_id = mysqli_insert_id($con);

            // Insert variant information into the database
            foreach ($variant_filenames as $key => $filename) {
                $v_description = $_POST['v_description'][$key];
                $v_color_id = $_POST['v_color_id'][$key];
                $v_size_id = $_POST['v_size_id'][$key];
                $v_price = $_POST['v_price'][$key];
                $v_sale_price = $_POST['v_sale_price'][$key];
                $v_sku = $_POST['v_sku'][$key];

                $product_attribute_query = "INSERT INTO product_attributes (product_id, v_description, v_color_id, v_size_id, v_price, 
                    v_sale_price, v_sku, v_image) 
                    VALUES ('$last_insert_id','$v_description','$v_color_id','$v_size_id','$v_price',
                    '$v_sale_price','$v_sku','$filename')";

                $product_attribute_query_run = mysqli_query($con, $product_attribute_query);

                if (!$product_attribute_query_run) {
                    $variant_upload_success = false;
                }
            }

            if ($variant_upload_success) {
                redirect("add-product.php", "Product and Variant Added Successfully. New Product ID: " . $last_insert_id);
            } else {
                redirect("add-product.php", "Something Went Wrong While Adding Variant");
            }
        } else {
            redirect("add-product.php", "Failed to Insert Product");
        }
    } else {
        redirect("add-product.php", "Failed to Upload Product Image");
    }

    // Update Product Button
} elseif (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $sku = $_POST['sku'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "../category-uploads/product-uploads"; // upload path

    $update_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', small_description='$small_description', 
    description='$description', original_price='$original_price', selling_price='$selling_price', qty='$qty', sku='$sku', meta_title='$meta_title', 
    meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', trending='$trending', 
    image='$update_filename' WHERE id='$product_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../category-uploads/" . $old_image)) {
                unlink("../category-uploads/" . $old_image);
            }
        }

        $variant_update_success = true;
        // Update variant information in the database
        foreach ($_POST['v_description'] as $key => $v_description) {
            $v_color_id = $_POST['v_color_id'][$key];
            $v_size_id = $_POST['v_size_id'][$key];
            $v_price = $_POST['v_price'][$key];
            $v_sale_price = $_POST['v_sale_price'][$key];
            $v_sku = $_POST['v_sku'][$key];
            $v_status = isset($_POST['v_status'][$key]) ? '1' : '0';
            $new_image_2 = $_FILES['v_image']['name'][$key];
            $old_image_2 = $_POST['old_image_2'][$key];

            if ($new_image_2 != "") {
                $image_ext = pathinfo($new_image_2, PATHINFO_EXTENSION);
                $update_filename = time() . '.' . $image_ext;
            } else {
                $update_filename = $old_image_2;
            }

            $path = "../category-uploads/product-uploads/variant-uploads"; // upload path

            // Update the product_attribute_query to include the new image
            $product_attribute_query = "UPDATE product_attributes SET v_description='$v_description', v_color_id='$v_color_id', 
            v_size_id='$v_size_id', v_price='$v_price', v_sale_price='$v_sale_price', v_sku='$v_sku', v_status='$v_status',
            v_image='$update_filename' WHERE product_id='$product_id' AND v_sku='$v_sku'";

            $product_attribute_query_run = mysqli_query($con, $product_attribute_query);

            if ($product_attribute_query_run) {
                if ($new_image_2 != "") {
                    move_uploaded_file($_FILES['v_image']['tmp_name'][$key], $path . '/' . $update_filename); // change this line to handle multiple files
                    if (file_exists("../category-uploads/product-uploads/variant-uploads/" . $old_image_2)) {
                        unlink("../category-uploads/product-uploads/variant-uploads/" . $old_image_2);
                    }
                }
            } else {
                $variant_update_success = false;
            }
        }

        if ($variant_update_success) {
            redirect("edit-product.php?id=$product_id", "Product and Variant Updated Successfully");
        } else {
            redirect("edit-product.php?id=$product_id", "Something Went Wrong While Updating Variant");
        }
    } else {
        redirect("edit-product.php?id=$product_id", "Failed to Upload Product Image");
    }
} elseif (isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id' ";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_qurey = "DELETE FROM products WHERE id='$product_id' ";
    $delete_qurey_run = mysqli_query($con, $delete_qurey);

    if ($delete_qurey_run) {
        if (file_exists("../category-uploads/product-uploads/" . $image)) {
            unlink("../category-uploads/product-uploads/" . $image);
        }
        // redirect("product.php", "Product deleted successfully");
        echo 200;
    } else {
        // redirect("product.php", "Something Went Wrong");
        echo 500;
    }
} elseif (isset($_POST['delete_variant_btn'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM product_attributes WHERE id='$product_id' ";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $v_image = $product_data['v_image'];

    $delete_qurey = "DELETE FROM product_attributes WHERE id='$product_id' ";
    $delete_qurey_run = mysqli_query($con, $delete_qurey);

    if ($delete_qurey_run) {
        if (file_exists("../category-uploads/product-uploads/variant-uploads/" . $v_image)) {
            unlink("../category-uploads/product-uploads/variant-uploads/" . $v_image);
        }
        // redirect("product.php", "Product deleted successfully");
        echo 200;
    } else {
        // redirect("product.php", "Something Went Wrong");
        echo 500;
    }
} elseif (isset($_POST['update_order_btn'])) {
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no'";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    redirect("view-order.php?t=$track_no", "Order Status Updated Successfully!");
} else {
    header('location: ../index.php');
}
