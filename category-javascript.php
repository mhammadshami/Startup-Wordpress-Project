<?php
/*
 ** This Function Do Bla Bla Bla
 **
 */
?>
<?php get_header(); ?>
<div class="container home-page">
    <div class="category-information text-center">
        <h1 class='category-title'><?php single_cat_title(); ?></h1>
        <p class='category-description'>
            <?php echo category_description(); ?>
        </p>
        <div class="cat-stats">
            <span>Articles Count: 20</span> |
            <span>Comments Count: 100</span>
        </div>
    </div>

    <div class="row">
        <?php
        if (have_posts()) { // Check if there are posts

            while (have_posts()) { // Loop Through Posts
                the_post(); ?>

        <div class="col-sm-6">
            <div class="main-post">
                <h3 class="post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <span class="post-author"> <i class="fa fa-user fa-fw"></i> <?php the_author_posts_link(); ?>, </span>
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
                <hr />
                <p class="post-categories">
                    <i class="fa fa-tags fa-fw"></i>
                    <?php the_category(','); ?>
                </p>
            </div>
        </div>

        <?php

            } // End While Loop

        } // End If Condition

        ?>
    </div>
    <?php
    echo '<div class="post-pagination">';

    if (get_previous_posts_link()) {
        previous_posts_link('<i class="fa fa-chevron-left fa-fw fa-lg " aria-hidden="true"></i> New Articles');
    } else {
        echo '<span class="previous-span">New Articles</span>';
    }

    if (get_next_posts_link()) {
        next_posts_link('Old Articles <i class="fa fa-chevron-right fa-fw fa-lg " aria-hidden="true"></i>');
    } else {
        echo '<span class="next-span">Old Articles</span>';
    }

    echo '</div';
    ?>
    <div class="pagination-numbers" style="height:50"><?php echo numbering_pagination(); ?></div>
</div>

<?php get_footer(); ?>