<?php
/**
 * There is function for oru shortcodes'
 *
 */
?>

<?php

$attributes = get_query_var( 'attributes' ); //This function refere on function set_query_var

$args = [
	'post_type'      => 'cars',
	'posts_per_page' => 0,
	'tax_query'      => [],
	'meta_query'     => [],
//'meta_key' => 'color', //Show specific car
//'meta_value' => 'red'
];

if ( isset( $attributes['price_below'] ) ) {
	$args['meta_query'][] = array(
		'key'     => 'price',
		'value'   => $attributes['price_below'],
		'type'    => 'numeric',
		'compare' => '<='
	);
}

if ( isset( $attributes['price_above'] ) ) {
	$args['meta_query'][] = array(
		'key'     => 'price',
		'value'   => $attributes['price_above'],
		'type'    => 'numeric',
		'compare' => '>='
	);
}

if ( isset( $attributes['color'] ) ) {
	$args['meta_query'][] = array(
		'key'     => 'color',
		'value'   => $attributes['color'],
		'compare' => '='
	);
}

if ( isset( $attributes['brand'] ) ) {
	$args['tax_query'][] = [
		'taxonomy' => 'brands',
		'field'    => 'slug',
		'terms'    => array( $attributes['brand'] ),
	];
}

$query = new WP_Query( $args );
?>

<?php if ( $query->have_posts() ): ?>

	<?php while ( $query->have_posts() )  : $query->the_post(); ?>

		<div class="card mb-3">

			<div class="card-body">

				<a href="<?php the_post_thumbnail_url( 'blog-large' ); ?>">
					<img src="<?php the_post_thumbnail_url( 'blog-large' ); ?>" alt="<?php the_title(); ?>" class="img-fluid mb-3 img-thumbnail">
				</a>

				<h3><?php the_title(); ?></h3>

				<h5>Registration:<?php the_field( 'registration' ); ?></h5>

				<h5>Color:<?php the_field( 'color' ); ?></h5>

			</div>

		</div>

	<?php endwhile; ?>

<?php endif; ?>
