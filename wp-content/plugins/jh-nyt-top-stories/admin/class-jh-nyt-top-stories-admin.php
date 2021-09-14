<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.janushenderson.com/
 * @since      1.0.0
 *
 * @package    Jh_Nyt_Top_Stories
 * @subpackage Jh_Nyt_Top_Stories/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jh_Nyt_Top_Stories
 * @subpackage Jh_Nyt_Top_Stories/admin
 * @author     Janus Henderson <webtechteam@janushenderson.com>
 */

class Jh_Nyt_Top_Stories_Admin
{

	/**
	 * wp cron event
	 * 
	 * @since 1.0.0
	 */
	const cron_event = 'jh_nyt_top_stories_cron_event';
	/**
	 * api url
	 * 
	 * @since 1.0.0	
	 * @var string
	 */
	const url = 'https://api.nytimes.com/svc/topstories/v2/home.json?api-key=';

	/**
	 * option api key name
	 * 
	 * @since 1.0.0
	 * @var string
	 */

	const api_key = 'jh_nyt_top_stories_api_key';

	/**
	 * option cron enable name
	 * 
	 * @since 1.0.0
	 * @var 1.0.0
	 */

	const cron_enable = 'jh_nyt_top_stories_cron_enable';

	/**
	 * option cron job hour name
	 * 
	 * @since 1.0.0
	 * @var 1.0.0
	 */

	const cron_hour = 'jh_nyt_top_stories_cron_hour';

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jh_Nyt_Top_Stories_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jh_Nyt_Top_Stories_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/jh-nyt-top-stories-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jh_Nyt_Top_Stories_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jh_Nyt_Top_Stories_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/jh-nyt-top-stories-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Register Post Type
	 * Post Type: NYT Top Stories
	 * 
	 * @since 1.0.0
	 */
	public function register_post_types()
	{
		$labels = array(
			'name'               => __( 'NYT Top Stories', 'jh-nyt-top-stories' ),
			'singular_name'      => __( 'NYT Top Story', 'jh-nyt-top-stories' ),
			'add_new'            => __( 'Add New', 'jh-nyt-top-stories' ),
			'add_new_item'       => __( 'Add New NYT Top Story', 'jh-nyt-top-stories' ),
			'edit_item'          => __( 'Edit NYT Top Story', 'jh-nyt-top-stories' ),
			'new_item'           => __( 'New NYT Top Story', 'jh-nyt-top-stories' ),
			'all_items'          => __( 'All NYT Top Story', 'jh-nyt-top-stories' ),
			'view_item'          => __( 'View NYT Top Story', 'jh-nyt-top-stories' ),
			'search_items'       => __( 'Search NYT Top Stories', 'jh-nyt-top-stories' ),
			'not_found'          => __( 'No NYT Top Stories found', 'jh-nyt-top-stories' ),
			'not_found_in_trash' => __( 'No NYT Top Stories found in the Trash', 'jh-nyt-top-stories' ),
			'parent_item_colon'  => '',
			'menu_name'          => 'NYT Top Stories'
		);

		$args = array(
			'labels'             => $labels,
			'description'        => '',
			'public'             => true,
			'exclude_from_search' => true,
			'show_ui'            => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'supports'           => array( 'title', 'revisions', 'excerpt' ),
			'show_in_rest'       => true
		);

		register_post_type('nyt-top-story', $args);

		// register Category
		register_taxonomy(
			'nyt_cat',
			array( 'nyt-top-story' ),
			array(
				'hierarchical'          => true,
				'label'                 => __( 'Categories', 'jh-nyt-top-stories' ),
				'labels'                => array(
					'name'              => __( 'NYT categories', 'jh-nyt-top-stories' ),
					'singular_name'     => __( 'Category', 'jh-nyt-top-stories' ),
					'menu_name'         => __( 'Categories', 'Admin menu name', 'jh-nyt-top-stories' ),
					'search_items'      => __( 'Search categories', 'jh-nyt-top-stories' ),
					'all_items'         => __( 'All categories', 'jh-nyt-top-stories' ),
					'parent_item'       => __( 'Parent category', 'jh-nyt-top-stories' ),
					'parent_item_colon' => __( 'Parent category:', 'jh-nyt-top-stories' ),
					'edit_item'         => __( 'Edit category', 'jh-nyt-top-stories' ),
					'update_item'       => __( 'Update category', 'jh-nyt-top-stories' ),
					'add_new_item'      => __( 'Add new category', 'jh-nyt-top-stories' ),
					'new_item_name'     => __( 'New category name', 'jh-nyt-top-stories' ),
					'not_found'         => __( 'No categories found', 'jh-nyt-top-stories' ),
				),
				'show_ui'               => true,
				'query_var'             => true,
				'rewrite'               => array(
					'slug'         => 'nyt_cat',
					'with_front'   => false,
					'hierarchical' => true,
				),
			)
		);


		// register Tags
		register_taxonomy(
			'nyt_tag',
			array('nyt-top-story'),
			array(
				'hierarchical'          => false,
				'label'                 => __('NYT tags', 'jh-nyt-top-stories'),
				'labels'                => array(
					'name'                       => __('NYT tags', 'jh-nyt-top-stories'),
					'singular_name'              => __('Tag', 'jh-nyt-top-stories'),
					'menu_name'                  => __('Tags', 'Admin menu name', 'jh-nyt-top-stories'),
					'search_items'               => __('Search tags', 'jh-nyt-top-stories'),
					'all_items'                  => __('All tags', 'jh-nyt-top-stories'),
					'edit_item'                  => __('Edit tag', 'jh-nyt-top-stories'),
					'update_item'                => __('Update tag', 'jh-nyt-top-stories'),
					'add_new_item'               => __('Add new tag', 'jh-nyt-top-stories'),
					'new_item_name'              => __('New tag name', 'jh-nyt-top-stories'),
					'popular_items'              => __('Popular tags', 'jh-nyt-top-stories'),
					'separate_items_with_commas' => __('Separate tags with commas', 'jh-nyt-top-stories'),
					'add_or_remove_items'        => __('Add or remove tags', 'jh-nyt-top-stories'),
					'choose_from_most_used'      => __('Choose from the most used tags', 'jh-nyt-top-stories'),
					'not_found'                  => __('No tags found', 'jh-nyt-top-stories'),
				),
				'show_ui'               => true,
				'query_var'             => true,
				'rewrite'               => array(
					'slug' => 'nyt_tag',
					'with_front' => false,
				),
			)
		);
	}

	/**
	 * add plugin menu items
	 * 
	 * @since 1.0.0
	 */

	public function add_plugin_menu_items()
	{
		add_submenu_page(
			'edit.php?post_type=nyt-top-story',
			__( 'Settings', 'jh-nyt-top-stories' ),
			__( 'Settings', 'jh-nyt-top-stories' ),
			'manage_options',
			'jh_nyt_admin_menu_settings',
			array( $this, 'display_admin_menu_settings_page' )
		);
	}

	/**
	 *	edit settings page
	 *  
	 * @since 1.0.0
	 */
	public function display_admin_menu_settings_page()
	{
		require_once( 'partials/jh-nyt-top-stories-admin-display.php' );
		return false;
	}

	/**
	 * Getting the data from the api and save it
	 * 
	 * @since 1.0.0
	 */
	public static function import_stories()
	{

		try {
			$api_key = get_option( self::api_key );

			if ($api_key) {
				
				$url = self::url . $api_key;
				$res = wp_remote_get(
					$url,
					array(
						'timeout' => 120
					)
				);
			
				if ( is_array( $res ) && !is_wp_error( $res ) ) {
					
					$data = json_decode( $res["body"], true );
					
					if ( $data["status"] == "OK" ) {
						$results = $data["results"];

						foreach ( $results as $result ) {
							$uri = $result["uri"];

							$args = array(
								'post_per_page' => -1,
								'post_type' => 'nyt-top-story',
								'post_status' => 'publish',
								'meta_key' => '_nyt_id',
								'meta_value' => $uri,
								
							);

							$posts = get_posts( $args );
							
							if ( empty( $posts ) ) {								
								self::save_story( $result );
							}
						}
					} else {
						return false;
					}
				} else {					
					return false;
				}
			}
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * save story
	 * 
	 * @since 1.0.0
	 */

	private static function save_story( $result )
	{
		$title = esc_sql( $result["title"] );
		$expert = esc_sql( $result["excerpt"] );
		$date = $result["published_date"];
		$url = esc_sql( $result["url"] );
		$byline = esc_sql( $result["byline"] );
		$category = $result["section"];
		$tags = $result["des_facet"];
		$uri = $result["uri"];
		
		
		$post_id = wp_insert_post(
			array(
			'post_type' => 'nyt-top-story',
			'post_status' => 'publish',
			'post_excerpt' => $expert,
			'post_modified' => strtotime( $date ),
			'post_title' => $title,
			'post_content' => '',
		) );
		
		if ( $post_id ) {
			update_post_meta( $post_id, 'URL', $url );
			update_post_meta( $post_id, 'byline', $byline );
			update_post_meta( $post_id, '_nyt_id', $uri );

			self::save_taxonomy( $category, $post_id, 'nyt_cat' );
			self::save_taxonomy( $tags, $post_id );			
		}
		
	}

	/**
	 * save taxonomy
	 * 
	 * @since 1.0.0
	 */
	public static function save_taxonomy( $tags, $post_id, $taxonomy = 'nyt_tag' ) {
		if ( is_array( $tags ) ) {
			wp_set_object_terms( $post_id, $tags, $taxonomy );
		} else {
			wp_set_object_terms( $post_id, $tags, $taxonomy );
		}
	}

	/**
	 * get the wp options
	 * 
	 * @since 1.0.0
	 */
	public static function get_option( $field = "" )
	{

		if ( !$field ) {
			$api_key = get_option( self::api_key );
			$cron_enable = get_option( self::cron_enable );
			$cron_hour = get_option( self::cron_hour );

			return array(
				'api_key' => $api_key,
				'cron_enable' => $cron_enable,
				'cron_hour' => $cron_hour
			);
		} else if ( $field == "api_key" ) {
			return get_option( self::api_key );
		} else if ( $field == "cron_enable" ) {
			return get_option( self::cron_enable );
		} else if ( $field == "cron_hour" ) {

			$hour = get_option( self::cron_hour );

			return !empty( $hour ) ? (int)$hour : 1;
		}

		return false;
	}

	/**
	 * save the option
	 * 
	 * @since 1.0.0
	 */
	public static function save_option( $posts ) {
		
		foreach ( $posts as $key => $p ) {
			if ( $key == "api_key" ) {
				update_option( self::api_key, $p );
			} else if ( $key == "cron_enable" ) {				
				update_option( self::cron_enable, $p );				
			} else if ( $key == "cron_hour" ) {
				update_option( self::cron_hour, $p );
			}
		}

		$cron_enable = isset( $posts["cron_enable"] ) ? $posts["cron_enable"] : 0;
		$cron_hour = isset( $posts["cron_hour"] ) ? $posts["cron_hour"] : 1;

		if ( $cron_enable && $cron_hour ) {
			self::set_schedule();
		}
	}

	/**
	 * enable schedule
	 * 
	 * @since 1.0.0
	 */
	public static function set_schedule( ) {

		wp_clear_scheduled_hook( self::cron_event );

        if ( ! wp_next_scheduled( self::cron_event ) ) {

            $enable = self::get_option( "cron_enable" );

			if ( $enable ) {
				$hour = self::get_option( "cron_hour" );
				$name = ($hour == 1) ? "hourly" :  "every-$hour-hours";
				$time = time();
				
				wp_schedule_event( $time, $name, self::cron_event );
			}
			
            
        } else {

        }
	}

	/**
	 * add the schedule names
	 * 
	 * @since 1.0.0
	 */
	public function add_schedule_hours( $schedules ) {

		$hour = self::get_option( 'cron_hour' );		

		$schedules["hourly"] = array(
			'interval'  => 60,
			'display'   => __( "hourly", 'jh-nyt-top-stories' )
		);

		if ( $hour > 1 ) {
			$schedules["every-$hour-hours"] = array(
				'interval'  => $hour * 60,
				'display'   => __( "Every $hour hours", 'jh-nyt-top-stories' )
			);
		}
		
		return $schedules;
	}

	/**
	 * add the schedule callback
	 * 
	 * @since 1.0.0
	 */
	public function schedule_callback() {
		self::import_stories();
	}

	/**
	 * add the cli
	 * 
	 * @since 1.0.0
	 */
	public function add_cli() {

		WP_CLI::add_command( 'nyt_top_stories', array( $this, 'import' ) );
	}

	/**
	 * add the command list
	 * 
	 * example
	 * 		wp nyt_top_stories import
	 * 
	 * @since 1.0.0
	 */
	public function import() {
		WP_CLI::line( 'Importing the data form ' . self::url );
		WP_CLI::line( 'Starting...' );
		$imported = self::import_stories();
		if ( $imported ) {
			WP_CLI::line( __( 'Imported top stories successfully.', 'jh-nyt-top-stories' ) );
		} else {
			WP_CLI::line( WP_CLI::colorize( '%r Error:%n' . __('Please check the api key or internet.', 'jh-nyt-top-stories' ) ) );
		}
	}
}

?>