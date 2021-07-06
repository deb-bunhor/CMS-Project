<?php
if (isset($_POST['checkBoxArray'])) {
    foreach (($_POST['checkBoxArray']) as $postValueID) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$postValueID' ";
                $update_to_published_status = mysqli_query($connection, $query);
                if (!$update_to_published_status) {
                    die("QUERY ERROR" . mysqli_error($connection));
                }
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = '$postValueID' ";
                $update_to_published_status = mysqli_query($connection, $query);
                if (!$update_to_published_status) {
                    die("QUERY ERROR" . mysqli_error($connection));
                }
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = '$postValueID' ";
                $update_to_published_status = mysqli_query($connection, $query);
                if (!$update_to_published_status) {
                    die("QUERY ERROR" . mysqli_error($connection));
                }
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueID}'";
                $select_post_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_post_query)){
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }
                $query = " INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_status, post_image, post_tags, post_content) ";
                $query .= "VALUES($post_category_id, '$post_title','$post_author', 
                '$post_date', '$post_status', '$post_image', '$post_tags', '$post_content')";
                $copy_query = mysqli_query($connection, $query);
                if(!$copy_query){
                    die("Query Failed".mysqli_error($connection));
                }
                break;
        }
    }
}
?>



<form action="#" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4" style="margin-bottom: 5px;">
            <select class="form-control" name="bulk_options" id="">
                <option value="">--Select Option--</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4" style="margin-bottom: 5px;">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead class="thead-dark">
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Categories</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Views</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($select_posts_query)) {

                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];

                echo "<tr>";
            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
            <?php
                echo "<td> $post_id </td>";
                echo "<td> $post_author </td>";
                echo "<td> $post_title </td>";




                $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
                $select_cat = mysqli_query($connection, $query);
                // confirmQuery($select_cat);

                while ($row = mysqli_fetch_assoc($select_cat)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];


                    echo "<td> {$cat_title} </td>";
                }


                echo "<td> $post_status </td>";
                echo "<td> <img width='100px' src='../images/$post_image' alt='image'> </td>";
                echo "<td> $post_tags </td>";
                echo "<td> $post_comment_count </td>";
                echo "<td> $post_date </td>";
                echo "<td>$post_views_count <a href='posts.php?reset={$post_id}'>Reset</a> </td>";
                echo "<td> <a class='btn btn-primary' href='../post.php?p_id={$post_id}'> View Post </a> </td>";
                echo "<td> <a class='btn btn-primary' href='posts.php?source=edit_post&p_id={$post_id}'> Edit </a> </td>";
                echo "<td> <a onClick=\"javascript: return confirm('Are you sure you want to delete!!') \" class='btn btn-danger' href='posts.php?delete={$post_id}'> Delete </a>​​</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>
<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_post_query = mysqli_query($connection, $query);
    if (!$delete_post_query) {
        die('QUERY DELETE ERROR' . mysqli_error($connection));
    }
    header("Location: posts.php");
}

if (isset($_GET['reset'])) {
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =".mysqli_real_escape_string($connection, $_GET['reset'])."";
    $reset_query = mysqli_query($connection, $query);
    if (!$reset_query) {
        die('QUERY ERROR' . mysqli_error($connection));
    }
    header("Location: posts.php");
}
?>