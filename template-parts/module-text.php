<?php $background = get_sub_field('background'); 
$bgclass = ""; 
   if( $background == 'yellow' ) { $bgclass = "bg-bw-yellow"; };
   if( $background == 'orange' ) { $bgclass = "bg-bw-orange"; };
   if( $background == 'green' ) { $bgclass = "bg-bw-green";  };
$isDark = "";
   if( $background == 'orange' || $background == 'green' ) { $isDark = "dark"; }
   else { $isDark = "light"; }
?>

<div class="module-text py-6 md:py-16 xl:py-24 <?php if( $background ) { echo ' ' . $bgclass; } ?>">
   <div class="site-container">
      <div class="max-w-3xl 2xl:max-w-4xl">
         <article class="<?php echo $isDark; ?> h-full flex flex-col justify-between">
            <?php the_sub_field('text'); ?>

            <?php $link = get_sub_field('button');
            if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="btn" 
               href="<?php echo esc_url($link_url); ?>" 
               target="<?php echo esc_attr( $link_target ); ?>" >
               <?php echo esc_html($link_title); ?>
            </a>
            <?php endif; ?>
         </article>
      </div>
   </div>
</div>
