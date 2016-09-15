<?php
/*
	These functions relate to protecting a page with Shibboleth.
*/

// Check valid UFL.EDU email.
if ( !function_exists('is_uf_email') ) {
	function is_uf_email($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {		
			if(preg_match('/ufl.edu$/i', $email))
				return true;
			else
				return false;
		}
		else {
			return false;
		}
	}
}

// Check if a vaild REMOTE_USER is set.
function ufl_shibboleth_valid_user() {

	$user = ufclas_check_server_auth_value('REMOTE_USER');
		
	if ( is_uf_email( $user ) ) {
		return true;
	} else {
		return false;
	}
}

// Get current protocol from options, fallback to server variable.
function ufl_get_protocol() {
	if ( is_ssl() ) {
		return 'https://';
	} else {
		return 'http://';
	}
}

// Create a button to log in to Shib.
function ufl_shibboleth_login_button() {
	global $post;
	$url_parts = parse_url( get_permalink($post->ID) );
	echo '<p><a class="btn btn-lg" href="'.ufl_get_protocol().$_SERVER['SERVER_NAME'].'/Shibboleth.sso/Login?target='.urlencode( ufl_get_protocol().$url_parts['host'].$url_parts['path'] ).'">Login with GatorLink</a></p>';
}

// Check if authed with Shib.
function ufl_check_shibboleth_auth() {
	if ( ufl_shibboleth_valid_user() ) {
		return true;
	} else {
		return false;
	}
}

// Check if authed with Shib.
function ufclas_check_shibboleth_group_auth( $postid ) {
	
	if ( !ufl_shibboleth_valid_user() ) {
		return false;
	} else {
		// Valid GatorLink User
		$group_meta = get_post_meta( $postid, 'custom_meta_visitor_auth_groups', true );
		
		$user_groups = ufclas_check_server_auth_value('UFADGroupsDN');

		if( empty($group_meta) || empty($user_groups) ){
			return false;
		}
		else {
			// Create an array of groups and check against groups
			$group_meta = str_replace( ' ', '', $group_meta );
			$valid_groups = explode(',', trim($group_meta, ' ,'));
			
			foreach($valid_groups as $group){
				if(stripos($user_groups, 'CN='.$group.',') !== false){
					return true;	
				}
			}
			
			// If not in any valid groups, reject user
			return false;	
		}
	}
}

// Check the auth level for vistors of the page.
function ufl_check_page_visitor_level($postid) {
	// Check if Shib is required for this page.
	$custom_meta = get_post_custom($postid);
	
	$custom_visitor_auth_level = ( isset($custom_meta['custom_meta_visitor_auth_level']) )? $custom_meta['custom_meta_visitor_auth_level'][0]:'';
	switch ($custom_visitor_auth_level) {
		case 'WordPress Users':
			$custom_visitor_auth_level = '1';
			break;
		case 'GatorLink Users':
			$custom_visitor_auth_level = '2';
			break;
		case 'UFAD Group':
			$custom_visitor_auth_level = '3';
			break;
		case 'Public':
		default:
			$custom_visitor_auth_level = '0';
			break;
	}
	return $custom_visitor_auth_level;
}

// Check for authenticated user.
function ufl_check_authorized_user($postid) {
	switch (ufl_check_page_visitor_level($postid)) {
		case '0':
			return true;
			break;
		case '1':
			if ( is_user_logged_in() ) {
				//define( 'DONOTCACHEPAGE', 1 );
				return true;
			} else {
				return false;
			}
			break;
		case '2':
			if ( ufl_check_shibboleth_auth($postid) ) {
				//define( 'DONOTCACHEPAGE', 1 );
				return true;
			} else {
				return false;
			}
			break;
		case '3':
			if ( ufclas_check_shibboleth_group_auth($postid) ) {
				//define( 'DONOTCACHEPAGE', 1 );
				return true;
			} else {
				return false;
			}
			break;
		default:
			return false;
			break;
	}

}
/**
 * Check the server values for authenticated users in both the variable and REDIRECT_ variable.
 */
function ufclas_check_server_auth_value( $var ){
	if( isset($_SERVER[$var]) ){
		return $_SERVER[$var];
	}
	elseif( isset($_SERVER['REDIRECT_'.$var]) ) {
		return $_SERVER['REDIRECT_'.$var];
	}
	else{
		return '';	
	}
}

?>
