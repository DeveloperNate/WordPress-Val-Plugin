<?php
/**
 * @package Nathan
 */
/*
Plugin Name: Hearts Title
Plugin URI: none
Description:  This is plugin about hearts
Version: 0.1
Author: Nathan
Author URI: 
License: GPLv2 
Text Domain: Nathan 
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.


*/

// Make sure we don't expose any info if called directly

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class Heart{

    function __construct(){
        // any code that is in here will be executed 

        add_action('wp_enqueue_scripts',array($this,'script')); // adds the scripts method to the correct hook for adding my required scripts
		add_action('widgets_init',array($this,'regWidget')); // adds my addWidget method to the correct hook for creating my widget
        
    }

    function script(){

        // all my scripts that I want to add to my plugin
        wp_enqueue_style('HeartStyle',plugins_url('/hearts\css\styles.css')); //adds my CSS script
		wp_enqueue_script('HeartScript', plugins_url('/hearts\js\main.js'),array('jquery')); // add my JQUERY script 
		


    }

    function regWidget(){

        // register our widget


    }
}