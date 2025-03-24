<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Wptegal_Form' ) ) :

	/**
	 * Main Wptegal_Form Class.
	 *
	 * @package		WptegalFORM
	 * @subpackage	Classes/Wptegal_Form
	 * @since		1.0.0
	 * @author		iqsa
	 */
	final class Wptegal_Form {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Wptegal_Form
		 */
		private static $instance;

		/**
		 * WptegalFORM helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Wptegal_Form_Helpers
		 */
		public $helpers;

		/**
		 * WptegalFORM settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Wptegal_Form_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'Wptegal-form' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'Wptegal-form' ), '1.0.0' );
		}

		/**
		 * Main Wptegal_Form Instance.
		 *
		 * Insures that only one instance of Wptegal_Form exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Wptegal_Form	The one true Wptegal_Form
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Wptegal_Form ) ) {
				self::$instance					= new Wptegal_Form;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Wptegal_Form_Helpers();
				self::$instance->settings		= new Wptegal_Form_Settings();

				//Fire the plugin logic
				new Wptegal_Form_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'WptegalFORM/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once WptegalFORM_PLUGIN_DIR . 'core/includes/classes/class-Wptegal-form-helpers.php';
			require_once WptegalFORM_PLUGIN_DIR . 'core/includes/classes/class-Wptegal-form-settings.php';

			require_once WptegalFORM_PLUGIN_DIR . 'core/includes/classes/class-Wptegal-form-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'Wptegal-form', FALSE, dirname( plugin_basename( WptegalFORM_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.