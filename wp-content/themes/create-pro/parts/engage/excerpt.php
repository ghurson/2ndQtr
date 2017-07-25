<?php
    global $post;
    $post = get_post();
    setup_postdata($post);
?>

<div class="gh_excerpt">
    <h2>
        <a href="http://<?= the_field("link") ?>" target="_blank"><?= the_title() ?></a>
    </h2>

    <?php the_post_thumbnail('thumbnail'); ?>


    <div class="<?= has_post_thumbnail() ? 'meta' : '' ?>">

        <div class="entry-meta">
            <?php create_posted_on(); ?>
        </div><!-- .entry-meta -->


        <?= the_content() ?>

        <p><a href="http://<?= the_field("link") ?>" target="_blank">Read More &raquo;</a></p>


        <footer class="entry-footer">
            <?php create_entry_footer(); ?>
        </footer><!-- .entry-footer -->

    </div>


</div>

