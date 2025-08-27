<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php if ( wp_is_mobile() ) {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' ); } else {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' ); } ?>

<div class="single hero">
   <div class="full-container">

      <?php if ( has_post_thumbnail() ) : ?>
      <div class="absolute inset-0">
         <img class="h-full w-full object-cover" src="<?php echo $img[0]; ?>" alt="">
         <div class="absolute inset-0 bg-black/30"></div>
      </div>
      <?php endif; ?>

      <div class="relative hero-md">
         <div class="site-container">
            <article class="lead text-white text-center">
               <h1><?php the_title(); ?></h1>
               <p><time datetime="<?php the_time('F jS, Y'); ?>">
                  <?php the_time('F jS, Y'); ?>
               </time></p>
            </article>
         </div>
      </div>

   </div>
</div>

<div class="site-container my-12">
   <div class="max-w-3xl 2xl:max-w-4xl mx-auto">
      <article id="post-<?php the_ID(); ?>" <?php post_class('single-content'); ?>>
         <?php the_content(); ?>
      </article>
   </div>
</div>

<?php $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
if( $related ) { ?>
<div class="site-container my-12">
   <div class="max-w-2xl 2xl:max-w-4xl pb-8">
      <article class="single-content">
         <h2>Related Posts</h2>
      </article>
   </div>

   <div class="grid md:grid-cols-3 gap-8">
      <?php foreach( $related as $post ) { setup_postdata($post); ?>
         <?php get_template_part( 'loop' ); ?>
      <?php } ?>
   <?php wp_reset_postdata(); ?>
   </div>
</div>
<?php } ?>

<?php endwhile; endif; ?>
<?php get_footer();
