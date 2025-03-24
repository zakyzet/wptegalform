<?php
$post_id = $_GET['id'];



 $args = array(
                                        'post_type' => 'superpform',
                                        'post__in' => array($post_id)
                                    );
global $wpdb;
$table_name_formsetting = $wpdb->base_prefix."_entries_options";
$namafiled = "";
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
          //    $namafiled = superpform::convertHyphensToSpaces($v->label);
              $namafiled = str_replace(" ","",$v->label);
              $namafiled2 = str_replace(array("'","?"),"",$namafiled);
              $namafiled3 = str_replace(array("."),"_",$namafiled2);
              
              $wpdb->update( $table_name_formsetting, array('element_label' => $v->label, 'element_key' => $namafiled3), array('element_name' => $v->name) );
          }
          else{
            // echo $v->name."belum ada";
             // $namafiled = superpform::convertHyphensToSpaces($v->label);
           //   $namafiled = str_replace(array( '\'', '"',',' , ';', '<', '>',' '),"",$v->label);
               $namafiled = str_replace(" ","",$v->label);
              $namafiled2 = str_replace(array("'","?"),"",$namafiled);
              $namafiled3 = str_replace(array("."),"_",$namafiled2);
              $wpdb->insert($table_name_formsetting, array('post_id' => $post_id,'element_label' => $v->label, 'element_name' => $v->name,'element_key' => $namafiled3));
              
          }
         
     }
 }





            // Get the author ID of the post
            $post_author_id = get_post_field('post_author', $post_id);
            $post_title = get_the_title($post_id);
            $post_slug = get_post_field('post_name', $post_id);
            $whatsapp = get_post_meta($post_id, 'whatsapp', true);
			$spreadsheet_id = get_post_meta($post_id, 'spreadsheet_id', true); 
            
            // Check if the post belongs to the logged-in user
            if ($post_author_id == get_current_user_id()) { 
            ?>
            <?php
            /**
                <div class="container">
    			<div class="box-wrap">
    				<div class="box-title">
    					<h1>Share</h1>
    				</div>
    				<div class="content">
							<div class="share-content">
								<aside class="share-menu">
									<div class="share-menu-item">
										<a href="#">
											<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-hiddenfield.svg">
											<span>Link</span>
										</a>
									</div>
									<div class="share-menu-item">
										<a href="#">
											<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-hiddenfield.svg">
											<span>Social Media</span>
										</a>
									</div>
									<div class="share-menu-item">
										<a href="#">
											<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-hiddenfield.svg">
											<span>WhatsApp</span>
										</a>
									</div>
									<div class="share-menu-item">
										<a href="#">
											<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-hiddenfield.svg">
											<span>iFrame Embed</span>
										</a>
									</div>
									<div class="share-menu-item">
										<a href="#">
											<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-hiddenfield.svg">
											<span>QR Code</span>
										</a>
									</div>
								</aside>
								<div class="share-option">
									<section>
										<h2 class="section-title">Share as link</h2>
										<div class="section-description">
											<p>Start using by copying the web address below.</p>
										</div>
										<div class="form-group copylink w-50">
											<input class="form-control" type="text" name="copylink" value="https://form.superp.app/form/-e8tnR">
											<button type="button">Copy</button>
										</div>
									</section>
									<section>
										<h2 class="section-title">Share on Social Media</h2>
										<div class="section-description">
											<p>Start using by sharing it accross social media</p>
										</div>
										<div class="share-socmed">
											<a href="#">
												<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-twitter.svg">
											</a>
											<a href="#">
												<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-facebook.svg">
											</a>
											<a href="#">
												<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-linkedin.svg">
											</a>
										</div>
									</section>
									<section>
										<h2 class="section-title">Add as your WhatsApp Message</h2>
										<div class="section-description">
											<p>Start using by sharing it aa your custom message in WhatsApp</p>
										</div>
										<div class="share-wamessage grid">
											<div class="card card-wamessage">
										    <div class="top">
										      <article>
										      	<p>Thank you for your message 🙏</p>
										      	<p>Please fill 👉 form.superp.app/form/-e8tnR to share your requirements. One of our team members will assist you shortly.</p>
										      </article>
										    </div>
										    <div class="bottom waShare">
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-wa-circle.svg">
										      </a>
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-copy.svg">
										      </a>
										    </div>
										  </div>
										  <div class="card card-wamessage">
										    <div class="top">
										      <article>
										      	<p>Welcome to yourBusinessName. <br>Our team is currently assisting another customer. Meanwhile, *please fill 👉👉 form.superp.app/form/-e8tnR* to share your details. <br>Thank you</p>
										      </article>
										    </div>
										    <div class="bottom waShare">
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-wa-circle.svg">
										      </a>
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-copy.svg">
										      </a>
										    </div>
										  </div>
										  <div class="card card-wamessage">
										    <div class="top">
										      <article>
										      	<p>Thank you for your message 🙏</p>
										      	<p>Please fill 👉 form.superp.app/form/-e8tnR to share your requirements. One of our team members will assist you shortly.</p>
										      </article>
										    </div>
										    <div class="bottom waShare">
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-wa-circle.svg">
										      </a>
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-copy.svg">
										      </a>
										    </div>
										  </div>
										  <div class="card card-wamessage">
										    <div class="top">
										      <article>
										      	<p>Welcome to yourBusinessName. <br>Our team is currently assisting another customer. Meanwhile, *please fill 👉👉 form.superp.app/form/-e8tnR* to share your details. <br>Thank you</p>
										      </article>
										    </div>
										    <div class="bottom waShare">
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-wa-circle.svg">
										      </a>
										      <a href="#">
										      	<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/ic-share-copy.svg">
										      </a>
										    </div>
										  </div>
										</div>
									</section>
									<section>
										<h2 class="section-title">Embed inside a webpage</h2>
										<div class="section-description">
											<p>Copy the code snippet below and paste it in the webpage, where you want to embed your WhatsForm.</p>
										</div>
										<div class="form-group copylink">
											<input class="form-control" type="text" name="copylink" value='<iframe src="https://form.superp.app/form/-e8tnR"  width="100%" height="600" frameBorder="0"></iframe>'>
											<button type="button">Copy</button>
										</div>
									</section>
									<section>
										<h2 class="section-title">QR Code</h2>
										<div class="section-description">
											<p>Place this QR code on your store front, to get more enquiries on WhatsApp</p>
										</div>
										<div class="boxqr">
											<img src="<?php echo plugin_dir_url(__FILE__); ?>assets/img-QR-code.png">
										</div>
									</section>
								</div>
							</div>
    				</div>
    			</div>
    		</div>
    		**/
    		?>
             
            
            
            
            
            
           	<div class="dashboard-container myforms form-publish">
                <div class="share-form">
                  <h1>Share <?php echo esc_html($post_title); ?></h1>
                  <div class="share-link">
                    <h3>Share as link</h3>
                    <p>Your form is now published and ready to be shared with the everyone! Copy this link to share your form on social media, messaging apps or via email.</p>
                    <div class="input-group copylink">
                      <input class="form-control" type="text" name="copylink" value="<?php echo esc_url(home_url('form/') . $post_slug); ?>" disabled="disabled">
                      <div class="input-group-append">
                        <button type="button" class="btn btn-small btn-primary" onclick="copyToClipboard(this)">Copy</button>
                      </div>
                    </div>
                  </div>
                       
                         <script>
                                        function copyToClipboard(button) {
                                            // Get the input element associated with the clicked button
                                            var inputElement = button.parentNode.parentNode.querySelector('input');
                                            console.log(inputElement)

                                            // Create a temporary textarea element to hold the text to be copied
                                            var tempTextarea = document.createElement('textarea');
                                            tempTextarea.value = inputElement.value;

                                            // Append the textarea to the document
                                            document.body.appendChild(tempTextarea);

                                            // Select the text in the textarea
                                            tempTextarea.select();

                                            // Copy the selected text to the clipboard
                                            document.execCommand('copy');

                                            // Remove the temporary textarea
                                            document.body.removeChild(tempTextarea);

                                            // Update the button text to "Copied"
                                            button.innerText = 'Copied';

                                            // Reset the button text after a short delay
                                            setTimeout(function() {
                                                button.innerText = 'Copy';
                                            }, 2000); // Reset after 2 seconds (adjust the delay as needed)
                                        }
                                        </script>
                      
                  <div class="share-embed">
                    <h3>Embed inside a webpage</h3>
                    <p>Copy the code snippet below and paste it in the webpage, where you want to embed your HayForm</p>
                    <div class="form-group copyiframe">
                      <input class="form-control" type="text" value='<iframe src="<?php echo esc_url(home_url('form/') . $post_slug); ?>"  width="100%" height="600" frameBorder="0"></iframe>'>
                    </div>
                    <p id="result"></p>
                  </div>
                </div>
                <div class="form-action">
                    <?php
                    $showaction = "no";
                    if(isset($_SESSION['daricreateform'])){
                        
                        if($_SESSION['daricreateform'] == "ok"){
                            $showaction = "ok";
                            $_SESSION['daricreateform'] = "no";
                        }
                        else{
                            $showaction = "no";
                        }
                    }
                    else{
                        $showaction = "no";
                    }
                  
                    ?>
                    
                    <?php if($showaction == "ok"){
                        ?>
                        <ul class="positions">
                    <li class="passed"><span class="number">1</span><span>Create Form</span></li>
                    <li class="passed"><span class="number">2</span><span>Configuration</span></li>
                    <li class="current"> <span class="number">3</span><span>Publsihed</span></li>
                  </ul>
                  <?php
                    }
                    ?>
                  
                  <div class="buttons"><a class="btn btn-small btn-primary" href="?page=highfive_form_dashboard">Back to dashboard </a></div>
                </div>
              </div>
                                        
                                        
            <?php                          
            }
            ?>