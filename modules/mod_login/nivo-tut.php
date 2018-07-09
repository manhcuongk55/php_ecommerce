<div id="featuredPost">
    <div id="slider" class="nivoSlider">

<?php
    $featuredPost = new WP_Query();
    $featuredPost->query('showposts=5&cat=8');
    while($featuredPost->have_posts()) : $featuredPost->the_post(); 
        $do_not_duplicate[] = $post->ID;
    ?>
        <a href="<?php the_permalink();?>"><img src="<?php echo get_post_meta($post->ID, 'featuredImg', true);?>" alt="<?php the_title() ?>" title="<?php the_title() ?>" /></a>

    <?php endwhile; ?>
    </div>
</div>