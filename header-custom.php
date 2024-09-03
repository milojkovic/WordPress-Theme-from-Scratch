<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<title>Document</title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<header id="mytheme-page-header" class="mytheme-dark-header">

	<nav id="main-nav" class="mytheme-page-header-inner navbar navbar-expand-lg" role="navigation">

		<div class="mytheme-header-wrapper">

			<div class="header-logo">
				<a href="/">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/jbl-logo.png" alt="logo">
				</a>
			</div>

			<!-- Brand and toggle get grouped for better mobile display -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
			        aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- The WordPress Menu goes here -->
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'top-menu',
					//'menu' => 'Top Bar' //Another way
					'container_class' => 'mytheme-header-navigation collapse navbar-collapse',
					'container_id'    => 'mytheme-header-navigation',
					'menu_class'      => 'navbar-nav ml-auto',
					'menu_id'         => 'main-menu',
					'container'       => 'div',
					'depth'           => 2,
//					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
//					'walker'          => new WP_Bootstrap_Navwalker(),
				)
			);
			?>

		</div><!-- .wrapper -->

	</nav><!-- #main-nav -->

</header>


