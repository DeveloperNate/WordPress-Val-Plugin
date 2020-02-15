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

// Add required files by exiting if you can't widget file 
if ( file_exists(plugin_dir_path(__File__).'/includes/HeartWidget.php')) {
	require_once(plugin_dir_path(__File__).'/includes/HeartWidget.php');
}else{
	exit;
}

if (!class_exists('Heart')){ // makes sure that only one class can be created

    class Heart{

        private $options;

        function __construct(){
            // any code that is in here will be executed 

            add_action('wp_enqueue_scripts',array($this,'script')); // adds the scripts method to the correct hook for adding my required scripts
            add_action('widgets_init',array($this,'regWidget')); // adds my addWidget method to the correct hook for creating my widget
            add_action('admin_menu', array($this,'addSettingPage')); // adds my addMainPage method to the correct hook for page in setting
			add_action('admin_init', array($this,'settingFields')); // adds my SettingFields to the correct hook for adding fields into our setting page
            
        }

        function addSettingPage(){
            add_options_page('Hearts','Val Day Settings', 'manage_options','ValPlugin',array($this,'addTemplate')); // adds a new setting page 
            
			}
			
		function addTemplate(){

            // create the design for our setting page 
            ?>
            <form action="options.php" method="post">
            <?php 
            settings_fields('optionGroup'); // Gives a settings group name. This should match the group name used in register_setting().
            do_settings_sections('ValPlugin');  // Prints out all settings sections to your page Id
            ?>
            <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
            </form>
            <?php
            
			}
			
			
		function getTitle() {

			$this->options = get_option('optionName'); // gets the options array
				
			if (empty($this->options['title_string'])) { // set the option array as Heart if array is empty
				$this->options['title_string'] = 'Heart';
				}
	
			echo "<input type='text' id='plugin_title_string' name='optionName[title_string]' size='40' type='text' value='{$this->options['title_string']}' />"; // creates the field. Must have id = add_setting_field  and name = array[index]
			}

		function heartNumbers(){

			$this->options = get_option('optionName'); // gets the options array
	
			if (empty($this->options['heart_string'])) { // set the option array as Normal if array is empty
				$this->options['heart_string'] = 'Normal';
				}
	
			echo "<select id ='plugin_heart_numbers' name = 'optionName[heart_string]' >
			<option value='Few'>Few</option>
			<option value='Normal'>Normal</option>
			<option value='Many'>Many</option>
			<option value='{$this->options['heart_string']}'  selected > {$this->options['heart_string']} </option>
			</select> ";// creates the field. Must have id = add_setting_field  and name = array[index]

			}

		function plugin_options_validate($input) {
			// will validate the inputted data 
			$new_input = array(); // because we have multiple fields we need to create an array instead of a single variable
			$new_input['title_string'] = sanitize_text_field( $input['title_string'] );
			$new_input['animation_string'] = sanitize_text_field( $input['animation_string'] );
			$new_input['heart_string'] = sanitize_text_field( $input['heart_string'] );
	
			return $new_input;
			}
	
			function plugin_section_text(){
				//
			}

        function settingFields(){
            register_setting( 'optionGroup', 'optionName', array($this,'plugin_options_validate') ); // Register a setting and its data. 1 argument = setting group / 2nd arguement = setting name  / 3rd argument = validating method
			add_settings_section('mainSection', 'Main Settings', array($this,'plugin_section_text'), 'ValPlugin'); // Adds section to setting page. 1 arg = ID / 2nd = title / 3rd = method / 4th = Page name
			add_settings_field('plugin_title_string', 'Title', array($this,'getTitle'), 'ValPlugin', 'mainSection'); //Add a new field to a section of a settings page. 1 arg = ID for field / 2nd = title / 3rd = method / 4th = Page / 5th = section ID
			add_settings_field('plugin_animation_string', 'Animation Style', array($this,'selectAnimation'), 'ValPlugin', 'mainSection');
			add_settings_field('plugin_heart_numbers', 'Number of Hearts', array($this,'heartNumbers'), 'ValPlugin', 'mainSection'); 
        }

        function selectAnimation(){
            $this->options = get_option('optionName'); // gets the options array

            if (empty($this->options['animation_string'])) {// set the option array as fading if array is empty  OR finds the name of the value to put into the option value
				$this->options['animation_string'] = 'fading';
				$name = 'Fading Hearts';
			  }else{
				switch ($this->options['animation_string']) {
					case "fading":
						$name = 'Fading Heart';
						break;
					case "rain":
						$name = 'Flying Heart';
						break;
					case "rotate":
						$name = 'Rotating Hearts';
						break;
				}
			  }
			echo "<select id ='plugin_animation_string' name = 'optionName[animation_string]' >
			<option value='fading'>Fading Hearts</option>
			<option value='rain'>Flying Hearts</option>
			<option value='rotate'>Rotaing Hearts</option>
			<option value='{$this->options['animation_string']}'  selected > {$name} </option>
		  </select> ";// creates the field. Must have id = add_setting_field  and name = array[index]
			
        }

        function script(){

            // all my scripts that I want to add to my plugin
            wp_enqueue_style('HeartStyle',plugins_url('/hearts\css\styles.css')); //adds my CSS script
            wp_enqueue_script('HeartScript', plugins_url('/hearts\js\main.js'),array('jquery')); // add my JQUERY script 
        }

        function regWidget(){

            // register our widget
            register_widget('Val_Widget');//registers my widget
        }
    }
    $plugin = new Heart();  //creates the object 
}