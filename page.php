<?php
/*
Template Name: Page
*/
get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<?php if ( wp_is_mobile() ) {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' ); } else {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' ); } ?>

<div class="hero">
   <div class="full-container h-full">

      <?php if ( has_post_thumbnail() ) : ?>
      <div class="absolute inset-0">
         <img class="h-full w-full object-cover" src="<?php echo $img[0]; ?>" alt="">
         <div class="absolute inset-0 bg-black/10 bg-gradient-to-t from-black/60 to-black/30"></div>
      </div>
      <?php endif; ?>

      <div class="site-container hero-md">
         <article class="lead text-white max-w-3xl">
            <?php the_content(); ?>

            <?php $link = get_field('link');
            if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="btn btn-dark" 
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
