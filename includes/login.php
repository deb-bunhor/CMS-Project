<?php
include "db.php";
session_start();


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);
// $hashed_password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));


$query = " SELECT * FROM users WHERE user_username = '{$username}' ";
$select_user_query = mysqli_query($connection, $query);
if(!$select_user_query){
    die("QUERY FAIL".mysqli_error($connection));
}

while($row = mysqli_fetch_array($select_user_query)){
   $db_id = $row['user_id'];
   $db_username = $row['user_username'];
   $db_password = $row['user_password'];
   $db_firstname = $row['user_firstname'];
   $db_lastname = $row['user_lastname'];
   $db_role = $row['user_role'];


}

// $password = crypt($password, $db_password);

    if(password_verify($password, $db_password)){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_role;
        header("Location: ../admin");    
    }else{
        header("Location: ../index.php");
        
    }






}
