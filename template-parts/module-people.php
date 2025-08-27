<div class="module-text py-6 md:py-16 xl:py-24 bg-bw-orange">
   <div class="site-container">
      <div class="max-w-3xl 2xl:max-w-4xl">
         <article class="dark h-full flex flex-col justify-between">
            <?php the_sub_field('title'); ?>
         </article>
      </div>
   </div>
</div>

<div class="module-people bg-bw-yellow py-6 md:py-16 xl:py-24">
   <div class="site-container">
      <?php if ($blocks = get_sub_field('blocks')): ?>
         <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 gap-y-12">
            <?php foreach ($blocks as $block): ?>
            <div class="md:flex md:space-x-6 <?php if (!empty($block['about'])): ?>items-start<?php else: ?>items-center<?php endif; ?>">
               <div class="flex flex-col md:items-center text-center">
                  <?php if (!empty($block['image'])): ?>
                     <div class="w-[150px] h-[150px] rounded-full mb-4 overflow-hidden">
                        <img src="<?php echo esc_url($block['image']['url']); ?>" alt="<?php echo esc_attr($block['name']); ?>" class="w-full h-full object-cover">
                     </div>
                  <?php else: ?>
                     <div class="w-[150px] h-[150px] rounded-full mb-4 bg-dark flex items-center justify-center">
                        <img class="w-full p-4" 
                        src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>"
                        alt="<?php echo get_bloginfo( 'name' );?>" >
                     </div>
                  <?php endif; ?>
               </div>
               <div class="person max-w-md" x-data="{ expanded: false }">
                  <article>
                     <p class="mb-0 text-xl"><?php echo esc_html($block['name']); ?></p>
                     
                     <?php if (!empty($block['position'])): ?>
                        <p class="text-base mb-0 !leading-snug"><?php echo esc_html($block['position']); ?></p>
                     <?php endif; ?>
                     
                     <?php if (!empty($block['email'])): ?>
                        <a href="mailto:<?php echo esc_attr($block['email']); ?>" class="block mb-0"><?php echo esc_html($block['email']); ?></a>
                     <?php endif; ?>
                     
                     <?php if (!empty($block['phone'])): ?>
                        <?php $clean_phone = preg_replace('/[\(\)\s-]/', '', $block['phone']); ?>
                        <a href="tel:<?php echo esc_attr($clean_phone); ?>" class="block"><?php echo esc_html($block['phone']); ?></a>
                     <?php endif; ?>
                  </article>

                  <?php if (!empty($block['about'])): ?>
                  <article class="mt-4 light small transition-all duration-300 ease-in-out" :class="expanded ? 'min-h-[170px]' : 'h-[170px] overflow-hidden'">
                     <?php echo $block['about']; ?>
                  </article>

                  <div class="toggle hidden border-t border-dark/20 pt-2 -mt-6 bg-bw-yellow cursor-pointer" @click="expanded = !expanded" x-show="!expanded">
                     <?php if (get_locale() === 'fi'): ?>
                        Lue lisää
                     <?php else: ?>
                        Read more
                     <?php endif; ?>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
            <?php endforeach; ?>
         </div>
      <?php endif; ?>
   </div>
</div>
