<?php
/**
 * Thi is single page for new custom post field 'car'
 *
 */
?>

<?php get_header(); ?>

<section class="page-wrap">

	<div class="container">

		<h1><?php the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ): ?>
			<div class="gallery">
				<a href="<?php the_post_thumbnail_url( 'blog-large' ); ?>">
					<img src="<?php the_post_thumbnail_url( 'blog-large' ); ?>" alt="<?php the_title(); ?>" class="img-fluid mb-3 img-thumbnail">
				</a>
			</div>
		<?php endif; ?>

<!--		Gallery work with CPF PRO -->
		<?php
		$gallery = get_field( 'gallery' );
		if ( $gallery ):?>
			<div class="gallery mb-5">
				<?php foreach ( $gallery as $image ): ?>
					<a href="<?php echo $image['sizes']['blog-large']; ?>"><img src="<?php echo $image['sizes']['blog-small']; ?>" class="img-fluid img-thumbnail">
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="row">

			<div class="col-lg-7">
				<?php get_template_part( 'includes/section', 'cars' ); ?>
				<?php wp_link_pages(); ?>

				<?php get_template_part( 'includes/form', 'enquiry' ); ?>
			</div>

			<div class="col-lg-5">
				<!-- On this way we display custom post fields on page. Thi is very, very basic WP functionality to display CPF, and doesn't give you to flexibility-->
				<!--	<ul>-->
				<!--		--><?php //if ( get_post_meta( $post->ID, 'Color', true ) ): ?>
				<!--			<li>-->
				<!--				Color: --><?php //echo get_post_meta( $post->ID, 'Color', true ) ?>
				<!--			</li>-->
				<!--		--><?php //endif; ?>
				<!---->
				<!--		--><?php //if ( get_post_meta( $post->ID, 'Registration', true ) ): ?>
				<!--			<li>-->
				<!--				Registration: --><?php //echo get_post_meta( $post->ID, 'Registration', true ) ?>
				<!--			</li>-->
				<!--		--><?php //endif; ?>
				<!--	</ul>-->

				<!--	Here is installed plugin 'advance custom field' and function above 'get_post_meta' doesn't work, create on ease way -->
				<h3>Specifications</h3>
				<ul>
					<li>
						Color: <?php the_field( 'color' ); ?>
					</li>

					<li>
						Registration: <?php the_field( 'registration' ); ?>
					</li>
				</ul>

				<h3>Relationship</h3>

				<?php
				$featured_posts = get_field( 'features' );
				if ( $featured_posts ): ?>
					<ul>
						<?php foreach ( $featured_posts as $post ):
							// Setup this post for WP functions (variable must be named $post).
							setup_postdata( $post ); ?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>

				<?php endif; ?>

				<h3>Features</h3>
				<ul>
					<!-- This used in pro version, I use repeater.-->
					<?php //if ( have_rows( 'features' ) ): ?>
					<!---->
					<!--	--><?php
					//	while ( have_rows( 'features' ) ): the_row();
					//		$feature = get_sub_field( 'features' );
					//		?>
					<!--		<li>-->
					<!--			--><?php //echo $feature; ?>
					<!--		</li>-->
					<!--	--><?php //endwhile; ?>
					<!---->
					<?php //endif; ?>
				</ul>

			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
