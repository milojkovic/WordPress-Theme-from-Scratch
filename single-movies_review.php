<?php
/**
 * Thi is single page for new custom post field 'movies_review'
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
					<img src="<?php the_post_thumbnail_url( 'blog-large' ); ?>" alt="<?php the_title(); ?>"
					     class="img-fluid mb-3 img-thumbnail">
				</a>
			</div>
		<?php endif; ?>

		<div class="row">
			<div class="col-lg-9">
				<?php get_template_part( 'includes/section', 'cars' ); ?>
				<?php wp_link_pages(); ?>

				<h5>About Movie</h5>
				<ul>
					<?php if ( get_field( 'director' ) ): ?>
						<li>
							Director: <?php the_field( 'director' ); ?>
						</li>
					<?php endif; ?>
					<?php if ( get_field( 'writer' ) ): ?>
						<li>
							Writer: <?php the_field( 'writer' ); ?>
						</li>
					<?php endif; ?>
					<?php if ( get_field( 'stars' ) ): ?>
						<li>
							Stars: <?php the_field( 'stars' ); ?>
						</li>
					<?php endif; ?>
					<?php if ( get_field( 'rating' ) ): ?>
						<li>
							Rating: <?php the_field( 'rating' ); ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
