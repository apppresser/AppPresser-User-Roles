<?php
/*
Plugin Name: AppPresser User Roles - Template Plugin (Random User Role)
Plugin URI: http://apppresser.com
Description: Modify this plugin to integrate user roles which will be used in an AppPresser app.
Version: 1.0.0
Author: [You]
License: MIT
*/

/**
 * Example:
 * Add your own logic to set which role you want the user to have in the app
 * Example here randomly chooses between admin and member with each login
 * 
 * @param $user_id integer The current user's ID
 * 
 * @return $role string Any role you wish this user to have in the app.
 */
function get_app_user_role( $user_id ) {

	$role = (rand(0, 1)) ? 'admin' : 'member';

	return $role;
}

/**
 * Adds a role to the AppPresser login data which gets sent back to the app
 * 
 * @param $login_data array The existing login data just prior to being sent to the app
 * @param $user_id integer The current user's ID
 * 
 * @return $login_data array
 */
function appp_login_data_add_role( $login_data, $user_id ) {

	$role = get_app_user_role( $user_id );

	if( $role ) {
		$login_data['role'] = $role;
	}

	return $login_data;
}
add_filter( 'appp_login_data', 'appp_login_data_add_role', 10, 2 );