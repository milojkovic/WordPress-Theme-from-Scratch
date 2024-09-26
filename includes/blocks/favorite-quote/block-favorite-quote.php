<?php
function favorite_quote_block_register() {
	//Script registration
	wp_register_script(
		'favorite-quote-block-script',
		get_template_directory_uri() . '/includes/blocks/favorite-quote/block.js',
		array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n', 'wp-server-side-render' ),
		filemtime( get_template_directory() . '/includes/blocks/favorite-quote/block.js' )
	);

	//Block registration
	register_block_type( 'custom/favorite-quote', array(
		'editor_script'   => 'favorite-quote-block-script',
		'render_callback' => 'favorite_quote_block_render',
		'attributes'      => array(
			'quote' => array(
				'type'    => 'string',
				'default' => '',
			),
		),
	) );
}

add_action( 'init', 'favorite_quote_block_register' );

//Server-side render function
function favorite_quote_block_render( $attributes ) {
	if ( ! empty( $attributes['quote'] ) ) {
		return '<blockquote class="mytheme-page-quote">' . esc_html( $attributes['quote'] ) . '</blockquote>';
	} else {
		return '<blockquote>' . __( 'Enter your favorite movie quote.', 'textdomain' ) . '</blockquote>';
	}

//	$quote = isset( $attributes['quote'] ) ? esc_html( $attributes['quote'] ) : 'No quote provided.';
//	return sprintf( '<blockquote>%s</blockquote>', $quote );
}
