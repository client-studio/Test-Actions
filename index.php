<?php get_header(); ?>

<div class="hero">
   <div class="site-container">

      <div class="hero-text">
         <article class="lead">
            <h1><?php the_archive_title(); ?></h1>
            <?php $desc = the_archive_description();
            if ($desc) : ?>
            <p><?php the_archive_description(); ?></p>
            <?php endif; ?>
         </article>
      </div>

      <?php if ( have_posts() ) : ?> 
      <div class="mb-12">
         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ( have_posts() ) : the_post(); ?>
               <?php get_template_part( 'loop' ); ?>
            <?php endwhile; ?>
         </div>
      </div>
      <?php endif; ?>

      <?php 
      $prev_link = get_previous_posts_link(__('&laquo; Older'));
      $next_link = get_next_posts_link(__('Newer &raquo;'));
      if ($prev_link || $next_link) : ?>
         <?php client_pagination(); ?>
      <?php endif; ?>

   </div>
</div>

<?php get_footer();
