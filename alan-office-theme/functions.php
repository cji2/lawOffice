<?php

/* the following is for whole website setting to load our JavaScript file and CSS file. */
function alan_office_files() {
	/* NULL means that there is no dependency.
	   if we use modular setup, jQuery can be setup with NULL option.  	*/
	wp_enqueue_script('main-law-office-js', get_theme_file_uri('js/scripts-bundled.js'), 
						NULL, microtime(), true);
	// this has the dependency of jQuery
	/* so, WordPress will automatically load jQuery.						
	wp_enqueue_script('main-law-office-js', get_theme_file_uri('js/scripts-bundled.js'), 
						array('jQuery'), microtime(), true);  */
	wp_enqueue_style('custom-google-fonts', 
						'//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', 
						'//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('office_main_styles', get_stylesheet_uri(), NULL, microtime());
	// wp_enqueue_script();
	/* when we use local server or web server on Internet, WordPress landing page URL can vary.
	   So, we need to generalize the URL, which is used to json REST api in 'Search.js' file.
	   In this case, WordPress function, wp_localize_script is used.  
	   the data of array() will be dsiplayed on the landing web page, which can be checked by
	   "view source page' option of web browser. 
	   lawOfficeData will be an object and root_url as its property, which can be accessed by
	   'Search.js' file */
	wp_localize_script('main-law-office-js', 'lawOfficeData', array(
		'root_url' => get_site_url(),

	));
}

add_action('wp_enqueue_scripts', 'alan_office_files');

function alan_office_features() {

	// this registers main navigation menu in WordPress.
	// this will activate (display) 'menu' option on Appearance menu of WordPress Dashboard.
	//register_nav_menu('headerMenuLocation', 'Header Menu Location');

	// this registers footer navigation menu in WordPress.
	// this will activate (display) 'menu' option on Appearance menu of WordPress Dashboard.
	//register_nav_menu('footerMenuLocationOne', 'Footer Location One');
	//register_nav_menu('footerMenuLocationTwo', 'Footer Location Two');

	// this is used for <title> </title> in <head></head> area.
	// <title> tag's content follows the title of page automatcially by WordPress.
	add_theme_support('title-tag');
}

add_action('after_setup_theme', 'alan_office_features');

// redirect subscriber accounts out of admin and onto homepage.
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {

	$ourCurrentUser = wp_get_current_user();
	// the following condition means any clinet users of Alan law office, not staffs.
	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {

	$ourCurrentUser = wp_get_current_user();
	// the following condition means any clinet users of Alan law office, not staffs.
	if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}

// customize login screen!
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
	return esc_url(site_url('/'));
}

/* the following is for just login page to load our CSS file. */
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
	wp_enqueue_style('office_main_styles', get_stylesheet_uri());
	wp_enqueue_style('custom-google-fonts', 
						'//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

function ourLoginLogo() {
	return get_bloginfo('name');
}

add_filter('login_headertitle', 'ourLoginLogo');

function ourLoginTitle() {
	return get_bloginfo('name');
}

add_filter('login_headertitle', 'ourLoginTitle');

?>