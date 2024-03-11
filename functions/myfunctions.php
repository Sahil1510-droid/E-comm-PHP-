<?php

session_start();
include('../config/dbcon.php');  //database connection

/*
 * The function getAll() retrieves all records from a specified table in a database using PHP and
 * MySQLi.
 * 
 * @param table The `getAll` function you provided takes a table name as a parameter. This function is
 * designed to retrieve all records from the specified table in a database using a SQL query.
 * 
 * @return The function `getAll()` is returning the result of the SQL query that selects all
 * columns from the specified table. The function executes the query using `mysqli_query()` and returns
 * the result set.
 */
function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

/* The `getByID(, )` function you provided is a PHP function that retrieves data from a
database table based on a specific ID. Here's a breakdown of what the code is doing: */
function getByID($table, $id)
{

    global $con;
    $query = "SELECT * FROM $table WHERE id = '$id' ";
    $query_run = mysqli_query($con, $query);
    return $query_run;
}

/*
 * The function getByID2 retrieves data from a specified table based on the provided ID and also
 * fetches product attributes related to the ID.
 * 
 * @param table The `table` parameter in the `getByID2` function represents the name of the database
 * table from which you want to retrieve data. It is used in the SQL query to specify the table from
 * which to select records based on the provided `id`.
 * @param id The function `getByID2` takes two parameters: `` and ``. The `` parameter is
 * used to retrieve records from the database tables based on the specified ID value.
 * 
 * @return The function `getByID2` is returning the result of the query that selects all rows from the
 * `product_attributes` table where the `product_id` matches the provided ``.
 */
function getByID2($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$id' ";
    $query_run = mysqli_query($con, $query);

    global $con;
    $product_attribute_query = "SELECT * FROM product_attributes WHERE product_id ='$id' ";
    $product_attribute_query_run = mysqli_query($con, $product_attribute_query);
    return $product_attribute_query_run;
}

/*
 * The function `getAllProductAttributes` retrieves all product attributes from a database table in PHP
 * using MySQLi.
 * 
 * @return The function `getAllProductAttributes()` is returning the result of the SQL query that
 * selects all attributes from the `product_attributes` table in the database. The result returned is
 * the result set obtained from executing the query using `mysqli_query()`.
 */
function getAllProductAttributes()
{
    global $con;
    $sql = "SELECT * FROM product_attributes";
    $result = mysqli_query($con, $sql);
    return $result;
}


function checkTrackingNoValid($trackingNo)
{
    global $con;
    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo'";
    return mysqli_query($con,  $query);
}

function getOrderHistory(){
    
    global $con;
    $query = "SELECT * FROM orders WHERE status != '0'";
    return $query_run = mysqli_query($con, $query);
}

function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status = '0'";
    return $query_run = mysqli_query($con, $query);
}



/*
 * The function `redirect` in PHP sets a session message and redirects the user to a specified URL.
 * 
 * @param url The `url` parameter in the `redirect` function is the destination URL where the user will
 * be redirected after the function is called.
 * @param message The `redirect` function takes two parameters: `` and ``. The ``
 * parameter is the URL where the user will be redirected, and the `` parameter is the message
 * that will be stored in the session before the redirection occurs.
 */
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
