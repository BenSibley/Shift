<?php
defined( 'ABSPATH' ) OR exit;

function ct_shift_last_updated_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'ct_shift_last_updated',
			esc_html__( 'Last Updated Date', 'shift' ),
			'ct_shift_last_updated_callback',
			$screen,
			'side'
		);
	}
}
add_action( 'add_meta_boxes', 'ct_shift_last_updated_meta_box' );

function ct_shift_last_updated_callback( $post ) {

  wp_nonce_field( 'ct_shift_last_updated', 'ct_shift_last_updated_nonce' );
  $display = get_post_meta( $post->ID, 'ct_shift_last_updated', true );

  ?>
	<p>
		<select name="shift-last-updated" id="shift-last-updated" style="box-sizing: border-box; width: 100%;">
			<option value="default"><?php esc_html_e( 'Use Customizer setting', 'shift' ); ?></option>
			<option value="yes" <?php if ( $display == 'yes' ) {
				echo 'selected';
			} ?>><?php esc_html_e( 'Show the date', 'shift' ); ?>
			</option>
			<option value="no" <?php if ( $display == 'no' ) {
				echo 'selected';
			} ?>><?php esc_html_e( "Don't show the date", 'shift' ); ?>
			</option>
		</select>
	</p> <?php
}
function ct_shift_last_updated_save_data( $post_id ) {

	global $post;

	if ( ! isset( $_POST['ct_shift_last_updated_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['ct_shift_last_updated_nonce'], 'ct_shift_last_updated' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	/* it's safe to save the data now. */

	if ( isset( $_POST['shift-last-updated'] ) ) {

    $display = $_POST['shift-last-updated'];
    $accepted_values = array('default', 'yes', 'no');

		if ( in_array( $display, $accepted_values ) ) {
			update_post_meta( $post_id, 'ct_shift_last_updated', $display );
		}
	}
}
add_action( 'pre_post_update', 'ct_shift_last_updated_save_data' );