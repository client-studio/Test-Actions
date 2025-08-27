<?php $background = get_sub_field('background'); 
$bgclass = ""; $borderColor = "";
   if( $background == 'yellow' ) { $bgclass = "bg-bw-yellow"; $borderColor = "border-[#A3A3A3]/50"; };
   if( $background == 'orange' ) { $bgclass = "bg-bw-orange"; $borderColor = "border-[#F9F9F6]/50"; };
   if( $background == 'green' ) { $bgclass = "bg-bw-green";  $borderColor = "border-bw-yellow/50"; };
$isDark = "";
   if( $background == 'orange' || $background == 'green' ) { $isDark = "dark"; }
   else { $isDark = "light"; }
?>

<div class="module-feature py-6 md:py-9 <?php if( $background ) { echo ' ' . $bgclass; } ?>">
   <div class="site-container py-10 md:py-12 border-t border-b <?php echo $borderColor; ?>"> 
      <div class="grid md:grid-cols-2 items-center gap-8 lg:gap-16">
         <figure class="module-feature__image h-full <?php if ( get_sub_field( 'layout' ) ): ?> md:order-2<?php endif ?>">
            <?php $image = get_sub_field('image'); ?><?php if( $image ): ?>
               <img src="<?php echo $image['sizes']['large']; ?>" class="w-full xl:pr-20 h-80 md:h-auto md:aspect-[3/4] xl:aspect-[11/12] object-cover rounded-sm" alt="<?php echo $image['alt']; ?>" />
            <?php endif; ?>
         </figure>

         <div class="module-feature__text h-full <?php if ( get_sub_field( 'layout' ) ): ?> md:order-1<?php endif ?>">
            <article class="<?php echo $isDark; ?> max-w-xl h-full flex flex-col">
               <?php the_sub_field('text'); ?>

               <?php $link = get_sub_field('button');
               if( $link ):
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self';
               ?>
               <a class="btn btn-border btn-arrow" 
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
