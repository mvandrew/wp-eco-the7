<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( !class_exists('EcoThe7Counters') ) {
	/**
	 * Managing counters Class EcoThe7Counters
	 *
	 * @author      Andrey Mishchenko
	 * @since       2.0.0
	 * @package     ecothe7
	 */
	class EcoThe7Counters {

		/**
		 * Current Class Instance.
		 *
		 * @var EcoThe7Counters
		 */
		private static $INSTANCE = null;

		/**
		 * Yandex Metrika Setting Name
		 * @var string
		 */
		public static $YANDEX_METRIKA_NAME = 'ecothe7_counter_yandex_metrika';

		/**
		 * Yandex Webmaster Setting Name
		 * @var string
		 */
		public static $YANDEX_WEBMASTER_NAME = 'ecothe7_counter_yandex_webmaster';

		/**
		 * Google Analytics Setting Name
		 * @var string
		 */
		public static $GOOGLE_ANALYTICS_NAME = 'ecothe7_counter_google_analytics';

		/**
		 * Google Webmaster Setting Name
		 * @var string
		 */
		public static $GOOGLE_WEBMASTER_NAME = 'ecothe7_counter_google_webmaster';

		/**
		 * Yandex Metrika Counter ID
		 * @var string
		 */
		public $yandex_metrika_id;

		/**
		 * Yandex Webmaster ID
		 * @var string
		 */
		public $yandex_webmaster_id;

		/**
		 * Google Analytics ID
		 * @var string
		 */
		public $google_analytics_id;

		/**
		 * Google Webmaster ID
		 * @var string
		 */
		public $google_webmaster_id;


		/**
		 * EcoThe7Counters constructor.
		 */
		public function __construct() {

			$this->yandex_metrika_id        = get_theme_mod( self::$YANDEX_METRIKA_NAME, '' );
			$this->yandex_webmaster_id      = get_theme_mod( self::$YANDEX_WEBMASTER_NAME, '' );

			$this->google_analytics_id      = get_theme_mod( self::$GOOGLE_ANALYTICS_NAME, '' );
			$this->google_webmaster_id      = get_theme_mod( self::$GOOGLE_WEBMASTER_NAME, '' );

			// __construct
		}


		/**
		 * Create new Counters class and return it.
		 *
		 * @return EcoThe7Counters
		 */
		public static function get_instance() {

			if ( self::$INSTANCE == null ) {
				self::$INSTANCE = new EcoThe7Counters();
			}

			return self::$INSTANCE;

			// get_instance
		}


		/**
		 * Added counters settings.
		 *
		 * @param WP_Customize_Manager $wp_customize The Customizer object.
		 * @param string $panel Settings Panel ID
		 */
		public function customize_register( &$wp_customize, $panel ) {

			// Counters Section
			$section = 'ecothe7_counters_settings';
			$wp_customize->add_section( $section, array(
				'priority'              => 4,
				'title'                 => __( 'Counters IDs', 'eco-the7' ),
				'panel'                 => $panel
			));

			// Yandex Metrika ID
			$name = self::$YANDEX_METRIKA_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Yandex Metrika ID', 'eco-the7'),
				'section'               => $section,
				'settings'              => $name
			));

			// Yandex Webmaster ID
			$name = self::$YANDEX_WEBMASTER_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Yandex Webmaster ID', 'eco-the7'),
				'section'               => $section,
				'settings'              => $name
			));

			// Google Analytics ID
			$name = self::$GOOGLE_ANALYTICS_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Google Analytics ID', 'eco-the7'),
				'section'               => $section,
				'settings'              => $name
			));

			// Google Webmaster ID
			$name = self::$GOOGLE_WEBMASTER_NAME;
			$wp_customize->add_setting( $name, array(
				'default'               => '',
				'capability'            => 'edit_theme_options'
			));
			$wp_customize->add_control( $name, array(
				'type'                  => 'text',
				'label'                 => __('Google Webmaster ID', 'eco-the7'),
				'section'               => $section,
				'settings'              => $name
			));

			// customize_register
		}


		/**
		 * Displays Yandex Metrika code.
		 *
		 * @return void
		 */
		public function yandex_metrika_code() {

			$template_file = _ET7_TEMPLATE_ELEMENTS_DIR . '/counter_yandex_metrika.php';
			if ( mb_strlen($this->yandex_metrika_id) > 0 && file_exists($template_file) ) {
				include ($template_file);
			}

			// yandex_metrika_code
		}


		/**
		 * Displays Yandex Webmaster code.
		 *
		 * @return void
		 */
		public function yandex_webmaster_code() {

			if ( mb_strlen($this->yandex_webmaster_id) > 0 ) {
				printf( '<meta name="yandex-verification" content="%s" />',
					$this->yandex_webmaster_id );
			}

			// yandex_webmaster_code
		}


		/**
		 * Displays Google Analytics code.
		 *
		 * @return void
		 */
		public function google_analytics_code() {

			$template_file = _ET7_TEMPLATE_ELEMENTS_DIR . '/counter_google_analytics.php';
			if ( mb_strlen($this->google_analytics_id) > 0 && file_exists($template_file) ) {
				include ($template_file);
			}

			// google_analytics_code
		}


		/**
		 * Displays Google Webmaster code.
		 *
		 * @return void
		 */
		public function google_webmaster_code() {

			if ( mb_strlen($this->google_webmaster_id) > 0 ) {
				printf( '<meta name="google-site-verification" content="%s" />',
					$this->google_webmaster_id );
			}

			// google_webmaster_code
		}
		
	}
}