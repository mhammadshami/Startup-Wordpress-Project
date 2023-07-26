<?php

// if (comments_open()) {

if (comments_open()) { // Check If Comments Are Open
?>
<h3 class="comments-count"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></h3>
<ul class='list-unstyled comments-list'>
    <?php

    $comments_arguments = array(
        'max_depth' => 3,
        'type' => 'comment',
        'avatar_size' => 64,
    );
    wp_list_comments();
    echo "</ul>";
    echo "<hr class='comment-separator' />";

    // $commentform_arguments = array(
    //     'fields' => array(
    //         'author' => '<div class="form-group"><label>Your Name</label><input class="form-control" /></div>',
    //         'email' => '<div class="form-group"><label>Email</label> This Is Email Field</div>',
    //         'url' => '<div class="form-group"><label>Url</label> This Is Url Field</div>'
    //     ),
    //     'comment_field' => '<div class="form_group">Textarea</div>'
    // );
    $commentform_arguments = array(
            'title_reply' => 'Add Your Comment',
            'title_reply_to' => 'Add a Reply To [%s]',
            'class_submit' => 'btn btn-primary btn-md',
            'comment_notes_before' => ''
    );
     
    comment_form($commentform_arguments);
    //comment_form();
} else {
    echo 'Sorry Comments Are Disabled !';
}