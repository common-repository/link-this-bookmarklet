<?php 
 /*
 Plugin Name: Link This Bookmarklet
 Version: 1.0
 Plugin URI: http://blog.slaven.net.au/wordpress-plugins/link-this-bookmarklet-wordpress-plugin/
 Description: Provides the ability to have a bookmarklet on your browser that will let you add any page as a link on your blog. Replaces the functionality of the Add Link bookmarklet that was removed in WordPress 2.5
 Author: Glenn Slaven
 Author URI: http://blog.slaven.net.au/

 Copyright 2008 Glenn Slaven  (email : gdalziel@gmail.com)
 */


class LinkThisBookmarklet {
	
	var $link_url;
	var $plugin_basename; 
	
	function Init() {
		add_filter('plugin_row_meta', array(&$this, 'RegisterPluginLinks'),10,2);
		
		if ( isset($_REQUEST['link-this-bookmarklet'])) {
			add_action('template_redirect', array(&$this, 'ShowBookmarklet'));
		}
		
		if ( isset($_REQUEST['link-this-bookmarklet-js'])) {
			add_action('template_redirect', array(&$this, 'ShowBookmarkletJS'));
		}
		
		$this->plugin_basename = plugin_basename(__FILE__);
		$this->link_url = "javascript:void((function(){var%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('src','". get_option('siteurl') . "/?link-this-bookmarklet-js=1');document.body.appendChild(e)})())";
	}
	
	function RegisterPluginLinks($links, $file) {
		if ($file == $this->plugin_basename) {
			$links[] = '<a href="' . $this->link_url . '">' . __('Add Link to Wordpress') . '</a> (Drag this link to your links bar)';
		}
		return $links;		
	}
	
	function ShowBookmarklet() {
		ob_start();
		
		require('link-this-bookmarklet-ui.php');
		
		ob_end_flush();
		die();
	}
	
function ShowBookmarkletJS() {
		ob_start();
		require('link-this-bookmarklet-js.php');
		ob_end_flush();
		die();
	}
}

if(defined('ABSPATH') && defined('WPINC')) { 
	add_action("init",array(new LinkThisBookmarklet(),"Init"),1000,0);
}
?>