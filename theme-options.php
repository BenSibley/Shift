<?php

function ct_shift_register_theme_page() {
	add_theme_page( __( 'Shift Dashboard', 'shift' ), __( 'Shift Dashboard', 'shift' ), 'edit_theme_options', 'shift-options', 'ct_shift_options_content', 'ct_shift_options_content' );
}
add_action( 'admin_menu', 'ct_shift_register_theme_page' );

function ct_shift_options_content() {

	$customizer_url = add_query_arg(
		array(
			'url'    => site_url(),
			'return' => add_query_arg( 'page', 'shift-options', admin_url( 'themes.php' ) )
		),
		admin_url( 'customize.php' )
	);
	?>
	<div id="shift-dashboard-wrap" class="wrap">
		<h2><?php _e( 'Shift Dashboard', 'shift' ); ?></h2>
		<?php do_action( 'theme_options_before' ); ?>
		<div class="content content-customization">
			<h3><?php _e( 'Customization', 'shift' ); ?></h3>
			<p><?php _e( 'Click the "Customize" link in your menu, or use the button below to get started customizing Shift', 'shift' ); ?>.</p>
			<p>
				<a class="button-primary"
				   href="<?php echo esc_url( $customizer_url ); ?>"><?php _e( 'Use Customizer', 'shift' ) ?></a>
			</p>
		</div>
		<div class="content content-support">
			<h3><?php _e( 'Support', 'shift' ); ?></h3>
			<p><?php _e( "You can find the knowledgebase, changelog, support forum, and more in the Shift Support Center", "shift" ); ?>.</p>
			<p>
				<a target="_blank" class="button-primary"
				   href="https://www.competethemes.com/documentation/shift-support-center/"><?php _e( 'Visit Support Center', 'shift' ); ?></a>
			</p>
		</div>
		<div class="content content-premium-upgrade">
			<h3><?php _e( 'Shift Pro', 'shift' ); ?></h3>
			<p><?php _e( 'Download the Shift Pro plugin and unlock custom colors, new layouts, sliders, and more', 'shift' ); ?>...</p>
			<p>
				<a target="_blank" class="button-primary"
				   href="https://www.competethemes.com/shift-pro/"><?php _e( 'See Full Feature List', 'shift' ); ?></a>
			</p>
		</div>
		<div class="content content-resources">
			<h3><?php _e( 'WordPress Resources', 'shift' ); ?></h3>
			<p><?php _e( 'Save time and money searching for WordPress products by following our recommendations', 'shift' ); ?>.</p>
			<p>
				<a target="_blank" class="button-primary"
				   href="https://www.competethemes.com/wordpress-resources/"><?php _e( 'View Resources', 'shift' ); ?></a>
			</p>
		</div>
		<div class="content content-review">
			<h3><?php _e( 'Leave a Review', 'shift' ); ?></h3>
			<p><?php _e( 'Help others find Shift by leaving a review on wordpress.org.', 'shift' ); ?></p>
			<a target="_blank" class="button-primary" href="https://wordpress.org/support/view/theme-reviews/shift"><?php _e( 'Leave a Review', 'shift' ); ?></a>
		</div>
		<div class="content content-delete-settings">
			<h3><?php _e( 'Reset Customizer Settings', 'shift' ); ?></h3>
			<p>
				<?php printf( __( "<strong>Warning:</strong> Clicking this button will erase the Shift theme's current settings in the <a href='%s'>Customizer</a>.", 'shift' ), esc_url( $customizer_url ) ); ?>
			</p>
			<form method="post">
				<input type="hidden" name="shift_reset_customizer" value="shift_reset_customizer_settings"/>
				<p>
					<?php wp_nonce_field( 'shift_reset_customizer_nonce', 'shift_reset_customizer_nonce' ); ?>
					<?php submit_button( __( 'Reset Customizer Settings', 'shift' ), 'delete', 'delete', false ); ?>
				</p>
			</form>
		</div>
		<?php do_action( 'theme_options_after' ); ?>
	</div>
<?php }