<?php
/**
 * Plugin Name: Site Protection
 * Plugin URI: http://wordpress.org/extend/plugins/presslabs-site-protection/
 * Description: Site protection plugin for dev instances to avoid indexing by search engines. Doesn't allow access to the site without being logged-in.
 * Version: 1.0
 * Author: Presslabs
 * Author URI: http://www.presslabs.com/
 */

add_action( 'template_redirect', 'presslabs_site_protection_walled_garden' );
function presslabs_site_protection_walled_garden() {
	if ( ! is_user_logged_in() ) {
		header( 'HTTP/1.1 403 Forbidden' );
		?><html>
		<head>
			<title><?php _e( 'Login protection', 'presslabs-site-protection' ); ?></title>
			<meta http-equiv="refresh" content="2; URL=/wp-login.php">
			<meta name="keywords" content="automatic redirection">
			<?php wp_head(); ?>
		</head>
		<body><?php echo __( "If your browser doesn't automatically go there within a few seconds, you may want to click <a href='/wp-login.php'>to login</a> manually", 'presslabs-site-protection' ) . '.'; wp_footer(); ?></body>
		</html><?php
		exit;
	}
}

add_action( 'plugins_loaded', 'presslabs_site_protection_load_textdomain' );
function presslabs_site_protection_load_textdomain() {
	load_plugin_textdomain( 'presslabs-site-protection', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
