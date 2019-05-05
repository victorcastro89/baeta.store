<?php if ( ! defined( 'WOODMART_THEME_DIR' ) ) exit( 'No direct script access allowed' );

/**
* ------------------------------------------------------------------------------------------------
* Share and follow buttons shortcode
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'woodmart_shortcode_social' )) {
	function woodmart_shortcode_social($atts) {
		extract(shortcode_atts( array(
			'type' => 'share',
			'align' => 'center',
			'tooltip' => 'no',
			'style' => 'default', 
			'size' => 'default', 
			'form' => 'circle',
			'color' => 'dark',
			'css_animation' => 'none',
			'el_class' => '',
		), $atts ));

		$target = "_blank";

		$classes = 'woodmart-social-icons';
		$classes .= ' text-' . $align;
		$classes .= ' icons-design-' . $style;
		$classes .= ' icons-size-' . $size;
		$classes .= ' color-scheme-' . $color;
		$classes .= ' social-' . $type;
		$classes .= ' social-form-' . $form;
		$classes .= ( $el_class ) ? ' ' . $el_class : '';
		$classes .= woodmart_get_css_animation( $css_animation );

		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		
		$page_link = get_the_permalink();
		if ( woodmart_woocommerce_installed() && is_shop() ) $page_link = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
		if ( woodmart_woocommerce_installed() && ( is_product_category() || is_category() ) ) $page_link = get_category_link( get_queried_object()->term_id );
		if ( is_home() && ! is_front_page() ) $page_link = get_permalink( get_option( 'page_for_posts' ) );
		
		ob_start();
		?>

			<div class="<?php echo esc_attr( $classes ); ?>">
				<?php if ( ( $type == 'share' && woodmart_get_opt('share_fb') ) || ( $type == 'follow' && woodmart_get_opt( 'fb_link' ) != '')): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'fb_link' )) : 'https://www.facebook.com/sharer/sharer.php?u=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-facebook">
						<i class="fa fa-facebook"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Facebook', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( ( $type == 'share' && woodmart_get_opt('share_twitter') ) || ( $type == 'follow' && woodmart_get_opt( 'twitter_link' ) != '')): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'twitter_link' )) : 'https://twitter.com/share?url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-twitter">
						<i class="fa fa-twitter"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Twitter', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( ( $type == 'share' && woodmart_get_opt('share_email') ) || ( $type == 'follow' && woodmart_get_opt( 'social_email' ) ) ): ?>
					<a rel="nofollow" href="mailto:<?php echo '?subject=' . esc_html__('Check%20this%20', 'woodmart') . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-email">
						<i class="fa fa-envelope"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Email', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'isntagram_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'isntagram_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-instagram">
						<i class="fa fa-instagram"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Instagram', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'youtube_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'youtube_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-youtube">
						<i class="fa fa-youtube"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('YouTube', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( ( $type == 'share' && woodmart_get_opt('share_pinterest') ) || ( $type == 'follow' && woodmart_get_opt( 'pinterest_link' ) != '' ) ): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'pinterest_link' )) : 'https://pinterest.com/pin/create/button/?url=' . $page_link . '&media=' . $thumb_url[0]; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-pinterest">
						<i class="fa fa-pinterest"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Pinterest', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'tumblr_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'tumblr_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-tumblr">
						<i class="fa fa-tumblr"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Tumblr', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( ( $type == 'share' && woodmart_get_opt('share_linkedin') ) || ( $type == 'follow' && woodmart_get_opt( 'linkedin_link' ) != '' ) ): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'linkedin_link' )) : 'https://www.linkedin.com/shareArticle?mini=true&url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-linkedin">
						<i class="fa fa-linkedin"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('linkedin', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'vimeo_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'vimeo_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-vimeo">
						<i class="fa fa-vimeo"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Vimeo', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'flickr_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'flickr_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-flickr"><i class="fa fa-flickr"></i><span class="woodmart-social-icon-name"><?php esc_html_e('Flickr', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'github_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'github_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-github"><i class="fa fa-github"></i><span class="woodmart-social-icon-name"><?php esc_html_e('GitHub', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'dribbble_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'dribbble_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-dribbble"><i class="fa fa-dribbble"></i><span class="woodmart-social-icon-name"><?php esc_html_e('Dribbble', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'behance_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'behance_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-behance">
						<i class="fa fa-behance"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Behance', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'soundcloud_link' ) != ''): ?>
						<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'soundcloud_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-soundcloud">
							<i class="fa fa-soundcloud"></i>
							<span class="woodmart-social-icon-name"><?php esc_html_e('Soundcloud', 'woodmart') ?></span>
						</a>
				<?php endif ?>

				<?php if ( $type == 'follow' && woodmart_get_opt( 'spotify_link' ) != ''): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'spotify_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-spotify">
						<i class="fa fa-spotify"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Spotify', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( ( $type == 'share' && woodmart_get_opt('share_ok') ) || ( $type == 'follow' && woodmart_get_opt( 'ok_link' ) != '' ) ): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? esc_url(woodmart_get_opt( 'ok_link' )) : 'https://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-ok">
						<i class="fa fa-odnoklassniki"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Odnoklassniki', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'share' && woodmart_get_opt('share_whatsapp') || ( $type == 'follow' && woodmart_get_opt( 'whatsapp_link' ) != '' ) ): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? ( woodmart_get_opt( 'whatsapp_link' )) : 'https://wa.me/?text=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-whatsapp">
						<i class="fa fa-whatsapp"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('WhatsApp', 'woodmart') ?></span>
					</a>
				<?php endif ?>
				
				<?php if ( $type == 'share' && woodmart_get_opt('share_vk') || ( $type == 'follow' && woodmart_get_opt( 'vk_link' ) != '' ) ): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? ( woodmart_get_opt( 'vk_link' )) : 'https://vk.com/share.php?url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-vk">
						<i class="fa fa-vk"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('VK', 'woodmart') ?></span>
					</a>
				<?php endif ?>
				
				<?php if ( $type == 'follow' && woodmart_get_opt( 'snapchat_link' ) != '' ): ?>
					<a rel="nofollow" href="<?php echo woodmart_get_opt( 'snapchat_link' ); ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-snapchat">
						<i class="fa fa-snapchat-ghost"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Snapchat', 'woodmart') ?></span>
					</a>
				<?php endif ?>

				<?php if ( $type == 'share' && woodmart_get_opt('share_tg') || ( $type == 'follow' && woodmart_get_opt( 'tg_link' ) != '' ) ): ?>
					<a rel="nofollow" href="<?php echo 'follow' === $type ? ( woodmart_get_opt( 'tg_link' )) : 'https://telegram.me/share/url?url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="<?php if( $tooltip == "yes" ) echo 'woodmart-tooltip'; ?> woodmart-social-icon social-tg">
						<i class="fa fa-telegram"></i>
						<span class="woodmart-social-icon-name"><?php esc_html_e('Telegram', 'woodmart') ?></span>
					</a>
				<?php endif ?>

			</div>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}
