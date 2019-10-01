<!-- This is just for individual blog(FAQ) posts. 
	(cf) page.php is for individual pages.
	     and page is a special type of post.
-->
<?php
 get_header();

 while(have_posts()) {
	the_post(); ?>
	<div class="page-banner">
		<div class="page-banner__bg-image" 
			style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>);">
		</div>
		<div class="page-banner__content container container--narrow">
			<h1 class="page-banner__title"><?php the_title(); ?></h1>
			<div class="page-banner__intro">
				<!-- <p>Don't Forget To Replace Me Later!</p> -->
			</div>
		</div>  
	</div>
	<!-- This displays the main content of each blog post (FAQ) -->
	<div class="container container--narrow page-section">
		<div class="metabox metabox--position-up metabox--with-home-link">
			<p>
				<!-- the link of parent page, 
					which is made by get_permlink() that gets the argument as the ID of the page
				-->
				<a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>">
					<i class="fa fa-home" aria-hidden="true">
					</i> 
					<!-- echo the title of parent page -->
					FAQ Home <?php //echo get_the_title($theParent); ?>
				</a> 
					<!-- echo the title of current page -->
				<span class="metabox__main">
					Posted by <?php the_author_posts_link(); ?> 
					on <?php the_time('F j, Y'); ?> 
					in <?php echo get_the_category_list(', '); ?>
				</span>
			</p>
		</div>
		<div class="generic-content">
			<?php the_content(); ?>
		</div>
	</div>
	 
	<h2><?php //the_title() ?></h2>
	<?php //the_content(); ?>
<?php }
 get_footer();
?>