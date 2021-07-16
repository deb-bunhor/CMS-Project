<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th colspan="4"></th>
            <!-- <th></th> -->
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM users";
        $select_all_user_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_all_user_query)) {

            $user_id = $row['user_id'];
            $user_username = $row['user_username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_randSalt = $row['randSalt'];


            echo "<tr>";
            echo "<td> $user_id </td>";
            echo "<td> $user_username </td>";




            // $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
            // $select_cat = mysqli_query($connection, $query);
            // // confirmQuery($select_cat);

            // while ($row = mysqli_fetch_assoc($select_cat)) {
            //     $cat_id = $row['cat_id'];
            //     $cat_title = $row['cat_title'];


            //     echo "<td> {$cat_title} </td>";
            // }


            echo "<td> $user_firstname </td>";


            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_posts_title_query = mysqli_query($connection, $query);
            // $row = mysqli_fetch_assoc($select_posts_title_query);
            // $post_id = $row['post_id'];
            // $post_title = $row['post_title'];
            // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

            echo "<td> $user_lastname </td>";
            echo "<td> $user_email </td>";
            echo "<td> $user_role </td>";
            echo "<td>  </td>";


            echo "<td> <a class='btn btn-primary' href='user.php?change_to_admin={$user_id}'> Admin </a>​​ </td>";
            echo "<td> <a class='btn btn-primary' href='user.php?change_to_subscriber={$user_id}'> Subscriber </a>​​ </td>";
            echo "<td> <a class='btn btn-primary' href='user.php?source=edit_user&edit_id={$user_id}'> Edit </a>​​ </td>";
            echo "<td> <a class='btn btn-danger' href='user.php?delete={$user_id}'> Delete </a>​​ </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['change_to_admin'])) {
    $user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";
    $update_user_query = mysqli_query($connection, $query);
    if (!$update_user_query) {
        die('QUERY DELETE ERROR' . mysqli_error($connection));
    }
    header("Location: user.php");
}


if (isset($_GET['change_to_subscriber'])) {
    $user_id = $_GET['change_to_subscriber'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id";
    $update_user_query = mysqli_query($connection, $query);
    if (!$update_user_query) {
        die('QUERY DELETE ERROR' . mysqli_error($connection));
    }
    header("Location: user.php");
}


if (isset($_GET['delete'])) {
    if (isset($_SESSION['user_role'])) {
       if ($_SESSION['user_role'] == 'admin') {

            $user_id =$_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$user_id}";
            $delete_user_query = mysqli_query($connection, $query);
            if (!$delete_user_query) {
                die('QUERY DELETE ERROR' . mysqli_error($connection));
            }
            header("Location: user.php");
       }
    }
}

?>