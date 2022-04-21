<?php
/**
 * @package flash-author
 * @version 1.0.0
 */
/*
Plugin Name: Flash Author
Plugin URI: https://wordpress.org/plugins/flash-author/
Description: This is a plugin to add a nice gif background image to the author.
Author: BlackCorsair
Version: 1.0.0
Requires at least: 5.9
Requires PHP: 7.4
License: GPLv2+
Author URI: https://blackdemo.store/
Update URI: https://wordpress.org/plugins/flash-author/
*/

if ( !defined('ABSPATH') ) { 
    die();
}

define( 'FAUTHOR_PLUGIN_URL', plugin_dir_url( __FILE__ ) ) ;
define( 'FAUTHOR_DIR', __DIR__ . '/' ) ;
define( 'FAUTHOR_IMG_COUNT', fnick_img_count() ) ;

function fnick_img_count() {
	$i = 1;
	foreach (glob(FAUTHOR_DIR . 'img/*.gif') as $img) {
		$i++;
    }
	return $i;
}

$flashAuthor = new flashAuthor();

class flashAuthor {
	private $target; 
	private $image; 
	private $author; 
	private $style;
	private $meta_data = '_flash_author';
  
    public function __construct() {
		/* post author */
        add_filter( 'the_author', array( $this, '_the_author' ), 11 );
		/* comment author */
        add_filter( 'get_comment_author', array( $this, '_the_comment_author' ), 11, 2 );
		/* myself options */
        add_filter( 'show_user_profile', array( $this, '_show_user_profile' ) );
        add_filter( 'personal_options_update', array( $this, '_save' ) );
		/* admin options */
        add_filter( 'edit_user_profile', array( $this, '_show_user_profile' ) );
        add_filter( 'edit_user_profile_update', array( $this, '_save' ) );
		/* load js files */
		add_action( 'admin_enqueue_scripts', array( $this, '_enqueue_scripts' ));
    }
  
    public function _the_author( $author ) {
		$this->author = $author;
		//$this->target = the_author_meta('ID');
		return $this->_the_flash();
    }
	
	public function _the_comment_author( $author, $comment_ID) {
		$this->author = $author;
		$this->target = get_comment( $comment_ID )->user_id;
		return $this->_the_flash();
    }
    
	public function _the_style() {
		return esc_attr( 'background-image: url('.FAUTHOR_PLUGIN_URL . 'img/'.$this->image.'.gif);-webkit-background-clip: text;color: transparent;background-size: 100% 100%;font-weight: bold;' );
    }
	
    public function _the_img() {
		return get_the_author_meta(  $this->meta_data, $this->target );
    }
	
    public function _the_flash() {
		$this->image = $this->_the_img();
		$this->style = $this->_the_style();
		if ( is_blog_admin() ) return $this->author;
		if ( $this->image == 0 or empty($this->image) ) {
			return $this->author;
		}
		return "<span style='{$this->style}'>{$this->author}</span>"; 
    }

    public function _save( $user_id ) {
        if ( !current_user_can( 'edit_user', $user_id ) ) {
   	        return false;
        }
		$wporg_field =  (int) sanitize_text_field( $_POST['wporg_field'] );
        update_user_meta( $user_id, $this->meta_data, $wporg_field);
    }

    public function _show_user_profile( $user ) {
		$this->target = $user->ID;
		$value = $this->_the_img();
		$author_nicename = get_the_author_meta( 'nicename' , $user->ID);
	    require_once FAUTHOR_DIR . 'tpl/items.php' ;
    }
	
	function _enqueue_scripts() {
         wp_enqueue_script( 'flash-author', FAUTHOR_PLUGIN_URL . 'js/flash-author.js');
    }
}


