<?php
/**
 * Department metaboxes.
 */

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_departments_replace_featured_image_title() {

	// Check current screen.
	if ( 'departments' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'departments', 'side' );
    add_meta_box( 'postimagediv', __( "Department's Picture", 'junkie-types' ), 'post_thumbnail_meta_box', 'departments', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_departments_replace_featured_image_title' );