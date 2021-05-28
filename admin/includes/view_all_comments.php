<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Comment ID</th>
            <th>Post ID</th>
            <th>Comment Author</th>
            <th>E-mail</th>
            <th>Content</th>
            <th>Status</th>
            <th>Date</th>
            <th></th>
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
            echo "<td> $comment_post_id </td>";
            echo "<td> $comment_author </td>";




            // $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id' ";
            // $select_cat = mysqli_query($connection, $query);
            // // confirmQuery($select_cat);

            // while ($row = mysqli_fetch_assoc($select_cat)) {
            //     $cat_id = $row['cat_id'];
            //     $cat_title = $row['cat_title'];


            //     echo "<td> {$cat_title} </td>";
            // }


            echo "<td> $comment_email </td>";
            echo "<td> $comment_content </td>";
            echo "<td> $comment_status </td>";
            echo "<td> $comment_date </td>";
            echo "<td>
                    <a href='#'> Delete </a>​​ | <a href='#'> Approve </a>
                    
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

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

?>