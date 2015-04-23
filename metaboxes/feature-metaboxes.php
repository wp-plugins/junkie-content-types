<?php
/**
 * Service metaboxes.
 */

/**
 * Replace 'Featured Image' title.
 */
function junkie_types_features_replace_featuresd_image_title() {

	// Check current screen.
	if ( 'features' != get_current_screen()->post_type )
		return;

    remove_meta_box( 'postimagediv', 'features', 'side' );
    add_meta_box( 'postimagediv', __( 'Feature Picture', 'junkie-types' ), 'post_thumbnail_meta_box', 'features', 'side', 'default' );

}
add_action( 'do_meta_boxes', 'junkie_types_features_replace_featuresd_image_title' );