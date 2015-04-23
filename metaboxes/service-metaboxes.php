<?php
/**
 * Service metaboxes.
 */

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_services_replace_featured_image_title() {

	// Check current screen.
	if ( 'services' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'services', 'side' );
    add_meta_box( 'postimagediv', __( 'Service Picture', 'junkie-types' ), 'post_thumbnail_meta_box', 'services', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_services_replace_featured_image_title' );