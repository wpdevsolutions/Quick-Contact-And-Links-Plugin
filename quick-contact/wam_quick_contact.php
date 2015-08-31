<?php
 
/**
 
* Plugin Name: WAM Quick Contact
 
* Plugin URI: http://www.wpdevsolutions.com/
 
* Description: Give your clients a way to quickly contact you from their WordPress Dashboard.
 
* Version: 1.0
 
* Author: Wayne Alan McWilliams
 
* Author URI: http://www.wpdevsolutions.com/
 
* License: A license name
 
*/

/// Adding the contact option to the toolbar

add_action( 'admin_bar_menu', 'wam_toolbar_quick_contact', 999 );

function wam_toolbar_quick_contact( $wp_admin_bar ) {
	$args = array(
		'id'    => 'quick_contact',
		'title' => 'Contact WPDevGuru',
		'href'  => 'http://www.wpdev.guru/contact',
	);
	$wp_admin_bar->add_node( $args );
}


//////////////////////////////////////////////////////////////


/// Adding the quick option links to the toolbar

add_action( 'admin_bar_menu', 'wam_toolbar_quick_menu', 1000 );

function wam_toolbar_quick_menu( $wp_admin_bar ) {

	$option_menus = array(
		array(
			'id'    => 'quick_menu',
			'title' => 'Quick Menu',
		),
		array(
			'id'    => 'add_media',
			'title' => 'Add Media',
			'href'  => admin_url() . 'upload.php',
			'parent' => 'quick_menu'
		),
		array(
			'id'    => 'add_user',
			'title' => 'Add User',
			'href'  => admin_url() . 'user-new.php',
			'parent' => 'quick_menu'
		),
		array(
			'id'    => 'edit_categories',
			'title' => 'Edit Categories',
			'href'  => admin_url() . 'edit-tags.php?taxonomy=category',
			'parent' => 'quick_menu'
		)
	);

	foreach( $option_menus as $option_menu ) {
		$wp_admin_bar->add_node( $option_menu );
	}
	
}

//////////////////////////////////////////////////////////////


/// Enqueue stylesheet

function wam_dashboard_widget_display_enqueues( $hook ) {
	if( 'index.php' != $hook ) {
		return;
	}

	wp_enqueue_style( 'dashboard-widget-styles', plugins_url( '', __FILE__ ) . '/widgets.css' );
}

add_action( 'admin_enqueue_scripts', 'wam_dashboard_widget_display_enqueues' );


//////////////////////////////////////////////////////////////

/// Adding the contact dashboard widget

function wam_register_dashboard_widget() {
 	global $wp_meta_boxes;

	wp_add_dashboard_widget(
		'wam_dashboard_widget',
		'Need Assistance? Contact Us!',
		'wam_dashboard_widget_display'
	);

 	$dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

	$wam_widget = array( 'wam_dashboard_widget' => $dashboard['wam_dashboard_widget'] );
 	unset( $dashboard['wam_dashboard_widget'] );

 	$sorted_dashboard = array_merge( $wam_widget, $dashboard );
 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action( 'wp_dashboard_setup', 'wam_register_dashboard_widget' );

function wam_dashboard_widget_display() {
	?>
    <h1>Your satisfaction is very important to us!</h1>
	<p>
	Please feel free to contact us anytime. Our business hours are from <strong>8am to 6pm</strong> Monday - Friday and will respond to your issue as soon as we can.
	</p>
    <h2>Contact us by:</h2>
	<p>
	<strong>Phone: </strong><a href="tel:+2105555555" title="Contact us by phone">210-555-5555</a>
	</p>
	<p>
	<strong>Email: </strong><a href="mailto:info@wpdev.guru" title="Contact us by email">info@wpdev.guru</a>
	</p>
	<?php
}


////////////////////////////////////////////////////

