<!-- this is for individual pages 
	(cf) single.php is for individual posts.
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
		        	<p>Don't Forget To Replace Me Later!</p>
		      	</div>
		    </div>  
		</div>

		<div class="container container--narrow page-section">

			<?php
				// echo wp_get_post_parent_id(get_the_ID());
				// echo get_the_ID();
				// if (wp_get_post_parent_id(get_the_ID())) {
				// 	echo "I am a child page.";
				// }
			?>

			<?php
				// echo wp_get_post_parent_id(get_the_ID());
				// echo get_the_ID();

				// The ID of parent page.
				$theParent = wp_get_post_parent_id(get_the_ID());

				if ($theParent) {  ?>
					<div class="metabox metabox--position-up metabox--with-home-link">
				      	<p>
				      		<!-- the link of parent page, 
				      			which is made by get_permlink() that gets the argument as the ID of the page
				      		-->
				      		<a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>">
				      			<i class="fa fa-home" aria-hidden="true">
				      			</i> 
				      			<!-- echo the title of parent page -->
				      			Back to <?php echo get_the_title($theParent); ?>
				      		</a> 
				      			<!-- echo the title of current page -->
				      		<span class="metabox__main"><?php the_title(); ?></span>
				      	</p>
				    </div>
				<?php    
				}
			?>

			<!--   The following link will be displayed only when the current page has parent page or children page-->
			<?php 
				/* get_pages() is the fucntion of WordPress just to get the value of memory, concerning all pages.
				   It returns children pages only when current page is parent. If it doesn't have any pareent pages,
				   it returns NULL. 	*/
				$testArray = get_pages(array(
					'child_of' => get_the_ID()
				));

				if($theParent or $testArray) { ?>

			    <!-- Page Link To Navigate between Parent and Children Pages -->
			    <div class="page-links">
			      	<h2 class="page-links__title">
			      		<a href="<?php echo get_permalink($theParent); ?>">
			      			<?php echo get_the_title($theParent); ?>
			      		</a>
			      	</h2>
			      	<ul class="min-list">
			      		<?php
			      			// this function needs argument as associative array.
			      			/*
			      			    $animalSounds = array(
			      					'cat' => 'meow', 
			      					'pig' => 'oink',
			      					'dog' => 'bark'
			      			   	);
			      			   	echo $animalSounds['dog'];
			      			*/
			      			if ($theParent) {
			      				$findChildrenOf = $theParent;
			      			} else {
			      				$findChildrenOf = get_the_ID();
			      			} 	
			      			// wp_list_pages() is the function of WordPress to display all pages.
			      			wp_list_pages(array(
			      				'title_li' => NULL,
			      				'child_of' => $findChildrenOf,
			      				'sort_column' => 'menu_order'
			      			));
			      		?>
			      		<!--
			        	<li class="current_page_item"><a href="#">Our History</a></li>
			        	<li><a href="#">Our Goals</a></li>
			        	-->
			      	</ul>
			    </div>
			<?php } ?>

		    <div class="generic-content">
		      	<?php the_content(); ?>
		    </div>

		</div>

		<!--
		<h1>This is a page not a post</h1>
		<h2><?php // the_title() ?></h2>
		<?php // the_content(); ?>   -->
<?php }
   get_footer();
?>