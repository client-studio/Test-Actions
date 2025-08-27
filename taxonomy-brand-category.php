<?php get_header(); ?>

<?php $page = get_post(422); ?>
<?php if ( wp_is_mobile() ) {
   $img = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'large', false, '' );
} else {
   $img = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'full', false, '' );
} ?>

<?php $current_tax = get_queried_object(); ?>
<?php
   $tax_description = term_description( $current_tax->term_id, $current_tax->taxonomy );
   $featured_image_url = get_field('featured_image', $current_tax); 
?>
<div class="hero">
   <div class="full-container h-full">
      <?php if ( has_post_thumbnail($page->ID) ) : ?>
      <div class="absolute inset-0">
         <?php if ( $featured_image_url ) : ?>
         <img class="h-full w-full object-cover" src="<?php echo $featured_image_url; ?>" alt="">
         <?php else : ?>
         <img class="h-full w-full object-cover" src="<?php echo $img[0]; ?>" alt="">
         <?php endif; ?>
            <div class="absolute inset-0 bg-black/10 bg-gradient-to-t from-black/60 to-transparent"></div>
      </div>
      <?php endif; ?>
      <div class="site-container hero-md">
            <article class="lead text-white max-w-3xl">
               <?php if ( $tax_description ) : ?>
               <?php echo apply_filters('the_content', $tax_description); ?>
               <?php else : ?>
               <?php echo apply_filters('the_content', $page->post_content); ?>
               <?php endif; ?>
               <?php 
               $link = get_field('link', $page->ID);
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

<?php
$terms = get_terms( array(
   'taxonomy' => 'brand-category',
   'hide_empty' => false,
) );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
   <div class="site-container my-12 flex items-center justify-center">
      <a href="<?php echo ICL_LANGUAGE_CODE === 'fi' ? '/fi/brandit' : '/brands'; ?>" class="">
         <h4 class="!my-0 !mx-2 text-sm hover:bg-bw-gold transition-colors duration-500 hover:text-light hover:border-bw-gold"><?php echo ICL_LANGUAGE_CODE === 'fi' ? 'Näytä kaikki' : 'Show all'; ?></h4>
      </a>
      <?php foreach ( $terms as $term ) : ?>
      <a href="<?php echo get_term_link( $term ); ?>" class="">
         <h4 class="!my-0 !mx-2 text-sm hover:bg-bw-gold transition-colors duration-500 hover:text-light hover:border-bw-gold <?php if ($current_tax->term_id == $term->term_id) echo 'bg-bw-gold text-light border-bw-gold'; ?>"><?php echo $term->name; ?></h2>
      </a>
      <?php endforeach; ?>
   </div>
<?php endif; ?>

<?php
$brands = get_posts( array(
   'post_type' => 'brand',
   'posts_per_page' => -1,
   'orderby' => 'title',
   'order' => 'ASC',
   'tax_query' => array(
      array(
         'taxonomy' => 'brand-category',
         'field' => 'term_id',
         'terms' => $current_tax->term_id,
      ),
   ),
) );
if ( $brands ) : ?>
   <div class="modules site-container grid md:grid-cols-2 gap-10 lg:gap-16 xl:gap-24 my-16">
      <?php foreach ( $brands as $brand ) : ?>
      <div>
         <a href="<?php echo get_permalink($brand->ID); ?>">
            <?php if ( has_post_thumbnail( $brand->ID ) ) : ?>
            <img class="w-full aspect-[3/2] object-cover" src="<?php echo get_the_post_thumbnail_url( $brand->ID, 'medium' ); ?>" alt="">
            <?php endif; ?>
         </a>

         <article class="fix py-4 md:py-7">
            <a href="<?php echo get_term_link( get_the_terms( $brand->ID, 'brand-category' )[0] ); ?>">
               <h4>
                  <?php echo get_the_terms( $brand->ID, 'brand-category' )[0]->name; ?>
               </h4>
            </a>
               <h2>
            <a href="<?php echo get_permalink($brand->ID); ?>">
                  <?php echo get_the_title( $brand->ID ); ?>
            </a>
               </h2>
            <?php echo apply_filters( 'the_content', $brand->post_content ); ?>
         </article>
      </div>
      <?php endforeach; ?>
   </div>
<?php endif; ?>



<div class="modules">
   <?php get_template_part( 'page', 'modules' ); ?>
</div>

<?php get_footer(); ?>
