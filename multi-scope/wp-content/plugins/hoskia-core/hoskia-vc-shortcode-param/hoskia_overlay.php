<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Class VC_Overlay_Param
 *
 * @since         4.3

 *  Ordering of fields, font_family, tag, text_align and etc. will be Same as ordering in array!
 *  To provide default value to field use 'key' => 'value'
 */
 
	//array(
	//	'type' 		   => 'overlay',
	//	'holder' 	   => 'div',
	//	'heading' 	   => __( 'Overlay Settings', 'quickfix' ),
	//	'param_name'   => 'ovrl',
	//	"group"		   => __( "Design Option", "quickfix" ),
	//	'settings'=>array(
	//		'fields'=>array(
	//			 'opacity',
	//			 'color',
	//		),
	//	),
	//),
 
 
class VC_Overlay_Param {

	function __construct() {
		if ( function_exists( 'vc_add_shortcode_param' ) ) {
			vc_add_shortcode_param( 'overlay', array( $this, 'vc_overlay_form_field' ),  plugins_url( '/js/hoskia_additional_param.js', __FILE__ ) );
		}
		
	}



	/**
	 * @param $settings
	 * @param $value
	 *
	 * @return mixed|void
	 */
	function vc_overlay_form_field( $settings, $value ) {
		$font_container = new VC_Overlay_Param();

		return apply_filters( 'vc_overlay_render_filter', $font_container->render( $settings, $value ) );
	}

	/**
	 * @param $settings
	 * @param $value
	 *
	 * @return string
	 */
	public function render( $settings, $value ) {
		$fields = array();
		$values = array();
		extract( $this->_vc_overlay_parse_attributes( $settings['settings']['fields'], $value ) );

		$data   = array();
		$output = '<div class="vc_row Virsky_vc">';
		if ( ! empty( $fields ) ) {
			if ( isset( $fields['field_size'] ) ) {
				$columns = $fields['field_size'];
			} else {
				$columns = 'xs-4';
			}
			
			
			if ( isset( $fields['opacity'] ) ) {
				$data['opacity'] = '
                <div class="vc_col-' . $columns . '">
                    <div class="wpb_element_label">' . esc_html__( 'Overlay Opacity', 'quickfix' ) . '</div>
                    <div class="crum-number-field-wrap vc_font_container_form_field-font_size-container">
                    <input type="number" min="0" max="1" step="0.1" class="Virsky_number_field wpb_vc_param_value vc_overlay_field-font_size-input" value="' . $values['opacity'] . '" />
                    </div>';

				$data['opacity'] .= '</div>';
			}
			
			

			if ( isset( $fields['color'] ) ) {
				$data['color'] = '
                <div class="vc_col-' . $columns . '">
                    <div class="wpb_element_label">' . __( 'Overlay Color', 'quickfix' ) . '</div>
                    <div class="vc_font_container_form_field-color-container wp-picker-container">
                        <div class="color-group">
				            <input class="vc_overlay_field-color-input" type="text" value="' . $values['color'] . '"/>
				            <input name="color" class="wpb_vc_param_value field-color-result" type="hidden" value="' . $values['color'] . '"/>
				        </div>
                    </div>';

					$data['color'] .= '
                    <span class="vc_description clear">' . esc_html__( 'Set overlay color', 'quickfix' ) . '</span>
                    ';
				
				$data['color'] .= '</div>';
			}


			$data = apply_filters( 'vc_font_container_output_data', $data, $fields, $values, $settings );

			// Combine all in output, make sure you follow ordering.
			foreach ( $fields as $key => $field ) {
				if ( isset( $data[ $key ] ) ) {
					$output .= $data[ $key ];
				}
			}
		}
		$output .= '</div>';

		$output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';

		return $output;
	}



	/**
	 * @param $attr
	 * @param $value
	 *
	 * @return array
	 */
	public function _vc_overlay_parse_attributes( $attr, $value ) {
		$fields = array();
		if ( isset( $attr ) ) {
			foreach ( $attr as $key => $val ) {
				if ( is_numeric( $key ) ) {
					$fields[ $val ] = '';
				} else {
					$fields[ $key ] = $val;
				}
			}
		}

		$values = vc_parse_multi_attribute( $value, array(
				
				'opacity'                  => isset( $fields['opacity'] ) ? $fields['opacity'] : '',
				'color'                      => isset( $fields['color'] ) ? $fields['color'] : '',
				'color_description'          => isset( $fields['color_description'] ) ? $fields['color_description'] : 'left',
			)
		);

		return array( 'fields' => $fields, 'values' => $values );
	}
}


if ( class_exists( 'VC_Overlay_Param' ) ) {
	$vc_overlay_param = new VC_Overlay_Param();
}
