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
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>

                   
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel" style="background-color: #FBEEE6; color: #9F8189;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $post_count = recordCount('posts'); ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer" style="background-color: #CFF4D2; color: black;">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel " style="background-color: #FFE5D8; color: #9F8189;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comment_count = recordCount('comments'); ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer" style="background-color: #CFF4D2; color: black;">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel" style="background-color: #FFCAD4; color: #9F8189;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_count = recordCount('users'); ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="user.php">
                            <div class="panel-footer" style="background-color: #CFF4D2; color: black;">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel" style="background-color: #F3ABB6; color: #9F8189;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $category_count = recordCount('categories'); ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer" style="background-color: #CFF4D2; color: black;">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php

                $post_published_count = checkStatus('posts', 'post_status', 'published');

                $post_draft_count = checkStatus('posts', 'post_status', 'draft');

                $unapprove_comment_count = checkStatus('comments', 'comment_status', 'unapprove');

                $subscribes_count = checkStatus('users', 'user_role', 'subscriber');
            ?>


            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                                <?Php
                                    $elements_text = ['All Posts','Active Posts', 'Draft Posts', 'Comments', 'Pending Comment', 'User', 'Subscribers', 'Categories'];
                                    $elements_count = [$post_count, $post_published_count,  $post_draft_count, $comment_count,  $unapprove_comment_count, $user_count, $subscribes_count, $category_count];
                                    for($i = 0; $i < 8; $i++){
                                        echo "['{$elements_text[$i]}'".","."{$elements_count[$i]}],";
                                    }


                                ?>

                            // ['Posts', 10],
                            // ['Posts', 10],
                            // ['Posts', 10],
                            // ['Posts', 10],
                        ]);

                        var options = {
                            chart: {
                                title: 'Company Performance',
                                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>



        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <?php include 'includes/admin_footer.php' ?>