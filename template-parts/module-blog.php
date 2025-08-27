<div class="module-blog md">
   <div class="site-container">
      <?php if (get_sub_field('title')): ?>
      <div class="max-w-2xl 2xl:max-w-3xl pb-8">
         <article>
            <?php the_sub_field('title'); ?>
         </article>
      </div>
      <?php endif; ?>
      
      <div class="grid md:grid-cols-3 gap-8">
         <?php // this field can return either a single category or multiple
         // ensure that you are only getting the ID values of the terms and not term objects
         $categories = get_sub_field('category', false, false);
         if ($categories) {
            if (!is_array($categories)) {
               $categories = array($categories);
            }
            // make sure all values are integers
            $categories = array_map('intval', $categories);
         }
         $args = array(  
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3, 
            // comment this away if not using category selector
            'cat' =>  $categories
         ); ?>
         <?php $the_query = new WP_Query($args); if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
         <div class="item">
            <?php get_template_part( 'loop' ); ?>
         </div>
         <?php endwhile; endif;	wp_reset_postdata();	?>
      </div>
   </div>
</div>
