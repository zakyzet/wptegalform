<?php
    ob_start();
/**
 * Wptegal Form
 *
 * @package       WptegalFORM
 * @author        Akhmad Abdu Zaky
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Wptegal Form
 * Plugin URI:    https://Wptegal.com/
 * Description:   This is some demo short description...
 * Version:       1.0.0
 * Author:        Akhmad Abdu Zaky
 * Author URI:    https://your-author-domain.com
 * Text Domain:   Wptegal-form
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Wptegal Form. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin name
define( 'WptegalFORM_NAME',			'Wptegal Form' );

// Plugin version
define( 'WptegalFORM_VERSION',		'1.0.0' );

// Plugin Root File
define( 'WptegalFORM_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'WptegalFORM_PLUGIN_BASE',	plugin_basename( WptegalFORM_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'WptegalFORM_PLUGIN_DIR',	plugin_dir_path( WptegalFORM_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'WptegalFORM_PLUGIN_URL',	plugin_dir_url( WptegalFORM_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once WptegalFORM_PLUGIN_DIR . 'core/class-Wptegal-form.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  iqsa
 * @since   1.0.0
 * @return  object|Wptegal_Form
 */
function WptegalFORM() {
	return Wptegal_Form::instance();
}

WptegalFORM();
$filedirektoriplugin = plugin_dir_url( __DIR__ ).'pages/';
if(is_admin()){
    add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'Wptegal Form', 'Wptegal  Form', 'manage_options', 'Wptegal_form_dashboard', 'WptegalFORM_options', 'dashicons-welcome-widgets-menus', 10 );
}

function WptegalFORM_options(){
 
  require_once  WptegalFORM_PLUGIN_DIR.'backend/wptegalformclass-dashboard.php';
}

}


// mulai class wptegalformclass

if (!defined('WPINC')) {
	die;
}

class wptegalformclass
{
	private $version;
	private $path;
	private $url;

	public function __construct()
	{
		$this->version = '1.1';
		$this->path = plugin_dir_path(__FILE__);
		$this->url = plugin_dir_url(__FILE__);

	//	register_activation_hook(__FILE__, array($this, 'flush_rewrite_rules'));
	//	register_activation_hook(__FILE__, array($this, 'activate_plugin'));
		//register_deactivation_hook(__FILE__, array($this, 'flush_rewrite_rules'));

	//	add_action('init', array($this, 'hide_admin_bar_for_subscribers'));
		//add_action('admin_init', array($this, 'redirect_subscribers_from_admin'));

	//	add_filter('template_include', array($this, 'dashboard_template'));

		// add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		// add_action('wp_footer', array($this, 'form_builder_script'));

		add_action('init', array($this, 'register_custom_post_type'));
		// add_action('wp_insert_post', array($this, 'generate_post_slug'), 10, 3);
		add_action('init', array($this, 'custom_rewrite_rule'));
		// add_filter('the_content', array($this, 'modify_content_for_wptegalformclass'));
	//	add_filter('template_include', array($this, 'modify_single_template'));

		add_filter('manage_wptegalformclass_posts_columns', array($this, 'custom_post_list_column'));
		add_action(
			'manage_wptegalformclass_posts_custom_column',
			function ($column, $post_id) {
				$this->custom_post_list_column_data($column, $post_id);
			},
			10,
			2
		);
		
     //   add_filter('login_redirect', array($this, 'login_redirect'), 10, 3);
        // add_action('init', array($this, 'redirect_wp_login'));
      //  add_filter('login_headerurl', array($this, 'custom_login_logo_url'));
	//	add_action('login_head', array($this, 'custom_login_logo'));
	 //   add_action('login_footer', array($this, 'custom_login_footer'));
	//	add_action('template_redirect', array($this, 'redirect_404_to_home'));


	}
	public function redirect_404_to_home() {
		if (is_404()) {
			wp_redirect(home_url());
			exit;
		}
	}

	public function activate_plugin()
	{
		global $wpdb;
		do_action( 'my_plugin_activate' );
		// Finding Dashboard Page, Create New Page if not exist
	//	$dashboard_page = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = 'dashboard' AND post_type = 'page'", OBJECT);

		// Finding App Page, Create New Page if not exist
	//	$app_page = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = 'app' AND post_type = 'page'", OBJECT);

		
	}

	
	
	public function register_custom_post_type()
	{
		register_post_type(
			'wptegalformclass',
			array(
				'labels'             => array(
					'name'               => _x('Forms', 'post type general name', 'wptegalformclass'),
					'singular_name'      => _x('Form', 'post type singular name', 'wptegalformclass'),
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array('slug' => 'form', 'with_front' => false),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array('title', 'editor', 'author'),
			)
		);

		// Register meta key 'whatsapp' for the custom post type
		register_post_meta(
			'wptegalformclass',
			'whatsapp',
			array(
				'type'         => 'string',
				'single'       => true,
				'show_in_rest' => true, // if you want to use in REST API
			)
		);
	}

	// Add custom column to post list
	public function custom_post_list_column($columns)
	{
		$columns['whatsapp'] = 'WhatsApp';
		return $columns;
	}

	// Display custom column data in post list
	public function custom_post_list_column_data($column, $post_id)
	{
		if ($column == 'whatsapp') {
			// Retrieve the WhatsApp number using get_post_meta
			$wa_number = get_post_meta($post_id, 'whatsapp', true);

			// Display the WhatsApp number in the column
			echo esc_html($wa_number);
		}
	}

	public function custom_rewrite_rule()
	{
		add_rewrite_rule('^forms/([^/]+)/?$', 'index.php?post_type=wptegalformclass&p=$matches[1]', 'top');
	}

	public function generate_post_slug($post_ID, $post, $update)
	{
		if ($post->post_type === 'wptegalformclass' && !$update) {
			$random_slug = $this->generate_random_string();
			$data = array(
				'ID'        => $post_ID,
				'post_name' => $random_slug,
			);
			wp_update_post($data);
		}
	}

	public static function generate_random_string()
	{
		$uppercase_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$lowercase_letters = 'abcdefghijklmnopqrstuvwxyz';
		$numbers = '0123456789';

		$random_string = '';

		// Add at least 1 uppercase letter
		$random_string .= $uppercase_letters[rand(0, strlen($uppercase_letters) - 1)];

		// Add at least 2 more letters (uppercase or lowercase)
		for ($i = 0; $i < 2; $i++) {
			$all_letters = $uppercase_letters . $lowercase_letters;
			$random_string .= $all_letters[rand(0, strlen($all_letters) - 1)];
		}

		// Add at least 1 number
		$random_string .= $numbers[rand(0, strlen($numbers) - 1)];

		// Add remaining characters (if any)
		for ($i = strlen($random_string); $i < 5; $i++) {
			$all_characters = $uppercase_letters . $lowercase_letters . $numbers;
			$random_string .= $all_characters[rand(0, strlen($all_characters) - 1)];
		}

		// Shuffle the string to make it random
		$random_string = str_shuffle($random_string);

		return $random_string;
	}

	public static function convertSpacesToHyphens($string) {
		// Replace spaces with hyphens
		$result = str_replace(' ', '-', $string);

		// Remove any consecutive hyphens
		$result = preg_replace('/-+/', '-', $result);

		// Trim hyphens from the beginning and end of the string
		$result = trim($result, '-');

		return $result;
	}

	public static function convertHyphensToSpaces($string) {
		// Replace hyphens with spaces
		$result = str_replace('-', ' ', $string);

		return $result;
	}
	
	public static function keepLettersAndHyphens($inputString) {
        // Keep only letters and hyphens using a regular expression
        $cleanString = preg_replace('/[^a-zA-Z-]/', '', $inputString);
    
        return $cleanString;
    }

	public static function renderFormBuilderHTML($formBuilderJSON) {
		$elements = json_decode($formBuilderJSON, true);
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		// Check if decoding was successful and $elements is an array
		if (!is_array($elements)) {
			return 'Invalid JSON format.';
		}
        //echo "<pre>"; // Agar hasilnya lebih rapi
        //print_r($elements);
        //echo "</pre>";
		
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'wptegalformclass.harnods-server.com') !== true) {
		$html = '<form id="wptegalformclass" method="post" action="'.$actual_link.'">';
	} else {
		$html = '<form id="wptegalformclass" method="post" action="'.$actual_link.'">';
	}

    foreach ($elements as $element) {
        if (!is_array($element) || !isset($element['type'])) {
            continue;
        }

        // Start form group
        $html .= '<div class="form-group">';

        // Check if 'name' key is set
        // $name = isset($element['label']) ? wptegalformclass::convertSpacesToHyphens($element['label']) : '';
      //  $name = isset($element['label']) ? wptegalformclass::keepLettersAndHyphens($element['label']) : '';
        $namafiled = str_replace(" ","",$element['label']);
        $namafiled2 = str_replace(array("'","?"),"",$namafiled);
        $namafiled3 = strtolower($namafiled2);
        $name = $namafiled3;
        $label = isset($element['label']) ? $element['label'] : '';

        // Label (skip for header and paragraph)
        if ($element['type'] !== 'header' && $element['type'] !== 'paragraph') {
            $html .= '<label for="' . $label . '">' . $label;
            if ($element['required']) {
                $html .= '<span class="required">*</span>'; // Add a required indicator
            }
            if (!empty($element['description'])) {
                    $html .= '<span class="tooltip-element" data-toggle="tooltip" data-placement="top" title="' . $element['description'] . '">?</span>';
             }
            $html .= '</label>';
        }

        switch ($element['type']) {
            case 'header':
                $html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
                break;
            case 'paragraph':
                $html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
                break;
            case 'checkbox-group':
                    $html .= '<div class="checkbox formbuilder-checkbox-group">';
                   
                foreach ($element['values'] as $value) {
                    $html .= '<div class="checkbox-group formbuilder-checkbox"> <input class="form-check-input" type="checkbox" name="' . $name . '[]" value="' . $value['label'] . '" id="' . $name . '-' . $value['label'] . '"><label class="form-check-label formbuilder-checkbox-group-label" for="' . $name . '-' . $value['label'] . '">' . $value['label'];
                    
                    $html .= '</label></div>';
                }
                if ($element['other'] === true) {
                    $uniqueOtherId = $name . '-otherOption-' . uniqid(); // Buat ID unik sekali dan gunakan untuk elemen input dan label

                    $html .= '<div class="checkbox-group formbuilder-checkbox other-checkbox">';
                    $html .= '<input class="form-check-input" type="checkbox" id="' . $uniqueOtherId . '">';
                    $html .= '<label class="form-check-label" for="' . $uniqueOtherId . '">Other</label>';
                    $html .= '<input type="text" name="'.$name.'[]" class="form-control" placeholder="Please specify" style="display: none;">';
                   //  $html .= '<input type="text" name="other-' . $element['name'] . '" id="' . $uniqueOtherId . '-text" class="form-control" placeholder="Please specify" style="display: none;">';
                    $html .= '</div>';
                }
                
                    $html .= '</div>';
                break;
            case 'radio-group':
                $firstOption = true; // Flag to track the first option
                $html .= '<div class="radio-group">';
                $groupName = $name . '-' . uniqid();
                foreach ($element['values'] as $value) {
                    $html .= '<div class="formbuilder-radio">';
                    
                    $radiouniqueId = $name . '-' . $value['value'] . '-' . uniqid();

                    // Pindahkan input sebelum label
                    $html .= '<input class="form-check-input" type="radio" name="' . $name . '" value="' . $value['value'] . '" id="' . $radiouniqueId . '"';

                    // Tambahkan "required" hanya pada input pertama
                    if ($element['required'] && $firstOption) {
                        $html .= ' required';
                        $firstOption = false; // Set flag menjadi false setelah opsi pertama
                    }

                    $html .= '>';
                    $html .= '<label class="form-check-label" for="' . $radiouniqueId . '">' . $value['label'] . '</label>';
                    $html .= '</div>';
                }
                if (!empty($element['description'])) {
                    //$html .= '<p class="help-block">' . $element['description'] . '</p>';
                    $html .= '<span class="tooltip-element" data-toggle="tooltip" data-placement="top" title="' . $element['description'] . '">?</span>';
                }
                    $html .= '</div>';
                // $firstOption = true; // Flag to track the first option
                //     $html .= '<div class="form-check">';
                // foreach ($element['values'] as $value) {
                //     $html .= '<input class="form-check-input" type="radio" name="' . $name . '" value="' . $value['value'] . '" id="' . $name . '-' . $value['value'] . '"';
                //     if ($element['required'] && $firstOption) {
                //         $html .= ' required';
                //         $firstOption = false; // Set the flag to false after the first option
                //     }
                //     $html .= '>';
                //     $html .= '<label class="form-check-label" for="' . $name . '-' . $value['value'] . '">' . $value['label'] . '</label>';
                // }
                break;
            case 'date':
                $html .='<div class="date-field">';
                $html .= '<input class="' . $element['className'] . '" type="date" name="' . $name . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required';
                }
                if ($element['placeholder']) {
                    $html .= 'placeholder = "'. $element['placeholder'] .'"';
                }
                $html .= '>';
                $html .='</div>';
                break;
            case 'number':
                $html .= '<input class="' . $element['className'] . '" type="number" name="' . $name . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required';
                }
                $html .= '>';
                break;
            case 'select':
                if ($element['multiple']) {
                    $html .= '<select class="' . $element['className'] . '" name="' . $name . '[]" id="' . $name . '"';
                }
                else{
                    $html .= '<select class="' . $element['className'] . '" name="' . $name . '" id="' . $name . '"';
                }
                if ($element['placeholder']) {
                    $html .= 'title = "'. $element['placeholder'] .'"';
                }
                
                if ($element['multiple']) {
                    $html .= ' multiple ';
                }
                if ($element['required']) {
                    $html .= ' required ';
                }
				
                $html .= '>';
                foreach ($element['values'] as $value) {
                    $html .= '<option value="' . $value['label'] . '"  >' . $value['label'] . '</option>';
                }
                $html .= '</select>';
                break;
            case 'text':
                $html .= '<input type="text" name="' . $name . '" class="' . $element['className'] . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required ';
                }
				if ($element['placeholder']) {
                    $html .= 'placeholder = "'. $element['placeholder'] .'"';
                }
                if ($element['value']) {
                    $html .= ' value = "'. $element['value'] .'"';
                }
                $html .= '>';
                break;
            case 'textarea':
                $html .= '<textarea name="' . $name . '" class="' . $element['className'] . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required ';
                }
                if ($element['placeholder']) {
                    $html .= ' placeholder = "'. $element['placeholder'] .'"';
                }
                if ($element['rows']) {
                    $html .= ' rows = "'. $element['rows'] .'"';
                }
                $html .= '></textarea>';
                break;
            // Add more cases for other form elements as needed
            default:
                // Handle unknown form element types
                break;
        }

        // End form group
        $html .= '</div>';
    }

// 		foreach ($elements as $element) {
// 			if (!is_array($element) || !isset($element['type'])) {
// 				continue; // Skip non-array elements or elements without a type
// 			}

// 			// Start form group
// 			$html .= '<div class="form-group">';

// 			// Check if 'name' key is set
// 			// $name = isset($element['name']) ? $element['name'] : '';

// 			$name = isset($element['label']) ? wptegalformclass::convertSpacesToHyphens($element['label']) : '';
// 			$label = isset($element['label']) ? $element['label'] : '';

// 			// Label (skip for header and paragraph)
// 			if ($element['type'] !== 'header' && $element['type'] !== 'paragraph') {
// 				$html .= '<label for="' . $name . '">' . $label . ':</label>';
// 			}

// 			switch ($element['type']) {
// 				case 'header':
// 					$html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
// 					break;
// 				case 'paragraph':
// 					$html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
// 					break;
// 				case 'text':
// 					$html .= '<input type="' . $element['subtype'] . '" name="' . $name . '" class="form-control" id="' . $name . '" value="">';
// 					break;
// 				case 'textarea':
// 					$html .= '<textarea name="' . $name . '" class="' . $element['className'] . '" id="' . $element['subtype'] . '"></textarea>';
// 					break;
// 				case 'select':
// 					$multipleAttribute = ($element['multiple'] === true) ? 'multiple' : '';
// 					$html .= '<select class="' . $element['className'] . '" name="' . $name . '" id="' . $name . '"' . $multipleAttribute . '>';
// 					foreach ($element['values'] as $value) {
// 						$html .= '<option value="' . $value['label'] . '" ' . ($value['selected'] ? 'selected' : '') . '>' . $value['label'] . '</option>';
// 					}
// 					$html .= '</select>';
// 					break;
// 				case 'checkbox-group':
// 					foreach ($element['values'] as $value) {
// 						$html .= '<div class="checkbox">';
// 						$html .= '<label class="form-check-label" for="' . $name . '-' . $value['label'] . '"><input class="form-check-input" type="checkbox" name="' . $name . '[]" value="' . $value['label'] . '" id="' . $name . '-' . $value['label'] . '">' . $value['label'] . '</label>';
// 						$html .= '</div>';
// 					}
// 					if ($element['other'] === true) {
// 						$html .= '<div class="checkbox">';
// 						$html .= '<label class="form-check-label"><input class="form-check-input" type="checkbox" id="other-' . $name . '"> Other';
// 						$html .= '<input type="text" name="' . $name . '[]" id="other-' . $name . 'Text" class="form-control" placeholder="Please specify" style="display: none;"></label>';
// 						$html .= '</div>';
// 						$html .= '<script>';
// 						$html .= 'document.getElementById(\'other-' . $name . '\').addEventListener(\'change\', function() {';
// 						$html .= 'var otherCheckboxText = document.getElementById(\'other-' . $name . 'Text\');';
// 						$html .= 'otherCheckboxText.style.display = this.checked ? \'block\' : \'none\';';
// 						$html .= 'otherCheckboxText.value = \'\';';
// 						$html .= '});';
// 						$html .= '</script>';
// 					}
// 					break;
// 				case 'radio-group':
// 					foreach ($element['values'] as $value) {
// 						$html .= '<div class="checkbox">';
// 						$html .= '<label class="form-check-label" for="' . $name . '-' . $value['label'] . '"><input class="form-check-input" type="radio" name="' . $name . '[]" value="' . $value['label'] . '" id="' . $name . '-' . $value['label'] . '">' . $value['label'] . '</label>';
// 						$html .= '</div>';
// 					}
// 					/*
//                 if ($element['other'] === true) {
//                     $html .= '<div class="checkbox">';
//                     $html .= '<label class="form-check-label"><input class="form-check-input" type="radio" id="other-' . $name . '"> Other';
//                     $html .= '<input type="text"  name="' . $name . '[]" id="other-' . $name . 'Text" class="form-control" placeholder="Please specify" style="display: none;"></label>';
//                     $html .= '</div>';
//                     $html .= '<script>';
//                     $html .= 'document.getElementById(\'other-' . $name . '\').addEventListener(\'change\', function() {';
//                     $html .= 'var otherRadioText = document.getElementById(\'other-' . $name . 'Text\');';
//                     $html .= 'otherRadioText.style.display = this.checked ? \'block\' : \'none\';';
//                     $html .= 'otherRadioText.value = \'\';';
//                     $html .= '});';
//                     $html .= '</script>';
//                 }
//                 */
// 					break;
// 				case 'date':
// 					// $minAttributes = ($element['min'] === true) ? 'min="' . $element['min']['value'] . '"' : '';
// 					// $maxAttributes = ($element['max'] === true) ? 'max="' . $element['max']['value'] . '"' : '';
// 					// $stepAttributes = ($element['step'] === true) ? 'step="' . $element['step']['value'] . '"' : '';

// 					// $html .= '<input class="' . $element['className'] . '" type="' . $element['subtype'] . '" name="' . $name . '" id="' . $name . '"' . $minAttributes . ' ' . $maxAttributes . ' ' . $stepAttributes . '>';

// 					$html .= '<input class="' . $element['className'] . '" type="' . $element['subtype'] . '" name="' . $name . '" id="' . $name . '">';
// 					break;
// 				case 'number':
// 					$minAttributes = ($element['min'] === true) ? 'min="' . $element['min']['value'] . '"' : '';
// 					$maxAttributes = ($element['max'] === true) ? 'max="' . $element['max']['value'] . '"' : '';
// 					$stepAttributes = ($element['step'] === true) ? 'step="' . $element['step']['value'] . '"' : '';

// 					$html .= '<input class="' . $element['className'] . '" type="' . $element['subtype'] . '" name="' . $name . '" id="' . $name . '"' . $minAttributes . ' ' . $maxAttributes . ' ' . $stepAttributes . '>';
// 					break;
// 					// Add more cases for other form elements as needed
// 				default:
// 					// Handle unknown form element types
// 					break;
// 			}

// 			if (!empty($element['description'])) {
// 				$html .= '<p class="help-block">' . $element['description'] . '</p>';
// 			}

// 			// End form group
// 			$html .= '</div>';
// 		}

		$html .= '<div class="form-group text-right"><button type="submit" id="send-message" class="btn-success btn">Submit</button></div>';
		$html .= '</form>';

		return $html;
	}

	public function modify_single_template($template)
	{
		// Check if the current post is of type 'wptegalformclass'
		if (is_single() && is_post_type('wptegalformclasskk')) {
			// Use your custom template file
			$custom_template = plugin_dir_path(__FILE__) . 'frontend/single-wptegalformclass.php';

			// Check if the custom template file exists
			if (file_exists($custom_template)) {
				return $custom_template;
			} else {
				// Fallback to the default template if the custom template file doesn't exist
				return $template;
			}
		}

		// For other post types, return the original template
		return $template;
	}

	// Redirect login
    
    // Redirect users away from wp-login.php
   
	
	
    
}



// Instantiate the class
$wptegalformclass = new wptegalformclass();
//selesai class wptegalformclass