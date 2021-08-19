<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.janushenderson.com/
 * @since      1.0.0
 *
 * @package    Jh_Nyt_Top_Stories
 * @subpackage Jh_Nyt_Top_Stories/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Jh_Nyt_Top_Stories
 * @subpackage Jh_Nyt_Top_Stories/public
 * @author     Janus Henderson <webtechteam@janushenderson.com>
 */
class Jh_Nyt_Top_Stories_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jh-nyt-top-stories-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jh-nyt-top-stories-public.js', array( 'jquery' ), $this->version, false );
	}
}

// Create a short code
function jh_nyt_shortcode($attr) { 

  $args = shortcode_atts( array(
    'title' => '#',
    'section' => 'home' 
  ), $attr );

  // Get the API response
  $url = 'https://api.nytimes.com/svc/topstories/v2/' . $args['section'] . '.json?api-key=7AHHtGVhc4kF8Y7O4Z4IV0wt8RXDwXg7';
  $response = file_get_contents($url);
  $stories = json_decode($response, true);
  
  $title = "<h2>" . $args['title'] . "</h2>";
  $list .= "<ul>";
  foreach ($stories['results'] as $item) {
    $list .= "<li><a href='" . $item['url'] . "'>" . $item['title'] . "</a></li>";
  }
  $list .= "</ul>";
  $output = $title . $list;

  return $output;
} 
add_shortcode('nyt', 'jh_nyt_shortcode'); 

// Register Custom Post Type
function custom_post_type() {
	$labels = array(
		'name'                  => _x( 'NYT Top Stories', 'Post Type General Name', 'jh-nyt-top-stories' ),
		'singular_name'         => _x( 'NYT Top Story', 'Post Type Singular Name', 'jh-nyt-top-stories' ),
		'menu_name'             => __( 'NYT Story', 'jh-nyt-top-stories' ),
		'name_admin_bar'        => __( 'NYT Story', 'jh-nyt-top-stories' ),
		'archives'              => __( 'NYT Story Archives', 'jh-nyt-top-stories' ),
		'attributes'            => __( 'NYT Story Attributes', 'jh-nyt-top-stories' ),
		'parent_item_colon'     => __( 'Parent NYT Story:', 'jh-nyt-top-stories' ),
		'all_items'             => __( 'All NYT Stories', 'jh-nyt-top-stories' ),
		'add_new_item'          => __( 'Add New NYT Story', 'jh-nyt-top-stories' ),
		'add_new'               => __( 'Add New', 'jh-nyt-top-stories' ),
		'new_item'              => __( 'New NYT Story', 'jh-nyt-top-stories' ),
		'edit_item'             => __( 'Edit NYT Story', 'jh-nyt-top-stories' ),
		'update_item'           => __( 'Update NYT Story', 'jh-nyt-top-stories' ),
		'view_item'             => __( 'View NYT Story', 'jh-nyt-top-stories' ),
		'view_items'            => __( 'View NYT Stories', 'jh-nyt-top-stories' ),
		'search_items'          => __( 'Search NYT Story', 'jh-nyt-top-stories' ),
		'not_found'             => __( 'Not found', 'jh-nyt-top-stories' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jh-nyt-top-stories' ),
		'featured_image'        => __( 'Featured Image', 'jh-nyt-top-stories' ),
		'set_featured_image'    => __( 'Set featured image', 'jh-nyt-top-stories' ),
		'remove_featured_image' => __( 'Remove featured image', 'jh-nyt-top-stories' ),
		'use_featured_image'    => __( 'Use as featured image', 'jh-nyt-top-stories' ),
		'insert_into_item'      => __( 'Insert into NYT Story', 'jh-nyt-top-stories' ),
		'uploaded_to_this_item' => __( 'Uploaded to this NYT Story', 'jh-nyt-top-stories' ),
		'items_list'            => __( 'NYT Stories list', 'jh-nyt-top-stories' ),
		'items_list_navigation' => __( 'NYT Stories list navigation', 'jh-nyt-top-stories' ),
		'filter_items_list'     => __( 'Filter NYT Stories list', 'jh-nyt-top-stories' ),
	);
	$args = array(
		'label'                 => __( 'NYT Top Story', 'jh-nyt-top-stories' ),
		'description'           => __( 'Imported top stories from NYT', 'jh-nyt-top-stories' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-welcome-widgets-menus',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'jh_nyt_top_stories', $args );
}
add_action( 'init', 'custom_post_type', 0 );
