 <?php
     global $wpdb;
   //mulai create table options
$table_name_option = $wpdb->base_prefix."_entries_options";
$query_table_option = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name_option ) );                                     

if ( ! $wpdb->get_var( $query_table_option ) == $table_name_option ) {
   
   global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name_option (
		id mediumint(10) NOT NULL AUTO_INCREMENT,
		post_id varchar (10) DEFAULT '' NOT NULL,
		element_label varchar (1000) DEFAULT '' NOT NULL,
        element_name varchar (1000) DEFAULT '' NOT NULL,
        element_key varchar (1000) DEFAULT '' NOT NULL,
        date varchar (100) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    
  
      
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
    
             
}    
    //selesai create table option    
     
     
   global $wpdb;
   //mulai create table setting
$table_name_setting = $wpdb->base_prefix."_table_setting";
$query_table_setting = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name_setting ) );                                     

if ( ! $wpdb->get_var( $query_table_setting ) == $table_name_setting ) {
   
   global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name_setting (
		id mediumint(10) NOT NULL AUTO_INCREMENT,
		post_id varchar (10) DEFAULT '' NOT NULL,
		nama_form varchar (1000) DEFAULT '' NOT NULL,
        nama_kolom varchar (1000) DEFAULT '' NOT NULL,
        show_or_hide varchar (1000) DEFAULT '' NOT NULL,
        alias varchar (1000) DEFAULT '' NOT NULL,
        urut_kolom varchar (1000) DEFAULT '' NOT NULL,
        date varchar (100) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    
  
      
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
    
             
}    
    //selesai create table setting  

     ?>
     
     <div id="wrap">
     <div class="web-wrapper" id="page">
    
    <main>
           <div class="dashboard">
                <div class="dashboard-area">
            <?php 
    if (isset($_GET['action'])) {
    /**
     * Show the Builder
     */
     
     
       require_once('getaction.php');
       
       
    } else {
    /**
     * Show the form List
     */
            ?>
          <div class="dashboard-container myforms">
                <h1>My Forms</h1>
                <div class="forms-list row">
                  <div class="col-lg-4 col-md-6">
               
            <?php $checkfilesingle = file_exists(get_template_directory()."/single-superpform.php"); 
        	if($checkfilesingle == "1"){
            }
            else{
                copy(WptegalFORM_PLUGIN_DIR.'backend/single-superpform.php', get_template_directory().'/single-superpform.php');
            }
        	?>
                            </a>
            <a class="myform-card addnew" href="?page=Wptegal_form_dashboard&action=create">
                      <div class="content"><img src="<?php echo plugin_dir_url(__FILE__) . 'assets/add-new-ilus.png'; ?>" alt="ilustration"/><span>Create a new form</span></div></a></div>
            
             <?php

        $current_user_id = get_current_user_id();

        $args = array(
            'post_type'      => 'superpform',
            'posts_per_page' => -1,
            'author'         => $current_user_id,
            'post_status' => array('publish', 'draft')
        );
		 global $wpdb;
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                if(get_post_status() == "publish"){
                   $ctable_name = $wpdb->base_prefix."_entries_".strtolower(str_replace(" ","_",get_the_title()));
                    $table_name = $wpdb->base_prefix."_entries_".strtolower(str_replace(" ","_",get_the_ID()));
                   // $ctable_name = $wpdb->base_prefix."_entries_".strtolower(str_replace(" ","_",get_the_ID()));
                    $cquery = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $ctable_name ) );   
                    $showentries = "";
                    if ( $wpdb->get_var( $cquery ) == $ctable_name ) {
                         $showentries = '
                                 <a class="card-file" href="?page=Wptegal_form_dashboard&action=entries&id=' . get_the_ID() . '">Entries</a>
                                ';
                    }
                    
                    //cek kolom entrie
                    $post_id = get_the_ID();



 									$args = array(
                                        'post_type' => 'superpform',
                                        'post__in' => array($post_id)
                                    );
global $wpdb;
$table_name_formsetting = $wpdb->base_prefix."_entries_options";
$table_name = $wpdb->base_prefix."_entries_".strtolower(str_replace(" ","_",get_the_ID()));                    
                    $postsnya = get_posts($args);
                    
  foreach ($postsnya as $pos){
     $contentpost =  json_decode($pos->post_content);
     foreach($contentpost as $key=> $v){
         
         $results = $wpdb->get_results ("SELECT * FROM  $table_name_formsetting WHERE post_id =  '$post_id' AND element_name ='$v->name'");
	//	$sql_query     = $wpdb->prepare("SELECT COUNT(*) FROM  $table_name_formsetting WHERE post_id =  $post_id AND element_name = $v->name");

       //  $cekresult = $wpdb->query( $sql_query ); 
        
          $checkRows = count($results);
       
          if($checkRows > 0){
            //  echo $v->name."ada";
           //   $namafiled = superpform::convertHyphensToSpaces($v->label);
              $namafiled = strtolower(str_replace(" ","",$v->label));
              $namafiled2 = str_replace(array("'","?"),"",$namafiled);
              $namafiled3 = str_replace(array("."),"_",$namafiled2);
              $wpdb->update( $table_name_formsetting, array('element_label' => $v->label, 'element_key' => $namafiled3), array('element_name' => $v->name) );
          }
          else{
            // echo $v->name."belum ada";
             // $namafiled = superpform::convertHyphensToSpaces($v->label);
              $namafiled = strtolower(str_replace(" ","",$v->label));
              $namafiled2 = str_replace(array("'","?"),"",$namafiled);
              $namafiled3 = str_replace(array("."),"_",$namafiled2);
              $wpdb->insert($table_name_formsetting, array('post_id' => $post_id,'element_label' => $v->label, 'element_name' => $v->name,'element_key' => $namafiled3));
              
          }
         
         
         
         
         // mulai add kolom
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
         // selesai add kolom
         
     } // end foreach $v
 }
                    
                    // selesai kolom entrie                   
                    
                }
                ?>
                   <div class="col-lg-4 col-md-6">
                    <div class="myform-card">
                      <div class="top"> 
                    <?php
                    if(get_post_status() == "publish"){
                        ?>
                            <a class="form-name" target="_blank" href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a><a class="form-link" target="_blank" href="<?php echo esc_url(get_permalink());?>"> <span><?php echo esc_url(get_permalink());?></span></a>
                        <?php
                    }
                    else{
                        ?>
                          <?php echo esc_html(get_the_title());?>
                       <?php
                    }
                    ?> </div>
                      <div class="bottom">
                          <?php
                          if(get_post_status() == "publish"){
                              ?>
                          <a class="action share" href="?page=Wptegal_form_dashboard&action=share&id=<?php echo get_the_ID();?>"><span>Share</span></a>
                          <a class="action entries" href="?page=Wptegal_form_dashboard&action=entries&id=<?php echo get_the_ID();?>"><span>Entries</span></a>
                                  <?php
                          }
                            else{
                                ?>
                                    <span class="tag">Draft</span>
                                    <?php
                            }
                			?>
                          
                        <div class="dropdown">
                          <div class="action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</div>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                
                          <a class="action edit" href="?page=Wptegal_form_dashboard&action=edit&id=<?php echo get_the_ID();?>">Edit</a>
                                
                           <?php
                          if(get_post_status() == "publish"){
                              ?>      
                          <a class="action duplicate" href="?page=Wptegal_form_dashboard&action=duplicate&id=<?php echo get_the_ID();?>">Duplicate</a> <?php
                          }
                                ?>
                          <a class="action delete" href="#" data-toggle="modal" data-target="#modalDelete" data-idform="<?php echo  get_the_ID(); ?>">Delete</a>
                         <?php // <a href="#" class="card-delete" data-toggle="popover" title="Delete Confirmation" data-content="Are you sure you want to delete this item? Click <a href=\'' . $_SERVER['REQUEST_URI'] . '?action=delete&id=' . get_the_ID() . '\'>here</a> to proceed." data-html="true">Delete</a> ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
                <?php
            }
            wp_reset_postdata();
        } else {
        }
                            ?>
                                
                                
            
                
            
            
            
                </div>
              </div>
            <?php } ?>
        	</div>
 		</div>
		<div class="modal modalDelete" id="modalDelete" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">         
                <h4>Are you sure you want to delete this form?</h4>
                <p>You are about to delete <b>Customer Satisfaction Form (Copy).</b> It'll be gone forever and we won't be able to recover it.</p>
              </div>
              <div class="modal-footer"><a class="btn btn-small btn-white" type="button" data-dismiss="modal">Cancel</a><a class="btn btn-small btn-alert" href="?page=Wptegal_form_dashboard&action=delete&id=777">Yes, delete it</a></div>
            </div>
          </div>
        </div>
        <?php
        $tampilkanpopupdelete = "no";
        if(isset($_SESSION['deletesukses'])){
            if($_SESSION['deletesukses'] == "ok"){
                $tampilkanpopupdelete = "ok";
                $_SESSION['deletesukses'] = "no";
            }
            else{
                $tampilkanpopupdelete = "no";
            }
        }
        else{
            $tampilkanpopupdelete = "no";
        }
        ?>
        
        <?php
        if($tampilkanpopupdelete == "ok"){
            ?>
            <div class="alert alert-secondary alert-dismissible fade show" role="alert"><strong>Your form has been deleted.</strong>
                <p>We’re sorry we wont be able to recover it. </p>
                <div class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
              </div>
              
              <?php
        }
        ?>
        
        
        <?php
        $tampilkanpopupdraft = "no";
        if(isset($_SESSION['notifcreatedraft'])){
            if($_SESSION['notifcreatedraft'] == "ok"){
                $tampilkanpopupdraft = "ok";
                $_SESSION['notifcreatedraft'] = "no";
            }
            else{
                $tampilkanpopupdraft = "no";
            }
        }
        else{
            $tampilkanpopupdraft = "no";
        }
       
        if($tampilkanpopupdraft == "ok"){
             ?>
            <div class="alert alert-secondary alert-dismissible fade show" role="alert"><strong>Your form has been saved as draft.</strong>
                <p>Dont forget to publish your form shortly :). </p>
                <div class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
              </div>
              
              <?php
        }
        ?>
         
    </main>
</div>
</div>
<script src="<?php echo plugin_dir_url(__FILE__) . 'plugins/popper.min.js'; ?>"></script>
<script src="<?php echo plugin_dir_url(__FILE__) . 'plugins/bootstrap.min.js'; ?>"></script>        
<script src="<?php echo plugin_dir_url(__FILE__) . 'bootstrap-select/bootstrap-select.min.js'; ?>"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({
        placement: 'top',
        trigger: 'focus',
        html: true
        });
    });
    $('.header-user').each(function(){
        var t = $(this),
            s = t.find('span');
        s.click(function(){
            t.toggleClass('dd-show');
        })
    })
    $('body').on('click', function(e) {
        // Cek apakah dropdown sedang ditampilkan
        if ($('.header-user').hasClass('dd-show')) {
            var target = $(e.target);

            // Periksa apakah yang diklik adalah dropdown atau turunannya
            if (!target.is('.header-user') && !target.closest('.header-user').length) {
                // Tutup dropdown jika yang diklik bukan bagian dari dropdown
                $('.header-user').removeClass('dd-show');
            }
        }
    });
	$('.myform-card').each(function() {
            var t = $(this),
                title = t.find(".form-name").text(),
                del = t.find('.action.delete');
            del.each(function() {
                var id = $(this).data('idform')
                $(this).on('click', function() {
                    $('#modalDelete').on('show.bs.modal', function(event) {                        
                        var fullUrl = window.location.href;
                        var modal = $(this)                        
                        var baseUrl = fullUrl + "&action=delete&id=";
                        var updatedUrl = baseUrl + id;
                        modal.find('.modal-body p b').text(title)
                        modal.find('.modal-footer .btn-alert').attr('href', updatedUrl)
                    })
                })
            })
        })

</script>