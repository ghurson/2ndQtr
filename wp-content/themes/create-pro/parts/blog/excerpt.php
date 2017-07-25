<div class="gh_excerpt">
    <h2>
        <a href="<?= the_permalink() ?>"><?= the_title() ?></a>
    </h2>

    <?php the_post_thumbnail('thumbnail'); ?>


    <div class="<?= has_post_thumbnail() ? 'meta' : '' ?>">

        <div class="entry-meta">
            <?php create_posted_on(); ?>
        </div><!-- .entry-meta -->


        <?= the_excerpt() ?>

        <p><a href="<?= the_permalink() ?>">Read More &raquo;</a></p>


        <footer class="entry-footer">
            <?php create_entry_footer(); ?>
        </footer><!-- .entry-footer -->

    </div>


</div>

