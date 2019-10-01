<!DOCTYPE html>
<!-- This will setup the language of website -->
<html <?php language_attributes(); ?> >
<head>
	<!-- -This setup the character setting -->
	<meta charset="<?php bloginfo('charset'); ?> ">

	<!-- This will rescale the website, which depends of the size of device (iPhone, tablet PC ...) -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- <title></title> -->
	<?php wp_head(); ?>
</head>

<!-- This will inform us of page ID, child page, parent page, status of log-in, etc.
 	These information of classes can be used for styling with CSS files or JavaScript coding -->
<body <?php body_class(); ?> >

	<header class="site-header">
	    <div class="container">
	      <h1 class="school-logo-text float-left"><a href="<?php echo site_url() ?>"><strong>Alan </strong>Law Office</a></h1>
		  <a href="<?php echo esc_url(site_url('/search')); ?>" class="js-search-trigger site-header__search-trigger">
			  <i class="fa fa-search" aria-hidden="true"></i>
		  </a>
	      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
	      <div class="site-header__menu group">

	      	<!-- This displays main navigation menu. -->
	        <nav class="main-navigation">

	        	<!--
	        	<?php
	        		// This enables dynamic navigation menu
	        		/*
	        		wp_nav_menu(array(
	        			// the headerMenuLocation is defined at function.php file
	        			'theme_location' => 'headerMenuLocation'
	        		));
	        		*/
	        	?>
				-->
	          	<ul>
					<!-- if the current page is 'About Us', its navigation men will be highlighted 
					     The ID of About Us page is 13.         									-->
					<li <?php if (is_page('about-us') or wp_get_post_parent_id(get_the_ID()) == 13 ) 
								echo 'class="current-menu-item"' ?> >
						<a href="<?php echo site_url('/about-us') ?>">
							About Us
						</a>
					</li>
					<li <?php if (is_page('appointment-with-alan') or 
								wp_get_post_parent_id(get_the_ID()) == 77 ) 
								echo 'class="current-menu-item"' ?> >
						<a href="<?php echo site_url('/appointment-with-alan') ?>">
							Appoinment
						</a>
					</li>
					<li <?php if (is_page('immigration-services') or 
								wp_get_post_parent_id(get_the_ID()) == 80 or
								wp_get_post_parent_id(wp_get_post_parent_id(get_the_ID())) == 80 ) 
								echo 'class="current-menu-item"' ?> >
						<a href="<?php echo site_url('/immigration-services') ?>">
							Immigration
						</a>
					</li>
		            <li <?php if (is_page('business-services') or wp_get_post_parent_id(get_the_ID()) == 90 ) 
								echo 'class="current-menu-item"' ?> >
						<a href="<?php echo site_url('/business-services') ?>">
							Business
						</a>
					</li>
					<li <?php if (is_page('accident-and-injury-services') or wp_get_post_parent_id(get_the_ID()) == 82 ) 
								echo 'class="current-menu-item"' ?> >
						<a href="<?php echo site_url('/accident-and-injury-services') ?>">
							Accident and Injury
						</a>
					</li>
					<li <?php  /* this will highlight FAQ blog navigation menu, 
							      while visiting.      */
							if ( get_post_type() == 'post') 
								echo 'class="current-menu-item"' ?> >
						<a href="<?php echo site_url('/blog') ?>">
							FAQ
						</a>
					</li>
	          	</ul>
	        </nav>

	        <div class="site-header__util">
				<?php 
					if(is_user_logged_in()) { ?>
						<!-- site_url(/wp-signup.php) is for WordPress signup URL 
							esc_url() is used for security-purpose. -->
						<a href="<?php echo wp_logout_url(); ?>" 
							class="btn btn--small  btn--dark-orange float-left btn--with-photo">
							<span class="site-header__avatar">
								<?php 
									// avatar can be setup thru 'http://gravatar.com'
									echo get_avatar(get_current_user_id(), 60); 
								?>
							</span>
							<span class="btn__text">Log Out</span>
						</a>
				<?php }
					else { ?>
						<a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">
							Login
						</a>
						<!--  The following use WordPress function for registration, rather than site_url() -->
						<a href="<?php echo wp_registration_url(); ?>" 
									class="btn btn--small  btn--dark-orange float-left">
							Sign Up
						</a>
						<!-- site_url(/wp-signup.php) is for WordPress signup URL 
							esc_url() is used for security-purpose. -->
						<!--
						<a href="<?php //echo esc_url(site_url('/wp-signup.php')); ?>" 
									class="btn btn--small  btn--dark-orange float-left">
							Sign Up
						</a> -->
				<?php }
				?>
				 
				<a href="<?php //echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger">
					<i class="fa fa-search" aria-hidden="true"></i>
				</a>
	        </div>
	      </div>
	    </div>
	</header>