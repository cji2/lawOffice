<!--
    The content of this file is copied from index.php.
    This file be used for home page.
    And index.php file will be used for powered generic blog listing screen.
-->
<?php get_header(); ?>

	<div class="page-banner">
	   <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg') ?>);"></div>
	    <div class="page-banner__content container t-center c-white">
	      <h2 class="headline headline--medium">Welcome to the Law Office of</h2>
	      <h1 class="headline headline--large">Alan Gudeta!</h1>
	      <h2 class="headline headline--small">Free Initial Consultation.</h2>
	      <h3 class="headline headline--small">
		  	<!-- Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in? -->
		  </h3>
		  <!--
	      <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
		  -->
	    </div>
	</div>

  	<div class="full-width-split group">
	  	<!-- 1st group of split -->	
	    <div class="full-width-split__one">
	      <div class="full-width-split__inner">
	        <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
			<!-- test123 -->
			<?php
				$today = date('Y-m-d');
				// this implement customized WordPRess Query using WP_Query().
				$homepageEvents = new WP_Query(array(
					/* set the number of events of a page.
					   '-1' value make it display all events.
					*/
					'posts_per_page' => 2,
					/* post type is event, which is definded by the file 
						..\wp-content\mu-plugin\alan-office-types.php		*/
					'post_type' => 'event',
					// this will make the event ordered by event date
					'meta_key' => 'event_date',
					// this will make the event order by custom field
					'orderby' => 'meta_value',
					'order' => 'ASC',
					/* This makes the event displayed, which excludes one in the past.
					   $today should follow the format decidecd by 'Advanced Custom Fields' plugin,
					   which is date('Y-m-d').
					*/
					'meta_query' => array(
						array(
							'key' => 'event_date',
							'compare' => '>=',
							'value' => $today
							//'type' => 'numeric'
						)
					)
				));  

				while($homepageEvents -> have_posts()) {
					$homepageEvents -> the_post(); ?>
					<!-- <li><?php //the_title(); ?></li>  -->
					<div class="event-summary">
						<a class="event-summary__date t-center" href="<?php the_permalink();?>">
							<span class="event-summary__month"> 
								<?php // this field is created by 'Custom Fields' plugins.
								//the_field('event_date'); 
								// this is PHP function, not WordPress
								$eventDate = new DateTime(get_field('event_date'));
								echo $eventDate -> format('M'); 
								?> 
							</span>
							<span class="event-summary__day">
								<?php echo $eventDate -> format('d'); ?> 
							</span>  
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
				/* this will reset the customized WordPress Query. 
					   it will reset WordPress data and global variables back to the state
					   that it was in when it made its default automatic query based on the current
					   URL right before we came along and made customized WordPress query.    */
				} wp_reset_postdata();
			?>
	        
	        <p class="t-center no-margin">
				<a href="<?php echo site_url('/events') ?>" class="btn btn--blue">
					View All Events
				</a>
			</p>

	      </div>
	    </div>
	    <!-- 2nd group of split -->
	    <div class="full-width-split__two">
	      <div class="full-width-split__inner">
	        <h2 class="headline headline--small-plus t-center">Frequenlty Asked Questions and Answers</h2>
				<?php
					// this implement customized WordPRess Query using WP_Query().
					$homepagePosts = new WP_Query(array(
						'posts_per_page' => 2
						//'post_type' => 'page'
					));  

					while ($homepagePosts -> have_posts()) {
						$homepagePosts -> the_post();  ?>
						<div class="event-summary">
							<a class="event-summary__date event-summary__date--beige t-center" 
								href="<?php the_permalink(); ?>">
								<span class="event-summary__month"> <?php the_time('M'); ?> </span>
								<span class="event-summary__day"><?php the_time('d'); ?> </span>  
							</a>
							<div class="event-summary__content">
								<h5 class="event-summary__title headline headline--tiny">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h5>

								<p> <?php 
										// this will display only the first 18 characters of contents. 
										echo wp_trim_words(get_the_content(), 18) 
									?> 
									<a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
								</p>
							</div>
						</div>
				<?php		
					/* this will reset the customized WordPress Query. 
					   it will reset WordPress data and global variables back to the state
					   that it was in when it made its default automatic query based on the current
					   URL right before we came along and made customized WordPress query.    */
					} wp_reset_postdata();
				?>
	      
	        <p class="t-center no-margin">
				<a href="<?php echo site_url('/blog') ?>" class="btn btn--yellow">
					View All FAQs
				</a>
			</p>
	      </div>
	    </div>
  	</div>

  	<div class="hero-slider">
		  <!-- 1st group of slider -->	
		  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg') ?>);">
		    <div class="hero-slider__interior container">
		      <div class="hero-slider__overlay">
		        <h2 class="headline headline--medium t-center">Immigration Services</h2>
		        <p class="t-center">Citzenship, Greed Card, Asylum ...</p>
		        <p class="t-center no-margin"><a href="echo site_url('/immigration-services')" class="btn btn--blue">Learn more</a></p>
		      </div>
		    </div>
		  </div>
		  <!-- 2nd group of slider -->	
		  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg') ?>);">
		    <div class="hero-slider__interior container">
		      <div class="hero-slider__overlay">
		        <h2 class="headline headline--medium t-center">Accident and Injury</h2>
		        <p class="t-center">First Steps after an Injury, Claims and Insurance, Liabilties</p>
		        <p class="t-center no-margin"><a href="<?php echo site_url('/accident-and-injury-services') ?>" class="btn btn--blue">Learn more</a></p>
		      </div>
		    </div>
		  </div>
		  <!-- 3rd group of slider -->	
		  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg') ?>);">
		    <div class="hero-slider__interior container">
		      <div class="hero-slider__overlay">
		        <h2 class="headline headline--medium t-center">Business Services</h2>
		        <p class="t-center">Business Formation, Corporate Compliance, Other Business Services</p>
		        <p class="t-center no-margin"><a href="<?php echo site_url('/business-services') ?>" class="btn btn--blue">Learn more</a></p>
		      </div>
		    </div>
		  </div>
	</div>

<?php 

get_footer();
?>