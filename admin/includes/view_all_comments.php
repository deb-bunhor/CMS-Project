<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Content</th>
            <th>E-mail</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM comments";
        $select_posts_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts_query)) {

            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

        

            echo "<tr>";
            echo "<td> $comment_id </td>";
            echo "<td> $comment_content </td>";
            echo "<td> $comment_email </td>";




            // $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
            // $select_cat = mysqli_query($connection, $query);
            // // confirmQuery($select_cat);

            // while ($row = mysqli_fetch_assoc($select_cat)) {
            //     $cat_id = $row['cat_id'];
            //     $cat_title = $row['cat_title'];


            //     echo "<td> {$cat_title} </td>";
            // }


            echo "<td> Status </td>";

            
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_posts_title_query = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($select_posts_title_query);
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

            echo "<td> $comment_date </td>";
            echo "<td> <a href='#'> Approve </a>​​ </td>";
            echo "<td>  <a href='#'> Unapprove </a>​​";
            echo "<td>
                    <a href='comments.php?delete={$comment_id}'> Delete </a>​​
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_comment_query = mysqli_query($connection, $query);
    if (!$delete_comment_query) {
        die('QUERY DELETE ERROR' . mysqli_error($connection));
    }
    header("Location: comments.php");
}

?>