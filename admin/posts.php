<?php include 'includes/admin_header.php' ?>

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
                            <small>Author</small>
                        </h1>

                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = "SELECT * FROM posts";
                                $select_posts_query = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($select_posts_query)) {
                                    
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];
                                    $post_author = $row['post_author'];
                                    $post_date = $row['post_date'];
                                }
                            ?>



                                <tr>
                                    <td>1</td>
                                    <td>bunhor</td>
                                    <td>Reading</td>
                                    <td>book</td>
                                    <td>draft</td>
                                    <td>Me</td>
                                    <td>php</td>
                                    <td>Good</td>
                                    <td>01-May-2021</td>
                                </tr>                           
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <?php include 'includes/admin_footer.php' ?>
