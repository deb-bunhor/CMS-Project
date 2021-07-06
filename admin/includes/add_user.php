<?php
    if(isset($_POST['add_user'])){
        var_dump($_FILES);
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_username = $_POST['user_username'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];

        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        move_uploaded_file($user_image_temp, "../images/$user_image");

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role,
        user_username, user_password, user_email, user_image) ";
        $query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$user_username}',
        '{$user_password}', '{$user_email}', '{$user_image}')";

        $add_user = mysqli_query($connection, $query);
        // confirmQuery($add_user);
        echo "<div class='alert alert-success col-sm-12'>";
        echo "User Created" . "<a href='user.php'> / View Users</a>";
        echo "</div>";
    }
?>



<form action="#" method="POST" enctype="multipart/form-data" >
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="post_category">Role</label>
        <select class="btn btn-primary" name="user_role" id="">
            <option value="subscriber">--Select Options--</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Username</label>
        <input type="text" class="form-control" name="user_username">
    </div>
    <div class="form-group">
        <label for="post_status">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_status">E-mail</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
    </div>
</form>