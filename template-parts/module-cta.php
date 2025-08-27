<div class="module-cta md">
   <div class="full-container min-h-[480px] lg:min-h-[580px] 2xl:min-h-[680px] flex items-center h-full">
      <div class="absolute inset-0">
         <?php $img = get_sub_field('background'); ?><?php if( $img ): ?>
            <img src="<?php echo $img['sizes']['large']; ?>" class="w-full h-full object-cover" alt="<?php echo $img['alt']; ?>" />
            <div class="absolute inset-0 bg-black/20 bg-gradient-to-r from-black/60 to-transparent"></div>
         <?php endif; ?>
      </div>

      <div class="site-container">
         <div class="text-white max-w-2xl 2xl:max-w-3xl relative py-12">
            <article>
               <?php the_sub_field('text'); ?>

               <?php $link = get_sub_field('button');
               if( $link ):
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self';
               ?>
               <a class="btn btn-light" 
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
