<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="mkdf-info-section-part mkdf-tour-item-content">
        <?php the_content(); ?>
    </div>
<?php endwhile; endif; ?>