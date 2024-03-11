<?php

session_start();
include('config/dbcon.php');

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getAllActiveProducts()
{
    global $con;
    $query = "SELECT * FROM products WHERE status='0'";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug= ? AND status='0' LIMIT 1";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $slug);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id= ? AND status='0'";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}


function getCartItems()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p
    WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC";
    $result = mysqli_query($con, $query);
    return $result;
}

function getWishListItems()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p
    WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC";
    $result = mysqli_query($con, $query);
    return $result;
}

function getOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id = '$userId' ";
    return $query_run = mysqli_query($con,  $query);
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id= ? AND status='0' ";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

function getRelatedProducts($product_id, $con)
{
    $query = "SELECT * FROM products WHERE color = (SELECT color FROM products WHERE id = $product_id) AND id != $product_id LIMIT 4";
    $result = mysqli_query($con, $query);
    return $result;
}

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId' ";
    return mysqli_query($con,  $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
