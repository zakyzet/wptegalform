<?php
    $ip = $_SERVER['REMOTE_ADDR'];
$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
//echo date_default_timezone_get();

$datenow = date('Y-m-d H:i:s');
    global $wpdb;
    $sends = "0";
$sql6 = "";
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$tabelseting= $wpdb->base_prefix."_table_setting";
$pesannya = "";
$email = "highfive@harnods-server.com";
$elementdateinput = "date";
$dateinput = "dateinput";
    $valueinput = "";
    add_filter( 'show_admin_bar', '__return_false' );
$post_id = get_the_ID();
$post_title = get_the_title();
 $args = array(
                                        'post_type' => 'superpform',
                                        'post__in' => array(get_the_ID())
                                    );


$table_name = $wpdb->base_prefix."_entries_".strtolower(str_replace(" ","_",$post_id));
$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );                                     
$urutkolom = "5";
$elementname = "";
if ( ! $wpdb->get_var( $query ) == $table_name ) {
   
   global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(10) NOT NULL AUTO_INCREMENT,
		post_id varchar (10) DEFAULT '' NOT NULL,
		form_name varchar (100) DEFAULT '' NOT NULL,
        whatsapp varchar (100) DEFAULT '' NOT NULL,
        date varchar (100) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    
  
      
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
    
             
}    



  $cols_sql = "DESCRIBE $table_name";
$all_objects = $wpdb->get_results( $cols_sql );
$urutkolom = "0";
$email_receiverpost = "";

foreach($all_objects as $obtablesetting){
    $_SESSION[$obtablesetting->Field] = "0";
}


$namafield3 = "";
  $postsnya = get_posts($args);
//echo "Ini bukan error, ditampilin untuk cek aja.<pre>";
//echo "<pre>";
//print_r($postsnya);
//echo "<pre>";
									$nolabel = "0";
              foreach ($postsnya as $pos){
                      $contentpost =  json_decode($pos->post_content);
                      foreach($contentpost as $key=> $v){
						  //ALTER TABLE `email_history` DROP `$form_id`;
                       
                         $namafiled2 = htmlentities(substr(strtolower(str_replace(" ","",$v->label)),100)) ;
                         $elementname = $v->name;
                          
                          $namafiled = htmlentities(strtolower(str_replace(" ","",$v->label)));
                         
                            if(strlen($namafiled) > 100 ){
                                        $column = $wpdb->get_results( $wpdb->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",DB_NAME, $table_name, $namafiled2) );
                                        $namafiled3 = $namafiled;
                            }
                            else{
                                        $column = $wpdb->get_results( $wpdb->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",DB_NAME, $table_name, $namafiled) );
                                        $namafiled3 = $namafiled;
                            }
                        
                          
                          
                          $column = $wpdb->get_results( $wpdb->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",DB_NAME, $table_name, $elementname) );
                          
                          $columndate = $wpdb->get_results( $wpdb->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",DB_NAME, $table_name, "dateinput") );
                          
                          if(!empty($columndate)){
                              $sql8 = "ALTER TABLE `{$table_name}` DROP `{$dateinput}`;";
                            //  $sqldate = "ALTER TABLE `{$table_name}` ADD `{$elementdateinput}` VARCHAR(100) NOT NULL;";
                             // $updatedate = "ALTER TABLE `{$table_name}` ALTER COLUMN `{$elementdateinput}` VARCHAR(100) NOT NULL;";
                              $wpdb->query( $sql18);
                          }
							$updatedate = "ALTER TABLE `{$table_name}` ALTER COLUMN `{$elementdateinput}` VARCHAR(100) NOT NULL;";
                              $wpdb->query( $updatedate);
                            if ( ! empty( $column ) ) {
                                // echo "<script>alert('sudah ada nama kolom ".$namafiled."')</script>";
                         //     echo $v->type;
                            //    echo "<br>";
                          //      print_r($column);
                          //       echo "<br>";
                                
								 if($v->type == "header" || $v->type == "paragraph" || $v->type == "hidden"){
										if(strlen($namafiled) > 100 ){
											$sql5 = "ALTER TABLE `{$table_name}` DROP `{$elementname}`;";
										}
										else{
											$sql5 = "ALTER TABLE `{$table_name}` DROP `{$elementname}`;";
										}
										$query_result5 = $wpdb->query( $sql5);
								 }
								 else{
									 if($v->type == "select"){
                                         if(strlen($namafiled) > 100 ){
                                              foreach($all_objects as $obtablesetting2){
                                                 if($elementname == $obtablesetting2->Field){
                                                     $_SESSION[$obtablesetting2->Field]++;
                                                     if($_SESSION[$obtablesetting2->Field] > 1){
                                                         $sql6 = "ALTER TABLE `{$table_name}` DROP `{$elementname}`;";
                                                     }
                                                 }
                                                
                                            	}
                                         }
                                         else{
                                             foreach($all_objects as $obtablesetting2){
                                                 if($elementname == $obtablesetting2->Field){
                                                     $_SESSION[$obtablesetting2->Field]++;
                                                     if($_SESSION[$obtablesetting2->Field] > 1){
                                                         $sql6 = "ALTER TABLE `{$table_name}` DROP `{$elementname}`;";
                                                     }
                                                 }
                                                
                                            	}
                                         }
                                        $query_result6 = $wpdb->query( $sql6);
                                         /**
                                     		$cekkolomresult = $wpdb->query('SHOW COLUMNS FROM '.$table_name);
                                         	if ($cekkolomresult !== FALSE) {
    											$cekkolomresults = $cekkolomresult->fetchAll();
                                            }
                                             else{
                                             }
                                            //  $ceckkolomvalues = $cekkolomresult->fetch_all(MYSQLI_ASSOC);
                                                $cekcolumn_names = array();    // $column_names = [];

                                                if(!empty($cekkolomresults)){
                                                    $cekcolumn_names = array_keys($cekkolomresults[0]);
                                                }
                                              
                                              if (in_array($namafiled, $cekcolumn_names)) {
                                                    echo "Yes! " . $namafiled . " is present in the table!";
                                                }
                                                **/
                                     
                                     }
                                     else{
                                          $urutkolom++;
                                        $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $post_id AND urut_kolom=$urutkolom");
                                        if($resultts){

                                            foreach( $resultts as $resultt ) {

                                                 $wpdb->update($tabelseting, array('alias'=> $v->label), array('id' => $resultt->id));
                                            }

                                        }
                                        else{
                                            //$wpdb->insert($tabelseting,$datainsertts);
                                        }
                                     }
                                     
                                     
                                     
									
									 
								 }
                                
								
                                
                            }
                             else{
								  if($v->type != "header"){
                                      if( $v->type != "paragraph"){
                                          if($v->type != "hidden"){
                                              
                                             
                                             
                                              
                                               if(strlen($namafiled) > 100 ){
                                                    $sql2 = "ALTER TABLE `{$table_name}` ADD `{$elementname}` VARCHAR(100) NOT NULL;";
                                                }
                                                else{
                                                    $sql2 = "ALTER TABLE `{$table_name}` ADD `{$elementname}` VARCHAR(100) NOT NULL;";
                                                }


                                                $query_result = $wpdb->query( $sql2);


                                                //add colom to table setting

                                                $urutkolom++;
                                                $datainsertts = array(
                                                    'id' => '',
                                                    'post_id' => $post_id,
                                                    'nama_form' =>$post_title,
                                                    'nama_kolom'=>$elementname,
                                                    'show_or_hide'=>'1',
                                                    'alias'=> $v->label,
                                                    'urut_kolom'=>$urutkolom
                                                );

                                                $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $post_id AND urut_kolom=$urutkolom");
                                                if($resultts){

                                                    foreach( $resultts as $resultt ) {

                                                         $wpdb->update($tabelseting, array('alias'=> $v->label), array('id' => $resultt->id));
                                                    }

                                                }
                                                else{
                                                    $wpdb->insert($tabelseting,$datainsertts);
                                                }
                                              
                                              
                                               if($v->type == "select"){
                                                         if(strlen($namafiled) > 100 ){
                                                              foreach($all_objects as $obtablesetting2){
                                                                 if($elementname == $obtablesetting2->Field){
                                                                     $_SESSION[$obtablesetting2->Field]++;
                                                                     if($_SESSION[$obtablesetting2->Field] > 1){
                                                                         $sql6 = "ALTER TABLE `{$table_name}` DROP `{$elementname}`;";
                                                                     }
                                                                 }

                                                                }
                                                         }
                                                         else{
                                                             foreach($all_objects as $obtablesetting2){
                                                                 if($elementname == $obtablesetting2->Field){
                                                                     $_SESSION[$obtablesetting2->Field]++;
                                                                     if($_SESSION[$obtablesetting2->Field] > 1){
                                                                         $sql6 = "ALTER TABLE `{$table_name}` DROP `{$elementname}`;";
                                                                     }
                                                                 }

                                                                }
                                                         }
                                                        $query_result6 = $wpdb->query( $sql6);
                                                        
                                                     } // end if type is select

                                              
                                          }
                                      }
                                    
                                      
                                      
                                      
								  }
                              }
                          
					
                        
						
                       } // end foreach $v
       			}          





	$postfield = array();
	$isiposfield1 = array();
	$isiposfield2 = "";
     $spreadsheet_id = esc_attr(get_post_meta(get_the_ID(), 'spreadsheet_id', true));
                                   

                                    $postsnya = get_posts($args);
									$nolabel = "0";
              foreach ($postsnya as $pos){
                      $contentpost =  json_decode($pos->post_content);
                      foreach($contentpost as $key=> $v){
                          
                            if(isset($_GET[$v->label])){
								$sends = "1";
                            }
                            else{
                                $sends = "0";
                            }
                              if(isset($_GET[$v->label])){
                                  $isiposfield1[strtolower(str_replace(" ","_",$v->label))] = $_GET[$v->label];
							array_push($postfield, strtolower(str_replace(" ","_",$v->label)).$_GET[$v->label]);
                              }
                       }
       			}                    
                            
if($sends == "1"){
  //  print_r($postfield);
    json_encode($isiposfield1, true);
   
    /**
     $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $spreadsheet_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($postfield),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: __Host-GAPS=1:E1OvdRtW4DG_ESHVUKdsfIwZ-2WUhg:7K8wVfWI9kpCdySO'
  ),
));

echo $response = curl_exec($curl);

curl_close($curl);
    
    
    
    
    $url = $spreadsheet_id;

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = json_encode($isiposfield1, true);

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
**/

}
$element_key = "";
    $element_name = "";
$element_label = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $formData = $_POST;
 // echo "<pre>";
  // print_r($formData);
  //  echo "<pre>";
    
	$fname = strtolower(str_replace(" ","_",$post_title));
      $phoneNumber = esc_attr(get_post_meta(get_the_ID(), 'whatsapp', true)); // Update this with the correct phone number
    $email_receiverpost = esc_attr(get_post_meta(get_the_ID(), 'email_receiver', true)); // Update this with the correct phone number
	$spreadsheet_id = esc_attr(get_post_meta(get_the_ID(), 'spreadsheet_id', true)); // Update this with the correct phone number     
   // $sql = "INSERT INTO $table_name (`post_id`,`form_name`) values ($post_id, $fname)";
global $wpdb;
//$wpdb->query($sql);
    $wpdb->insert($table_name, array('post_id' => $post_id,'form_name' => $fname, 'whatsapp' => $phoneNumber,'date' => $datenow,));
$lastid = $wpdb->insert_id;
    
    
    
    // Construct WhatsApp message
    $formattedMessage = "";
    foreach ($formData as $key => $value) {
        // Handle checkboxes (if it's an array, implode the values)
        $name = isset($key) ? superpform::convertHyphensToSpaces($key) : '';
        $element_key = str_replace(" ","",$name);
        $element_key2 = str_replace(array("'","?"),'',$element_key);
      $element_key3 = strtolower($element_key2);
      //  echo "<br>";
        $cekresults = $wpdb->get_results("SELECT * FROM  hfj__entries_options WHERE post_id =  '$post_id' AND element_key ='$element_key3'");
       
        foreach($cekresults as $cr){
            $element_name = $cr->element_name;
           
            $element_label = $cr->element_label;
            // echo "<br>";
           // $_SESSION[$element_name] = array();
            
        }
     //  echo "ini bukan error, tapi untuk cek aja. jangan masukin ke feedback:D";
     //   echo "<br>";
         	if (is_array($value)) {
         //       echo "ini array ".implode(", ", $value);
            //    echo "<br>";
         //  array_push($_SESSION[$element_name], implode(", ", $value));
            $wpdb->update($table_name,array($element_name => implode(", ", $value)),array('id' =>$lastid));
         //    $formattedMessage .= "<strong>" . $element_label . "</strong>:\n" . implode(", ", $value) . "<br>";
                
               if(is_email($value)){
                    $valueinput = '<a href="mailto:'.$value.'" style="color: #F84E1B;">'.$value.'</a>';
                }
                else{
                    $valueinput = $value;
                }
        $formattedMessage .= '<tr><td style="padding: 0 0 8px" width="100%" valign="top"><b>'.$element_label.'</b>:</td><td style="padding: 0 0 8px" width="100%" valign="top">'.implode(", ", $value).'</td></tr>';
                    
        
        
        
            } else {
                /**
                if(isset($_POST['othertext'])){
                    if($_POST['othertext'] == ""){
                        $wpdb->update($table_name,array($element_name => $value),array('id' =>$lastid));
                		$formattedMessage .= "<strong>" . $element_label . "</strong>:\n" . $value . "<br>";
                    }
                    else{
                        $wpdb->update($table_name,array($element_name => $_POST['othertext']),array('id' =>$lastid));
                		$formattedMessage .= "<strong>" . $element_label . "</strong>:\n" . $_POST['othertext'] . "<br>";
                    }
                }
                else{
                    $wpdb->update($table_name,array($element_name => $value),array('id' =>$lastid));
                	$formattedMessage .= "<strong>" . $element_label . "</strong>:\n" . $value . "<br>";
                }
                **/
			//	echo "ini bukan array ".$value;
          //      echo "<br>";
                
        $wpdb->update($table_name,array($element_name => $value),array('id' =>$lastid));
                //	$formattedMessage .= "<strong>" . $element_label . "</strong>:\n" . $value . "<br>";
                if(is_email($value)){
                    $valueinput = '<a href="mailto:'.$value.'" style="color: #F84E1B;">'.$value.'</a>';
                }
                else{
                    $valueinput = $value;
                }
                $formattedMessage .= '
                    <tr>
                        <td style="padding: 0 0 8px; width: 100%; vertical-align: top;">
                            <b>'.$element_label.'</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 0 8px; width: 100%; vertical-align: top;">
                            '.$valueinput.'
                        </td>
                    </tr>
					<tr><td style="padding: 0 0 16px; width: 100%; vertical-align: top;"></td></tr>';
    
            }
        
        
    }

    // WhatsApp phone number
   
    // WhatsApp phone number

  //    urlencode($formattedMessage);
    function wpdocs_set_html_mail_content_type() {
	return 'text/html';
}
add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
      $to = $email_receiverpost;
                      $subject = "Response for ".get_the_title();
                       $headers[] = 'From: '. $email;
                       $headers[] = 'Cc: ahmad@harnods.com';
                       $headers[] = 'Bcc: iqsa@harnods.com';

 $emailbody = '<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">
<div style="padding: 48px 0; margin: 0 auto;max-width: 600px;">

    <table cellpadding="0" cellspacing="0" border="0" width="600" style="font-size: 16px; line-height: 30px; color: #111111; font-family: "Jost", sans-serif; margin: 0 auto; background: #F2F4F5; font-weight: 500;">
        <tr>
            <td width="30%" style="width: 30%;height: 3px;position: relative;background: #F84E1B;"></td>
            <td width="70%" style="width: 70%;height: 3px;position: relative;background: #E5E5E5;"></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="600" style="font-size: 16px; line-height: 30px; color: #111111; font-family: "Jost", sans-serif; margin: 0 auto; background: #F2F4F5; font-weight: 500;">
        <tbody>
            <tr>
                <td width="100%" style="vertical-align: top; padding: 60px 30px 80px;background: #F2F4F5;" align="left">
                    <a href="#"><img style="height: 40px; display: block; margin: 0 auto; margin-bottom: 40px;" src="https://highfivejobs-dev.harnods-server.com/wp-content/uploads/2024/11/highfive-logo.png"></a>
                    <p style="width: 450px; margin: 0 0 24px;">Response From ['.get_the_title().']</p>


                    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size: 16px; line-height: 30px; color: #232323; font-family: "Jost", sans-serif; margin: 0 auto 30px; font-weight: 500;">
                        '.$formattedMessage.'
            		</table>
            		<p style="width: 450px; margin: 40px 0 0;">Please review it in the admin panel.</p>
            	</td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" border="0" width="600" style="font-size: 16px; line-height: 30px; color: #111111; font-family: "Jost", sans-serif; margin: 0 auto; background: #F2F4F5; font-weight: 500;">
                        <tr>
                            <td width="30%" style="width: 30%;height: 1px;position: relative;background: #F84E1B;"></td>
                            <td width="70%" style="width: 70%;height: 1px;position: relative;background: #E5E5E5;"></td>
                        </tr>
                    </table>
                </td>

            </tr>
		</tr>
	</tbody>
</table>
</div>';       

                    //Here put your Validation and send mail
                    $sent = wp_mail($to, $subject, $emailbody, $headers);
                          if($sent) {
                                $pesannya = "<div class='notif'> Your message was sent successfully </div> ";
                              
                          }//mail sent!
                          else  {
                          $pesannya = "<div class='notiferror'>Pesan gagal dikirim</div>";
                          }//message wasn't sent
    
    
    // Construct WhatsApp URL
    $whatsappUrl = "https://wa.me/62" . $phoneNumber . "?text=" . urlencode($formattedMessage);

    // Redirect to WhatsApp
// header("Location: " . $whatsappUrl);
 // exit();
    
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_the_title() . ' - ' . get_bloginfo('name'); ?></title>
   <link rel="shortcut icon" href="<?php echo get_site_icon_url();?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo get_home_url();?>/wp-content/plugins/highfive-form/frontend/css/styles.css"/>
	<?php //echo get_home_url();?>
	
</head>
<body>
<div class="wrapper">
    <main class="form-rendered">
        <div class="container">
            <div class="content ">
                <div class="rendered-form formbuilder-embedded-bootstrap">
        			<div class="logo-powered" style="margin-bottom: 32px;">
                        <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_h5.jpg" alt="Powered Logo" style="height: 64px; width: 64px; object-fit: contain;"></div>
                    </div>
                    <!-- Your Form Will Here -->
                    <?php  
     				 echo  $pesannya;
                    // Call the function and echo the result
                   	
					echo superpform::renderFormBuilderHTML(get_the_content(null, false));
					//echo "<script>console.log(`".superpform::renderFormBuilderHTML(get_the_content(null, false))."`)</script>"
                    ?>
                </div>
            </div>
            <div class="powered-by">
                <div class="logo-powered">
                    <!-- span>Powered by</span>
                    <div><?php echo file_get_contents( plugin_dir_url(__FILE__) . '/assets/logo-hayform.svg' ); ?></div -->
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  tinymce.init({
    selector: '#tinymce',
    height: 300,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '<?php echo plugin_dir_url(__FILE__) . '/css/codepen.min.css'; ?>'
    ]
  });
  var quill = new Quill('#quill', {
    theme: 'snow' // or 'bubble'
  });
  
</script>
    
	<script>
    document.getElementById("superpform").setAttribute("action","<?php echo $actual_link;?>");
    $('[data-toggle="tooltip"]').tooltip();

	$('select.form-control').each(function() {
            var select = $(this),
                size = (select.data('size') !== undefined) ? select.data('size') : 4;
            select.selectpicker({
                style: 'select-control',
                placeholder: 'halo',
                size: size,
                liveSearchPlaceholder: 'Search here..',
                width: "100%",
            });
            select.each(function() {
                if (select.attr('multiple')) {
                    select.on('changed.bs.select loaded.bs.select', function(e, clickedIndex, isSelected, previousValue) {
                        var $title = $(this).parent().find('.filter-option-inner-inner');
                        var selectedText = $title.text();
                        var $rootEl = $(this).parent();

                        if ($(this).parent().find('.bs-placeholder').length === 0) {

                            var selectedCount = selectedText.split(', ').length;
                            if (selectedCount > 2) {
                                selectedText = selectedCount;
                            }
                            $title.text($(this).attr('title'));
                            $rootEl.addClass('has-selected');
                        } else {
                            $title.text($(this).data('placeholder'));
                            $rootEl.removeClass('has-selected');
                        }
                    });
                }
            })

        });
		$('.form-group').each(function() {
            var inpt = $(this).find('input');
            var slct = $(this).find('select');
            var txtarea = $(this).find('textarea');
            var lbl = $(this).find('label');
            var radio = $(this).find('input[type="radio"]');

            // Cek apakah elemen tidak mengandung input, select, textarea, atau radio
            if (inpt.length < 1 && slct.length < 1 && txtarea.length < 1 && radio.length < 1 && lbl.length > 0) {
                $(this).addClass('hidden');
            }
        });
        $('.formbuilder-checkbox.other-checkbox').each(function() {
                var t = $(this);
                var chcko = $(this).find('input[type="checkbox"]'); 

                chcko.on('change', function() {
                    // Cek apakah checkbox dicentang
                    if (this.checked) {
                        // Tampilkan elemen dengan ID 'otherOptionText' di dekatnya
                        t.find('.form-control').show();
                    } else {
                        // Sembunyikan jika tidak dicentang
                        t.find('.form-control').hide();
                    }
                });
            });
		$('.form-rendered #send-message').each(function(){
			var t = $(this);
            $('.form-rendered').removeClass('loading');
            t.on('click', function(){
            	$('.rendered-form .notif').hide();
            	$('.form-rendered').addClass('loading');
            })
        })

    </script>
    <?php
$parsed_url = parse_url(home_url());
echo '<!--' . $parsed_url['host'] . ' -->';

    // Check if the page is loaded inside an iframe
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $parsed_url['host']) !== true) {
		?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('superpform');

        if (form) {
            form.addEventListener('submit', function (event) {
                // event.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = new FormData(form);
                var formattedMessage = "Response%20for%20<?php esc_html(get_the_title()); ?>%0A%0A";

                formData.forEach(function (value, key) {
                    formattedMessage += "*" + key + ":*\n" + value + "\n\n";
                });

                // Get WhatsApp phone number
                var phoneNumber = <?php echo '62' . esc_attr(get_post_meta(get_the_ID(), 'whatsapp', true)); // Update this with the correct phone number ?>

                // Construct WhatsApp URL
             //   var whatsappUrl = "https://wa.me/" + phoneNumber + "?text=" + formattedMessage;
                var whatsappUrl = "https://wa.me/" + phoneNumber + "?text=<?php echo urlencode($formattedMessage);?>";

                // Open WhatsApp URL in a new tab
              //  window.open(whatsappUrl, '_blank');
            });
        }
        //$('select.form-control').selectpicker();
        $('.date-field').each(function() {
            var t = $(this);
            // t.datepicker();
        });
    });
    //$('.form-group label').each(function() {
        // Ambil teks dari label
        //var labelText = $(this).html();

        // Hapus titik dua jika ada
        //$(this).html(labelText.replace(':', ''));
    //});
	

</script>
<?php
    }
    ?>
</body>
</html>