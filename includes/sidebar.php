<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form> <!-- Search Form -->
        <!-- /.input-group -->
    </div>





    <!-- Login Form -->
    <div class="well">

        <?php if (isset($_SESSION['user_role'])) : ?>
            <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Log out</a>
        <?php else : ?>
            <h4>Sign in your account</h4>

            <form action="includes/login.php" method="POST">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="input-group">

                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <span class="input-group-btn">
                        <button class="btn btn-success" name="login" type="submit">Login</button>
                    </span>
                </div>
            </form>
        <?php endif; ?>
        <!-- Search Form -->
        <!-- /.input-group -->
    </div>










    <!-- Blog Categories Well -->
    <div class="well">
        <?php
        $query = "SELECT * FROM categories";
        $select_cat_sidebar_query = mysqli_query($connection, $query);

        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($select_cat_sidebar_query)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li class='col-lg-6' ><a href='categories.php?cat_id=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include 'widget.php' ?>

</div>