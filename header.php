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

<header id="mytheme-page-header">

	<nav id="main-nav" class="mytheme-page-header-inner navbar navbar-expand-md" role="navigation">

		<div class="mytheme-header-wrapper navigation container-fluid">

			<div class="header-logo">
				<a href="/">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/jbl-logo.png" alt="logo">
				</a>
			</div>

			<!-- Brand and toggle get grouped for better mobile display -->
			<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- The WordPress Menu goes here -->
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'top-menu',
					//'menu' => 'Top Bar' //Another way
					'container_class' => 'mytheme-header-navigation navbar-collapse collapse',
					'container_id'    => 'navbarNav',
					'menu_class'      => 'navbar-nav ml-auto',
					'menu_id'         => 'main-menu',
					'container'       => 'div',
					'depth'           => 2,
				)
			);
			?>

		</div><!-- .wrapper -->
	</nav><!-- #main-nav -->

</header>


