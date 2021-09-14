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

	/**
	 *  show the top stories
	 * 	[nyt_top_stories count="5" "sort"="desc"]
	 * 
	 * @since 1.0.0
	 */
	public function nyt_top_stores( $atts = array(), $conten = null ) {
		extract(
			shortcode_atts(
				array(
					'count' => '5',
					'sort' => 'desc'
		   		),
			$atts)
		);

		$stories = get_posts(
			array(
				'numberposts' => $count,
				'post_type' => 'nyt-top-story',
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => $sort
			)
		);

		$html = '';
		if ( !empty( $stories ) ) {
			ob_start();			
			?>
			<div class="nyt_top_stories_container">
				<ul>
					<?php foreach ($stories as $story):
					$title = get_the_title( $story );
					$link = get_post_meta( $story->ID, 'URL', true );
					$byline = get_post_meta( $story->ID, 'byline', true );
				 ?>
					<li class="nyt_story_item">
						<h3><a href="<?php echo $link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h3>
						<p><?php echo $byline; ?></p>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php
			$html = ob_get_clean();
		}

		return $html;
	}

}
