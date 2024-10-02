<?php
/**
 * This is an example of creating a plugin from scratch without any CPF plugin or other helpers.
 *
 */
?>

<?php get_header(); ?>

<section class="page-wrap">

	<div class="container">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<section>
					<h1><?php the_title(); //Shows post title (movie title) ?></h1>
					<div>
						<?php the_content(); //Shows the main content of the post ?>
					</div>
				</section>

				<section>
					<h5>About Movie</h5>
					<ul>
						<?php if ( get_post_meta( get_the_ID(), '_movie_title', true ) ): ?>
							<li>
								Title: <?php echo get_post_meta( get_the_ID(), '_movie_title', true ) ?>
							</li>
						<?php endif; ?>

						<?php if ( get_post_meta( get_the_ID(), '_movie_author', true ) ): ?>
							<li>
								Author: <?php echo get_post_meta( get_the_ID(), '_movie_author', true ) ?>
							</li>
						<?php endif; ?>

						<?php if ( get_post_meta( get_the_ID(), '_movie_actors', true ) ): ?>
							<li>
								Actors: <?php echo get_post_meta( get_the_ID(), '_movie_actors', true ) ?>
							</li>
						<?php endif; ?>
					</ul>
				</section>

			<?php endwhile;
		else :
			echo '<p>No movies found.</p>';
		endif;
		?>

		<h2>Connect to the API and print data:</h2>

		<?php
		global $post;
		$post_id = get_the_ID(); // or $post->ID

		$response = wp_remote_get(
			'http://party-test.loc/wp-json/wp/v2/movies/' . $post_id,
			array(
				'headers' => array(
					'Accept'       => 'application/json',
					'Content-Type' => 'application/json'
				),
			)
		);
		//$response = wp_remote_get( 'http://party-test.loc/wp-json/wp/v2/movies/133' );

		if ( is_wp_error( $response ) ) {
			//If there is an error, print a message
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
		} else {
			//Download the response body
			$body = wp_remote_retrieve_body( $response );
			$data = json_decode( $body, true );

			//Check and print meta data if present
			if ( isset( $data['title']['rendered'] ) ) {
				echo 'Title: ' . $data['title']['rendered'] . '<br>';
			}
			if ( isset( $data['_movie_title'] ) ) {
				echo 'Movie Title: ' . $data['_movie_title'] . '<br>';
			}
			if ( isset( $data['_movie_author'] ) ) {
				echo 'Movie Author: ' . $data['_movie_author'] . '<br>';
			}
			if ( isset( $data['_movie_actors'] ) ) {
				echo 'Movie Actors: ' . $data['_movie_actors'] . '<br>';
			}

//			//Another way, decode as an object instead of array
//			$data = json_decode( $body );
//			//Access data as objects
//			echo 'Movie Title: ' . $data->_movie_title . '<br>';
		}
		?>

	</div>
</section>

<?php get_footer(); ?>
