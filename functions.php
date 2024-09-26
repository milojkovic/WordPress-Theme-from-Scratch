<?php

// Load Stylesheets
function load_css() {

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all' );
	wp_enqueue_style( 'bootstrap' );

	wp_register_style( 'magnific', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), false, 'all' );
	wp_enqueue_style( 'magnific' );

	wp_register_style( 'main', get_template_directory_uri() . '/assets/css/main.css', array(), false, 'all' );
	wp_enqueue_style( 'main' );
}

add_action( 'wp_enqueue_scripts', 'load_css' );

// Load Javascript
function load_js() {
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', false, true );
	wp_enqueue_script( 'bootstrap' );

	wp_register_script( 'magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', 'jquery', false, true );
	wp_enqueue_script( 'magnific' );

	wp_register_script( 'custom', get_template_directory_uri() . '/assets/js/dist/custom.js', 'jquery', false, true );
	wp_enqueue_script( 'custom' );
}

add_action( 'wp_enqueue_scripts', 'load_js' );

// Theme Options
add_theme_support( 'menus' ); // Allow to add menu in bar
add_theme_support( 'post-thumbnails' ); // Allow to add images in single post
add_theme_support( 'widgets' ); // Allow to add Widgets

// Menus
register_nav_menus(

	array(
		'top-menu'    => 'Top Menu Location',
		'mobile-menu' => 'Mobile Menu Location',

	)
);

// Custom Image Sizes
add_image_size( 'blog-large', 800, 600, false );
add_image_size( 'blog-small', 300, 200, true );

// Register Sidebars
function my_sidebars() {

	register_sidebar(
		array(
			'name'         => 'Page Sidebar',
			'id'           => 'page-sidebar',
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>'
		)
	);

	register_sidebar(
		array(
			'name'         => 'Blog Sidebar',
			'id'           => 'blog-sidebar',
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>'
		)
	);
}

add_action( 'widgets_init', 'my_sidebars' );


// My custom post types
function my_first_post_type() {

	$args = array(
		'labels'       => array(
			'name'          => 'Cars',
			'singular_name' => 'Car',
		),
		'hierarchical' => true,
		//If is false will be more like posts
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-car',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
	);

	register_post_type( 'cars', $args );
}

add_action( 'init', 'my_first_post_type' );
//This hook 'init' is load just before the website load, before header loaded on the website

//Taxonomy is like category
function my_first_taxonomy() {

	$args = array(

		'labels' => array(
			'name'          => 'Brands',
			'singular_name' => 'Brand',
		),

		'public'       => true,
		'hierarchical' => true,
		//If is false will be more like tags
	);

	register_taxonomy( 'brands', array( 'cars' ), $args );

}

add_action( 'init', 'my_first_taxonomy' );
add_action( 'wp_ajax_enquiry', 'enquiry_form' );
add_action( 'wp_ajax_nopriv_enquiry', 'enquiry_form' ); //Use for user who not login


//Function for contact form
function enquiry_form() {

//wp_send_json_success('Works!'); //Testing and manipulate wit ajax post data

	if ( ! wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {

		wp_send_json_error( 'Nonce is incorrect', 401 );
		die();
	}

	$formdata = [];
	wp_parse_str( $_POST['enquiry'], $formdata );

	// Admin email
	$admin_email = get_option( 'admin_email' );

	// Email headers
	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'From: My Website <' . $admin_email . '>';
	$headers[] = 'Reply-to:' . $formdata['email'];

	// Who are we sending the email to?
	$send_to = $admin_email;

	// Subject
	$subject = "Enquiry from " . $formdata['fname'] . ' ' . $formdata['lname'];

	// Message
	$message = '';

	foreach ( $formdata as $index => $field ) {
		$message .= '<strong>' . $index . '</strong>: ' . $field . '<br />';
	}

	try {
		if ( wp_mail( $send_to, $subject, $message, $headers ) ) {
			wp_send_json_success( 'Email sent' );
		} else {
			wp_send_json_error( 'Email error' );
		}
	} catch ( Exception $e ) {
		wp_send_json_error( $e->getMessage() );
	}

	wp_send_json_success( $formdata['fname'] );
}


/**
 * Register Custom Navigation Walker
 */
//function register_navwalker() {
//	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
//}
//
//add_action( 'after_setup_theme', 'register_navwalker' );

//Their we use SMTP instead basic php mailer, because dont go in the span. Wordpress use server which is not proporli
// setup SPF record, end because of dat mail never cam or go in the span folder
add_action( 'phpmailer_init', 'custom_mailer' );
function custom_mailer( PHPMailer $phpmailer ) {

	$phpmailer->SetFrom( 'milos@gmail.com', 'Milos' );
	$phpmailer->Host       = 'email-smtp.milos.amazonaws.com';
	$phpmailer->Port       = 587;
	$phpmailer->SMTPAuth   = true;
	$phpmailer->SMTPSecure = 'tls';
	$phpmailer->Username   = SMTP_LOGIN;
	$phpmailer->Password   = SMTP_PASSWORD;
	$phpmailer->IsSMTP();
}

//Shortcodes is little snippets that you can put into your content editor that will run a piece of code
//Crete simple shortcodes
function my_shortcode( $atts, $content = null, $tag = '' ) {
	ob_start(); //Output buffering, not allow to echo twice on page
	print_r( $content );
	set_query_var( 'attributes', $atts );//With this function calling $atts
	get_template_part( 'includes/latest', 'cars' );

	return ob_get_clean();
}

add_shortcode( 'latest_cars', 'my_shortcode' );

//Crete simple shortcodes
function my_phone() {
	return '<a href="tel:0643457860">064/3457-860</a>';
}

add_shortcode( 'phone', 'my_phone' );

//Custom search for cars
function search_query() {

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$args = [
		'paged'          => $paged,
		'post_type'      => 'cars',
		'posts_per_page' => 1,
		'tax_query'      => [],
		'meta_query'     => [
			'relation' => 'AND',
		],
	];

	if ( isset( $_GET['keyword'] ) ) {

		if ( ! empty( $_GET['keyword'] ) ) {
			$args['s'] = sanitize_text_field( $_GET['keyword'] );
		}
	}

	if ( isset( $_GET['brand'] ) ) {
		if ( ! empty( $_GET['brand'] ) ) {
			$args['tax_query'][] = [
				'taxonomy' => 'brands',
				'field'    => 'slug',
				'terms'    => array( sanitize_text_field( $_GET['brand'] ) )

			];
		}
	}

	if ( isset( $_GET['price_above'] ) ) {
		if ( ! empty( $_GET['price_above'] ) ) {
			$args['meta_query'][] = array(
				'key'     => 'price',
				'value'   => sanitize_text_field( $_GET['price_above'] ),
				'type'    => 'numeric',
				'compare' => '>='
			);
		}
	}

	if ( isset( $_GET['price_below'] ) ) {
		if ( ! empty( $_GET['price_below'] ) ) {

			$args['meta_query'][] = array(
				'key'     => 'price',
				'value'   => sanitize_text_field( $_GET['price_below'] ),
				'type'    => 'numeric',
				'compare' => '<='
			);

		}
	}

	return new WP_Query( $args );
}

//Include file for custom gutenberg block
include_once get_template_directory() . '/includes/blocks/favorite-quote/block-favorite-quote.php';




