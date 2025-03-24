<?php 
global $wpdb;
if($_GET['action'] === 'entries'){
               $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                //start entries
                $idpost = $_GET['id'];
                $table_name = $wpdb->base_prefix."_entries_".strtolower(str_replace(" ","_",$idpost));
                $namatable = $wpdb->base_prefix."_entries_".strtolower(str_replace(" ","_",$idpost));
                $tabelseting="hfj_table_setting";
    			$table_name_formsetting = $wpdb->base_prefix."_entries_options";
                
    
    $args = array(
                                        'post_type' => 'superpform',
                                        'post__in' => array($idpost)
                                    );
    
    $cols_sql = "DESCRIBE $table_name";
$all_objects = $wpdb->get_results( $cols_sql );
$urutkolom = "0";

foreach($all_objects as $obtablesetting){
    $_SESSION[$obtablesetting->Field] = "0";
}
    
    
    
  
                    function dapatkan_data_entries() {
                      global $wpdb;
                      $results1 = $wpdb->get_results("SELECT * FROM $namatable order by id DESC");
                      return $results1;
                    }
                
                $iddelete = "";
                if(isset($_POST['delrow'])){
                    $iddelete = $_POST['delrow'];
                    foreach ($iddelete as $idnya){
                       $wpdb->delete( $namatable, array( 'id' => $idnya ) );
                    }
                }
                
                $idts = "";
                $soh = "";
                $aliasts = "";
                
                if(isset($_POST['savets'])){
                     $idts = $_POST['idrowts'];
                    $soh = $_POST['soh'];
                    $aliasts = $_POST['aliasts'];
                    $wpdb->update($tabelseting, array('show_or_hide'=>$soh, 'alias'=>$aliasts), array('id'=>$idts));
                }
                ?>
                    <style>
  .buttons-csv {
      	background-color:#db5925;
   		margin-left:10px;
      	margin-top:10px;
   		height:40px;
    	padding-top:2px;
    	padding-left:8px;
   		padding-right:8px;
   		padding-bottom:8px;
   		color:white;
      	text-decoration: none;
     }
.buttons-csv:hover {
    	background-color:#8f3410;
   		color:white;
     	text-decoration: none;
       }
.buttons-pdf {
    	background-color:#db5925;
   		margin-left:10px;
      	margin-top:10px;
   		height:40px;
    	width:200px;
    	padding-top:2px;
    	padding-left:8px;
   		padding-right:8px;
   		padding-bottom:8px;
   		color:white;
    	text-decoration: none;
     }
.buttons-pdf:hover {
    	background-color:#8f3410;
   		color:white;
     	text-decoration: none;
       }
.buttons-print {
      	background-color:#db5925;
   		margin-left:10px;
      	margin-top:10px;
   		height:40px;
    	padding-top:2px;
    	padding-left:8px;
   		padding-right:8px;
   		padding-bottom:8px;
   		color:white;
    	text-decoration: none;
     }
.buttons-print:hover {
    	background-color:#8f3410;
   		color:white;
     	text-decoration: none;
       }
.buttons-excel {
       	background-color:#db5925;
   		margin-left:10px;
      	margin-top:10px;
   		height:40px;
    	padding-top:2px;
    	padding-left:8px;
   		padding-right:8px;
   		padding-bottom:8px;
   		color:white;
    	text-decoration: none;
       }
.buttons-excel:hover {
    	background-color:#8f3410;
   		color:white;
     	text-decoration: none;
       }
 .buttons-copy {
    	background-color:#db5925;
   		margin-left:10px;
      	margin-top:10px;
   		height:40px;
    	padding-top:2px;
    	padding-left:8px;
   		padding-right:8px;
   		padding-bottom:8px;
   		color:white;
     	text-decoration: none;
       }
.buttons-copy:hover {
    	background-color:#8f3410;
   		color:white;
     	text-decoration: none;
       }
.finput[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.finput[type=email], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.finput[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.finput[type=submit]:hover {
  background-color: #45a049;
}

.fdiv {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.ftextarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}
.fselect {
  width: 100%;
  padding: 16px 20px;
  border: none;
  border-radius: 4px;
  background-color: #f1f1f1;
}
.bsubmit {
  background-color: #0e7182; 
  color: white; 
    cursor: pointer;
    height:40px;
    width:80px;
}

.bsubmit:hover {
  background-color: #2aa3b8;
  color: white;
    cursor: pointer;
}
  .suksesalert {
  padding: 20px;
  background-color: #84e0c2;
  color: #1c664e;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

                
                /* The Modal (background) */
.tsmodal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.tsmodal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
                
                
</style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
	<style type="text/css" class="init">
	
div.dt-button-collection {
	width: 400px;
}

div.dt-button-collection button.dt-button {
	display: inline-block;
	width: 32%;
}
div.dt-button-collection button.buttons-colvis {
	display: inline-block;
	width: 49%;
}
div.dt-button-collection h3 {
	margin-top: 5px;
	margin-bottom: 5px;
	font-weight: 100;
	border-bottom: 1px solid rgba(150, 150, 150, 0.5);
	font-size: 1em;
	padding: 0 1em;
}
div.dt-button-collection h3.not-top-heading {
	margin-top: 10px;
}

	</style>
     <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> 
             <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
     <?php
        $fulldate="";
                $datenya="";
                $timenya="";
    $namaform = get_the_title($idpost);
    ?>
    
     <div class="dashboard-container entries">
                <div class="dashboard-heading">
                  <div class="breadcrumbs"><a href="?page=highfive_form_dashboard">My Forms</a><span>Entries: <?php echo get_the_title($idpost);?> </span></div>
                  <h1>Entries: <?php echo get_the_title($idpost);?></h1><a class="backto" href="?page=highfive_form_dashboard">Back to dashboard</a>
                </div>
                <div class="dashboard-filter">
                  <div class="row justify-content-between">
                    <div class="col-lg-3 left">
                      <div class="form-group search">
                        <input class="form-control" type="text" placeholder="Search responses"/>
                      </div>
                    </div>
                    <div class="col-lg-6 right"><a class="btn btn-small btn-white" id="exprtExcel" href="javascript:void(0);"><img class="icon" src="<?php echo plugin_dir_url(__FILE__) . 'images/ic-download.png'; ?>"/><span>Export as Excel</span></a><a class="btn btn-small btn-white" id="exprtCsv"  href="javascript:void(0);"><img class="icon" src="<?php echo plugin_dir_url(__FILE__) . 'images/ic-download.png'; ?>"/><span>Export as CSV</span></a></div>
                  </div>
                </div>
                <div class="dashboard-table">
                    
                    
                   <form method="post" action="<?php echo $actual_link;?>" id="form-delete"> 
                           
                           <a class="btn btn-small btn-white" type="button" id="btn-delete">DELETE</a>
                     <table id="myTable"  class="display table">
                                <thead>
                                     <tr>
                      <th>
                      	<div class="custom-control custom-checkbox">
                      		<input class="custom-control-input" type="checkbox" id="check-all">
                            <!-- input class="custom-control-input" type="checkbox" id="checkAll" -->
                            <label class="custom-control-label" for="check-all"></label>
                         </div>
                      </th>
                                      
    <?php
    $cols_sql = "DESCRIBE $namatable";
$all_objects = $wpdb->get_results( $cols_sql );
$urutkolom = "0";

foreach($all_objects as $obtablesetting){
    
    $urutkolom++;
    $datainsertts = array(
        'id' => '',
        'post_id' => $idpost,
        'nama_form' =>$namaform,
        'nama_kolom'=>$obtablesetting->Field,
        'show_or_hide'=>'1',
        'alias'=> '',
        'urut_kolom'=>$urutkolom
    );
    
    $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $idpost AND urut_kolom=$urutkolom");
    if($resultts){
        
    }
    else{
        $wpdb->insert($tabelseting,$datainsertts);
    }

}
                
foreach($all_objects as $objct){
    
    
    if($objct->Field != "id"){
        if($objct->Field != "post_id"){
            if($objct->Field != "whatsapp"){
                if($objct->Field != "form_name"){
                        $formnamenya = $objct->Field;
                         $resultts = $wpdb->get_results("SELECT * FROM  $table_name_formsetting WHERE post_id = $idpost AND element_name ='$formnamenya'");
                        if($resultts){
                			foreach($resultts as $rts){
                                ?>
                                        <th><?php echo ucfirst($rts->element_label);?></th>
                                    <?php
                                            
                                
                            }
                        }
                        else{
                            if($objct->Field == "date"){
                            ?>
                            <th><?php echo ucfirst($objct->Field);?></th>
                            <?php
                            }
                        }
                }
            }
            
        }
    
    }
    
    
}
?>
                                        
                                      
                                    </tr>
                                </thead>

                                <tbody>
                           <?php
   $resultsf = $wpdb->get_results("SELECT * FROM $namatable order by id DESC");
                               $noUrutt = "0";
                               foreach ($resultsf as $prop) {
                                $noUrutt++;
								?>
                                     <tr>
                                   <td> 
                                       <div class="custom-control custom-checkbox">
                                        <!-- input class="custom-control-input" type="checkbox" id="check-all" -->
                                    	<input type='checkbox' class='check-item custom-control-input' name='delrow[]' value='<?php echo $prop->id;?>' id='<?php echo $prop->id;?>'>
                                        <label class="custom-control-label" for='<?php echo $prop->id;?>'></label>
                                     </div>
                                    
                                    
                                    </td>
                                      
                                         
                                      <?php
                                        $cols_sql = "DESCRIBE $namatable";
                                        $all_objects = $wpdb->get_results( $cols_sql );
                                        $urutkolom = "0";
                                   
                                   foreach($all_objects as $objct){
    
    
                                        if($objct->Field != "id"){
                                            if($objct->Field != "post_id"){
                                                if($objct->Field != "whatsapp"){
                                                    if($objct->Field != "form_name"){
                                                        $fieldnamenya = $objct->Field;
                                                        ?>
                                                         <td> <?php echo  $prop->$fieldnamenya;?></td>
                                                             <?php
                                                          

                                                    }
                                                }

                                            }

                                        }
    
    
}
                                   
                                   
                                   
                                   ?>
                                       
                                    </tr>
                                    <?php
                                }
    					?>
                       
                       
                                    
                                  

                                    </tbody>
                                    <!-- tfoot>
                                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                                         
                                        <?php
    									$cols_sql = "DESCRIBE $namatable";
$all_objects = $wpdb->get_results( $cols_sql );
foreach($all_objects as $objct){
    if($objct->Field != "id"){
         if($objct->Field != "post_id"){
              if($objct->Field != "whatsapp"){
                  if($objct->Field != "form_name"){
                    	$formnamenya = $objct->Field;
                         $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $idpost AND nama_kolom ='$formnamenya'");
                        if($resultts){
                			foreach($resultts as $rts){
                                if($rts->show_or_hide == "1"){
                                    if($rts->alias != ""){
                                         ?>
                                        <th><?php echo ucfirst($rts->alias);?></th>
                                        <?php
                                    }
                                    else{
                                         ?>
                                        <th><?php 
                                             echo ucfirst($objct->Field);
                                            ?></th>
                                        <?php
                                    }
                                }
                                else{
                                    
                                }
                            }
                        }
                        else{
                            ?>
                            <th><?php echo ucfirst($objct->Field);?></th>
                            <?php
                        }
                  }
              }
         }
    }
}
?>
                                    </tr>
                                    </tfoot -->



            </table>
          
    
                    </form>
                  
                  
                </div>
    			<div class="action-group">
                  <div class="selected-item"> <span id="checkedCount">3</span>&nbsp;<span>entries selected</span></div>
                  <div class="right"><a class="btn btn-small btn-white exprtExcl" href="javascript:void(0);"><img class="icon" src="<?php echo plugin_dir_url(__FILE__) . 'images/ic-download.png'; ?>"><span>Export as Excel</span></a><a class="btn btn-small btn-white exprtCSV" href="javascript:void(0);"><img class="icon" src="<?php echo plugin_dir_url(__FILE__) . 'images/ic-download.png'; ?>" ><span>Export as CSV</span></a><a class="btn btn-small btn-white btn-delete bulk-del" href="javascript:void(0);"><img class="icon" src="<?php echo plugin_dir_url(__FILE__) . 'images/ic-form-delete.svg'; ?>"><span>Delete</span></a></div>
                </div>
              </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php
    /**
    
    
                  <div class="box-wrap dashboard-parent">
                <div class="box-title">
   
                    <h1><a href="<?php echo esc_url(home_url('dashboard/')); ?>" class="back-editor back-dashboard btn-link"></a>Entries Form: <?php echo get_the_title($idpost);?></h1>
                    <!-- a class="btn btn-primary" href="#">New form</a -->
                         
                         
                </div>
                           <div class="box-title hidden">
                        <button class="btn btn-primary hidden" id="myBtn" >Table Setting</button>
                         </div>
                <div class="content entries" id="fb-container">
                    <div class="dashboard tableEntries">
                        <div class="grid">
                        
                           <form method="post" action="<?php echo $actual_link;?>" id="form-delete"> 
                           <div class="tabler-wrapper">
                           <a class="btn-link-delete" type="button" id="btn-delete">DELETE</a>
                     <table id="myTable"  class="display">
                                <thead>
                                     <tr>
                        <th><input type="checkbox" id="check-all"></th>
                                      
    <?php
    $cols_sql = "DESCRIBE $namatable";
$all_objects = $wpdb->get_results( $cols_sql );
$urutkolom = "0";

foreach($all_objects as $obtablesetting){
    
    $urutkolom++;
    $datainsertts = array(
        'id' => '',
        'post_id' => $idpost,
        'nama_form' =>$namaform,
        'nama_kolom'=>$obtablesetting->Field,
        'show_or_hide'=>'1',
        'alias'=> '',
        'urut_kolom'=>$urutkolom
    );
    
    $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $idpost AND urut_kolom=$urutkolom");
    if($resultts){
        
    }
    else{
        $wpdb->insert($tabelseting,$datainsertts);
    }

}
                
foreach($all_objects as $objct){
    
    
    if($objct->Field != "id"){
        if($objct->Field != "post_id"){
            if($objct->Field != "whatsapp"){
                if($objct->Field != "form_name"){
                        $formnamenya = $objct->Field;
                         $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $idpost AND nama_kolom ='$formnamenya'");
                        if($resultts){
                			foreach($resultts as $rts){
                                if($rts->show_or_hide == "1"){
                                    if($rts->alias != ""){
                                         ?>
                                        <th><?php echo ucfirst($rts->alias);?></th>
                                        <?php
                                    }
                                    else{
                                         
                                         ?>
                                        <th><?php 
                                            echo ucfirst($objct->Field);
                                        
                                        ?></th>
                                        <?php
                                    }
                                }
                                else{
                                    
                                }
                            }
                        }
                        else{
                            ?>
                            <th><?php echo ucfirst($objct->Field);?></th>
                            <?php
                        }
                }
            }
            
        }
    
    }
    
    
}
?>
                                        
                                      
                                    </tr>
                                </thead>

                                <tbody>
                           <?php
   $resultsf = $wpdb->get_results("SELECT * FROM $namatable order by id DESC");
                               $noUrutt = "0";
                               foreach ($resultsf as $prop) {
                                $noUrutt++;
								?>
                                     <tr>
                                   <td> <input type='checkbox' class='check-item' name='delrow[]' value='<?php echo $prop->id;?>'></td>
                                       
                                            <?php
                                            $cols_sql = "DESCRIBE $namatable";
                                            $all_objects = $wpdb->get_results( $cols_sql );
                                            foreach($all_objects as $objct){
                                                if($objct->Field != "id"){
                                                    if($objct->Field != "post_id"){
                                                        if($objct->Field != "whatsapp"){
                                                            if($objct->Field != "form_name"){
                                                                $formnamenya = $objct->Field;
                     										    $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $idpost AND nama_kolom ='$formnamenya'");
                                                                if($resultts){
                                                                    foreach($resultts as $rts){
                                                                        if($rts->show_or_hide == "1"){
                                                                           $objnya = $objct->Field;
                                                                            if($objnya == "date"){
                                                                                $fulldate= $prop->$objnya;
                                                                                $datenya = date('j M Y', strtotime($fulldate));
                                                                                $timenya = date('H:i', strtotime($fulldate));
                                                                                ?>
                                                                                <td><?php echo $datenya; ?>, <?php echo $timenya; ?></td>
                                                                                <?php
                                                                            }
                                                                            else{
                                                                            
                                                                            ?>
                                                                                <td><?php echo $prop->$objnya;?></td>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        else{
            																
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    
                                                                }
                                                            }
                                                        }
                                                    }
                                                } //end if not id
                                            }
                                            ?>
                                         
                                       
                                    </tr>
                                    <?php
                                }
    					?>
                       
                       
                                    
                                  

                                    </tbody>
                                    <tfoot>
                                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                                         
                                        <?php
    									$cols_sql = "DESCRIBE $namatable";
$all_objects = $wpdb->get_results( $cols_sql );
foreach($all_objects as $objct){
    if($objct->Field != "id"){
         if($objct->Field != "post_id"){
              if($objct->Field != "whatsapp"){
                  if($objct->Field != "form_name"){
                    	$formnamenya = $objct->Field;
                         $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $idpost AND nama_kolom ='$formnamenya'");
                        if($resultts){
                			foreach($resultts as $rts){
                                if($rts->show_or_hide == "1"){
                                    if($rts->alias != ""){
                                         ?>
                                        <th><?php echo ucfirst($rts->alias);?></th>
                                        <?php
                                    }
                                    else{
                                         ?>
                                        <th><?php 
                                             echo ucfirst($objct->Field);
                                            ?></th>
                                        <?php
                                    }
                                }
                                else{
                                    
                                }
                            }
                        }
                        else{
                            ?>
                            <th><?php echo ucfirst($objct->Field);?></th>
                            <?php
                        }
                  }
              }
         }
    }
}
?>
                                    </tr>
                                    </tfoot>



            </table>
            </div>
    
                    </form>
                    
                    
                    
                        </div>
                    </div>
                </div>
            </div>
              **/
              ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.js"</script>
    
        <!-- js untuk bootstrap4  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
                        
  
    
    



<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
 
   
    <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    /*$("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });*/
      
    function updateCheckedCount() {
        var checkedItems = $(".check-item:checked").length;  // Hitung jumlah item yang dicentang
        $("#checkedCount").text(checkedItems);
        if (checkedItems > 0) {
          $('.action-group').addClass('show');
        } else {
          $('.action-group').removeClass('show');
        }
    }
      
    // Event listener untuk 'check all'
    $("#check-all").click(function() {
        // Cek apakah 'checkAll' dicentang atau tidak
        $(".check-item").prop('checked', $(this).prop('checked'));
        updateCheckedCount();  // Perbarui hitungan ketika semua item dicentang atau dibatalkan 
        //- $('.action-group').toggleClass('show');
    });

    // Event listener untuk setiap item
    $(".check-item").click(function() {
        // Cek apakah semua checkbox sudah dicentang
        if ($(".check-item:checked").length == $(".checkItem").length) {
            $("#check-all").prop('checked', true);
        } else {
            $("#check-all").prop('checked', false);
        }
        updateCheckedCount();  // Perbarui hitungan ketika ada perubahan pada checkbox individual
    });

    // Panggil fungsi untuk pertama kali saat halaman dimuat, jika ada checkbox yang sudah dicentang
    updateCheckedCount();
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
      
      var confirm = window.confirm("Are you sure want to delete this row?"); // Buat sebuah alert konfirmasi
      
    if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-delete").submit(); // Submit form
   });
      
      // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
// btn.onclick = function() {
  // modal.style.display = "block";
//}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
  });
                
                
                


  </script>
    

        <script>
    var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[4] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
            $(document).ready(function () {
                   
                // Create date inputs
                    minDate = new DateTime($('#min'), {
                        format: 'MMMM Do YYYY'
                    });
                    maxDate = new DateTime($('#max'), {
                        format: 'MMMM Do YYYY'
                    });

                     var table =  $('#myTable').DataTable( {
                            paging: true,
                         	ordering: true,
      						info: false,
                         	columnDefs: [
                         		{ "orderable": false, "targets": 0 }
                     		],
                            dom: 'Bfrtip',
                            buttons: [
                                { extend: 'csv', className: 'btn btn-small btn-white', text: 'Export as CSV' },
                                { extend: 'excel', className: 'btn btn-small btn-white', text: 'Export as Excel'}
                                   
                               //  ['csv', 'excel']
                              
                            ],
                            initComplete: function () {
                            $('.buttons-pdf').html('Pdf')
                            },
                            pageLength: 25,
                            lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
                         	language: {
                                'emptyTable': '<div class="table-empty"><img class="tableempty-ilus" src="<?php echo plugin_dir_url(__FILE__) . "images/data-blank-ilus.png"; ?>"><div class="text text-center"><strong>You have no entries yet</strong>                          <p>We recommend you to share your form to get more entries.</p><a class="btn btn-small btn-primary" href="<?php echo esc_url("?page=highfive_form_dashboard&action=share&id=").$_GET['id']; ?>">Share your form</a></div></div>'
                            }
                        } );
                	$('.dashboard-filter').each(function() {
                        var t = $(this),
                            xcl = t.find('#exprtExcel'),  // Ubah dari #exprtExcel ke .exprtExcel
                            csv = t.find('#exprtCsv'),
                        	exprtXcl = t.find('.exprtExcl'),
                        	exprtCsv = t.find('.exprtCsv'),
                        	bulkDel = t.find('.bulk-del');// Ubah dari #exprtCsv ke .exprtCsv

                        xcl.on('click', function() {
                            $('body').find('.buttons-excel').trigger('click');
                        });
                        exprtXcl.on('click', function() {
                            $('body').find('.buttons-excel').trigger('click');
                        });

                        csv.on('click', function() {
                            $('body').find('.buttons-csv').trigger('click');
                        });
                        exprtCsv.on('click', function() {
                            $('body').find('.buttons-csv').trigger('click');
                        });
                        bulkDel.on('click', function(){	
                            $('body').find('#btn-delete').trigger('click');
                            alert('a')
                        });
                    });
                
                	$('.entries').each(function() {
                        var t = $(this),
                        	exprtXcl = t.find('.exprtExcl'),
                        	exprtCsv = t.find('.exprtCsv'),
                        	bulkDel = t.find('.bulk-del');// Ubah dari #exprtCsv ke .exprtCsv

                        exprtXcl.on('click', function() {
                            $('body').find('.buttons-excel').trigger('click');
                        });

                        exprtCsv.on('click', function() {
                            $('body').find('.buttons-csv').trigger('click');
                        });
                        bulkDel.on('click', function(){	
                            $('body').find('#btn-delete').trigger('click');
                        });
                    });
                
                	$('.dashboard-filter .search input').on('keyup', function() {
                        if(this.value != ''){
                        	table.search(this.value).draw(); // Mengirim input pencarian ke DataTables
                        }else{
                        	table.search('').draw();
                        }
                        
                    });
                   
                    // Refilter the table
                    /**
                    $('#min, #max').on('change', function () {
                        table.draw();
                    });
                    
                    var dd = $('body').find('.entries .dt-buttons');
                    dd.each(function(){
                        var t = $(this),
                          a = t.find('.dt-button'),
                          textDiv =  "Action";
                          modifiedText = textDiv.replace('(', '&nbsp;(');
                          select = $('<div class="dropdown-menu">'),
                          toggle = $("<button class='btn btn-border btn-block dropdown-toggle btn-white' data-toggle='dropdown'>"+modifiedText+"</button>"),
                          st = $("<div class='dropdown dropdown-nav'/>");
                        a.each(function(){
                          var c = $(this).clone(),
                              anchor = $(this).attr('href'),
                              textDiv =  c.text();
                              modifiedText = textDiv.replace('(', '&nbsp;(');
                              $isi = $('<div data-anchor=' + anchor + '>'+modifiedText+'</div>');
                          $isi.addClass('dropdown-nav-item')
                          select.append($isi)

                          $isi.on('click',function(e){
                            var clickedText = e.target.innerText;
                            var matchingAnchor = t.find('.dt-button:contains(' + clickedText + ')');
                            console.log(matchingAnchor);
                           	matchingAnchor.trigger('click');

                            toggle.text(e.target.innerText)
                          })
                      })
                      st.append(toggle);
                      st.append(select);
                      st.insertAfter(t);
                    })
                    **/
            });
			
        </script>
            
        <div id="myModal" class="tsmodal">

  <!-- Modal content -->
  <div class="tsmodal-content">
    <span class="close">&times;</span>
   <h2>Table Setting</h2>
   
        <table class="table">
        <tr>
        <th>Coloumn Name</th>
        <th>Alias</th>
        <th>Show Or Hide</th>
        <th>Action</th>
        </tr>
         <?php
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $resultts = $wpdb->get_results("SELECT * FROM  $tabelseting WHERE post_id = $idpost ORDER BY urut_kolom ASC");
    if($resultts){
        foreach($resultts as $dts){
            ?>
                <form method="post" action="<?php echo $actual_link;?>">
                <tr>
                <td><?php   echo $dts->nama_kolom;?></td>
                    <td>
                    <input type="hidden" value="<?php echo $dts->id;?>" name="idrowts">
                    <input type="text" value="<?php echo $dts->alias;?>" name="aliasts">
                   </td>
                         <td>
                        <select name="soh">
                        <?php 
                        if($dts->show_or_hide == "1"){
                            ?>
                                <option selected="selected" value="1">Show</option>
                                <option  value="0">Hide</option>
                                <?php
                        }
                            else{
                                ?>
                                    <option selected="selected" value="0">Hide</option>
                                <option  value="1">Show</option>
                                    <?php
                            }
            ?>
                        </select>
                        
                            </td>
                            <td><button class="btn btn-primary" type="submit" name="savets">Save</button></td>
                            </form>
                </tr>
                <?php
           
        }
    }
    

        ?>

        
        </table>
     </div>

</div>
                    <?php
                //end entries
            }
            else{
            echo 'No Form ID is Detected';
            }
            ?>