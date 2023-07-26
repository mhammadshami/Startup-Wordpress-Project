<?php
/*
 ** This Function Do Bla Bla Bla
 **
 */
?>
<?php
get_header(); // Get Header
include(get_template_directory() . '/includes/breadcrumb.php'); // Include Breadcrumb


?>

<div class="container post-page">
    <?php
    if (have_posts()) { // Check if there are posts

        while (have_posts()) { // Loop Through Posts
            the_post(); ?>

            <div class="main-post single-post">
                <?php edit_post_link('Edit <i class="fa fa-pencil"></i>'); ?>
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
                <?php the_post_thumbnail('', ['class' => 'img-responsive img-thumbnail', 'title' => 'Post Image']); ?>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>

                <hr />
                <p class="post-categories">
                    <i class="fa fa-tags fa-fw"></i>
                    <?php the_category(','); ?>
                </p>
                <p class="post-tags">
                    <?php
                    if (has_tag()) {
                        the_tags();
                    } else {
                        echo 'Tags: There\'s No Tags';
                    }
                    ?>
                </p>
            </div>

        <?php

        } // End While Loop

    } // End If Condition

    // get Post Id = > get_queried_object_id();

    // Categories Ids
    $random_posts_arguments = array(
        'posts_per_page' => 5,
        'orderby' => 'rand',
        'category__in' => wp_get_post_categories(get_queried_object_id()),
        'post__not_in' => array(get_queried_object_id())
    );
    $random_posts = new WP_Query($random_posts_arguments);

    if ($random_posts->have_posts()) { // Check if there are posts 
        while ($random_posts->have_posts()) { // Loop Through Posts
            $random_posts->the_post(); ?>
            <h3 class="post-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
            <hr />
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
    ?>
    <div class="row">
        <div class="col-md-2">
            <?php
            $avatar_arguments = array(

                'class' => 'img-responsive img-thumbnail center block',
            );  // Avatar Arguments

            // get_avatar('Id Or Email', 'Size', 'Default', 'Alternate Text', 'Image Arguments' )
            echo get_avatar(get_the_author_meta('ID'), 128, '', 'User Avatar', $avatar_arguments);
            ?>
        </div>
        <div class="col-md-10 author-info">
            <h4>

                <?php the_author_meta('first_name'); ?>

                <?php the_author_meta('last_name'); ?>
                (<span class="nickname">
                    <?php the_author_meta('nickname'); ?>
                </span>)

            </h4>
            <?php
            if (get_the_author_meta('description')) { // Check If User Have a Biography 
            ?>
                <p><?php the_author_meta('description'); ?></p>
            <?php } else {
                echo 'There is no biography';
            }
            ?>
        </div>
        <hr />
        <p class="author-stats">
            User Posts Count: <span class="posts-count">
                <?php echo count_user_posts(get_the_author_meta('ID'));  ?>
            </span>,
            User Profile Link: <?php the_author_posts_link(); ?>
        </p>
    </div>

    <?php
    echo '<hr class="comment-separator" />';
    echo '<div class="post-pagination">';

    if (get_previous_post_link()) { // Check If Previous Post Exists

        previous_post_link('%link', '<i class="fa fa-chevron-left fa-fw fa-lg " aria-hidden="true"></i> Previous Article: %title');
    } else {
        echo '<span class="previous-span">Previous Article: None</span>';
    }

    if (get_next_post_link()) { // Check If Next Post Exists
        next_post_link('%link', 'Next Article: %title <i class="fa fa-chevron-right fa-fw fa-lg " aria-hidden="true"></i>');
    } else {
        echo '<span class="next-span">Next Article: None</span>';
    }

    echo '</div';

    ?>
    <div> <?php comments_template('/comments.php', true); ?></div>
</div>

<?php get_footer(); ?>