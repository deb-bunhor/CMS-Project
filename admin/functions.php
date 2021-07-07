<?php


function users_online()
{
    if (isset($_GET['onlineusers'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include("../includes/db.php");
        }
        $session = session_id();
        $time = time();
        $time_out_in_second = 05;
        $time_out = $time - $time_out_in_second;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if ($count == NULL) {
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }
        $user_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $cont_user = mysqli_num_rows($user_online_query);
    } // get request isset()

}
users_online();



function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die('QUERY INSERT ERROR' . mysqli_error($connection));
    }
}


function insert_categories()
{

    global $connection;
    if (isset($_GET['edit'])) {
        $edit_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = $edit_id";
        $select_cat_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($select_cat_query);
        if (!$select_cat_query) {
            die('QUERY SELECT ERROR' . mysqli_error($connection));
        }
        return $row['cat_title'];
    }
}

function update_categories()
{
    global $connection;
    if (isset($_POST['update'])) {
        $edit_id = $_GET['edit'];
        $category_title = $_POST['cat_title'];
        if ($category_title == "" || empty($category_title)) {
            echo "This field should not be empty!!";
        } else {
            $query = "UPDATE categories SET cat_title = '$category_title' WHERE cat_id = $edit_id";
            $update_cat = mysqli_query($connection, $query);
            if (!$update_cat) {
                die('QUERY UPDATE ERROR' . mysqli_error($connection));
            }
            header('Location: categories.php');
        }
    }
}

function select_categories()
{
    global $connection;
    $query = "SELECT * FROM categories ORDER BY cat_id";
    $select_cat_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_cat_query)) {

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td> <a class='btn btn-primary' href='categories.php?edit={$cat_id}'>Edit</a> </td>";
        echo "<td> <a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a> </td>";
        echo "</tr>";
    }
}

function add_categories()
{
    global $connection;
    $cat_title = $_POST['cat_title'];
    if ($cat_title == "" || empty($cat_title)) {
        echo "This field should not be empty!!";
    } else {
        $query = "INSERT INTO categories (cat_title) VALUE ('$cat_title')";
        $create_cat_query = mysqli_query($connection, $query);
        if (!$create_cat_query) {
            die("QUERY Failed" . mysqli_error($connection));
        }
    }
}

function delete_categories()
{
    global $connection;
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
    $delete_query = mysqli_query($connection, $query);
    if (!$delete_query) {
        die('QUERY DELETE ERROR' . mysqli_error($connection));
    }
    header("Location: categories.php");
}
