<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://akshaykn.vercel.app/
 * @since      1.0.0
 *
 * @package    Trekthehimalayas
 * @subpackage Trekthehimalayas/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Trekthehimalayas
 * @subpackage Trekthehimalayas/admin
 * @author     Akshay K Nair <akshayakn6@gmail.com>
 */
class Trekthehimalayas_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Trekthehimalayas_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trekthehimalayas_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/trekthehimalayas-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Trekthehimalayas_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trekthehimalayas_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/trekthehimalayas-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * From define_admin_hooks to render_admin_page
	 *
	 * @since    1.0.0
	 */
	public function tth_admin_menu() {
		add_menu_page( 'TTH Settings', 'TTH Settings', 'manage_options', 'tth-settings', array( $this, 'render_admin_page' ), 'dashicons-admin-generic', 75);
		add_submenu_page('tth-settings', 'Other Settings', 'Other Settings', 'manage_options', 'other-settings', array( $this, 'render_admin_subpage' ));
	}

	/**
	 * From tth_admin_menu to trekthehimalayas-admin-display.php
	 *
	 * @since    1.0.0
	 */
	public function render_admin_page() {
		require_once 'partials/trekthehimalayas-admin-display.php';
	}

	/**
	 * From tth_admin_menu to trekthehimalayas-admin-display.php
	 *
	 * @since    1.0.0
	 */
	public function render_admin_subpage() {
		require_once 'partials/trekthehimalayas-admin-subpage-display.php';
	}

	
	/**
	 * From define_admin_hooks to trekthehimalayas-admin-display.php
	 *
	 * @since    1.0.0
	 */
	public function create_treks_cpt() {

		/**
		 * Post Type: treks.
		 */
		register_post_type( "treks", [
			"label" => __( 'treks' ),
			"labels" => [
				"name" => __( 'Treks' ),
				"singular_name" => __( 'Trek' )
			],
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => "allTreks",
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => true,
			"rewrite" => [ "slug" => "allTreks", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail", "revisions", "excerpt" ],
			"show_in_graphql" => false,
			'menu_icon' => 'dashicons-location-alt',
			'menu_position' => 5,
			'taxonomies' => array( 'season', 'region', 'theme', 'difficulty', 'interest',
				'fitness', 'participation', 'essential', 'riskrespond', 'pickupdropoff'
			),
		]);

		/**
		 * Post Type: customizetrek.
		 */
		register_post_type( "customizetrek", [
			"label" => __( 'customizetrek' ),
			"labels" => [
				"name" => __( 'Customize Trek' ),
				"singular_name" => __( 'Customize Trek' )
			],
			"description" => "",
			"public" => false,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			'show_in_menu' => 'edit.php?post_type=treks',
			"show_in_nav_menus" => false,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => true,
			"rewrite" => [ "slug" => "", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "revisions" ],
			"show_in_graphql" => false,
		]);

		/**
		 * Post Type: suggesttrek.
		 */
		register_post_type( "suggesttrek", [
			"label" => __( 'suggesttrek' ),
			"labels" => [
				"name" => __( 'Suggest trek' ),
				"singular_name" => __( 'Suggest trek' )
			],
			"description" => "",
			"public" => false,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			'show_in_menu' => 'edit.php?post_type=treks',
			"show_in_nav_menus" => false,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => true,
			"rewrite" => [ "slug" => "", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "revisions" ],
			"show_in_graphql" => false,
		]);

		/**
		 * Post Type: mailinglist.
		 */
		register_post_type( "mailinglist", [
			"label" => __( 'mailinglist' ),
			"labels" => [
				"name" => __( 'Mailing List' ),
				"singular_name" => __( 'Mailing List' )
			],
			"description" => "",
			"public" => false,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			'show_in_menu' => 'edit.php?post_type=treks',
			"show_in_nav_menus" => false,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => true,
			"rewrite" => [ "slug" => "", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "revisions" ],
			"show_in_graphql" => false,
		]);

		/**
		 * Post Type: bookings.
		 */
		register_post_type( "bookings", [
			"label" => __( 'bookings' ),
			"labels" => [
				"name" => __( 'Bookings' ),
				"singular_name" => __( 'Booking' )
			],
			"description" => "",
			"public" => false,
			"publicly_queryable" => false,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => false,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => true,
			"rewrite" => [ "slug" => "", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail", "revisions", "excerpt" ],
			"show_in_graphql" => false,
			'menu_icon' => 'dashicons-tickets-alt',
			'menu_position' => 5
		]);

		/**
		 * Post Type: coupons.
		 */
		register_post_type( "coupons", [
			"label" => __( 'coupons' ),
			"labels" => [
				"name" => __( 'Coupons' ),
				"singular_name" => __( 'Coupon' )
			],
			"description" => "",
			"public" => false,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			"show_in_menu" => "edit.php?post_type=bookings",
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => true,
			"rewrite" => [ "slug" => "", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail", "revisions", "excerpt" ],
			"show_in_graphql" => false
		]);
	}

	/**
	 * New columns for treks CPT
	 * 
	 * @since    1.0.0
	 */
	public function treks_posts_columns( $columns )
	{
		$columns = array(
			'cb' => $columns['cb'],
			'title' => __( 'Title' ),
			'region' => __( 'Region' ),
			'status' => __( 'Status' ),
			'permalink' => __( 'Permalink' ),
			'date' => __( 'Date' ),
		);

		return $columns;
	}

	/**
	 * Column content for treks CPT
	 * 
	 * @since    1.0.0
	 */	
	public function treks_posts_column( $column, $post_id )
	{
		if ( 'region' === $column ) {
			echo 'Kerala';
		}
		if ( 'permalink' === $column ) {
			$base = get_the_permalink( $post_id, array(80, 80) ); 
			?>
				<a href="<?= $base; ?>" target="_blank">
					<?= basename($base); ?>
					<span class="dashicons dashicons-external"></span>
				</a>
			<?php
		}
		if ( 'status' === $column ) { 
			$live = get_post_status($post_id) == "publish"? true : false;
			?>
			<div class="wrapper">
				<div class="status-icon <?= $live? "live":"draft" ?>">
					<span class='dashicons dashicons-<?= $live? "yes-alt":"dismiss" ?>'></span>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * CPT column CSS styles
	 * 
	 * @since    1.0.0
	 */
	public function cpt_column_widths()
	{ ?>
		<style type="text/css">
			.posts .column-region { width:9%; }
			.posts .column-status { width:9%; }
			.posts .column-permalink { width:18%; }
			.posts .column-permalink a {
				display: flex;
			}
			.posts .column-permalink .dashicons { 
				font-size:15px;
				display: flex;
				align-items: center;
				justify-content: space-around;
				opacity: .8;
			}
			.posts .column-status .wrapper{
				width:100%;
				display:flex;
				margin:2% 0 0 10%;
				display: flex;
				align-items: center;
			}
			.posts .column-status .wrapper .status-icon{
				border-radius:10px;
			}
			.posts .column-status .wrapper .status-icon.live{
				color:#3bd33b;
			}
			.posts .column-status .wrapper .status-icon.draft{
				color:#ff2f2f;
			}
		</style> <?php
	}

	/**
	 * CPT sortable columns
	 * 
	 * @since    1.0.0
	 */
	public function smashing_treks_sortable_columns( $columns )
	{
		$columns['status'] = 'status';
		$columns['region'] = 'region';
		$columns['permalink'] = 'permalink';
  		return $columns;
	}

	/**
	 * New taxonomies for all the custom functionalitites 
	 * 
	 * @since    1.0.0
	 */
	public function add_treks_taxonomies()
	{
		register_taxonomy('season', ['treks'], array(
			'hierarchical' => true,
			'labels' => array(
			  'name' => _x( 'Seasons', 'taxonomy general name' ),
			  'singular_name' => _x( 'Season', 'taxonomy singular name' ),
			  'menu_name' => __( 'Seasons' ),
			),
			"show_in_rest" => true,
			"show_in_menu" => false,
			"show_in_quick_edit" => false,
			'rewrite' => array(
			  'slug' => 'season',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('region', ['treks'], array(
			'hierarchical' => true,
			'labels' => array(
			  'name' => _x( 'Regions', 'taxonomy general name' ),
			  'singular_name' => _x( 'Region', 'taxonomy singular name' ),
			  'menu_name' => __( 'Regions' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'regions',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('theme', ['treks'], array(
			'hierarchical' => true,
			'labels' => array(
			  'name' => _x( 'Themes', 'taxonomy general name' ),
			  'singular_name' => _x( 'Theme', 'taxonomy singular name' ),
			  'menu_name' => __( 'Themes' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'themes',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('difficulty', ['treks'], array(
			'hierarchical' => true,
			'labels' => array(
			  'name' => _x( 'Difficulties', 'taxonomy general name' ),
			  'singular_name' => _x( 'Difficulty', 'taxonomy singular name' ),
			  'menu_name' => __( 'Difficulties' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'difficulties',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('interest', ['treks'], array(
			'hierarchical' => true,
			'label' => 'Intrest',
			'labels' => array(
			  'name' => _x( 'Interests', 'taxonomy general name' ),
			  'singular_name' => _x( 'Interest', 'taxonomy singular name' ),
			  'menu_name' => __( 'Interests' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'interests',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('fitness', ['treks'], array(
			'hierarchical' => true,
			'label' => 'Fitness Policy',
			'labels' => array(
			  'name' => _x( 'Fitness Policies', 'taxonomy general name' ),
			  'singular_name' => _x( 'Fitness Policy', 'taxonomy singular name' ),
			  'menu_name' => __( 'Fitness Policies' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'fitness',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('participation', ['treks'], array(
			'hierarchical' => true,
			'label' => 'Participation Policy',
			'labels' => array(
			  'name' => _x( 'Participation Policies', 'taxonomy general name' ),
			  'singular_name' => _x( 'Participation Policy', 'taxonomy singular name' ),
			  'menu_name' => __( 'Participation Policies' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'participation',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('essential', ['treks'], array(
			'hierarchical' => true,
			'label' => 'Essentials',
			'labels' => array(
			  'name' => _x( 'Essentials', 'taxonomy general name' ),
			  'singular_name' => _x( 'Essentials', 'taxonomy singular name' ),
			  'menu_name' => __( 'Essentials' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'essential',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('riskrespond', ['treks'], array(
			'hierarchical' => true,
			'label' => 'Risk and Respond',
			'labels' => array(
			  'name' => _x( 'Risk and Respond', 'taxonomy general name' ),
			  'singular_name' => _x( 'Risk and Respond', 'taxonomy singular name' ),
			  'menu_name' => __( 'Risk and Respond' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'riskrespond',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
		register_taxonomy('pickupdropoff', ['treks'], array(
			'hierarchical' => true,
			'label' => 'Pickup/Dropoff Place',
			'labels' => array(
			  'name' => _x( 'Pickup/Dropoff Place', 'taxonomy general name' ),
			  'singular_name' => _x( 'Pickup/Dropoff Place', 'taxonomy singular name' ),
			  'menu_name' => __( 'Pickup/Dropoff Place' ),
			),
			"show_in_rest" => true,
			"show_in_quick_edit" => false,
			"show_in_menu" => false,
			'rewrite' => array(
			  'slug' => 'pickupdropoff',
			  'with_front' => false,
			  'hierarchical' => false
			),
		  ));
	}
	
}
