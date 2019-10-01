<!-- This is only for archive of event post type.
    In case of archive.php is for generic archive (FAQs blog)
    This file is copied from index.php, which is the generic blog (FAQ) 
	listing screen template.  A page is a special type of post, so a part 
    of page's url has "post_type=page" -->
<?php
get_header();
?>
<div class="page-banner">
	<div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>);"></div>
	<div class="page-banner__content container container--narrow">
		<h1 class="page-banner__title"> 
            All Events
            <?php 
			/* This will make all-archive-retrieval available
			   (e.g) by date (year, month, etc), author, category, etc. */
			// the_archive_title();
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
            <!--
			<p><?php the_archive_description(); ?></p> -->
			<p>See what is going on at Alan law office!</p>
			<!-- <p>Keep up with our latest news.</p> -->
		</div>
	</div>  
</div>

<!-- This will display the blogs (FAQ)! -->
<div class="container container--narrow page-section">
	<?php
		while(have_posts()) {
			the_post(); ?>
			<div class="event-summary">
                <a class="event-summary__date t-center" href="<?php the_permalink();?>">
                    <span class="event-summary__month"> 
                        <?php // this field is created by 'Custom Fields' plugins.
								//the_field('event_date'); 
								// this is PHP function, not WordPress
								$eventDate = new DateTime(get_field('event_date'));
								echo $eventDate -> format('M');  ?> 
                    </span>
                    <span class="event-summary__day"><?php echo $eventDate -> format('d'); ?> </span>  
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h5>
                    <p> <?php 
                        // this will display only the first 18 characters of contents. 
                        echo wp_trim_words(get_the_content(), 18) ?>
                        <a href="<?php the_permalink(); ?>" class="nu gray">
                            Learn more
                        </a>
                    </p>
                </div>
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



