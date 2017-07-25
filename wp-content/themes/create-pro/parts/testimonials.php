<div
    class="testimonials cycle-slideshow"
    data-cycle-slides=">div"
    >
    <?php foreach (get_field("testimonial") as $testimonial): ?>
        <div class="testimonial">
            <span class='gh_quote'><?= apply_filters("the_content", $testimonial['quote']) ?></span>
            <p class="gh_byline">~ <?= $testimonial['byline'] ?></p>
        </div>
    <?php endforeach; ?>
</div>
