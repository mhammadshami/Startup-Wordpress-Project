<?php
// Get Category Comments Count
$comments_args = array(
    'status' => 'approve' // Only Approved Comments
);
$comments_count = 0; // Start From Zero

$all_comments = get_comments($comments_args); // Get All Comments

foreach ($all_comments as $comment) { // Loop Through All Comments
    $post_id = $comment->comment_post_ID; // Get Post Id Of Comment

    if (!in_category('linux', $post_id,)) { // Check If Post Not In Linux Category
        continue; // Continue loop
    }
    $comments_count++;

    // Get Category Posts Count
    $cat = get_queried_object(); // Get Full Object Properties

    $posts_count = $cat->count; // Get Posts Count
}

?>
<div class='sidebar-linux'>
    <div class='widget'>
        <h3 class='widget-title'><?php single_cat_title(); ?>Statistics</h3>
        <div class='widget-content'>
            <ul>
                <li>
                    <span>Comments Count</span>: <?php echo $comments_count; ?>
                <li>
                    <span>Posts Count</span>: <?php echo $posts_count; ?>
                </li>
            </ul>
        </div>
    </div>
    <div class='widget'>
        <h3 class='widget-title'>Hot Post By Comment</h3>
        <div class='widget-content'>
            <ul>
                <?php
                $hotpost_args = array(
                    'posts_per_page' => 1,
                    'orderby' => 'comment_count',
                );

                $hotquery = new WP_Query($hotpost_args);

                if ($hotquery->have_posts()) {
                    while ($hotquery->have_posts()) {
                        $hotquery->the_post(); ?>

                <li>
                    <a target='_blank' href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
                    <hr />This Post Has:
                    <?php comments_popup_link('0 Comments', '1 Comment', '% Comments', 'comment-url', 'Comments Disabled'); ?>
                </li>
                <?php    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class='widget'>
        <h3 class='widget-title'>Latest PHP Posts</h3>
        <div class='widget-content'>
            <ul>
                <?php
                $posts_args = array(
                    'posts_per_page' => 5,
                    'cat' => 8,
                );

                $query = new WP_Query($posts_args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post(); ?>

                <li>
                    <a target='_blank' href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
                <?php    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class='widget'>
        <h3 class='widget-title'>Widget Title</h3>
        <div class='widget-content'>
            Widget Content
        </div>
    </div>
</div>