<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header(); ?>
<?php do_action( 'airi/action/before_render_main' ); ?>
<div id="main" class="site-main">
	<div class="container">
		<div class="row">
			<main id="site-content" class="<?php echo esc_attr(Airi()->layout()->get_main_content_css_class('col-xs-12 site-content'))?>">
				<div class="site-content-inner">

					<?php do_action( 'airi/action/before_render_main_inner' ); ?>

					<div id="blog_content_container" class="main--loop-container"><?php

						do_action( 'airi/action/before_render_main_content' );

						global $airi_loop;

						$tmp = $airi_loop;

						$airi_loop = array();

						$loop_layout = Airi()->settings()->get('video_display_type', 'grid');
						$loop_style = Airi()->settings()->get('video_display_style', '1');
						airi_set_theme_loop_prop('is_main_loop', true, true);
						airi_set_theme_loop_prop('loop_layout', $loop_layout);
						airi_set_theme_loop_prop('loop_style', $loop_style);
						airi_set_theme_loop_prop('responsive_column', Airi()->settings()->get('video_column', array('xlg'=> 3, 'lg'=> 3,'md'=> 2,'sm'=> 2,'xs'=> 1)));
						airi_set_theme_loop_prop('image_size', Airi_Helper::get_image_size_from_string(Airi()->settings()->get('video_thumbnail_size', 'full'),'full'));
						airi_set_theme_loop_prop('title_tag', 'h5');
						airi_set_theme_loop_prop('excerpt_length', 15);
						airi_set_theme_loop_prop('item_space', 'default');

						if(have_posts()):

							get_template_part('templates/videos/loop/start');

							$blog_template = 'templates/videos/loop/loop';

							while(have_posts()):

								the_post();
								get_template_part($blog_template);

							endwhile;

							get_template_part('templates/videos/loop/end');

						else:

							?>
							<p class="no-release"><?php _e( 'No video yet', 'airi' ); ?></p>
							<?php

						endif;

						/**
						 * Display pagination and reset loop
						 */

						airi_the_pagination();

						wp_reset_postdata();

						$tmp = $airi_loop;

						do_action( 'airi/action/after_render_main_content' ); ?>

					</div>

					<?php do_action( 'airi/action/after_render_main_inner' ); ?>
				</div>
			</main>
			<?php get_sidebar();?>
		</div>
	</div>
</div>
<?php do_action( 'airi/action/after_render_main' ); ?>
<?php get_footer();?>