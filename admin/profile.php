<?php include 'includes/admin_header.php' ?>

<?php if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query =" SELECT * FROM users WHERE user_username = '{$username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);
    if (!$select_user_profile_query) {
        die('QUERY SELECT ERROR' . mysqli_error($connection));
    }
    while($row = mysqli_fetch_array($select_user_profile_query)){
            $user_id = $row['user_id'];
            $user_username = $row['user_username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_randSalt = $row['randSalt'];
    }
}

if(isset($_POST['update_profile'])){
    $user_id = $_POST['user_id'];
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
    user_email='{$user_email}', user_image='{$user_image}' WHERE user_username='{$username}' ";
    $update_user = mysqli_query($connection, $query);
    confirmQuery($update_user);

    $_SESSION['username'] = $user_username;
    
}



?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php' ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $user_username; ?></small>
                    </h1>


                    <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php
                                if ($user_role == 'admin') {
                                    echo '<option value="subscriber">subscriber</option>';
                                } else {
                                    echo '<option value="admin">admin</option>';
                                }
                                ?>
                            </select>



                        </div>
                        <div class="form-group">
                            <label for="post_author">Username</label>
                            <input type="text" class="form-control" name="user_username" value="<?php echo $user_username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="post_status">Password</label>
                            <input type="text" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
                        </div>
                        <div class="form-group">
                            <label for="post_image">User Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label for="post_status">E-mail</label>
                            <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include 'includes/admin_footer.php' ?>