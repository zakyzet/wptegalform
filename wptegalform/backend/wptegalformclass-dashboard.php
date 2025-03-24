<?php
/*
Template Name: Dashboard Template
*/

if (!defined('WPINC')) {
die;
}

// Start output buffering
ob_start();

// Initialize variables
$title = '';
$content = '';
$wa_number = '';
$email_receiver = '';
$spreadsheet_id = '';
$slug = '';
$form_statuscek = "publish";
$tabelseting="hfj_table_setting";
$idpost = "1";
// Get the random slug
$random_slug = wptegalformclass::generate_random_string();

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
$form_id = absint($_GET['id']);

// Retrieve the details of the 'wptegalformclass' post
$form_post = get_post($form_id);

if ($form_post && $form_post->post_type === 'wptegalformclass') {
    $title = esc_html($form_post->post_title);
    $content = esc_html($form_post->post_content);
    $wa_number = get_post_meta($form_id, 'whatsapp', true);
    $email_receiver = get_post_meta($form_id, 'email_receiver', true);
    $spreadsheet_id = get_post_meta($form_id, 'spreadsheet_id', true);
    $slug = esc_html($form_post->post_name);
}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_submission_nonce']) && wp_verify_nonce($_POST['form_submission_nonce'], 'form_submission_nonce')) {
$form_title   = sanitize_text_field($_POST['form_title']);
$form_content = strip_tags($_POST['form_content']);
$form_slug    = $_POST['form_slug'];
$form_statuscek = $_POST['form_statuscek'];
$form_id      = isset($_POST['form_id']) ? absint($_POST['form_id']) : 0;
$wa_number    = sanitize_text_field($_POST['wa_number']); // Retrieve the WhatsApp number from the form
$input_email_receiver = sanitize_text_field($_POST['email_receiver']);
$spreadsheet_id = sanitize_text_field($_POST['spreadsheet_id']); // Retrieve the WhatsApp number from the form
$form_data = array(
    'post_title'   => $form_title,
    'post_name'   => $form_slug,
    'post_content' => $form_content,
    'post_type'    => 'wptegalformclass', // Change this to your actual post type
    'post_status'  => $form_statuscek, // You may set it to 'publish' or 'draft' based on your needs
);

if ($form_id) {
    // Update the existing post
    $form_data['ID'] = $form_id;
    $post_id = wp_update_post($form_data);

    // Update or add the WhatsApp number as post meta
    update_post_meta($form_id, 'whatsapp', $wa_number);
    update_post_meta($form_id, 'spreadsheet_id', $spreadsheet_id);
    update_post_meta($form_id, 'email_receiver', $input_email_receiver);
    
} else {
    // Create a new post
    $post_id = wp_insert_post($form_data);

    // If the post was successfully created, add the WhatsApp number as post meta
    if (!is_wp_error($post_id)) {
       // add_post_meta($post_id, 'whatsapp', $wa_number, true);
        add_post_meta($post_id, 'email_receiver', $input_email_receiver, true);
    }
}

if (is_wp_error($post_id)) {
    echo 'Post creation/updating failed. Error: ' . $post_id->get_error_message();
    // Add additional information for debugging if needed
} else {
    if($form_statuscek == "draft"){
        $redirect_url = '?page=highfive_form_dashboard';
        $_SESSION['notifcreatedraft'] = "ok";
        wp_redirect($redirect_url);
        exit();
    }
    else{
    echo 'Post created/updated successfully. ID: ' . $post_id;
    // Form submitted successfully, redirect to the form with the specified ID
    $redirect_url = 'https://highfivejobs-dev.harnods-server.com/wp-admin/admin.php?page=highfive_form_dashboard&action=share&id=' . $post_id;
    wp_redirect($redirect_url);
    exit();
    }
}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form | <?php echo get_bloginfo('name'); ?></title>
    <link rel="icon" href="<?php echo plugin_dir_url(__FILE__) . 'assets/ic-logo.svg'; ?>">
    <?php // <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/> ?>
        <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/plugins.css'; ?>"/>
    <link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . 'css/dashboard.css'; ?>"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<?php    if (isset($_GET['action'])) {
 if ($_GET['action'] === 'create' || $_GET['action'] === 'edit') { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
     <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script> 
  <?php //<!--   <script src="<?php echo plugin_dir_url(__FILE__);? js/form-builder2.min.js"></script>  --> ?>
 <?php //<!-- 	<script src="<?php echo plugin_dir_url(__FILE__);? js/form-render2.min.js"></script>  --> ?>
    <?php } } ?>
    <script src="<?php echo plugin_dir_url(__FILE__) . 'js/qrcode.min.js'; ?>"></script>
</head>
</head>
<body>

<?php
/**
 * Show the dashboard form logged in User
 */
if (is_user_logged_in()) {
    
    require_once('maindashboard.php');
    
    
} else {
/**
 * Show the login form for non-logged in User
 */
 require_once('loginpage.php');

}

// End output buffering and flush the buffer
ob_end_flush();

?>
  <script src="<?php echo plugin_dir_url(__FILE__) . 'js/dashboard.js'; ?>"></script>
   
</body>
</html>
     <?php
    global $wpdb;
        $table_name_formsetting = $wpdb->base_prefix."_entries_options";
$table_setting = $wpdb->base_prefix."_table_setting";
$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name_formsetting ) );                                     
$urutkolom = "5";
$elementname = "";
if ( ! $wpdb->get_var( $query ) == $table_name_formsetting ) {
   
   global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name_formsetting (
		id mediumint(10) NOT NULL AUTO_INCREMENT,
		post_id varchar (10) DEFAULT '' NOT NULL,
		element_label varchar (100) DEFAULT '' NOT NULL,
        element_name varchar (100) DEFAULT '' NOT NULL,
        element_key varchar (100) DEFAULT '' NOT NULL,
        date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id)
	) $charset_collate;";

    
  
      
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
    
             
}    

$query2 = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_setting ) );                                     

if ( ! $wpdb->get_var( $query2 ) == $table_setting ) {
   
   global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$sql2 = "CREATE TABLE $table_setting (
		id mediumint(10) NOT NULL AUTO_INCREMENT,
		post_id varchar (10) DEFAULT '' NOT NULL,
		nama_form varchar (100) DEFAULT '' NOT NULL,
        nama_kolom varchar (100) DEFAULT '' NOT NULL,
        show_or_hide varchar (100) DEFAULT '' NOT NULL,
        alias varchar (100) DEFAULT '' NOT NULL,
        urut_kolom varchar (100) DEFAULT '' NOT NULL,
        date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id)
	) $charset_collate;";

    
  
      
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql2 );
    
             
}    
        ?>