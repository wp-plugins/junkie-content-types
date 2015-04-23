<?php
/**
 * Testimonial metaboxes.
 */

/**
 * Registers new meta boxes.
 */
function junkie_types_register_testimonials_metaboxes() {

	// Check current screen.
	if ( 'testimonials' != get_current_screen()->post_type )
		return;

	// Register the meta box.
	add_meta_box( 
		'junkie-types-testimonials-metaboxes',
		esc_html__( 'Customer Options', 'junkie-types' ),
		'junkie_types_testimonials_metaboxes_display',
		'testimonials',
		'normal',
		'high'
	);

}
add_action( 'add_meta_boxes', 'junkie_types_register_testimonials_metaboxes' );

/**
 * Displays the content of the meta boxes.
 */
function junkie_types_testimonials_metaboxes_display( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'junkie-types-testimonials-metaboxes-nonce' ); ?>

	<?php do_action( 'junkie_types_testimonials_metaboxes_before' ); ?>

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-testimonials-website-name">
				<strong><?php _e( 'Website Name', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( "Customer's website name.", 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-testimonials-website-name" id="junkie-types-testimonials-website-name" value="<?php echo esc_attr( get_post_meta( $post->ID, 'junkie_types_testimonials_website_name', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'Google' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-testimonials-website-url">
				<strong><?php _e( 'Website URL', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( "Customer's website url", 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-testimonials-website-url" id="junkie-types-testimonials-website-url" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_testimonials_website_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'http://www.google.com/' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-testimonials-age">
				<strong><?php _e( 'Age', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( "Customer's age", 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-testimonials-age" id="junkie-types-testimonials-age" value="<?php echo esc_attr( get_post_meta( $post->ID, 'junkie_types_testimonials_age', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( '25 years' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<?php do_action( 'junkie_types_testimonials_metaboxes_after' ); ?>

	<?php
}

/**
 * Saves the metadata.
 */
function junkie_types_testimonials_save_metaboxes( $post_id, $post ) {

	if ( ! isset( $_POST['junkie-types-testimonials-metaboxes-nonce'] ) || ! wp_verify_nonce( $_POST['junkie-types-testimonials-metaboxes-nonce'], basename( __FILE__ ) ) )
		return;

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;

	$meta = array(
		'junkie_types_testimonials_website_name' => esc_attr( $_POST['junkie-types-testimonials-website-name'] ),
		'junkie_types_testimonials_website_url'  => esc_url_raw( $_POST['junkie-types-testimonials-website-url'] ),
		'junkie_types_testimonials_age'          => esc_attr( $_POST['junkie-types-testimonials-age'] ),
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'delete_post_meta', $post_id, $meta_key ) && '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'add_post_meta', $post_id, $meta_key ) && $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( current_user_can( 'edit_post_meta', $post_id, $meta_key ) && $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
	}

}
add_action( 'save_post', 'junkie_types_testimonials_save_metaboxes', 10, 2 );

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_testimonials_replace_featured_image_title() {

	// Check current screen.
	if ( 'testimonials' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'testimonials', 'side' );
    add_meta_box( 'postimagediv', __( "Customer's Photo", 'junkie-types' ), 'post_thumbnail_meta_box', 'testimonials', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_testimonials_replace_featured_image_title' );