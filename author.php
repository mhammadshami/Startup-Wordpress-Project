<?php get_header(); ?>
<div class="container author-page">
    <h1 class="profile-header text-center">
        <?php the_author_meta('nickname'); ?> Page
    </h1>
    <div class="author-main-info">
        <!-- Start Row -->
        <div class="row">

            <div class="col-md-3">
                <?php
                $avatar_arguments = array(

                    'class' => 'img-responsive img-thumbnail center block',
                );  // Avatar Arguments

                // get_avatar('Id Or Email', 'Size', 'Default', 'Alternate Text', 'Image Arguments' )
                echo get_avatar(get_the_author_meta('ID'), 196, '', 'User Avatar', $avatar_arguments);
                ?>
            </div>
            <div class="col-md-9">
                <ul class="list-unstyled">
                    <li>First Name: <?php the_author_meta("first_name"); ?></li>
                    <li>Last Name: <?php the_author_meta("last_name"); ?></li>
                    <li>Nickname: <?php the_author_meta("nickname"); ?></li>
                </ul>
                <hr />
                <?php
                if (get_the_author_meta('description')) { // Check If User Have a Biography 
                ?>
                    <p><?php the_author_meta('description'); ?></p>
                <?php } else {
                    echo 'There is no biography';
                }
                ?>
            </div>
        </div>
        <!-- End Row -->
    </div>

    <!-- Start Row -->
    <div class="row author-stats">
        <div class="col-md-3">
            <div class="stats">
                Posts Count
                <span> <?php echo count_user_posts(get_the_author_meta('ID'));  ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Comments Count
                <span>
                    <?php
                    $commentscount_arguments = array(
                        'user_id' => get_the_author_meta('ID'),
                        'count' => true,
                    );
                    echo get_comments($commentscount_arguments);
                    ?>
                </span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Total Posts View
                <span>0</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Testing
                <span>0</span>
            </div>
        </div>
    </div>
    <!-- End Row -->
    <?php
    $author_posts_per_page = 6;
    $author_posts_arguments = array(
        'author' => get_the_author_meta('ID'),
        'posts_per_page' => $author_posts_per_page, // all posts
    );
    $author_posts = new WP_Query($author_posts_arguments);

    if ($author_posts->have_posts()) { // Check if there are posts 
    ?>
        <h3 class="author-posts-title">
            Latest Posts [ <?php echo $author_posts_per_page; ?> ] Of
            <?php the_author_meta('nickname'); ?>
            Posts
        </h3>
        <?php
        while ($author_posts->have_posts()) { // Loop Through Posts
            $author_posts->the_post(); ?>
            <div class="author-posts row">
                <div class="col-sm-3">
                    <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
                </div>
                <div class="col-sm-9">
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <span class="post-date"> <i class="fa fa-calendar fa-fw"></i> <?php the_time("F j, Y"); ?>, </span>
                    <span class="post-comments">
                        <i class="fa fa-comments-o fa-fw"></i>
                        <?php comments_popup_link('0 Comments', '1 Comment', '% Comments', 'comment-url', 'Comments Disabled'); ?>
                    </span>
                    <!-- <p class="post-content">
                    <?php the_content('Read The Full Article ...'); ?>
                </p> -->
                    <div class="post-content">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php

        } // End While Loop

    } // End If Condition
    wp_reset_postdata(); // Reset Loop Query

    $comments_per_page = 6;
    $comments_arguments = array(
        'user_id' => get_the_author_meta('ID'),
        'status' => 'approve',
        'number' => $comments_per_page,
        'post_status' => 'publish',
        'post_type' => 'post',
    );
    $comments = get_comments($comments_arguments);

    if ($comments) {
        foreach ($comments as $comment) { ?>
            <a href="<?php echo get_permalink($comment->comment_post_ID); ?>">
                <?php echo get_the_title($comment->comment_post_ID) . '<br />'; ?>
            </a>
            <br />
            <?php echo mysql2date("d-m-Y", $comment->comment_date); ?>
            <br />
            <?php echo $comment->comment_content; ?>
            <hr />
    <?php }
    } else {
        echo 'This Author Does not have any comments';
    } ?>
</div>
<?php get_footer(); ?>