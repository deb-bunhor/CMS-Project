<?php
    if (isset($_GET['edit_id'])) {
        $the_edit_id = $_GET['edit_id'];
    }
        $query = "SELECT * FROM users WHERE user_id=$the_edit_id";
        $select_user_by_id_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_user_by_id_query)) {
    
            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $user_username = $row['user_username'];
            $user_password = $row['user_password'];
            $user_image = $row['user_image'];
            $user_email = $row['user_email'];
        }

    if(isset($_POST['update_user'])){
        $user_id = $_GET['edit_id'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_username = $_POST['user_username'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];

        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        move_uploaded_file($user_image_temp, "../images/$user_image");

        $query = "UPDATE  users SET user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', 
        user_role='{$user_role}', user_username='{$user_username}', user_password='{$user_password}', 
        user_email='{$user_email}', user_image='{$user_image}' WHERE user_id=$user_id ";
        $update_user = mysqli_query($connection, $query);
        confirmQuery($update_user);
        header('location: user.php');
    }
?>



<form action="#" method="POST" enctype="multipart/form-data" >
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    <div class="form-group">
        <label for="post_category">Role</label>
        <select class="btn btn-primary" name="user_role" id="">
            <option value="subscriber">--Select Options--</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>
    <div class="form-group" >
        <label for="post_author">Username</label>
        <input type="text" class="form-control" name="user_username" value="<?php echo $user_username; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Password</label>
        <input type="text" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" class="form-control" name="image" >
    </div>
    <div class="form-group">
        <label for="post_status">E-mail</label>
        <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update">
    </div>
</form>