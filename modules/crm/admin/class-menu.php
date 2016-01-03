<?php
namespace WeDevs\ERP\CRM;

/**
 * Admin Menu
 */
class Admin_Menu {

    /**
     * Kick-in the class
     *
     * @since 1.0
     *
     * @return void
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * Add menu items
     *
     * @since 1.0
     *
     * @return void
     */
    public function admin_menu() {

        add_menu_page( __( 'CRM', 'wp-erp' ), __( 'CRM', 'wp-erp' ), 'manage_options', 'erp-sales', array( $this, 'dashboard_page' ), 'dashicons-chart-bar', null );

        add_submenu_page( 'erp-sales', __( 'Overview', 'wp-erp' ), __( 'Overview', 'wp-erp' ), 'manage_options', 'erp-sales', array( $this, 'dashboard_page' ) );
        add_submenu_page( 'erp-sales', __( 'Contact', 'wp-erp' ), __( 'Contact', 'wp-erp' ), 'manage_options', 'erp-sales-customers', array( $this, 'contact_page' ) );
        add_submenu_page( 'erp-sales', __( 'Company', 'wp-erp' ), __( 'Company', 'wp-erp' ), 'manage_options', 'erp-sales-companies', array( $this, 'company_page' ) );
        // add_submenu_page( 'erp-sales', __( 'Oppurtunity', 'wp-erp' ), __( 'Oppurtunity', 'wp-erp' ), 'manage_options', 'erp-sales-oppurtunity', array( $this, 'dashboard_page' ) );
        // add_submenu_page( 'erp-sales', __( 'Customer Category', 'wp-erp' ), __( 'Customer Category', 'wp-erp' ), 'manage_options', 'erp-sales-category', array( $this, 'dashboard_page' ) );
        // add_submenu_page( 'erp-sales', __( 'Newsletter', 'wp-erp' ), __( 'Newsletter', 'wp-erp' ), 'manage_options', 'erp-sales-newsletter', array( $this, 'dashboard_page' ) );
        // add_submenu_page( 'erp-sales', __( 'Sales Team', 'wp-erp' ), __( 'Sales Team', 'wp-erp' ), 'manage_options', 'erp-sales-team', array( $this, 'dashboard_page' ) );

        /** Phone Calls and SMS */
        //add_menu_page( __( 'Calls & SMS', 'wp-erp' ), __( 'Calls & SMS', 'wp-erp' ), 'manage_options', 'erp-calls', array( $this, 'dashboard_page' ), 'dashicons-microphone', null );

        // add_submenu_page( 'erp-calls', __( 'Overview', 'wp-erp' ), __( 'Overview', 'wp-erp' ), 'manage_options', 'erp-calls', array( $this, 'dashboard_page' ) );
        // add_submenu_page( 'erp-calls', __( 'Logged Calls', 'wp-erp' ), __( 'Logged Calls', 'wp-erp' ), 'manage_options', 'erp-calls-logged', array( $this, 'dashboard_page' ) );
        // add_submenu_page( 'erp-calls', __( 'Scheduled Calls', 'wp-erp' ), __( 'Scheduled Calls', 'wp-erp' ), 'manage_options', 'erp-calls-schedule', array( $this, 'dashboard_page' ) );
        // add_submenu_page( 'erp-calls', __( 'SMS', 'wp-erp' ), __( 'SMS', 'wp-erp' ), 'manage_options', 'erp-calls-sms', array( $this, 'dashboard_page' ) );
    }

    /**
     * Handles the dashboard page
     *
     * @since 1.0
     *
     * @return void
     */
    public function dashboard_page() {
        include WPERP_CRM_VIEWS . '/dashboard.php';
    }

    /**
     * Handles the dashboard page
     *
     * @since 1.0
     *
     * @return void
     */
    public function contact_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ( $action ) {

            case 'view':
                $customer = new Contact( $id );

                if ( ! $customer->id ) {
                    wp_die( __( 'Contact not found!', 'wp-erp' ) );
                }

                $template = WPERP_CRM_VIEWS . '/contact/single.php';
                break;

            default:
                $template = WPERP_CRM_VIEWS . '/contact.php';
                break;
        }

        $template = apply_filters( 'erp_contact_template', $template, $action, $id );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Handles the dashboard page
     *
     * @since 1.0
     *
     * @return void
     */
    public function company_page() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ( $action ) {

            case 'view':
                $customer = new Contact( $id );

                if ( ! $customer->id ) {
                    wp_die( __( 'Company not found!', 'wp-erp' ) );
                }

                $template = WPERP_CRM_VIEWS . '/company/single.php';
                break;

            default:
                $template = WPERP_CRM_VIEWS . '/company.php';
                break;
        }

        $template = apply_filters( 'erp_company_template', $template, $action, $id );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Handles the dashboard page
     *
     * @since 1.0
     *
     * @return void
     */
    public function leads_page() {

        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ($action) {

            case 'view':
                $template = WPERP_CRM_VIEWS . '/leads/single.php';
                break;

            default:
                $template = WPERP_CRM_VIEWS . '/leads.php';
                break;
        }

        $template = apply_filters( 'erp_leads_template', $template, $action, $id );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Handles the dashboard page
     *
     * @since 1.0
     *
     * @return void
     */
    public function oppurtunity_page() {
        include WPERP_CRM_VIEWS . '/dashboard.php';
    }
}

new Admin_Menu();