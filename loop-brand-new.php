<div class="brand-item relative w-full">
   <div class="bg-black w-full aspect-[3/2] relative">
      <a href="<?php the_permalink(); ?>">
         <img src="<?php the_post_thumbnail_url('thumbnail') ?>" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="<?php the_title() ?>">
      </a>
   </div>
   <div class="pt-6">
      <?php 
         $brand_categories = get_the_terms($post->ID, 'brand-category');
         if ($brand_categories && !is_wp_error($brand_categories)) {
            $brand_category = $brand_categories[0];
            $category_link = get_term_link($brand_category);
      ?>
      <h4 class="wide"><a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($brand_category->name); ?></a></h4>
      <?php } ?>
      <article class="mt-1">
         <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      </article>
   </div>
</div>
