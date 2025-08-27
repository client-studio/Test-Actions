<!DOCTYPE html>
<html <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="<?php bloginfo( "template_directory",); ?>/webfonts/font.css" rel="stylesheet">
      <?php wp_head(); ?>
   </head>

   <body <?php body_class( 'antialiased bg-light min-h-dvh' ); ?>>
      <div id="page" class="min-h-screen" x-data="header()" x-init="init()" x-effect="effect()">

         <header class="site-header w-full fixed left-0 top-0 z-50 transition-transform duration-300 ease-linear"
            :class="{ '-translate-y-full': scroll_direction === 'down', 'translate-y-0': scroll_direction === 'up' }">

            <?php if( have_rows('infobar', 'option') ): while ( have_rows('infobar', 'option') ) : the_row(); ?><?php if ( get_sub_field('show_infobar') ): ?>
               <div class="infobar overflow-hidden bg-bw-green text-bw-yellow text-sm 2xl:text-base"
                  x-show="show_infobar"
                  x-collapse.duration.500ms
                  @scroll.window="show_infobar = window.scrollY <= 100">
                  <div class="site-container flex items-center py-2 lg:py-3">
                     <div class="grow mr-2">
                        <?php the_sub_field('text') ?>
                     </div>

                     <?php $link = get_sub_field('link'); if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                     ?>
                     <a class="btn btn-xs btn-arrow" href="<?php echo esc_url($link_url); ?>" target="_blank">
                        <?php echo esc_html($link_title); ?>
                     </a>
                     <?php endif; ?>
                  </div>
               </div>
            <?php endif; endwhile; endif; ?>
            
            <div class="main-header text-light transition-color duration-500" :class="{ 'bg-dark': has_scrolled || show_menu, '!bg-dark': <?php echo is_page_template('page-plain.php') ? 'true' : 'false'; ?> }">
               <nav class="site-container z-50">
                  <div class="grid grid-cols-2 md:grid-cols-3 items-center w-full py-4 md:py-6">

                     <div class="hidden md:flex items-center">
                        <?php wp_nav_menu( array(
                           'menu'            => 'Header Left',
                           'container_id'    => 'primary-menu',
                           'container'			=> 'none',
                           'menu_class'      => 'flex',
                           'theme_location'  => 'primary',
                           'li_class'        => '',
                           'fallback_cb'     => false,
                        )); ?>

                        <?php $current_lang = pll_current_language(); ?>
                        <div class="lang menu-item pl-4 lg:pl-8">
                           <?php if ($current_lang == 'en') : ?>
                              <a href="<?php echo esc_url( home_url() . '/fi' ); ?>">Suomeksi</a>
                           <?php else : ?>
                              <a href="/">In English</a>
                           <?php endif; ?>
                        </div>
                     </div>

                     <a class="logo md:mx-auto relative z-50" href="<?php echo home_url(); ?>">
                        <span class="sr-only"><?php echo get_bloginfo( 'name' );?></span>
                           <img class="xl:mt-0.5 h-auto w-36" 
                           src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>"
                           alt="<?php echo get_bloginfo( 'name' );?>" >
                     </a>

                     <div class="hidden md:block ml-auto">
                        <?php wp_nav_menu( array(
                           'menu'            => 'Header Right',
                           'container_id'    => 'primary-menu',
                           'container'			=> 'none',
                           'menu_class'      => 'flex',
                           'theme_location'  => 'primary',
                           'li_class'        => '',
                           'fallback_cb'     => false,
                        )); ?>
                     </div>

                     <div class="block md:hidden ml-auto" @click="show_menu = !show_menu">
                        <button type="button" class="w-8 h-8 align-middle relative menu-btn fill-neutral-300" aria-controls="mobile-menu" aria-expanded="false">
                           <span class="sr-only">Toggle menu</span>
                           <svg 
                              :class="{ 'opacity-0': show_menu, 'opacity-100': !show_menu }"
                              class="icon-open transition-opacity duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M 0 9 L 0 11 L 50 11 L 50 9 Z M 0 24 L 0 26 L 50 26 L 50 24 Z M 0 39 L 0 41 L 50 41 L 50 39 Z"/></svg>
                           <svg 
                              :class="{ 'opacity-100': show_menu, 'opacity-0': !show_menu }"
                              class="icon-close transition-opacity duration-300 absolute top-0" xmlns="http://www.w3.org/2000/svg" fill="white" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" xml:space="preserve"><path d="M0,24v2h50v-2H0z"/></svg>
                        </button>
                     </div>
                  </div>
               </nav>

               <div id="mobile-menu" 
                  x-show="show_menu"
                  x-data="mobileDropdown()" 
                  x-collapse.duration.400ms
                  class="loading md:!hidden">
                  <div>
                     <nav class="site-container py-3" x-ref="menuContent">
                        <?php wp_nav_menu( array(
                           'menu'            => 'Header Left',
                           'container_id'    => 'primary-menu',
                           'container'       => 'none',
                           'menu_class'      => 'border-t border-bw-gold/30',
                           'theme_location'  => 'primary',
                           'li_class'        => '',
                           'fallback_cb'     => false,
                        )); ?>

                        <?php wp_nav_menu( array(
                           'menu'            => 'Header Right',
                           'container_id'    => 'primary-menu',
                           'container'       => 'none',
                           'menu_class'      => '',
                           'theme_location'  => 'primary',
                           'li_class'        => '',
                           'fallback_cb'     => false,
                        )); ?>

                        <?php $current_lang = pll_current_language(); ?>
                        <li class="lang menu-item">
                           <?php if ($current_lang == 'en') : ?>
                              <a href="<?php echo esc_url( home_url() . '/fi' ); ?>">Suomeksi</a>
                           <?php else : ?>
                              <a href="/">In English</a>
                           <?php endif; ?>
                        </li>
                     </nav>
                  </div>
               </div>

            </div>
         </header>

         <?php if( have_rows('age_gate', 'option') ): while ( have_rows('age_gate', 'option') ) : the_row(); ?>
            <div class="age-gate fixed inset-0 z-[100] flex items-center justify-center transition-opacity duration-300" 
                  x-data="{ accepted: localStorage.getItem('age_verified') === 'true' }"
                  x-show="!accepted"
                  x-transition:leave="transition ease-in duration-300"
                  x-transition:leave-start="opacity-100"
                  x-transition:leave-end="opacity-0">
               <div class="hidden absolute inset-0 z-0" :class="{ '!block': !accepted }">
                  <?php 
                  $image = get_sub_field('background');
                  if($image): ?>
                     <img src="<?php echo esc_url($image['url']); ?>" 
                           alt="<?php echo esc_attr($image['alt']); ?>" 
                           class="w-full h-full object-cover">
                     <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(0,0,0,0.3)_0%,transparent_100%)]"></div>
                  <?php endif; ?>
               </div>
               <div class="relative z-10 bg-dark/80 rounded-xl p-8 max-w-2xl mx-4 text-center text-light backdrop-blur hidden" :class="{ '!block': !accepted }">
                  <article class="max-w-sm">
                     <?php if(pll_current_language() == 'fi'): ?>
                     <h2 class="text-bw-yellow">Tervetuloa Brewseekerin</h2>
                     <p class="text-bw-yellow"><?php the_sub_field('finnish_text'); ?></p>
                     <?php else: ?>
                     <h2 class="text-bw-yellow">Welcome to Brewseeker</h2>
                     <p class="text-bw-yellow"><?php the_sub_field('english_text'); ?></p>
                     <?php endif; ?>
                  </article> 
                  
                  <div class="flex justify-center gap-4 mt-8">
                     <a href="https://google.com" class="btn !w-full border border-bw-yellow text-bw-yellow hover:bg-bw-yellow hover:text-dark px-6 py-2 rounded-full transition-colors duration-300">
                        <?php echo pll_current_language() == 'fi' ? 'Ei' : 'No'; ?>
                     </a>
                     <button class="btn !w-full bg-bw-yellow hover:bg-bw-yellow/90 text-dark px-6 py-2 rounded-full transition-colors duration-300" 
                              @click="localStorage.setItem('age_verified', 'true'); accepted = true">
                        <?php echo pll_current_language() == 'fi' ? 'Kyllä' : 'Yes'; ?>
                     </button>
                  </div>
               </div>
            </div>
         <?php endwhile; endif; ?>


         <div id="content" class="site-content min-h-[75vh]">
            <main>
