<?php
/**
 * Plugin Name: WooCommerce LaybyCafe Gateway
 * Plugin URI: http://woothemes.com/products/laybycafe-payment-gateway/
 * Description: Receive payments using the South African LaybyCafe payments provider.
 * Author: WooThemes
 * Author URI: http://woothemes.com/
 * Version: 1.4.0
 *
 * Copyright (c) 2009-2016 WooThemes
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once( 'woo-includes/woo-functions.php' );
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '557bf07293ad916f20c207c6c9cd15ff', '18596' );

/**
 * Initialize the gateway.
 * @since 1.0.0
 */
function woocommerce_laybycafe_init() {
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}
	require_once( plugin_basename( 'classes/class-wc-gateway-laybycafe.php' ) );
	load_plugin_textdomain( 'woocommerce-gateway-laybycafe', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );
	add_filter( 'woocommerce_payment_gateways', 'woocommerce_laybycafe_add_gateway' );
}
add_action( 'plugins_loaded', 'woocommerce_laybycafe_init', 0 );

function woocommerce_laybycafe_plugin_links( $links ) {
	$settings_url = add_query_arg(
		array(
			'page' => 'wc-settings',
			'tab' => 'checkout',
			'section' => 'wc_gateway_laybycafe',
		),
		admin_url( 'admin.php' )
	);

	$plugin_links = array(
		'<a href="' . esc_url( $settings_url ) . '">' . __( 'Settings', 'woocommerce-gateway-laybycafe' ) . '</a>',
		'<a href="https://support.woothemes.com/">' . __( 'Support', 'woocommerce-gateway-laybycafe' ) . '</a>',
		'<a href="https://docs.woothemes.com/document/laybycafe-payment-gateway/">' . __( 'Docs', 'woocommerce-gateway-laybycafe' ) . '</a>',
	);

	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'woocommerce_laybycafe_plugin_links' );


/**
 * Add the gateway to WooCommerce
 * @since 1.0.0
 */
function woocommerce_laybycafe_add_gateway( $methods ) {
	$methods[] = 'WC_Gateway_LaybyCafe';
	return $methods;
}
