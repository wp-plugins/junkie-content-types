<?php
/**
 * Doctor metaboxes.
 */

/**
 * Registers new meta boxes.
 */
function junkie_types_register_doctors_metaboxes() {

	// Check current screen.
	if ( 'doctors' != get_current_screen()->post_type )
		return;

	// Register the meta box.
	add_meta_box( 
		'junkie-types-doctors-metaboxes',
		esc_html__( 'Doctor Options', 'junkie-types' ),
		'junkie_types_doctors_metaboxes_display',
		'doctors',
		'normal',
		'high'
	);

}
add_action( 'add_meta_boxes', 'junkie_types_register_doctors_metaboxes' );

/**
 * Displays the content of the meta boxes.
 */
function junkie_types_doctors_metaboxes_display( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'junkie-types-doctors-metaboxes-nonce' ); ?>

	<?php do_action( 'junkie_types_doctors_metaboxes_before' ); ?>

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctors-education">
				<strong><?php _e( 'Education', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( "The doctor's education", 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctors-education" id="junkie-types-doctors-education" value="<?php echo esc_attr( get_post_meta( $post->ID, 'junkie_types_doctors_education', true ) ); ?>" size="30" style="width: 99%;" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctors-work-days">
				<strong><?php _e( 'Work Days', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( "The doctor's work days", 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctors-work-days" id="junkie-types-doctors-work-days" value="<?php echo esc_attr( get_post_meta( $post->ID, 'junkie_types_doctors_work_days', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'Wednesday, Thursday, Friday' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctors-twitter">
				<strong><?php _e( 'Twitter', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Twitter URL', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctors-twitter" id="junkie-types-doctors-twitter" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctors_twitter_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://twitter.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctors-facebook">
				<strong><?php _e( 'Facebook', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Facebook URL', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctors-facebook" id="junkie-types-doctors-facebook" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctors_facebook_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'http://www.facebook.com/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctors-gplus">
				<strong><?php _e( 'Google Plus', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'Google Plus URL', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctors-gplus" id="junkie-types-doctors-gplus" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctors_googleplus_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://plus.google.com/+username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<div id="junkie-types-block">

		<div class="junkie-types-label">
			<label for="junkie-types-doctors-linkedin">
				<strong><?php _e( 'LinkedIn', 'junkie-types' ); ?></strong><br />
				<span class="description"><?php _e( 'LinkedIn URL', 'junkie-types' ); ?></span>
			</label>
		</div>

		<div class="junkie-types-input">
			<input type="text" name="junkie-types-doctors-linkedin" id="junkie-types-doctors-linkedin" value="<?php echo esc_url( get_post_meta( $post->ID, 'junkie_types_doctors_linkedin_url', true ) ); ?>" size="30" style="width: 99%;" placeholder="<?php echo esc_attr( 'https://www.linkedin.com/in/username' ); ?>" />
		</div>

	</div><!-- #junkie-types-block -->

	<?php do_action( 'junkie_types_doctors_metaboxes_after' ); ?>

	<?php
}

/**
 * Saves the metadata.
 */
function junkie_types_doctors_save_metaboxes( $post_id, $post ) {

	if ( ! isset( $_POST['junkie-types-doctors-metaboxes-nonce'] ) || ! wp_verify_nonce( $_POST['junkie-types-doctors-metaboxes-nonce'], basename( __FILE__ ) ) )
		return;

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return;

	$meta = array(
		'junkie_types_doctors_education'      => esc_attr( $_POST['junkie-types-doctors-education'] ),
		'junkie_types_doctors_work_days'      => esc_attr( $_POST['junkie-types-doctors-work-days'] ),
		'junkie_types_doctors_twitter_url'    => esc_url_raw( $_POST['junkie-types-doctors-twitter'] ),
		'junkie_types_doctors_facebook_url'   => esc_url_raw( $_POST['junkie-types-doctors-facebook'] ),
		'junkie_types_doctors_googleplus_url' => esc_url_raw( $_POST['junkie-types-doctors-gplus'] ),
		'junkie_types_doctors_linkedin_url'   => esc_url_raw( $_POST['junkie-types-doctors-linkedin'] )
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
add_action( 'save_post', 'junkie_types_doctors_save_metaboxes', 10, 2 );

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_doctors_replace_featured_image_title() {

	// Check current screen.
	if ( 'doctors' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'doctors', 'side' );
    add_meta_box( 'postimagediv', __( "Doctor's Photo", 'junkie-types' ), 'post_thumbnail_meta_box', 'doctors', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_doctors_replace_featured_image_title' );