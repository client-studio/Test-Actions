<?php if (!is_page('maintenance')) { ?>
   </main>
</div>

<footer class="bg-dark text-light" aria-labelledby="footer">
   <div class="site-container py-8 md:py-12">
      <a class="logo block w-fit mx-auto" href="<?php echo home_url(); ?>">
         <span class="sr-only"><?php echo get_bloginfo( 'name' );?></span>
            <img class="h-auto w-40" 
            src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>"
            alt="<?php echo get_bloginfo( 'name' );?>" >
      </a>
   </div>
   <div class="footer-menu max-md:hidden site-container flex justify-center items-center">
      <?php $current_lang = pll_current_language(); ?>
      <div class="home menu-item">
         <a href="<?php echo home_url(); ?>">
            <?php if ($current_lang == 'en') : ?>
               Home
            <?php else : ?>
               Etusivu
            <?php endif; ?>
         </a>
      </div>

      <nav class="max-md:hidden">
         <?php wp_nav_menu( array(
            'menu'            => 'footer',
            'container'			=> 'none',
            'menu_class'      => 'flex',
            'theme_location'  => 'primary',
            'li_class'        => '',
            'fallback_cb'     => false,
         )); ?>
      </nav>

      <div class="lang menu-item">
         <?php if ($current_lang == 'en') : ?>
            <a href="<?php echo esc_url( home_url() . '/fi' ); ?>">Suomeksi</a>
         <?php else : ?>
            <a href="/">In English</a>
         <?php endif; ?>
      </div>
   </div>

   <div class="footer-legal pt-4 md:pt-16 pb-8 md:pb-12 flex justify-center items-center flex-wrap">
      <div>
         &copy; <?php echo date('Y'); ?> Brew Seeker Oy
      </div> 

      <?php $address = get_field('address', 'option'); if( $address ): ?>
         <div>
            <?php echo $address; ?>
         </div>
      <?php endif; ?>

      <?php wp_nav_menu( array(
         'menu'            => 'Footer Legal',
         'container'			=> 'none',
         'menu_class'      => 'flex',
         'theme_location'  => 'primary',
         'li_class'        => 'mx-4 first:ml-0 last:mr-0 py-1',
         'fallback_cb'     => false,
      )); ?>
   </div>
</footer>

</div>
<?php } ?>

<?php wp_footer(); ?>

<?php if ( get_field( 'enable_contact_form_on_this_page' ) ) { ?>
<script>
   /** hide the form after submit **/
   document.addEventListener( 'wpcf7mailsent', function( event ) {
      document.querySelectorAll("form.wpcf7-form > :not(.wpcf7-response-output)").forEach(el => {
         el.style.display = 'none';
      });
   }, false );

   /** hide the original loader icon **/
   document.addEventListener('DOMContentLoaded', function() {
      var forms = document.querySelectorAll('form.wpcf7-form');
      forms.forEach(function(form) {
         form.addEventListener('submit', function() {
            var spinner = form.querySelector('.wpcf7-spinner');

            // Add a CSS class to hide the spinner
            spinner.classList.add('hidden');
         });
      });
   });

   document.addEventListener('DOMContentLoaded', function() {
      /**
       * Disable WPCF7 button while it's submitting
       * Stops duplicate enquiries coming through
       */
      document.addEventListener('wpcf7submit', function(event) {
         // Find only disabled submit buttons
         var button = document.querySelector('.wpcf7-submit[disabled]');

         // Grab the old value
         var old_value = button.getAttribute('data-value');

         // Enable the button
         button.disabled = false;

         // Put the old value back in
         button.value = old_value;
      }, false);

      var forms = document.querySelectorAll('form.wpcf7-form');
      forms.forEach(function(form) {
         form.addEventListener('submit', function() {
            var button = form.querySelector('input[type=submit]');
            var current_val = button.value;

            // Store the current value so we can reset it later
            button.setAttribute('data-value', current_val);

            // Disable the button
            button.disabled = true;

            // Tell the user what's happening
            button.value = 'Hold on...';
         });
      });
   });
</script>
<?php } ?>

</body>
</html>
