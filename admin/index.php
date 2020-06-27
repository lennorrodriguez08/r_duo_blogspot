<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";

    $query = "SELECT * FROM blog_post";
    $result = mysqli_query($connection, $query);
    $count_all_blog_id = mysqli_num_rows($result);

    $query = "SELECT * FROM blog_comments";
    $result = mysqli_query($connection, $query);
    $count_all_comments = mysqli_num_rows($result);

    $query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
    $result = mysqli_query($connection, $query);
    $count_all_subscribers = mysqli_num_rows($result);

    $query = "SELECT * FROM users WHERE user_role = 'Administrator'";
    $result = mysqli_query($connection, $query);
    $count_all_admin = mysqli_num_rows($result);

    $query = "SELECT * FROM blog_categories";
    $result = mysqli_query($connection, $query);
    $count_all_categories = mysqli_num_rows($result);

    $query = "SELECT * FROM blog_post WHERE blog_status = 'Draft'";
    $result = mysqli_query($connection, $query);
    $count_all_draft_post = mysqli_num_rows($result);

    $query = "SELECT * FROM blog_post WHERE blog_status = 'Published'";
    $result = mysqli_query($connection, $query);
    $count_all_published_post = mysqli_num_rows($result);
    
    $query = "SELECT * FROM blog_comments WHERE comment_status = 'Unapproved'";
    $result = mysqli_query($connection, $query);
    $count_all_unapproved_comments = mysqli_num_rows($result);

    $query = "SELECT * FROM blog_comments WHERE comment_status = 'Approved'";
    $result = mysqli_query($connection, $query);
    $count_all_approved_comments = mysqli_num_rows($result);

?>

    <div class="form-wrapper">
        <form action="">
            <h1 style="font-size: 20px;">ADMIN DASHBOARD</h1>
            <div class="admin-dashboard">
                <div class="blogs box">
                    <div>
                        <p>

                            <?php 
                                echo $count_all_blog_id;
                            ?>

                        </p>
                        <p>Total Blogs</p>
                        <p><a href="view_all_blog.php">More Details&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i></a></p>
                    </div>
                    <div>
                        <i class="fas fa-blog"></i>
                    </div>
                </div>
                <div class="comments box">
                    <div>
                        <p>

                            <?php 
                                echo $count_all_comments;
                            ?>

                        </p>
                        <p>Total Comments</p>
                        <p><a href="view_all_comments.php">More Details&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i></a></p>
                    </div>
                    <div>
                        <i class="far fa-comments"></i>
                    </div>
                </div>
                <div class="subscribers box">
                    <div>
                        <p>

                            <?php 
                                echo $count_all_subscribers;
                            ?>

                        </p>
                        <p>Total Subscribers</p>
                        <p><a href="view_all_users.php">More Details&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i></a></p>
                    </div>
                    <div>
                    <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="categories box">
                    <div>
                        <p>

                            <?php 
                                echo $count_all_categories;
                            ?>

                        </p>
                        <p>Total Categories</p>
                        <p><a href="update_categories.php">More Details&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i></a></p>
                    </div>
                    <div>
                    <i class="fas fa-list"></i>
                    </div>
                </div>
            </div>
        </form>
        <div>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Total', 'Count'],

            <?php

                $element_text = ['Blogs','Comments', 'Subscribers', 'Admin', 'Categories', 'Published Blogs', 'Draft Blogs', 'Approved Comments', 'Unapproved Comments'];
                $element_count = [$count_all_blog_id, $count_all_comments, $count_all_subscribers, $count_all_admin, $count_all_categories, $count_all_published_post, $count_all_draft_post, $count_all_approved_comments, $count_all_unapproved_comments];

                for ($i = 0; $i < 9; $i++) {

                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

                }

            ?>

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
        </div>
    </div>

<?php include "./admin_footer.php"; ?>