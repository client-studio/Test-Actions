<div class="module-form py-12 md:py-16 xl:py-24">
   <div class="site-container">

      <?php $title = get_sub_field('title') ?>
      <?php if ($title) : ?>
         <article class="text-center mx-auto mb-8 md:mb-12">
            <?php echo $title; ?>
         </article>
      <?php endif; ?>

      <div class="max-w-3xl 2xl:max-w-4xl mx-auto">
         <?php $shortcode = get_sub_field('shortcode'); ?>
         <?php echo do_shortcode($shortcode); ?>
      </div>

   </div>
</div>

