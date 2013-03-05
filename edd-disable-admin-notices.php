<?php
/*
Plugin Name: Easy Digital Downloads - Disable Admin Notices
Plugin URL: http://easydigitaldownloads.com/extension/disable-admin-notices
Description: Disables the admin new sale notification emails sent by Easy Digital Downloads
Version: 1.0
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Contributors: mordauk
*/

class EDD_Disable_Admin_Notices {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	function __construct() {

		// Removes the Admin Emails settings
		add_filter( 'edd_settings_emails', array( $this, 'remove_email_settings' ), 999 );

		// Removes the action that triggers the admin sales notice
		add_action( 'plugins_loaded', array( $this, 'disable_email_sending' ), 999 );

	} // end constructor


	/**
	 * Remove the Admin Emails settings
	 *
	 * @access      public
	 * @since       1.0
	 * @return      array
	 */

	public function remove_email_settings( $settings = array() ) {

		if( isset( $settings['admin_notice_emails'] ) )
			unset( $settings['admin_notice_emails'] );

		return $settings;

	}


	/**
	 * Disable the sending of the admin notice
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	 */

	public function disable_email_sending() {
		remove_action( 'edd_admin_sale_notice', 'edd_admin_email_notice', 10 );
	}


} // end class

// instantiate our plugin's class
$edd_disable_admin_notices = new EDD_Disable_Admin_Notices();