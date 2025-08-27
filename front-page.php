<?php
/*
Template Name: Home
*/
get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<?php if ( wp_is_mobile() ) {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium', false, '' ); } else {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' ); } ?>

<div class="hero">
   <div class="full-container h-full">

      <?php if ( has_post_thumbnail() ) : ?>
      <div class="absolute inset-0">
         <img class="h-full w-auto mx-auto object-cover" src="<?php echo $img[0]; ?>" alt="">
         <div class="absolute inset-0 bg-black/10 bg-gradient-to-t from-black/60 to-transparent"></div>
      </div>
      <?php endif; ?>

      <div class="site-container hero-xl">
         <article class="lead center">
            <?php the_content(); ?>

            <?php $link = get_field('link');
            if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="btn btn-border btn-arrow mx-auto" 
               href="<?php echo esc_url($link_url); ?>" 
               target="<?php echo esc_attr( $link_target ); ?>" >
               <?php echo esc_html($link_title); ?>
            </a>
            <?php endif; ?>
         </article>
      </div>
   </div>
</div>

<div class="modules">
   <?php get_template_part( 'page', 'modules' ); ?>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
