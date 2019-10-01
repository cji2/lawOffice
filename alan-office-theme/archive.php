<!--This file is copied from index.php, which is the generic blog (FAQ) 
	listing screen template.  
	A page is a special type of post, so a part of page's url has "post_type=page"
-->

<?php
get_header();
?>
<div class="page-banner">
	<div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>);"></div>
	<div class="page-banner__content container container--narrow">
		<h1 class="page-banner__title"> 
			<?php 
			/* This will make all-archive-retrieval available
			   (e.g) by date (year, month, etc), author, category, etc. */
			the_archive_title();
			/*
				if (is_category()) {
                // Display category name!
                echo 'Category: '; single_cat_title();
            } 
            if (is_author()) {
                // Display author name!
				echo 'Posts by '; the_author();
            } */ ?> 
        </h1>
		<div class="page-banner__intro">
			<p><?php the_archive_description(); ?></p>
			<!-- <p>Keep up with our latest news.</p> -->
		</div>
	</div>  
</div>

<!-- This will display the blogs (FAQ)! -->
<div class="container container--narrow page-section">
	<?php
		while(have_posts()) {
			the_post(); ?>
			<div class="post-item">
			<!-- This is the headline of each FAQ blog post -->
				<h4 class="headline headline--medium headline--post-title" >
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>
			</div>
			<div class="metabox">
				<!-- This is for published date and author information -->
				<p>
					Posted by <?php the_author_posts_link(); ?> 
					on <?php the_time('F j, Y'); ?> 
					in <?php echo get_the_category_list(', '); ?> 
				</p>
			</div>
			<div class="generic-content">
				<!-- This displays a part of content for each blog post --> 
				<?php the_excerpt(); ?>
				<p><a class="btn btn--blue" href="<?php the_permalink(); ?>" > Continue reading &raquo; </a> </p>
				<br /><br />
			</div>
	<?php 
		}
		// this allows us to move to each page.
		echo paginate_links();	
	?>
</div>

<?php
get_footer();
?>



