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
                        <div class="col-xs-6">
                        <!-- Add new Categories -->
                        <?php 
                        if(isset($_POST['submit'])){
                            add_categories();
                        }
                        ?>

                        <!-- Insert value to Categories text box when click edit -->
                        <?php
                        $cat_title = "";
                        if(isset($_GET['edit'])){
                            $cat_title = insert_categories();
                        }
                        ?> 

                        <form action="#" method="POST">
                            <div class="form-group">
                                <input class="form-control" type="text" name="cat_title" placeholder="Add Category" value="<?php echo $cat_title ?>">
                            </div>
                            <div class="form-group">
                            <?php if(isset($_GET['edit'])) : ?>
                                <input class="btn btn-primary" type="submit" name="update" value="Update">
                            <?php else : ?>
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            <?php endif; ?>
                            </div>
                        </form>

                        <!-- Update Table Categories -->
                        <?php
                            if(isset($_POST['update'])){
                                update_categories();
                            }
                        ?>

                        </div> <!-- Add Category Form -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th class="col-xs-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                //Find all categories
                                select_categories();
                                ?>

                                <?php 
                                //Delete Query
                                if(isset($_GET['delete'])){
                                    delete_categories();
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <?php include 'includes/admin_footer.php' ?>
