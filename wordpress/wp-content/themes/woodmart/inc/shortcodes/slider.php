<?php if ( ! defined( 'WOODMART_THEME_DIR' ) ) exit( 'No direct script access allowed' );

/**
* ------------------------------------------------------------------------------------------------
* Slider element shortcode
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'woodmart_shortcode_slider' )) {
	function woodmart_shortcode_slider($atts) {
		if( ! function_exists( 'wpb_getImageBySize' ) ) return;
		$output = $class = '';

		$parsed_atts = shortcode_atts(array(
			'slider' => '',
			'el_class' => ''
		), $atts );

		extract($parsed_atts);

		$class .= ' ' . $el_class;
		$class .= ' ' . woodmart_owl_items_per_slide( 1 );

		$slider_term = get_term_by('slug', $slider, 'woodmart_slider');

		if( is_wp_error( $slider_term ) || empty( $slider_term ) ) return;

		$args = array(
			'numberposts' => -1,
			'post_type' => 'woodmart_slide',	
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'woodmart_slider',
					'field' => 'id',
					'terms' => $slider_term->term_id
				)
			)
		);

		$slides = get_posts( $args );

		if( is_wp_error( $slides ) || empty( $slides ) ) return;

		$stretch_slider = get_term_meta( $slider_term->term_id, 'stretch_slider', true );
		
		$carousel_id = 'slider-' . $slider_term->term_id;

		$animation = get_term_meta( $slider_term->term_id, 'animation', true );

		$slide_speed_default = 900;//($animation == 'fade') ? false : 900;

		$slide_speed = apply_filters('woodmart_slider_sliding_speed', $slide_speed_default);

		$slider_atts = array(
			'carousel_id' => $carousel_id,
			'hide_pagination_control' => get_term_meta( $slider_term->term_id, 'pagination_style', true ) == '0' ? 'yes' : 'no',
			'hide_prev_next_buttons' => get_term_meta( $slider_term->term_id, 'arrows_style', true ) == '0' ? 'yes' : 'no',
			'autoplay' => (get_term_meta( $slider_term->term_id, 'autoplay', true ) == 'on') ? 'yes' : 'no',
			'speed' => apply_filters('woodmart_slider_autoplay_speed', 9000),
			'sliding_speed' => $slide_speed,
			'animation' => ($animation == 'fade') ? 'fadeOut' : false,
			'content_animation' => true,
			'autoheight' => 'yes',
			'wrap' => 'yes'
		); 

		ob_start(); ?>
			<?php woodmart_get_slider_css( $slider_term->term_id, $carousel_id, $slides ); ?>
			<div id="<?php echo esc_attr( $carousel_id ); ?>" class="woodmart-slider-wrapper<?php echo woodmart_get_slider_class( $slider_term->term_id ); ?>" <?php if( $stretch_slider ):?>data-vc-full-width="true" data-vc-full-width-init="true" data-vc-stretch-content="true"<?php endif; ?> <?php echo woodmart_get_owl_attributes( $slider_atts ); ?>>
				<div class="owl-carousel woodmart-slider<?php echo esc_attr( $class ); ?>">
					<?php foreach ($slides as $slide): ?>
						<?php 
							$slide_id = 'slide-' . $slide->ID;
							$slide_animation = get_post_meta( $slide->ID, 'slide_animation', true );
						?>
						<div id="<?php echo esc_attr( $slide_id ); ?>" class="woodmart-slide<?php echo woodmart_get_slide_class($slide->ID); ?>">
							<div class="container woodmart-slide-container">
								<div class="woodmart-slide-inner <?php echo (! empty( $slide_animation ) && $slide_animation != 'none' ) ? 'slide-animation anim-' . esc_attr( $slide_animation) : ''; ?>">
									<?php echo do_shortcode( wpautop( $slide->post_content ) ); ?>
								</div>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			</div>
			<?php if( $stretch_slider ) echo '<div class="vc_row-full-width vc_clearfix"></div>'; ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}


if( ! function_exists( 'woodmart_get_slider_css' ) ) {
	function woodmart_get_slider_css( $id, $el_id, $slides ) {

		$height 		= get_term_meta($id, 'height', true);
		$height_tablet 	= get_term_meta($id, 'height_tablet', true);
		$height_mobile 	= get_term_meta($id, 'height_mobile', true);

		echo '<style>';
		?>

			#<?php echo esc_attr( $el_id ); ?> .woodmart-slide {
				min-height: <?php echo esc_attr( $height ); ?>px;
			}
			
			@media (min-width: 1025px) {
				.browser-Internet #<?php echo esc_attr( $el_id ); ?> .woodmart-slide {
					height: <?php echo esc_attr( $height ); ?>px;
				}
			}

	        @media (max-width: 1024px) {
				#<?php echo esc_attr( $el_id ); ?> .woodmart-slide {
					min-height: <?php echo esc_attr( $height_tablet ); ?>px;
				}
			}

			@media (max-width: 767px) {
				#<?php echo esc_attr( $el_id ); ?> .woodmart-slide {
					min-height: <?php echo esc_attr( $height_mobile ); ?>px;
				}
			}

			<?php 
				foreach ($slides as $slide) {
					$image = '';
					if (has_post_thumbnail( $slide->ID ) ) {
						$image = wp_get_attachment_url( get_post_thumbnail_id($slide->ID) );
					} 

					$bg_color = get_post_meta( $slide->ID, 'bg_color', true );
					$width = get_post_meta( $slide->ID, 'content_width', true );
					$width_tablet = get_post_meta( $slide->ID, 'content_width_tablet', true );
					$width_mobile = get_post_meta( $slide->ID, 'content_width_mobile', true );

					$bg_image_tablet = get_post_meta( $slide->ID, 'bg_image_tablet', true );
					$bg_image_mobile = get_post_meta( $slide->ID, 'bg_image_mobile', true );

					?>
						#slide-<?php echo esc_attr( $slide->ID ); ?>.woodmart-loaded {
							<?php woodmart_maybe_set_css_rule('background-image', $image); ?>
						}

						#slide-<?php echo esc_attr( $slide->ID ); ?> {
							<?php woodmart_maybe_set_css_rule('background-color', $bg_color); ?>
						}

						#slide-<?php echo esc_attr( $slide->ID ); ?> .woodmart-slide-inner {
							<?php woodmart_maybe_set_css_rule('max-width', $width); ?>
						}

				        @media (max-width: 1024px) {
							<?php if ( $bg_image_tablet ) : ?>
								#slide-<?php echo esc_attr( $slide->ID ); ?>.woodmart-loaded {
									<?php woodmart_maybe_set_css_rule( 'background-image', $bg_image_tablet ); ?>
								}
							<?php endif; ?>

							#slide-<?php echo esc_attr( $slide->ID ); ?> .woodmart-slide-inner {
								<?php woodmart_maybe_set_css_rule('max-width', $width_tablet); ?>
							}
						}

						@media (max-width: 767px) {
							<?php if ( $bg_image_mobile ) : ?>
								#slide-<?php echo esc_attr( $slide->ID ); ?>.woodmart-loaded {
									<?php woodmart_maybe_set_css_rule( 'background-image', $bg_image_mobile ); ?>
								}
							<?php endif; ?>

							#slide-<?php echo esc_attr( $slide->ID ); ?> .woodmart-slide-inner {
								<?php woodmart_maybe_set_css_rule('max-width', $width_mobile); ?>
							}
						}

						<?php if ( get_post_meta( $slide->ID, '_wpb_shortcodes_custom_css', true ) ) : ?>
							<?php echo get_post_meta( $slide->ID, '_wpb_shortcodes_custom_css', true ); ?>
						<?php endif; ?>

						<?php if ( get_post_meta( $slide->ID, 'woodmart_shortcodes_custom_css', true ) ) : ?>
							<?php echo get_post_meta( $slide->ID, 'woodmart_shortcodes_custom_css', true ); ?>
						<?php endif; ?>

					<?php
				}
			?>

		<?php
		echo '</style>';
	}
}

if( ! function_exists( 'woodmart_maybe_set_css_rule' ) ) {
	function woodmart_maybe_set_css_rule( $rule, $value = '', $before = '', $after = '' ) {

		if( in_array( $rule, array( 'width', 'height', 'max-width', 'max-height' ) ) && empty( $after ) ) {
			$after = 'px';
		}

		if( in_array( $rule, array( 'background-image' ) ) && (empty( $before ) || empty( $after )) ) {
			$before = 'url(';
			$after = ')';
		}

		echo !empty( $value ) ? $rule . ':' . $before . $value . $after . ';' : '';
	}
}

if( ! function_exists( 'woodmart_get_slider_class' ) ) {
	function woodmart_get_slider_class( $id ) {
		$class = '';

		$arrows_style = get_term_meta( $id, 'arrows_style', true );
		$pagination_style = get_term_meta( $id, 'pagination_style', true );
		$pagination_color = get_term_meta( $id, 'pagination_color', true );
		$stretch_slider = get_term_meta( $id, 'stretch_slider', true );
		$scroll_carousel_init = get_term_meta( $id, 'scroll_carousel_init', true );

		$class .= ' arrows-style-' . $arrows_style;
		$class .= ' pagin-style-' . $pagination_style;
		$class .= ' pagin-color-' . $pagination_color;

		if ( $scroll_carousel_init == 'on' ) {
			$class .= ' scroll-init';
		}

		if( $stretch_slider ) {
			$class .= ' vc_row vc_row-fluid';
		} else {
			$class .= ' slider-in-container';
		}

		return $class;
	}
}

if( ! function_exists( 'woodmart_get_slide_class' ) ) {
	function woodmart_get_slide_class( $id ) {
		$class = '';

		$v_align = get_post_meta( $id, 'vertical_align', true );
		$h_align = get_post_meta( $id, 'horizontal_align', true );
		$full_width = get_post_meta( $id, 'content_full_width', true );
		$without_padding = get_post_meta( $id, 'content_without_padding', true );

		$class .= ' slide-valign-' . $v_align;
		$class .= ' slide-halign-' . $h_align;

		$class .= ' content-' . ( $full_width ? 'full-width' : 'fixed' );
		$class .= $without_padding ? ' slide-without-padding' : '';

		return $class;
	}
}
