<?php
/**
 * LaybyCafe Payment Gateway
 *
 * Provides a LaybyCafe Payment Gateway.
 *
 * @class 		woocommerce_laybycafe
 * @package		WooCommerce
 * @category	Payment Gateways
 * @author		WooThemes
 */
class WC_Gateway_LaybyCafe extends WC_Payment_Gateway {

    /**
     * Version
     *
     * @var string
     */
    public $version = '1.2.8';

    /**
     * @access protected
     * @var array $data_to_send
     */
    protected $data_to_send = array();

    /**
     * Constructor
     */
    public function __construct() {
        $this->id = 'laybycafe';
        $this->method_title       = __( 'LaybyCafe', 'woocommerce-gateway-laybycafe' );
        $this->method_description = sprintf( __( 'LaybyCafe works by sending the user to %sLaybyCafe%s to enter their payment information.', 'woocommerce-gateway-laybycafe' ), '<a href="http://laybycafe.co.za/">', '</a>' );
        $this->icon               = WP_PLUGIN_URL . '/' . plugin_basename( dirname( dirname( __FILE__ ) ) ) . '/assets/images/icon.png';
        $this->debug_email        = get_option( 'admin_email' );
        $this->available_countries  = array( 'ZA' );
        $this->available_currencies = array( 'ZAR' );

        // Supported functionality
        $this->supports = array(
            'products',
            'pre-orders',
            'subscriptions',
            'subscription_cancellation',
            'subscription_suspension',
            'subscription_reactivation',
            'subscription_amount_changes',
            'subscription_date_changes',
            'subscription_payment_method_change',
        );

        $this->init_form_fields();
        $this->init_settings();

        if ( ! is_admin() ) {
            $this->setup_constants();
        }

        // Setup default merchant data.
        $this->merchant_id      = $this->get_option( 'merchant_id' );
        $this->merchant_key     = $this->get_option( 'merchant_key' );
        $this->pass_phrase      = $this->get_option( 'pass_phrase' );
        $this->url              = 'https://app.laybycafe.com/processing';
        $this->validate_url     = 'https://app.laybycafe.com/processing';
        $this->title            = $this->get_option( 'title' );
        $this->response_url	    = add_query_arg( 'wc-api', 'WC_Gateway_LaybyCafe', home_url( '/' ) );
        $this->send_debug_email = 'yes' === $this->get_option( 'send_debug_email' );
        $this->description = $this->get_option( 'description' );
        $this->enabled = $this->is_valid_for_use() ? 'yes': 'no'; // Check if the base currency supports this gateway.

        // Setup the test data, if in test mode.
        if ( 'yes' === $this->get_option( 'testmode' ) ) {
            $this->url          = 'https://localhost/laybycafev1/processing';
            $this->validate_url = 'https://localhost/laybycafev1/processing';
            $this->add_testmode_admin_settings_notice();
        } else {
            $this->send_debug_email = false;
        }

        add_action( 'woocommerce_api_wc_gateway_laybycafe', array( $this, 'check_itn_response' ) );
        add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        add_action( 'woocommerce_receipt_laybycafe', array( $this, 'receipt_page' ) );
        add_action( 'woocommerce_scheduled_subscription_payment_' . $this->id, array( $this, 'scheduled_subscription_payment' ), 10, 2 );
        add_action( 'woocommerce_subscription_status_cancelled', array( $this, 'cancel_subscription_listener' ) );
        add_action( 'wc_pre_orders_process_pre_order_completion_payment_' . $this->id, array( $this, 'process_pre_order_payments' ) );
    }

    /**
     * Initialise Gateway Settings Form Fields
     *
     * @since 1.0.0
     */
    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'       => __( 'Enable/Disable', 'woocommerce-gateway-laybycafe' ),
                'label'       => __( 'Enable LaybyCafe', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'checkbox',
                'description' => __( 'This controls whether or not this gateway is enabled within WooCommerce.', 'woocommerce-gateway-laybycafe' ),
                'default'     => 'yes',
                'desc_tip'    => true,
            ),
            'title' => array(
                'title'       => __( 'Title', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'text',
                'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce-gateway-laybycafe' ),
                'default'     => __( 'LaybyCafe', 'woocommerce-gateway-laybycafe' ),
                'desc_tip'    => true,
            ),
            'description' => array(
                'title'       => __( 'Description', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'text',
                'description' => __( 'This controls the description which the user sees during checkout.', 'woocommerce-gateway-laybycafe' ),
                'default'     => '',
                'desc_tip'    => true,
            ),
            'testmode' => array(
                'title'       => __( 'LaybyCafe Sandbox', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'checkbox',
                'description' => __( 'Place the payment gateway in development mode.', 'woocommerce-gateway-laybycafe' ),
                'default'     => 'yes',
            ),
            'merchant_id' => array(
                'title'       => __( 'Merchant ID', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'text',
                'description' => __( 'This is the merchant ID, received from LaybyCafe.', 'woocommerce-gateway-laybycafe' ),
                'default'     => '',
            ),
            'merchant_key' => array(
                'title'       => __( 'Merchant Key', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'text',
                'description' => __( 'This is the merchant key, received from LaybyCafe.', 'woocommerce-gateway-laybycafe' ),
                'default'     => '',
            ),
            'pass_phrase' => array(
                'title'       => __( 'Passphrase', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'text',
                'description' => __( 'Needed in order to handle subscriptions and Pre-Orders. This phrase must match the phrase set on your merchant account., received from LaybyCafe.', 'woocommerce-gateway-laybycafe' ),
                'default'     => '',
            ),
            'send_debug_email' => array(
                'title'   => __( 'Send Debug Emails', 'woocommerce-gateway-laybycafe' ),
                'type'    => 'checkbox',
                'label'   => __( 'Send debug e-mails for transactions through the LaybyCafe gateway (sends on successful transaction as well).', 'woocommerce-gateway-laybycafe' ),
                'default' => 'yes',
            ),
            'debug_email' => array(
                'title'       => __( 'Who Receives Debug E-mails?', 'woocommerce-gateway-laybycafe' ),
                'type'        => 'text',
                'description' => __( 'The e-mail address to which debugging error e-mails are sent when in test mode.', 'woocommerce-gateway-laybycafe' ),
                'default'     => get_option( 'admin_email' ),
            ),
        );
    }

    /**
     * add_testmode_admin_settings_notice()
     * Add a notice to the merchant_key and merchant_id fields when in test mode.
     *
     * @since 1.0.0
     */
    public function add_testmode_admin_settings_notice() {
        $this->form_fields['merchant_id']['description']  .= ' <strong>' . __( 'Sandbox Merchant ID currently in use', 'woocommerce-gateway-laybycafe' ) . ' ( ' . esc_html( $this->merchant_id ) . ' ).</strong>';
        $this->form_fields['merchant_key']['description'] .= ' <strong>' . __( 'Sandbox Merchant Key currently in use', 'woocommerce-gateway-laybycafe' ) . ' ( ' . esc_html( $this->merchant_key ) . ' ).</strong>';
    }

    /**
     * is_valid_for_use()
     *
     * Check if this gateway is enabled and available in the base currency being traded with.
     *
     * @since 1.0.0
     * @return bool
     */
    public function is_valid_for_use() {
        $is_available          = false;
        $is_available_currency = in_array( get_woocommerce_currency(), $this->available_currencies );

        if ( $is_available_currency && $this->merchant_id && $this->merchant_key ) {
            $is_available = true;
        }

        return $is_available;
    }

    /**
     * Admin Panel Options
     * - Options for bits like 'title' and availability on a country-by-country basis
     *
     * @since 1.0.0
     */
    public function admin_options() {
        if ( in_array( get_woocommerce_currency(), $this->available_currencies ) ) {
            parent::admin_options();
        } else {
            ?>
            <h3><?php _e( 'LaybyCafe', 'woocommerce-gateway-laybycafe' ); ?></h3>
            <div class="inline error"><p><strong><?php _e( 'Gateway Disabled', 'woocommerce-gateway-laybycafe' ); ?></strong> <?php echo sprintf( __( 'Choose South African Rands as your store currency in %1$sPricing Options%2$s to enable the LaybyCafe Gateway.', 'woocommerce-gateway-laybycafe' ), '<a href="' . esc_url( admin_url( 'admin.php?page=wc-settings&tab=general' ) ) . '">', '</a>' ); ?></p></div>
            <?php
        }
    }

    /**
     * Generate the LaybyCafe button link.
     *
     * @since 1.0.0
     */


    function get_order_details($order_id){

        // 1) Get the Order object
        $order = wc_get_order( $order_id );

        // OUTPUT
        echo '<h3>RAW OUTPUT OF THE ORDER OBJECT: </h3>';
        print_r($order);
        echo '<br><br>';
        echo '<h3>THE ORDER OBJECT (Using the object syntax notation):</h3>';
        echo '$order->order_type: ' . $order->order_type . '<br>';
        echo '$order->id: ' . $order->id . '<br>';
        echo '<h4>THE POST OBJECT:</h4>';
        echo '$order->post->ID: ' . $order->post->ID . '<br>';
        echo '$order->post->post_author: ' . $order->post->post_author . '<br>';
        echo '$order->post->post_date: ' . $order->post->post_date . '<br>';
        echo '$order->post->post_date_gmt: ' . $order->post->post_date_gmt . '<br>';
        echo '$order->post->post_content: ' . $order->post->post_content . '<br>';
        echo '$order->post->post_title: ' . $order->post->post_title . '<br>';
        echo '$order->post->post_excerpt: ' . $order->post->post_excerpt . '<br>';
        echo '$order->post->post_status: ' . $order->post->post_status . '<br>';
        echo '$order->post->comment_status: ' . $order->post->comment_status . '<br>';
        echo '$order->post->ping_status: ' . $order->post->ping_status . '<br>';
        echo '$order->post->post_password: ' . $order->post->post_password . '<br>';
        echo '$order->post->post_name: ' . $order->post->post_name . '<br>';
        echo '$order->post->to_ping: ' . $order->post->to_ping . '<br>';
        echo '$order->post->pinged: ' . $order->post->pinged . '<br>';
        echo '$order->post->post_modified: ' . $order->post->post_modified . '<br>';
        echo '$order->post->post_modified_gtm: ' . $order->post->post_modified_gtm . '<br>';
        echo '$order->post->post_content_filtered: ' . $order->post->post_content_filtered . '<br>';
        echo '$order->post->post_parent: ' . $order->post->post_parent . '<br>';
        echo '$order->post->guid: ' . $order->post->guid . '<br>';
        echo '$order->post->menu_order: ' . $order->post->menu_order . '<br>';
        echo '$order->post->post_type: ' . $order->post->post_type . '<br>';
        echo '$order->post->post_mime_type: ' . $order->post->post_mime_type . '<br>';
        echo '$order->post->comment_count: ' . $order->post->comment_count . '<br>';
        echo '$order->post->filter: ' . $order->post->filter . '<br>';
        echo '<h4>THE ORDER OBJECT (again):</h4>';
        echo '$order->order_date: ' . $order->order_date . '<br>';
        echo '$order->modified_date: ' . $order->modified_date . '<br>';
        echo '$order->customer_message: ' . $order->customer_message . '<br>';
        echo '$order->customer_note: ' . $order->customer_note . '<br>';
        echo '$order->post_status: ' . $order->post_status . '<br>';
        echo '$order->prices_include_tax: ' . $order->prices_include_tax . '<br>';
        echo '$order->tax_display_cart: ' . $order->tax_display_cart . '<br>';
        echo '$order->display_totals_ex_tax: ' . $order->display_totals_ex_tax . '<br>';
        echo '$order->display_cart_ex_tax: ' . $order->display_cart_ex_tax . '<br>';
        echo '$order->formatted_billing_address->protected: ' . $order->formatted_billing_address->protected . '<br>';
        echo '$order->formatted_shipping_address->protected: ' . $order->formatted_shipping_address->protected . '<br><br>';
        echo '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br><br>';

        // 2) Get the Order meta data
        $order_meta = get_post_meta($order_id);

        echo '<h3>RAW OUTPUT OF THE ORDER META DATA (ARRAY): </h3>';
        print_r($order_meta);
        echo '<br><br>';
        echo '<h3>THE ORDER META DATA (Using the array syntax notation):</h3>';
        echo '$order_meta[_order_key][0]: ' . $order_meta[_order_key][0] . '<br>';
        echo '$order_meta[_order_currency][0]: ' . $order_meta[_order_currency][0] . '<br>';
        echo '$order_meta[_prices_include_tax][0]: ' . $order_meta[_prices_include_tax][0] . '<br>';
        echo '$order_meta[_customer_user][0]: ' . $order_meta[_customer_user][0] . '<br>';
        echo '$order_meta[_billing_first_name][0]: ' . $order_meta[_billing_first_name][0] . '<br><br>';
        echo 'And so on ……… <br><br>';
        echo '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br><br>';

        // 3) Get the order items
        $items = $order->get_items();

        echo '<h3>RAW OUTPUT OF THE ORDER ITEMS DATA (ARRAY): </h3>';

        foreach ( $items as $item_id => $item_data ) {

            echo '<h4>RAW OUTPUT OF THE ORDER ITEM NUMBER: '. $item_id .'): </h4>';
            print_r($item);
            echo '<br><br>';
            echo 'Item ID: ' . $item_id. '<br>';
            echo '$item["product_id"] <i>(product ID)</i>: ' . $item['product_id'] . '<br>';
            echo '$item["name"] <i>(product Name)</i>: ' . $item['name'] . '<br>';

            // Using get_item_meta() method
            echo 'Item quantity <i>(product quantity)</i>: ' . $order->get_item_meta($item_id, '_qty', true) . '<br><br>';
            echo 'Item line total <i>(product quantity)</i>: ' . $order->get_item_meta($item_id, '_line_total', true) . '<br><br>';
            echo 'And so on ……… <br><br>';
            echo '- - - - - - - - - - - - - <br><br>';
        }
        echo '- - - - - - E N D - - - - - <br><br>';
    }




    public function generate_laybycafe_form( $order_id ) {
        $order         = wc_get_order( $order_id );

        //$sandile = WC()->cart->get_cart();

        $product_description = "";
        $prodData = [];

        $sandile = "";

        foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ){

            $product_id = $cart_item['product_id']; // Product ID
            $product_obj = wc_get_product($product_id); // Product Object

            $product_qty = $cart_item['quantity']; // Product quantity

            $product_price = $cart_item['data']->price; // Product price
            $product_total_stock = $cart_item['data']->total_stock; // Product stock
            $product_type = $cart_item['data']->product_type; // Product type
            $product_name = $cart_item['data']->post->post_title; // Product Title (Name)
            $product_slug = $cart_item['data']->post->post_name; // Product Slug
            $product_description1 = $cart_item['data']->post->post_content; // Product description
            $product_excerpt = $cart_item['data']->post->post_excerpt; // Product short description
            $product_post_type = $cart_item['data']->post->post_type; // Product post type

            $cart_line_total = $cart_item['line_total']; // Cart item line total
            $cart_line_tax = $cart_item['line_tax']; // Cart item line tax total
            $cart_line_subtotal = $cart_item['line_subtotal']; // Cart item line subtotal
            $cart_line_subtotal_tax = $cart_item['line_subtotal_tax']; // Cart item line tax subtotal


            $sandile = $product_qty;


            /** SANDILE FIELDS I NEED */
            //$payment_plan = $cart_item['payment_plan'];
            $is_deposit = $cart_item['is_deposit'];
            $product_id_product_id = $cart_item['product_id'];
            $product_name = $cart_item['data']->name;

            $Persons = $cart_item['booking']['Persons'];

            $maximum_period_months = "";
            $payment_plan = $cart_item['wccf']['5251']['value'];



            if($payment_plan == "three_months_plan"){
                $maximum_period_months = "3 Months";
            }else if($payment_plan == "six_months_plan"){
                $maximum_period_months = "6 Months";
            }else if($payment_plan == "nine_months_plan"){
                $maximum_period_months = "9 Months";
            }else if($payment_plan == "twelve_months_plan"){
                $maximum_period_months = "12 Months";
            }

//            if($payment_plan == 0){
//                $maximum_period_months = 0;
//            }else if($payment_plan == 1){
//                $maximum_period_months = 3;
//                $product_price = $cart_item['full_amount'];
//            }else if ($payment_plan == 2){
//                $product_price = $cart_item['full_amount'];
//                $maximum_period_months = 6;
//            }else if($payment_plan == 4){
//                $product_price = $cart_item['full_amount'];
//                $maximum_period_months = 9;
//            }


            if($Persons == null || empty($Persons)){
                //Product Data//
                $prodData[] = array(
                    'payment_plan'=> $payment_plan,
                    'is_deposit'=>  $is_deposit,
                    'product_id_product_id' => $product_id_product_id,
                    'product_ref' => $product_id_product_id.'-'.$order->get_order_number(),
                    'product_name' => $product_name,
                    'product_price'=>$product_price,
                    'product_description' => strip_tags($product_description1),
                    'maximum_period_months' => $maximum_period_months,
                    'quantity' => $product_qty,
                    'product_type' => 'Simple Product'
                );
            }else{
                //Product Data//
                $prodData[] = array(
                    'payment_plan'=> $payment_plan,
                    'is_deposit'=>  $is_deposit,
                    'product_id_product_id' => $product_id_product_id,
                    'product_ref' => $product_id_product_id.'-'.$order->get_order_number(),
                    'product_name' => $product_name,
                    'product_price'=>$product_price,
                    'product_description' => strip_tags($product_description1),
                    'maximum_period_months' => $maximum_period_months,
                    'Persons' => $Persons,
                    'product_type' => 'Bookable Product'
                );
            }



            //full_amount

            // variable products
            $variation_id = $cart_item['variation_id']; // Product Variation ID
            if($variation_id != 0){
                $product_variation_obj = wc_get_product($variation_id); // Product variation Object
                $variation_array = $cart_item['variation']; // variation attributes + values

            }
        }

        //        $order = wc_get_order( $order_id);
        //        $items = $order->get_items();
        //
        //
//                echo '<pre>';
//                var_dump($order) or die();
//                echo '</pre>';


//        $order = new WC_Order( $order_id );
//        $items = $order->get_items();

//		echo '<pre>';
//        $this->get_order_details($order_id) or die();
//        echo '</pre>';

//        echo '<pre>';
//		print_r($sandile) or die();
//		echo '</pre>';
        // Construct variables for post
        $this->data_to_send = array(
            // Merchant details
            'merchant_id'      => $this->merchant_id,
            'merchant_key'     => $this->merchant_key,
            'return_url'       => $this->get_return_url( $order ),
            'cancel_url'       => $order->get_cancel_order_url(),
            'notify_url'       => $this->response_url,

            // Billing details
            'first_name'       => $order->billing_first_name,
            'last_name'        => $order->billing_last_name,
            'email'    => $order->billing_email,

            // Item details
            'm_payment_id'     => ltrim( $order->get_order_number(), __( '#', 'hash before order number', 'woocommerce-gateway-laybycafe' ) ),
            'amount'           => $order->get_total(),
            'item_name'        => get_bloginfo( 'name' ) . ' - ' . $order->get_order_number(),
            'item_description' => sprintf( __( 'New order from %s', 'woocommerce-gateway-laybycafe' ), get_bloginfo( 'name' ) ),

            // Custom strings
            'custom_str1'      => $order->order_key,
            'custom_str2'      => 'WooCommerce/' . WC_VERSION . '; ' . get_site_url(),
            'Order_Product_data'      => json_encode($prodData,JSON_PRETTY_PRINT),
            'user_agent'           => 'LaybyCafe-store-plugin',
        );

        // add subscription parameters
        if ( $this->order_contains_subscription( $order_id ) ) {
            // 2 == ad-hoc subscription type see LaybyCafe API docs
            $this->data_to_send['subscription_type'] = '2';
        }

        // pre-order: add the subscription type for pre order that require tokenization
        // at this point we assume that the order pre order fee and that
        // we should only charge that on the order. The rest will be charged later.
        if ( $this->order_contains_pre_order( $order_id )
            && $this->order_requires_payment_tokenization( $order_id ) ) {
            $this->data_to_send['amount']            = $this->get_pre_order_fee( $order_id );
            $this->data_to_send['subscription_type'] = '2';
        }

        $laybycafe_args_array = array();
        foreach ( $this->data_to_send as $key => $value ) {
            $laybycafe_args_array[] = '<input type="hidden" name="' . esc_attr( $key ) .'" value="' . esc_attr( $value ) . '" />';
        }

        return '<form action="' . esc_url( $this->url ) . '" method="post" id="laybycafe_payment_form">
				' . implode( '', $laybycafe_args_array ) . '
				<input type="submit" class="button-alt" id="submit_laybycafe_payment_form" value="' . __( 'Pay via LaybyCafe', 'woocommerce-gateway-laybycafe' ) . '" /> <a class="button cancel" href="' . $order->get_cancel_order_url() . '">' . __( 'Cancel order &amp; restore cart', 'woocommerce-gateway-laybycafe' ) . '</a>
				<script type="text/javascript">
					jQuery(function(){
						jQuery("body").block(
							{
								message: "' . __( 'Thank you for your order. We are now redirecting you to LaybyCafe to make payment.', 'woocommerce-gateway-laybycafe' ) . '",
								overlayCSS:
								{
									background: "#fff",
									opacity: 0.6
								},
								css: {
									padding:        20,
									textAlign:      "center",
									color:          "#555",
									border:         "3px solid #aaa",
									backgroundColor:"#fff",
									cursor:         "wait"
								}
							});
						jQuery( "#submit_laybycafe_payment_form" ).click();
					});
				</script>
			</form>';
    }

    /**
     * Process the payment and return the result.
     *
     * @since 1.0.0
     */
    public function process_payment( $order_id ) {

        if ( $this->order_contains_pre_order( $order_id )
            && $this->order_requires_payment_tokenization( $order_id )
            && ! $this->cart_contains_pre_order_fee() ) {
            throw new Exception( 'LaybyCafe does not support transactions without any upfront costs or fees. Please select another gateway' );
        }

        $order = wc_get_order( $order_id );
        return array(
            'result' 	 => 'success',
            'redirect'	 => $order->get_checkout_payment_url( true ),
        );
    }

    /**
     * Reciept page.
     *
     * Display text and a button to direct the user to LaybyCafe.
     *
     * @since 1.0.0
     */
    public function receipt_page( $order ) {
        echo '<p>' . __( 'Thank you for your order, please click the button below to pay with LaybyCafe.', 'woocommerce-gateway-laybycafe' ) . '</p>';
        echo $this->generate_laybycafe_form( $order );
    }

    /**
     * Check LaybyCafe ITN response.
     *
     * @since 1.0.0
     */
    public function check_itn_response() {
        $this->handle_itn_request( stripslashes_deep( $_POST ) );
    }

    /**
     * Check LaybyCafe ITN validity.
     *
     * @param array $data
     * @since 1.0.0
     */
    public function handle_itn_request( $data ) {
        $this->log( "\n" . '----------' . "\n" . 'LaybyCafe ITN call received' );
        $this->log( 'Get posted data' );
        $this->log( 'LaybyCafe Data: '. print_r( $data, true ) );

        $laybycafe_error  = false;
        $laybycafe_done   = false;
        $debug_email    = $this->get_option( 'debug_email', get_option( 'admin_email' ) );
        $session_id     = $data['custom_str1'];
        $vendor_name    = get_bloginfo( 'name' );
        $vendor_url     = home_url( '/' );
        $order_id       = absint( $data['custom_str3'] );
        $order_key      = wc_clean( $session_id );
        $order          = wc_get_order( $order_id );

        // Notify LaybyCafe that information has been received
        header( 'HTTP/1.0 200 OK' );
        flush();

        if ( false === $data ) {
            $laybycafe_error  = true;
            $laybycafe_error_message = PF_ERR_BAD_ACCESS;
        }

        // Verify security signature
        if ( ! $laybycafe_error && ! $laybycafe_done ) {
            $this->log( 'Verify security signature' );
            $signature = md5( $this->_generate_parameter_string( $data, false, false ) ); // false not to sort data
            // If signature different, log for debugging
            if ( ! $this->validate_signature( $data, $signature ) ) {
                $laybycafe_error         = true;
                $laybycafe_error_message = PF_ERR_INVALID_SIGNATURE;
            }
        }

        // Verify source IP (If not in debug mode)
        if ( ! $laybycafe_error && ! $laybycafe_done && $this->get_option( 'testmode' ) != 'yes' ) {
            $this->log( 'Verify source IP' );

            if ( ! $this->validate_ip( $_SERVER['REMOTE_ADDR'] ) ) {
                $laybycafe_error  = true;
                $laybycafe_error_message = PF_ERR_BAD_SOURCE_IP;
            }
        }

        // Get internal order and verify it hasn't already been processed
        if ( ! $laybycafe_error && ! $laybycafe_done ) {
            $this->log( "Purchase:\n". print_r( $order, true ) );

            // Check if order has already been processed
            if ( 'completed' === $order->status ) {
                $this->log( 'Order has already been processed' );
                $laybycafe_done = true;
            }
        }

        // Verify data received
        if ( ! $laybycafe_error ) {
            $this->log( 'Verify data received' );
            $validation_data = $data;
            unset( $validation_data['signature'] );
            $has_valid_response_data = $this->validate_response_data( $validation_data );

            if ( ! $has_valid_response_data ) {
                $laybycafe_error = true;
                $laybycafe_error_message = PF_ERR_BAD_ACCESS;
            }
        }

        // Check data against internal order
        if ( ! $laybycafe_error && ! $laybycafe_done ) {
            $this->log( 'Check data against internal order' );

            // Check order amount
            if ( ! $this->amounts_equal( $data['amount_gross'], $order->order_total )
                && ! $this->order_contains_pre_order( $order_id )
                && ! $this->order_contains_subscription( $order_id ) ) {
                $laybycafe_error  = true;
                $laybycafe_error_message = PF_ERR_AMOUNT_MISMATCH;
            } elseif ( strcasecmp( $data['custom_str1'], $order->order_key ) != 0 ) {
                // Check session ID
                $laybycafe_error  = true;
                $laybycafe_error_message = PF_ERR_SESSIONID_MISMATCH;
            }
        }

        // If an error occurred
        if ( $laybycafe_error ) {
            $this->log( 'Error occurred: '. $laybycafe_error_message );

            if ( $this->send_debug_email ) {
                $this->log( 'Sending email notification' );

                // Send an email
                $subject = "LaybyCafe ITN error: ". $laybycafe_error_message;
                $body =
                    "Hi,\n\n".
                    "An invalid LaybyCafe transaction on your website requires attention\n".
                    "------------------------------------------------------------\n".
                    "Site: ". $vendor_name ." (". $vendor_url .")\n".
                    "Remote IP Address: ".$_SERVER['REMOTE_ADDR']."\n".
                    "Remote host name: ". gethostbyaddr( $_SERVER['REMOTE_ADDR'] ) ."\n".
                    "Purchase ID: ". $order->get_order_number() ."\n".
                    "User ID: ". $order->user_id ."\n";
                if( isset( $data['pf_payment_id'] ) )
                    $body .= "LaybyCafe Transaction ID: ". $data['pf_payment_id'] ."\n";
                if( isset( $data['payment_status'] ) )
                    $body .= "LaybyCafe Payment Status: ". $data['payment_status'] ."\n";
                $body .=
                    "\nError: ". $laybycafe_error_message ."\n";

                switch( $laybycafe_error_message ) {
                    case PF_ERR_AMOUNT_MISMATCH:
                        $body .=
                            "Value received : ". $data['amount_gross'] ."\n".
                            "Value should be: ". $order->order_total;
                        break;

                    case PF_ERR_ORDER_ID_MISMATCH:
                        $body .=
                            "Value received : ". $data['custom_str3'] ."\n".
                            "Value should be: ". $order->get_order_number();
                        break;

                    case PF_ERR_SESSION_ID_MISMATCH:
                        $body .=
                            "Value received : ". $data['custom_str1'] ."\n".
                            "Value should be: ". $order->get_order_number();
                        break;

                    // For all other errors there is no need to add additional information
                    default:
                        break;
                }

                wp_mail( $debug_email, $subject, $body );
            }
        } elseif ( ! $laybycafe_done ) {

            $this->log( 'Check status and update order' );

            if ( $order->order_key !== $order_key ) {
                exit;
            }

            // alter order object to be the renewal order if
            // the ITN request comes as a result of a renewal submission request
            $description = json_decode( $data['item_description'] );
            if ( isset( $description->renewal_order_id ) ) {
                $order = wc_get_order( $description->renewal_order_id );
            }

            $status = strtolower( $data['payment_status'] );
            if ( 'complete' === $status ) {
                $this->handle_itn_payment_complete( $data, $order );
            } elseif ( 'failed' === $status ) {
                $this->handle_itn_payment_failed( $data, $order );
            } elseif ( 'pending' === $status ) {
                $this->handle_itn_payment_pending( $data, $order );
            } elseif ( 'cancelled' === $status ) {
                $this->handle_itn_payment_cancelled( $data, $order );
            }
        }
    }

    /**
     * This funtion mainly responds to ITN cancell requests initiated on LaybyCafe, but also acts
     * just in case they are not cancelled.
     *
     *
     * @param array $data should be from the Gatewy ITN callback.
     * @param WC_Order $order
     */
    public function handle_itn_payment_cancelled( $data, $order ) {
        $subscriptions = wcs_get_subscriptions_for_order( $order );

        remove_action( 'woocommerce_subscription_status_cancelled', array( $this, 'cancel_subscription_listener' ) );
        foreach ( $subscriptions as $subscription ) {
            if ( 'cancelled' !== $subscription->get_status() ) {
                $subscription->update_status( 'cancelled', __( 'Merchant cancelled subscription on LaybyCafe.' , 'woocommerce-gateway-laybycafe' ) );
                $this->_delete_subscription_token( $subscription );
            }
        }
        add_action( 'woocommerce_subscription_status_cancelled', array( $this, 'cancel_subscription_listener' ) );
    }

    /**
     * @param array $data should be from the Gatewy ITN callback.
     * @param WC_Order $order
     */
    public function handle_itn_payment_complete( $data, $order ) {
        $this->log( '- Complete' );
        $order->add_order_note( __( 'ITN payment completed', 'woocommerce-gateway-laybycafe' ) );

        //store token for future subscription deductions
        if ( $this->order_contains_subscription( $order ) && isset( $data['token'] ) ) {
            $token = sanitize_text_field( $data['token'] );
            $subscriptions = wcs_get_subscriptions_for_order( $order->get_order_number() );
            foreach ( $subscriptions as $subscription ) {
                $this->_set_subscription_token( $token, $subscription );
            }
        }

        // the same mechanism (adhoc token) is used to capture payment later
        if ( $this->order_contains_pre_order( $order->get_order_number() )
            && $this->order_requires_payment_tokenization( $order->get_order_number() ) ) {

            $token = sanitize_text_field( $data['token'] );
            $is_pre_order_fee_paid = get_post_meta( $order->get_order_number(), '_pre_order_fee_paid', true ) === 'yes';

            if ( ! $is_pre_order_fee_paid ) {
                $order->add_order_note( sprintf( __( 'LaybyCafe pre-order fee paid: R %s (%s)', 'woocommerce-gateway-laybycafe' ), $data['amount_gross'], $data['pf_payment_id'] ) );
                $this->_set_pre_order_token( $token, $order );
                // set order to pre-ordered
                WC_Pre_Orders_Order::mark_order_as_pre_ordered( $order );
                update_post_meta( $order->get_order_number(), '_pre_order_fee_paid', 'yes' );
                WC()->cart->empty_cart();
            } else {
                $order->add_order_note( sprintf( __( 'LaybyCafe pre-order product line total paid: R %s (%s)', 'woocommerce-gateway-laybycafe' ), $data['amount_gross'],$data['pf_payment_id'] ) );
                $order->payment_complete();
                $this->cancel_pre_order_subscription( $token );
            }
        } else {
            $order->payment_complete();
        }

        $debug_email   = $this->get_option( 'debug_email', get_option( 'admin_email' ) );
        $vendor_name    = get_bloginfo( 'name' );
        $vendor_url     = home_url( '/' );
        if ( $this->send_debug_email ) {
            $subject = 'LaybyCafe ITN on your site';
            $body =
                "Hi,\n\n".
                'A LaybyCafe transaction has been completed on your website\n'.
                '------------------------------------------------------------\n'.
                "Site: ". $vendor_name ." (". $vendor_url .")\n".
                "Purchase ID: ". $data['m_payment_id'] ."\n".
                "LaybyCafe Transaction ID: ". $data['pf_payment_id'] ."\n".
                "LaybyCafe Payment Status: ". $data['payment_status'] ."\n".
                "Order Status Code: ". $order->status;
            wp_mail( $debug_email, $subject, $body );
        }
    }

    /**
     * @param $data
     * @param $order
     */
    public function handle_itn_payment_failed( $data, $order ) {
        $this->log( '- Failed' );
        $order->update_status( 'failed', sprintf( __( 'Payment %s via ITN.', 'woocommerce-gateway-laybycafe' ), strtolower( sanitize_text_field( $data['payment_status'] ) ) ) );
        $debug_email   = $this->get_option( 'debug_email', get_option( 'admin_email' ) );
        $vendor_name    = get_bloginfo( 'name' );
        $vendor_url     = home_url( '/' );

        if ( $this->send_debug_email ) {
            $subject = 'LaybyCafe ITN Transaction on your site';
            $body =
                'Hi,\n\n'.
                'A failed LaybyCafe transaction on your website requires attention\n'.
                '------------------------------------------------------------\n'.
                "Site: ". $vendor_name ." (". $vendor_url .")\n".
                "Purchase ID: ". $order->id ."\n".
                "User ID: ". $order->user_id ."\n".
                "LaybyCafe Transaction ID: ". $data['pf_payment_id'] ."\n".
                "LaybyCafe Payment Status: ". $data['payment_status'];
            wp_mail( $debug_email, $subject, $body );
        }
    }

    /**
     * @since 1.4.0 introduced
     * @param $data
     * @param $order
     */
    public function handle_itn_payment_pending( $data, $order ) {
        $this->log( '- Pending' );
        // Need to wait for "Completed" before processing
        $order->update_status( 'on-hold', sprintf( __( 'Payment %s via ITN.', 'woocommerce-gateway-laybycafe' ), strtolower( sanitize_text_field( $data['payment_status'] ) ) ) );
    }

    /**
     * @param string $order_id
     * @return double
     */
    public function get_pre_order_fee( $order_id ) {
        foreach ( wc_get_order( $order_id )->get_fees() as $fee ) {
            if ( is_array( $fee ) && 'Pre-Order Fee' == $fee['name'] ) {
                return doubleval( $fee['line_total'] ) + doubleval( $fee['line_tax'] );
            }
        }
    }
    /**
     * @param string $order_id
     * @return bool
     */
    public function order_contains_pre_order( $order_id ) {
        if ( class_exists( 'WC_Pre_Orders_Order' ) ) {
            return WC_Pre_Orders_Order::order_contains_pre_order( $order_id );
        }
        return false;
    }

    /**
     * @param string $order_id
     *
     * @return bool
     */
    public function order_requires_payment_tokenization( $order_id ) {
        if ( class_exists( 'WC_Pre_Orders_Order' ) ) {
            return WC_Pre_Orders_Order::order_requires_payment_tokenization( $order_id );
        }
        return false;
    }

    /**
     * @return bool
     */
    public function cart_contains_pre_order_fee() {
        if ( class_exists( 'WC_Pre_Orders_Cart' ) ) {
            return WC_Pre_Orders_Cart::cart_contains_pre_order_fee();
        }
        return false;
    }
    /**
     * Store the LaybyCafe subscription token
     *
     * @param string $token
     * @param WC_Subscription $subscription
     */
    protected function _set_subscription_token( $token, $subscription ) {
        update_post_meta( $subscription->id, '_laybycafe_subscription_token', $token );
    }

    /**
     * Retrieve the LaybyCafe subscription token for a given order id.
     *
     * @param WC_Subscription $subscription
     * @return mixed
     */
    protected function _get_subscription_token( $subscription ) {
        return get_post_meta( $subscription->id, '_laybycafe_subscription_token', true );
    }

    /**
     * Retrieve the LaybyCafe subscription token for a given order id.
     *
     * @param WC_Subscription $subscription
     * @return mixed
     */
    protected function _delete_subscription_token( $subscription ) {
        return delete_post_meta( $subscription->id, '_laybycafe_subscription_token' );
    }

    /**
     * Store the LaybyCafe pre_order_token token
     *
     * @param string $token
     * @param WC_Order$order
     */
    protected function _set_pre_order_token( $token, $order ) {
        update_post_meta( $order->get_order_number(), '_laybycafe_pre_order_token', $token );
    }

    /**
     * Retrieve the LaybyCafe pre-order token for a given order id.
     *
     * @param WC_Order $order
     * @return mixed
     */
    protected function _get_pre_order_token( $order ) {
        return get_post_meta( $order->get_order_number(), '_laybycafe_pre_order_token', true );
    }

    /**
     * Wrapper function for wcs_order_contains_subscription
     *
     * @param WC_Order $order
     * @return bool
     */
    public function order_contains_subscription( $order ) {
        if ( ! function_exists( 'wcs_order_contains_subscription' ) ) {
            return false;
        }
        return wcs_order_contains_subscription( $order );
    }

    /**
     * @param $amount_to_charge
     * @param WC_Order $renewal_order
     */
    public function scheduled_subscription_payment( $amount_to_charge, $renewal_order ) {

        $subscription = wcs_get_subscription( get_post_meta( $renewal_order->get_order_number(), '_subscription_renewal', true ) );
        if ( empty( $subscription ) ) {
            return;
        }
        $response = $this->submit_subscription_payment( $subscription, $amount_to_charge );

        if ( is_wp_error( $response ) ) {
            $renewal_order->update_status( 'failed', sprintf( __( 'LaybyCafe Subscription renewal transaction failed (%s:%s)', 'woocommerce-gateway-laybycafe' ), $response->get_error_code() ,$response->get_error_message() ) );
        }
        // Payment will be completion will be capture only when the ITN callback is sent to $this->handle_itn_request().
        $renewal_order->add_order_note( __( 'LaybyCafe Subscription renewal transaction submitted.', 'woocommerce-gateway-laybycafe' ) );

    }

    /**
     * @param WC_Subscription $subscription
     * @param $amount_to_charge
     * @return mixed WP_Error on failure, bool true on success
     */
    public function submit_subscription_payment( $subscription, $amount_to_charge ) {
        $token = $this->_get_subscription_token( $subscription );
        $item_name = $this->get_subscription_name( $subscription );

        foreach ( $subscription->get_related_orders( 'all', 'renewal' ) as $order ) {
            $statuses_to_charge = array( 'on-hold', 'failed', 'pending' );
            if ( in_array( $order->get_status(), $statuses_to_charge ) ) {
                $latest_order_to_renew = $order;
                break;
            }
        }
        $item_description = json_encode( array( 'renewal_order_id' => $latest_order_to_renew->id ) );

        return $this->submit_add_hoc_payment( $token, $amount_to_charge, $item_name, $item_description );
    }

    /**
     * Get a name for the subscription item. For multiple
     * item only Subscription $date will be returned.
     *
     * For subscriptions with no items Site/Blog name will be returned.
     *
     * @param WC_Subscription $subscription
     * @return string
     */
    public function get_subscription_name( $subscription ) {

        if ( $subscription->get_item_count() > 1 ) {
            return $subscription->get_date_to_display( 'start' );
        } else {
            $items = $subscription->get_items();

            if ( empty( $items ) ) {
                return get_bloginfo( 'name' );
            }

            $item = array_shift( $items );
            return $item['name'];
        }
    }

    /**
     * Setup api data for the the adhoc payment.
     *
     * @since 1.4.0 introduced.
     * @param string $token
     * @param double $amount_to_charge
     * @param string $item_name
     * @param string $item_description
     *
     * @return bool|WP_Error
     */
    public function submit_add_hoc_payment( $token, $amount_to_charge, $item_name, $item_description ) {
        $args = array(
            'body' => array(
                'amount'           => $amount_to_charge * 100, // convert to cents
                'item_name'        => $item_name,
                'item_description' => $item_description,
            ),
        );
        return $this->api_request( 'adhoc', $token, $args );
    }

    /**
     * Send off API request.
     *
     * @since 1.4.0 introduced.
     *
     * @param $command
     * @param $token
     * @param $api_args
     * @param string $method GET | PUT | POST | DELETE.
     *
     * @return bool|WP_Error
     */
    public function api_request( $command, $token, $api_args, $method = 'POST' ) {
        $api_endpoint  = "https://api.laybycafe.co.za/subscriptions/$token/$command";
        $api_endpoint .= 'yes' === $this->get_option( 'testmode' ) ? '?testing=true' : '';

        $timestamp = current_time( rtrim( DateTime::ATOM, 'P' ) ) . '+02:00';
        $api_args['timeout'] = 45;
        $api_args['headers'] = array(
            'merchant-id' => $this->merchant_id,
            'timestamp'   => $timestamp,
            'version'     => 'v1',
        );

        // generate signature
        $all_api_variables                = array_merge( $api_args['headers'], (array)$api_args['body'] );
        $api_args['headers']['signature'] = md5( $this->_generate_parameter_string( $all_api_variables ) );
        $api_args['method']               = strtoupper( $method );

        $results = wp_remote_request( $api_endpoint, $api_args );

        if ( 200 !== $results['response']['code'] ) {
            return new WP_Error( $results['response']['code'], $results['response']['message'], $results );
        }

        return true;
    }

    /**
     * Responds to Subscriptions extension cancellation event.
     *
     * @since 1.4.0 introduced.
     * @param WC_Subscription $subscription
     */
    public function cancel_subscription_listener( $subscription ) {
        $token = $this->_get_subscription_token( $subscription );
        if ( empty( $token ) ) {
            return;
        }
        $this->api_request( 'cancel', $token, array(), 'PUT' );
    }

    /**
     * @since 1.4.0
     * @param string $token
     *
     * @return bool|WP_Error
     */
    public function cancel_pre_order_subscription( $token ) {
        return $this->api_request( 'cancel', $token, array(), 'PUT' );
    }

    /**
     * @since 1.4.0 introduced.
     * @param      $api_data
     * @param bool $sort_data_before_merge? default true.
     * @param bool $skip_empty_values Should key value pairs be ignored when generating signature?  Default true.
     *
     * @return string
     */
    protected function _generate_parameter_string( $api_data, $sort_data_before_merge = true, $skip_empty_values = true ) {

        // if sorting is required the passphrase should be added in before sort.
        if ( ! empty( $this->pass_phrase ) && $sort_data_before_merge ) {
            $api_data['passphrase'] = $this->pass_phrase;
        }

        if ( $sort_data_before_merge ) {
            ksort( $api_data );
        }

        // concatenate the array key value pairs.
        $parameter_string = '';
        foreach ( $api_data as $key => $val ) {

            if ( $skip_empty_values && empty( $val ) ) {
                continue;
            }

            if ( 'signature' !== $key ) {
                $val = urlencode( $val );
                $parameter_string .= "$key=$val&";
            }
        }
        // when not sorting passphrase should be added to the end before md5
        if ( $sort_data_before_merge ) {
            $parameter_string = rtrim( $parameter_string, '&' );
        } elseif ( ! empty( $this->pass_phrase ) ) {
            $parameter_string .= 'passphrase=' . urlencode( $this->pass_phrase );
        } else {
            $parameter_string = rtrim( $parameter_string, '&' );
        }

        return $parameter_string;
    }

    /**
     * @since 1.4.0 introduced.
     * @param WC_Order $order
     */
    public function process_pre_order_payments( $order ) {

        // The total amount to charge is the the order's total.
        $total = $order->get_total() - $this->get_pre_order_fee( $order->get_order_number() );
        $token = $this->_get_pre_order_token( $order );

        if ( ! $token ) {
            return;
        }
        // get the payment token and attempt to charge the transaction
        $item_name = 'pre-order';
        $results = $this->submit_add_hoc_payment( $token, $total, $item_name );

        if ( is_wp_error( $results ) ) {
            $order->update_status( 'failed', sprintf( __( 'LaybyCafe Pre-Order payment transaction failed (%s:%s)', 'woocommerce-gateway-laybycafe' ), $results->get_error_code() ,$results->get_error_message() ) );
            return;
        }

        // Payment completion will be handled by ITN callback
    }

    /**
     * Setup constants.
     *
     * Setup common values and messages used by the LaybyCafe gateway.
     *
     * @since 1.0.0
     */
    public function setup_constants() {
        //// Create user agent string
        define( 'PF_SOFTWARE_NAME', 'WooCommerce' );
        define( 'PF_SOFTWARE_VER', WC_VERSION );
        define( 'PF_MODULE_NAME', 'WooCommerce-LaybyCafe-Free' );
        define( 'PF_MODULE_VER', $this->version );

        // Features
        // - PHP
        $pfFeatures = 'PHP ' . phpversion() .';';

        // - cURL
        if ( in_array( 'curl', get_loaded_extensions() ) ) {
            define( 'PF_CURL', '' );
            $pfVersion = curl_version();
            $pfFeatures .= ' curl '. $pfVersion['version'] .';';
        } else {
            $pfFeatures .= ' nocurl;';
        }

        // Create user agrent
        define( 'PF_USER_AGENT', PF_SOFTWARE_NAME .'/'. PF_SOFTWARE_VER .' ('. trim( $pfFeatures ) .') '. PF_MODULE_NAME .'/'. PF_MODULE_VER );

        // General Defines
        define( 'PF_TIMEOUT', 15 );
        define( 'PF_EPSILON', 0.01 );

        // Messages
        // Error
        define( 'PF_ERR_AMOUNT_MISMATCH', __( 'Amount mismatch', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_BAD_ACCESS', __( 'Bad access of page', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_BAD_SOURCE_IP', __( 'Bad source IP address', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_CONNECT_FAILED', __( 'Failed to connect to LaybyCafe', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_INVALID_SIGNATURE', __( 'Security signature mismatch', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_MERCHANT_ID_MISMATCH', __( 'Merchant ID mismatch', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_NO_SESSION', __( 'No saved session found for ITN transaction', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_ORDER_ID_MISSING_URL', __( 'Order ID not present in URL', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_ORDER_ID_MISMATCH', __( 'Order ID mismatch', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_ORDER_INVALID', __( 'This order ID is invalid', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_ORDER_NUMBER_MISMATCH', __( 'Order Number mismatch', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_ORDER_PROCESSED', __( 'This order has already been processed', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_PDT_FAIL', __( 'PDT query failed', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_PDT_TOKEN_MISSING', __( 'PDT token not present in URL', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_SESSIONID_MISMATCH', __( 'Session ID mismatch', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_ERR_UNKNOWN', __( 'Unkown error occurred', 'woocommerce-gateway-laybycafe' ) );

        // General
        define( 'PF_MSG_OK', __( 'Payment was successful', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_MSG_FAILED', __( 'Payment has failed', 'woocommerce-gateway-laybycafe' ) );
        define( 'PF_MSG_PENDING',
            __( 'The payment is pending. Please note, you will receive another Instant', 'woocommerce-gateway-laybycafe' ).
            __( ' Transaction Notification when the payment status changes to', 'woocommerce-gateway-laybycafe' ).
            __( ' "Completed", or "Failed"', 'woocommerce-gateway-laybycafe' )
        );

        do_action( 'woocommerce_gateway_laybycafe_setup_constants' );
    }

    /**
     * Log system processes.
     * @since 1.0.0
     */
    public function log( $message ) {
        if ( 'yes' === $this->get_option( 'testmode' ) ) {
            if ( ! $this->logger ) {
                $this->logger = new WC_Logger();
            }
            $this->logger->add( 'laybycafe', $message );
        }
    }

    /**
     * validate_signature()
     *
     * Validate the signature against the returned data.
     *
     * @param array $data
     * @param string $signature
     * @since 1.0.0
     * @return string
     */
    public function validate_signature( $data, $signature ) {
        $result = $data['signature'] === $signature;
        $this->log( 'Signature = '. ( $result ? 'valid' : 'invalid' ) );
        return $result;
    }

    /**
     * validate_ip()
     *
     * Validate the IP address to make sure it's coming from LaybyCafe.
     *
     * @param array $sourceIP
     * @since 1.0.0
     * @return bool
     */
    public function validate_ip( $sourceIP ) {
        // Variable initialization
        $validHosts = array(
            'www.laybycafe.co.za',
            'sandbox.laybycafe.co.za',
            'w1w.laybycafe.co.za',
            'w2w.laybycafe.co.za',
        );

        $validIps = array();

        foreach( $validHosts as $pfHostname ) {
            $ips = gethostbynamel( $pfHostname );

            if ( $ips !== false ) {
                $validIps = array_merge( $validIps, $ips );
            }
        }

        // Remove duplicates
        $validIps = array_unique( $validIps );

        $this->log( "Valid IPs:\n". print_r( $validIps, true ) );

        return in_array( $sourceIP, $validIps );
    }

    /**
     * validate_response_data()
     *
     * @param array $post_data
     * @param string $proxy Address of proxy to use or NULL if no proxy.
     * @since 1.0.0
     * @return bool
     */
    public function validate_response_data( $post_data, $proxy = null ) {
        $this->log( 'Host = '. $this->validate_url );
        $this->log( 'Params = '. print_r( $post_data, true ) );

        if ( ! is_array( $post_data ) ) {
            return false;
        }

        $response = wp_remote_post( $this->validate_url, array(
            'body'       => $post_data,
            'timeout'    => 70,
            'user-agent' => PF_USER_AGENT
        ));

        if ( is_wp_error( $response ) || empty( $response['body'] ) ) {
            return false;
        }

        parse_str( $response['body'], $parsed_response );

        $response = $parsed_response;

        $this->log( "Response:\n" . print_r( $response, true ) );

        // Interpret Response
        if ( is_array( $response ) && in_array( 'VALID', array_keys( $response ) ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * amounts_equal()
     *
     * Checks to see whether the given amounts are equal using a proper floating
     * point comparison with an Epsilon which ensures that insignificant decimal
     * places are ignored in the comparison.
     *
     * eg. 100.00 is equal to 100.0001
     *
     * @author Jonathan Smit
     * @param $amount1 Float 1st amount for comparison
     * @param $amount2 Float 2nd amount for comparison
     * @since 1.0.0
     * @return bool
     */
    public function amounts_equal ( $amount1, $amount2 ) {
        return ! ( abs( floatval( $amount1 ) - floatval( $amount2 ) ) > PF_EPSILON );
    }
}
