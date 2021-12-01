<?php
/**
* Plugin Name: Color Swatch
* Plugin URI: 
* Description: This plugin is used to convert the product variation dropdown to swatch options.
* Version: 1.0
* Author: Pushpender Sharma
* Author URI: techmarbles.com
**/
defined( 'ABSPATH' ) or exit();

class ColorSwatch{

	function __construct(){
		define( 'CS_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
		define( 'CS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

		add_action('wp',array($this,'cs_on_wp_load'));
		add_action('wp_footer', array($this,'cs_load_scripts'));
		

		add_filter( 'woocommerce_dropdown_variation_attribute_options_args', array($this,'cs_dropdown_choice' ));

		add_filter('woocommerce_dropdown_variation_attribute_options_html', array($this,'cs_change_dropdown_to_swatch'),10,2);

	}

	function cs_on_wp_load(){
		if( is_product() ) {
			wp_register_style( 'color-swatch-style', CS_PLUGIN_URI. '/css/custom.css');
			wp_enqueue_style('color-swatch-style');
			
		}
	}

	function cs_load_scripts(){
		if( is_product() ) {
			wp_register_script( 'color-swatch-script', CS_PLUGIN_URI. '/js/custom.js',array('jquery'));
			wp_enqueue_script('color-swatch-script');
		}
	}

	function cs_dropdown_choice( $args ){
		if( is_product() ) {
			$args['class'] = 'cs-hide';
		}  
		return $args;    
	}

	function cs_change_dropdown_to_swatch($html, $args){
		if( is_product() ) {
			$html .= '<ul class=cs-variation-option cs-'.strtolower($args['attribute']).' >';
			switch (strtolower($args['attribute'])) {
				case 'color':
				foreach ($args['options'] as $option_value) {
					$html .= '<li class="cs-variable-options-value cs-dot cs-attribute-'.strtolower($args['attribute']).'" style="background-color:'.$option_value.';" data-attribute="'.strtolower($args['attribute']).'" data-attribute_value="'.$option_value.'"></li>'; 
				}
				break;

				default:
				foreach ($args['options'] as $option_value) {
					$html .= '<li class="cs-variable-options-value cs-box cs-attribute-'.strtolower($args['attribute']).'" data-attribute="'.strtolower($args['attribute']).'" data-attribute_value="'.$option_value.'">'.$option_value.'</li>'; 
				}
				break;
			}

			$html .= '</ul>'; 
		}  
		return $html; 
	}

}

new ColorSwatch();