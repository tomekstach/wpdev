<?php

/**
 * @class VamtamNumbersModule
 */
class VamtamNumbersModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		$path = trailingslashit( 'modules/' . basename( dirname( __FILE__ ) ) );

		parent::__construct(array(
			'name'        => __( 'Number Counter', 'vamtam-elements-b' ),
			'description' => __( 'Renders an animated number counter.', 'vamtam-elements-b' ),
			'category'    => __( 'VamTam Modules', 'vamtam-elements-b' ),
			'dir'         => VAMTAMEL_B_DIR . $path,
			'url'         => VAMTAMEL_B_URL . $path,
		));
	}

	public function enqueue_scripts() {
		$this->add_js( 'vamtam-numbers' );
	}

	public function render_number() {

		$number = $this->settings->number ? $this->settings->number : 0;
		$layout = $this->settings->layout ? $this->settings->layout : 'default';
		$type   = $this->settings->number_type ? $this->settings->number_type : 'percent';
		$prefix = $type == 'percent' ? '' : $this->settings->number_prefix;
		$suffix = $type == 'percent' ? '%' : $this->settings->number_suffix;
		$noJs   = '<noscript>' . number_format( $number ) . '</noscript>';

		$color = ! empty( $this->settings->number_color ) ? 'color:' . vamtam_el_sanitize_accent( $this->settings->number_color ) : '';

		echo '<div class="fl-number-string" style="' . esc_attr( $color ) . '">' . $prefix . '<span class="fl-number-int">' . $noJs . '</span>' . $suffix . '</div>'; // xss ok
	}

	public function render_circle_bar() {

		$width  = ! empty( $this->settings->circle_width ) ? esc_attr( $this->settings->circle_width ) : 100;
		$pos    = ( $width / 2 );
		$radius = $pos - 10;
		$dash   = number_format( ( ( M_PI * 2 ) * $radius ), 2, '.', '' );

		$bg_stroke  = isset( $this->settings->circle_bg_color ) ? vamtam_el_sanitize_accent( $this->settings->circle_bg_color ) : '';
		$num_stroke = isset( $this->settings->circle_color ) ? vamtam_el_sanitize_accent( $this->settings->circle_color ) : '';

		$html  = '<div class="svg-container">';
		$html .= '<svg class="svg" viewBox="0 0 ' . $width . ' ' . $width . '" version="1.1" preserveAspectRatio="xMinYMin meet">
			<circle class="fl-bar-bg" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill="transparent" stroke-dasharray="' . $dash . '" stroke-dashoffset="0" stroke="' . esc_attr( $bg_stroke ) . '"></circle>
			<circle class="fl-bar" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill="transparent" stroke-dasharray="' . $dash . '" stroke-dashoffset="' . $dash . '" transform="rotate(-90 ' . $pos . ' ' . $pos . ')" stroke="' . esc_attr( $num_stroke ) . '"></circle>
		</svg>';
		$html .= '</div>';

		echo $html; // xss ok
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('VamtamNumbersModule', array(
	'general' => array( // Tab
		'title'    => __( 'General', 'vamtam-elements-b' ), // Tab title
		'sections' => array( // Tab Sections
			'general' => array( // Section
				'title'  => '', // Section Title
				'fields' => array( // Section Fields
					'layout' => array(
						'type'    => 'select',
						'label'   => __( 'Layout', 'vamtam-elements-b' ),
						'default' => 'default',
						'options' => array(
							'default' => __( 'Only Numbers', 'vamtam-elements-b' ),
							'circle'  => __( 'Circle Counter', 'vamtam-elements-b' ),
							'bars'    => __( 'Bars Counter', 'vamtam-elements-b' ),
						),
						'toggle' => array(
							'default' => array(
								'fields' => array( 'text_align' ),
							),
							'circle' => array(
								'sections' => array( 'circle_bar_style' ),
							),
							'bars' => array(
								'sections' => array( 'bar_style' ),
								'fields'   => array( 'number_position' ),
							),
						),
					),
					'number_type' => array(
						'type'    => 'select',
						'label'   => __( 'Number Type', 'vamtam-elements-b' ),
						'default' => 'percent',
						'options' => array(
							'percent'  => __( 'Percent', 'vamtam-elements-b' ),
							'standard' => __( 'Standard', 'vamtam-elements-b' ),
						),
						'toggle' => array(
							'standard' => array(
								'fields' => array( 'number_prefix', 'number_suffix' ),
							),
						),
					),
					'number' => array(
						'type'        => 'text',
						'label'       => __( 'Number', 'vamtam-elements-b' ),
						'size'        => '5',
						'default'     => '100',
						'placeholder' => '100',
					),
					'max_number' => array(
						'type'  => 'text',
						'label' => __( 'Total', 'vamtam-elements-b' ),
						'size'  => '5',
						'help'  => __( 'The total number of units for this counter. For example, if the Number is set to 250 and the Total is set to 500, the counter will animate to 50%.', 'vamtam-elements-b' ),
					),
					'number_position' => array(
						'type'     => 'select',
						'label'    => __( 'Number Position', 'vamtam-elements-b' ),
						'size'     => '5',
						'help'     => __( 'Where to display the number in relation to the bar.', 'vamtam-elements-b' ),
						'options' => array(
							'default' => __( 'Inside Bar', 'vamtam-elements-b' ),
							'above'   => __( 'Above Bar', 'vamtam-elements-b' ),
							'below'   => __( 'Below Bar', 'vamtam-elements-b' ),
						),
					),
					'before_number_text' => array(
						'type'  => 'text',
						'label' => __( 'Text Before Number', 'vamtam-elements-b' ),
						'size'  => '20',
						'help'  => __( 'Text to appear above the number. Leave it empty for none.', 'vamtam-elements-b' ),
					),
					'after_number_text' => array(
						'type'  => 'text',
						'label' => __( 'Text After Number', 'vamtam-elements-b' ),
						'size'  => '20',
						'help'  => __( 'Text to appear after the number. Leave it empty for none.', 'vamtam-elements-b' ),
					),
					'number_prefix' => array(
						'type'  => 'text',
						'label' => __( 'Number Prefix', 'vamtam-elements-b' ),
						'size'  => '10',
						'help'  => __( 'For example, if your number is US$ 10, your prefix would be "US$ ".', 'vamtam-elements-b' ),
					),
					'number_suffix' => array(
						'type'  => 'text',
						'label' => __( 'Number Suffix', 'vamtam-elements-b' ),
						'size'  => '10',
						'help'  => __( 'For example, if your number is 10%, your suffix would be "%".', 'vamtam-elements-b' ),
					),
					'animation_speed' => array(
						'type'        => 'text',
						'label'       => __( 'Animation Speed', 'vamtam-elements-b' ),
						'size'        => '5',
						'default'     => '1',
						'placeholder' => '1',
						'description' => __( 'second(s)', 'vamtam-elements-b' ),
						'help'        => __( 'Number of seconds to complete the animation.', 'vamtam-elements-b' ),
					),
				),
			),
		),
	),
	'style' => array( // Tab
		'title'    => __( 'Style', 'vamtam-elements-b' ), // Tab title
		'sections' => array( // Tab Sections
			'text_style' => array(
				'title'  => __( 'Colors', 'vamtam-elements-b' ),
				'fields' => array(
					'text_color' => array(
						'type'  => 'vamtam-color',
						'label' => __( 'Text Color', 'vamtam-elements-b' ),
					),
					'number_color' => array(
						'type'  => 'vamtam-color',
						'label' => __( 'Number Color', 'vamtam-elements-b' ),
					),
					'number_size' => array(
						'type'        => 'text',
						'label'       => __( 'Number Size', 'vamtam-elements-b' ),
						'default'     => '32',
						'maxlength'   => '3',
						'size'        => '4',
						'description' => 'px',
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.fl-number-string',
							'property' => 'font-size',
							'unit'     => 'px',
						),
					),
					'text_align' => array(
						'type'    => 'select',
						'label'   => __( 'Alignment', 'vamtam-elements-b' ),
						'default' => 'center',
						'options' => array(
							'left'   => __( 'Left', 'vamtam-elements-b' ),
							'center' => __( 'Center', 'vamtam-elements-b' ),
							'right'  => __( 'Right', 'vamtam-elements-b' ),
						),
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.fl-number-text',
							'property' => 'text-align',
						),
					),
				),
			),
			'circle_bar_style' => array(
				'title'  => __( 'Circle Bar Styles', 'vamtam-elements-b' ),
				'fields' => array(
					'circle_width' => array(
						'type'        => 'text',
						'label'       => __( 'Circle Size', 'vamtam-elements-b' ),
						'default'     => '200',
						'maxlength'   => '4',
						'size'        => '4',
						'description' => 'px',
						'preview'  => array(
							'type'  => 'css',
							'rules' => array(
								array(
									'selector' => '.fl-number-circle-container',
									'property' => 'max-width',
									'unit'     => 'px',
								),
								array(
									'selector' => '.fl-number-circle-container',
									'property' => 'max-height',
									'unit'     => 'px',
								),
							),
						),

					),
					'circle_dash_width' => array(
						'type'        => 'text',
						'label'       => __( 'Circle Stroke Size', 'vamtam-elements-b' ),
						'default'     => '10',
						'maxlength'   => '2',
						'size'        => '4',
						'description' => 'px',
						'preview'  => array(
							'type'     => 'css',
							'selector' => '.svg circle',
							'property' => 'stroke-width',
							'unit'     => 'px',
						),
					),
					'circle_color' => array(
						'type'    => 'vamtam-color',
						'label'   => __( 'Circle Foreground Color', 'vamtam-elements-b' ),
						'default' => 'accent1',
					),
					'circle_bg_color' => array(
						'type'    => 'vamtam-color',
						'label'   => __( 'Circle Background Color', 'vamtam-elements-b' ),
						'default' => 'accent7',
					),
				),
			),
			'bar_style' => array(
				'title'  => __( 'Bar Styles', 'vamtam-elements-b' ),
				'fields' => array(
					'bar_color' => array(
						'type'    => 'vamtam-color',
						'label'   => __( 'Bar Foreground Color', 'vamtam-elements-b' ),
						'default' => 'accent1',
					),
					'bar_bg_color' => array(
						'type'    => 'vamtam-color',
						'label'   => __( 'Bar Background Color', 'vamtam-elements-b' ),
						'default' => 'accent7',
					),
				),
			),
		),
	),
));
