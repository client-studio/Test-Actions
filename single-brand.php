<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php if ( wp_is_mobile() ) {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', false, '' ); } else {
$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' ); } ?>

<div class="single single-taxonomy">
   <div class="header-size bg-dark h-24 w-full"></div> 
   <div class="site-container max-md:!px-0 pb-10 md:py-12">
      <div class="grid md:grid-cols-2 items-center gap-8 lg:gap-16 xl:gap-24">

         <figure class="w-full h-full md:order-2">
            <?php if (has_post_thumbnail( $post->ID ) ): ?>
               <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
               <img src="<?php echo $image[0]; ?>" class="w-full h-80 md:h-auto md:aspect-[3/4] object-cover" alt="<?php echo get_the_title( $post->ID ); ?>" />
            <?php endif; ?>
         </figure>

         <div class="module-feature__text h-full max-md:px-4">
            <div class="light h-full flex flex-col justify-between">
               <article class="light grow fix h-full basis-full">
                  <?php 
                  $brand_categories = get_the_terms($post->ID, 'brand-category');
                  if ($brand_categories && !is_wp_error($brand_categories)): ?>
                     <h4 class="wide"><a href="<?php echo get_term_link($brand_categories[0]); ?>"><?php echo $brand_categories[0]->name; ?></a></h4>
                  <?php endif; ?>

                  <h1><?php echo get_the_title( $post->ID ); ?></h1>
                  <?php echo apply_filters( 'the_content', get_post_field( 'post_content', $post->ID ) ); ?>

                  <?php $link = get_field('link');
                  if( $link ):
                     $link_url = $link['url'];
                     $link_title = $link['title'];
                     $link_target = $link['target'] ? $link['target'] : '_self';
                  ?>
                  <a class="mt-10 btn btn-border btn-arrow" 
                     href="<?php echo esc_url($link_url); ?>" 
                     target="<?php echo esc_attr( $link_target ); ?>" >
                     <?php echo esc_html($link_title); ?>
                  </a>
                  <?php endif; ?>
               </article>

            </div>
         </div>

      </div>
   </div> 
</div>

<?php
   $related = get_posts( array(
      'post_type' => 'brand',
      'posts_per_page' => 3,
      'orderby' => 'rand',
      'post__not_in' => array( $post->ID ),
   ) );
if( $related ) { ?>
<div class="site-container py-12">
   <div class="max-w-2xl 2xl:max-w-4xl pb-12">
      <article class="single-content">
         <h2><?php echo pll_current_language() === 'fi' ? 'Katso lisää' : 'More Brands'; ?></h2>
      </article>
   </div>

   <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
      <?php foreach( $related as $post ) { setup_postdata($post); ?>
         <?php get_template_part( 'loop', 'brand-new' ); ?>
      <?php } ?>
   <?php wp_reset_postdata(); ?>
   </div>
</div>
<?php } ?>

<?php endwhile; endif; ?>
<?php get_footer();
