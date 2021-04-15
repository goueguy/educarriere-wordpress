<?php

class HappyForms_Form_Assets {

	private static $instance;

	const MODE_NONE = 0;
	const MODE_ADMIN = 1;
	const MODE_BLOCK = 2;
	const MODE_CUSTOMIZER = 4;
	const MODE_COMPLETE = 8;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function output_frontend_styles( $form ) {
		happyforms_the_form_styles( $form );
		happyforms_additional_css( $form );
	}

	public function output_admin_styles( $form ) {
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo happyforms_get_plugin_url() . 'core/assets/css/no-interaction.css'; ?>">
		<?php
	}

	public function output_frontend_scripts( $form ) {
		wp_register_script(
			'happyforms-select',
			happyforms_get_plugin_url() . 'core/assets/js/lib/happyforms-select.js',
			array( 'jquery' ), HAPPYFORMS_VERSION, true
		);

		wp_register_script( 'happyforms-settings', '', array(), HAPPYFORMS_VERSION, true );

		$settings = apply_filters( 'happyforms_frontend_settings', array(	
			'ajaxUrl' => admin_url( 'admin-ajax.php' )	
		) );

		wp_localize_script( 'happyforms-settings', '_happyFormsSettings', $settings );

		$dependencies = apply_filters(
			'happyforms_frontend_dependencies',
			array( 'jquery', 'jquery-ui-core', 'jquery-ui-tooltip', 'happyforms-settings' ), [ $form ]
		);

		wp_register_script(
			'happyforms-frontend',
			happyforms_get_plugin_url() . 'inc/assets/js/frontend.js',
			$dependencies, HAPPYFORMS_VERSION, true
		);

		if ( wp_doing_ajax() ) {
			global $wp_scripts;

			add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
				return '';
			}, 10, 3 );

			wp_scripts()->all_deps( 'happyforms-frontend' );

			$queue = array();

			foreach ( wp_scripts()->to_do as $handle ) {
				$dep = wp_scripts()->registered[ $handle ];

				if ( $dep->src ) {
					$queue[] = array(
						'id' => $handle,
						'src' => $dep->src
					);
				}
				
				wp_scripts()->print_extra_script( $handle );
			}

			wp_scripts()->print_extra_script( 'happyforms-frontend' );
			?>
			<script type="text/javascript">
				var queue = <?php echo json_encode( $queue ); ?>;
				var loaded = 0;

				queue = queue.filter( function( item ) {
					if ( document.querySelector( 'script[id="' + item.id + '-js"]' ) ) {
						return false;
					}

					return true;
				} );

				function enqueueNextScript() {
					if ( queue.length === 0 ) {
						jQuery( '.happyforms-form' ).happyForm();
						return;
					}

					var item = queue.shift();
					var script = document.createElement( 'script' );
					script.id = item.id + '-js';
					script.src = item.src;
					
					script.addEventListener( 'load', function() {
						enqueueNextScript();
					} );
					
					document.body.appendChild( script );
				}

				enqueueNextScript();
			</script>
			<?php
		} else {
			wp_scripts()->print_scripts( 'happyforms-frontend' );
		}

		wp_deregister_script( 'happyforms-frontend' );

		do_action( 'happyforms_print_scripts', [ $form ] );
	}

	public function output( $form, $mode = self::MODE_COMPLETE ) {
		switch( $mode ) {
			case self::MODE_NONE: 
				break;
			case self::MODE_ADMIN:
			case self::MODE_BLOCK:
				$this->output_frontend_styles( $form );
				$this->output_admin_styles( $form );
				break;
			case self::MODE_CUSTOMIZER:
				$this->output_frontend_styles( $form );
				$this->output_admin_styles( $form );
				$this->output_frontend_scripts( $form );
				break;
			case self::MODE_COMPLETE: 
				$this->output_frontend_styles( $form );
				$this->output_frontend_scripts( $form );
				break;
		}
	}

	public function print_frontend_styles( $form ) {
		wp_register_style(
			'happyforms-color',
			happyforms_get_frontend_stylesheet_url( 'color.css' ),
			array(), HAPPYFORMS_VERSION
		);

		$dependencies = apply_filters(
			'happyforms_style_dependencies',
			array( 'happyforms-color' ), [ $form ]
		);

		wp_register_style(
			'happyforms-layout',
			happyforms_get_frontend_stylesheet_url( 'layout.css' ),
			$dependencies, HAPPYFORMS_VERSION
		);

		wp_styles()->do_items( 'happyforms-layout' );

		wp_deregister_style( 'happyforms-layout' );

		do_action( 'happyforms_print_frontend_styles', $form );
	}
}

if ( ! function_exists( 'happyforms_get_form_assets' ) ):

function happyforms_get_form_assets() {
	return HappyForms_Form_Assets::instance();
}

endif;

happyforms_get_form_assets();
