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

					<?php do_action( 'airi/action/before_render_main_inner' );?>

					<div class="page-content">
						<?php

						do_action( 'airi/action/before_render_main_content' );

						if( have_posts() ) :  the_post();

							echo '<div class="not-active-fullpage">';

							echo lastudio_events(array(
								'count' => 10,
								'el_class' => 'text-color-secondary'
							));

							echo '</div>';

						endif;

						do_action( 'airi/action/after_render_main_content' );

						?>
					</div>

					<?php do_action( 'airi/action/after_render_main_inner' );?>
				</div>
			</main>
			<!-- #site-content -->
			<?php get_sidebar();?>
		</div>
	</div>
</div>
<!-- .site-main -->
<?php do_action( 'airi/action/after_render_main' ); ?>
<?php get_footer();?>

