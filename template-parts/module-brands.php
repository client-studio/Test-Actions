<div class="module-brands py-6 md:py-16 xl:py-24">
   <div class="site-container">

      <?php $brands = get_sub_field('brands'); ?>
      <?php if( $brands ): ?>
      <div class="grid gap-12 md:gap-16 xl:gap-24">
         <?php $i = 0; ?>
         <?php foreach( $brands as $brand ): ?>
            <?php $isEven = $i % 2 == 0 ? 'pr-60' : 'pl-60'; ?>
            <div class="grid md:grid-cols-2 items-center gap-8 lg:gap-16 xl:gap-24 max-xl:!px-0  <?php echo $isEven; ?>">
               <figure class="h-full <?php if ( $i % 2 == 0 ): ?> md:order-2<?php endif ?>">
                  <?php if (has_post_thumbnail( $brand->ID ) ): ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $brand->ID ), 'large' ); ?>
                        <img src="<?php echo $image[0]; ?>" class="w-full h-96 md:h-auto md:aspect-[3/4] object-cover" alt="<?php echo get_the_title( $brand->ID ); ?>" />
                  <?php endif; ?>
               </figure>
               <div class="<?php if ( $i % 2 == 0 ): ?> md:order-1<?php endif ?>">
                  <article class="max-w-xl light">
                        <?php 
                        $terms = get_the_terms($brand->ID, 'brand-category');
                        if ($terms && !is_wp_error($terms)): ?>
                        <h4 class="wide">
                           <a href="<?php echo get_term_link($terms[0]); ?>"><?php echo $terms[0]->name; ?></a>
                        </h4>
                        <?php endif; ?>
                     <h1><?php echo get_the_title( $brand->ID ); ?></h1>
                     <?php echo apply_filters( 'the_content', get_post_field( 'post_content', $brand->ID ) ); ?>

                     <?php $link = get_field('link', $brand->ID);
                     if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                     ?>
                     <a class="mt-12 !hidden btn btn-border btn-arrow" 
                        href="<?php echo esc_url($link_url); ?>" 
                        target="<?php echo esc_attr( $link_target ); ?>" >
                        <?php echo esc_html($link_title); ?>
                     </a>
                     <?php endif; ?>
                  </article>
               </div>
            </div>
            <?php $i++; ?>
         <?php endforeach; ?>
      </div>
      <?php endif; ?>

   </div> 
</div>
