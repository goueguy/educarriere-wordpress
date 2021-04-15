<?php
$tracking = happyforms_get_tracking();
$status = $tracking->get_status();
?>

<div class="wrap">
	<div id="welcome-panel" class="welcome-panel happyforms-welcome-panel">
		<div class="welcome-panel-content">
			<?php if ( 3 === intval( $status['status'] ) ) {
				$tracking->print_template( 'success' );
			} else { ?>
				<h1><?php _e( 'Add your email address to complete setup', 'happyforms' ); ?>&hellip;</h1>
				<p class="description"><?php _e( 'Your email address will only ever be used to receive communications from us', 'happyforms' ); ?>.</p>
				<form action="<?php echo esc_attr( $tracking->monitor_action ); ?>" method="post" id="happyforms-tracking">
					<input name="<?php echo esc_attr( $tracking->monitor_email_field ); ?>" type="email" placeholder="<?php _e( 'Email address', 'happyforms' ); ?>" required value="<?php echo get_option( 'admin_email' ); ?>" />
					<button type="submit" class="button button-primary button-hero button-block"><?php _e( 'Allow and set up', 'happyforms' ); ?></button>
				</form>
			<?php } ?>
		</div>
	</div>

	<?php if ( 2 === $status['status'] ) : ?>
	<p class="welcome-panel-footer"><?php _e( 'Or, skip this step and ', 'happyforms' ); ?> <a href="<?php echo happyforms_get_all_form_link(); ?>" id="happyforms-tracking-skip"><?php _e( 'continue', 'happyforms' ); ?></a></p>
	<?php endif; ?>
</div>
