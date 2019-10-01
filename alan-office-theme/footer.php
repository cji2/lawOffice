	<footer class="site-footer">
	    <div class="site-footer__inner container container--narrow">
			<div class="group">
				<!-- 1st group of div -->
				<div class="site-footer__col-one">
					<h1 class="school-logo-text school-logo-text--alt-color"><a href="<?php echo site_url() ?>"><strong>Alan</strong> Law Office</a></h1>
					<p><a class="site-footer__link" href="#">(301) 920-6161</a>
					<br/>817 Silver Spring Ave., Suite 204
					<br/>Siver Spring, MD 20910</p>
				</div>

				<!-- 2nd group of div -->
				<div class="site-footer__col-two-three-group">
					<div class="site-footer__col-two">
						<nav class="nav-list"> 
							
						</nav>
					</div>

					<div class="site-footer__col-three">
						<nav class="nav-list"></nav>
					</div>
				</div>

				<!-- 3rd group of div -->
				<div class="site-footer__col-four">
				  <h3 class="headline headline--small">Connect With Us</h3>
				  <nav>
					<ul class="min-list social-icons-list group">
						<li>
							<a href="https://www.facebook.com/pages/Law-Offices-of-Alan-B-Gudeta/390219964504338" class="social-color-facebook">
								<i class="fa fa-facebook" aria-hidden="true"></i>
							</a>
						</li>
						<li><a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
						<li>
							<a href="https://www.linkedin.com/in/alan-gudeta-0694a545/" class="social-color-linkedin">
								<i class="fa fa-linkedin" aria-hidden="true"></i>
							</a>
						</li>
						<li><a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				  </nav>
				</div>
			</div>
	    </div>
  	</footer>
	<!--the following part is moved to 'Script.js' file, which is dedicated to Live Search. 
		If someone disable JavaScript, the following part is meaningless, since live search
	    will not work. -->		
	<!--div class="search-overlay search-overlay--active"-->
	<!--
	<div class="search-overlay">
		<div class="search-overlay__top">
			<div class="container">
				<i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
				<input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
				<i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
			</div>
			<div class="container">
			<div id="search-overlay__results"></div>
		</div>
    </div>
	-->
<?php 
	// this will load WordPress Admin Menu Bar at the top of the page.
	wp_footer(); 
?>
</body>
</html>