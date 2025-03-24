
<div class="dashboard-container myforms">     			
                <div class="form-editor row" id="fb-editor">
                  <div class="col-md-8 box-drag">
                    <div class="theform" id="my-drop-area">             
                      <div class="theform-header">
                        <div class="breadcrumbs"><a href="?page=highfive_form_dashboard">My Forms</a><span>New Form</span></div>
                        <div class="tag">Draft </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 box-elements">
                    <div class="form-wrap form-builder">
                      <h3>Form Elements</h3>
                      <div id="custom-control-list"></div>
                    </div>
                    <div id="formEditing"></div>
                  </div>
                </div>
                <div class="form-editor row" id="fb-preview">
                  <div class="col-md-8 box-drag">
                    <div class="theform" id="my-drop-area">             
                      <div class="theform-header">
                        <div class="breadcrumbs"><a href="?page=highfive_form_dashboard">My Forms</a><span>New Form</span></div>
                        <div class="tag">Draft </div>                       
                      </div>
     					
                      <form id="preview" class="left-side" style=""></form>
                    </div>
                  </div>
                  <div class="col-md-4 box-elements">
                    <div class="form-wrap form-builder">
                      <h3>Form Configuration</h3>
                      <form id="submission" class="right-side form" method="post" action="">
                            <?php wp_nonce_field('form_submission_nonce', 'form_submission_nonce'); ?>
                            <div class="form-group">
                                <label for="form_title">Form Name</label>
                                <input type="text" name="form_title" class="form-control" id="form_title" required>
                               <input type="hidden" name="form_statuscek" class="form-control" id="form_statuscek" value="publish">
                            </div>
                            <div class="form-group">
                                <label for="form_slug">Form Link</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    	<span class="input-group-text">hayform.com/form/</span>
                                    </div>
                                    <input type="text" class="form-control" id="form_slug" value="<?php echo $random_slug; ?>" disabled>
                                </div>
                            </div>
                                    <?php /**
                            <div class="form-group">
                                <label for="wa_number">WhatsApp Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                    </div>
                                    <input type="tel" name="wa_number" class="form-control" id="wa_number" required>
                                </div>
                            </div>
                            **/ ?>
                            <div class="form-group">
                                <label for="wa_number">Email</label>
                                <input type="email" name="email_receiver" class="form-control" id="email_receiver" required>
                            </div>
                           
                            
                            <input type="hidden" name="form_content" id="form_content">
                            <input type="hidden" name="form_slug" value="<?php echo $random_slug; ?>">
                            <div class="fb-submission-action" id="fb-submission-action">
                                <a class="btn btn-white" style="display:none;" href="?page=highfive_form_dashboard">Cancel</a>
                                <button type="submit" id="btnstep2" style="display:none;" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        
                    </div>
                    <div id="formEditing">
                         
                    </div>
                  </div>
                </div>
                                    
                <div class="share-form" id="form-submission">
                  <h1>Share Customer Satisfaction Form</h1>
                  <div class="share-link">
                    <h3>Share as link</h3>
                    <p>Your form is now published and ready to be shared with the everyone! Copy this link to share your form on social media, messaging apps or via email.</p>
                    <div class="input-group">
                      <input class="form-control" type="text" value="https://hayform.com/form/La88e" disabled="disabled"/>
                      <div class="input-group-append">
                        <button class="btn btn-small btn-primary">Copy</button>
                      </div>
                    </div>
                  </div>
                  <div class="share-embed">
                    <h3>Embed inside a webpage</h3>
                    <p>Copy the code snippet below and paste it in the webpage, where you want to embed your HayForm</p>
                    <div class="form-group copyiframe">
                      <input class="form-control" type="text" value="&lt;iframe src=&quot;https://hayform.com/form/La88e&quot;  width=&quot;100%&quot; height=&quot;600&quot; frameBorder=&quot;0&quot;&gt;&lt;/iframe&gt;"/>
                    </div>
                    <p id="result"></p>
                  </div>
                </div>
                        
                <div class="form-action">
                      <div class="container"> 
                        <div class="row">                        
                          <ul class="positions col">
                           <li id="li1" class="current"> <span class="number">1</span><span>Create Form</span></li>
                            <li id="li2"> <span class="number">2</span><span>Configuration</span></li>
                            <li id="li3"> <span class="number">3</span><span>Published</span></li>
                          </ul>
                          <div class="buttons col">
                        		<a class="btn btn-small btn-link" onclick="fcancel()" id="saveData2" href="javascript:(0)">Cancel</a>
                            	<a class="btn btn-small back-editor btn-white" id="editData">Back</a>
                        		<a class="btn btn-small btn-primary" id="saveData" style="dispaly:block;" href="javascript:(0)">Continue </a>
                                <a class="btn btn-small btn-primary" style="display:none;" id="submitstep2" onclick="fkliksubmit()" href="javascript:(0)">Submit</a>
                          </div>
                      </div>
                    </div>                                              
                </div>
                        
                        
              </div>
 
                <script>
                    function fkliksubmit(){
                        document.getElementById('btnstep2').click();
                    }
                    function fcancel(){
                       
                        var formtitle = document.getElementById('form_title').value;
                       // var nope = document.getElementById('wa_number').value;
                        if(formtitle === ""){
                        document.getElementById('form_title').value = "draft<?php echo rand();?>";
                        }
                        document.getElementById('form_statuscek').value = "draft";
                      
                        
                        //document.getElementById('btnstep2').click();
                       //  alert('testcancel');
                    }
                </script>
 
 
 <?php
 $_SESSION['daricreateform'] = "ok";
 /**
 <div class="dashboard-container myforms">
                <div class="form-editor row" id="fb-editor">
                  <div class="col-md-8 box-drag">
                    <div class="theform" id="my-drop-area">             
                      <div class="theform-header">
                        <div class="breadcrumbs"><a href="<?php echo esc_url(home_url('dashboard/')); ?>">My Forms</a><span>New Form</span></div>
                        <div class="tag">Draft </div>
           				
                      </div>
           
                    </div>
                  </div>
                  <div class="col-md-4 box-elements" id="step1">
                    <div class="form-wrap form-builder">
                      <h3>Form Elements</h3>
                      <div id="custom-control-list"></div>
                      
                      <div class="form-wrap form-builder" id="step2" style="display:none">
                        <h3>Form Configuration</h3>
                        <form id="preview" class="left-side form-rendered" style=""></form>
                        <form id="submission" class="right-side form" method="post" action="">
                            <a class="back-editor btn-link" id="editData">Back to Editor</a>
                            <?php wp_nonce_field('form_submission_nonce', 'form_submission_nonce'); ?>
                            <div class="form-group">
                                <label for="form_title">Form Name:</label>
                                <input type="text" name="form_title" class="form-control" id="form_title" required>
                            </div>
                            <div class="form-group">
                                <label for="form_slug">Form Link:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">hayform.com/form/</span>
                                    <input type="text" class="form-control" id="form_slug" value="<?php echo $random_slug; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wa_number">WhatsApp Number:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">+62</span>
                                    <input type="tel" name="wa_number" class="form-control" id="wa_number" required>
                                </div>
                            </div>
                           
                            
                            <input type="hidden" name="form_content" id="form_content">
                            <input type="hidden" name="form_slug" value="<?php echo $random_slug; ?>">
                            <div class="fb-submission-action" id="fb-submission-action">
                                <a class="btn btn-white" href="<?php echo esc_url(home_url('dashboard/')); ?>">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                      </div>
                      
                      
                      
                    </div>
           			
           			 
           
                  </div>
           <?php // mulai element step 2 ?>
           
                       <div id="fb-preview">
                        <form id="preview" class="left-side form-rendered" style=""></form>
                        <form id="submission" class="right-side form" method="post" action="">
                            <a class="back-editor btn-link" id="editData">Back to Editor</a>
                            <?php wp_nonce_field('form_submission_nonce', 'form_submission_nonce'); ?>
                            <div class="form-group">
                                <label for="form_title">Form Name:</label>
                                <input type="text" name="form_title" class="form-control" id="form_title" required>
                            </div>
                            <div class="form-group">
                                <label for="form_slug">Form Link:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">hayform.com/form/</span>
                                    <input type="text" class="form-control" id="form_slug" value="<?php echo $random_slug; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wa_number">WhatsApp Number:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">+62</span>
                                    <input type="tel" name="wa_number" class="form-control" id="wa_number" required>
                                </div>
                            </div>
                           
                            
                            <input type="hidden" name="form_content" id="form_content">
                            <input type="hidden" name="form_slug" value="<?php echo $random_slug; ?>">
                            <div class="fb-submission-action" id="fb-submission-action">
                                <a class="btn btn-white" href="<?php echo esc_url(home_url('dashboard/')); ?>">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                   
           <?php // selesai element step 2 ?>
                <div class="form-action">
                  <ul class="positions">
                    <li id="li1"> <span class="number">1</span><span>Create Form</span></li>
                    <li id="li2"> <span class="number">2</span><span>Configuration</span></li>
                    <li id="li3"> <span class="number">3</span><span>Publsihed</span></li>
                  </ul>
                  <div class="buttons"><a class="btn btn-small btn-white" href="<?php echo esc_url(home_url('dashboard/')); ?>">Cancel</a><a class="btn btn-small btn-primary" id="saveData" href="javascript:(0);">Continue </a></div>
                </div>
              </div>
 
 **/
  ?>
 <?php
 
 /**
            <div class="box-wrap">
                <div class="box-title">
                    <h1>New Form</h1>
                </div>
                <div class="content" id="fb-container">
                    <div id="fb-editor"></div>
                    <div id="fb-preview">
                        <form id="preview" class="left-side form-rendered" style=""></form>
                        <form id="submission" class="right-side form" method="post" action="">
                            <a class="back-editor btn-link" id="editData">Back to Editor</a>
                            <?php wp_nonce_field('form_submission_nonce', 'form_submission_nonce'); ?>
                            <div class="form-group">
                                <label for="form_title">Form Name:</label>
                                <input type="text" name="form_title" class="form-control" id="form_title" required>
                            </div>
                            <div class="form-group">
                                <label for="form_slug">Form Link:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">hayform.com/form/</span>
                                    <input type="text" class="form-control" id="form_slug" value="<?php echo $random_slug; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wa_number">WhatsApp Number:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">+62</span>
                                    <input type="tel" name="wa_number" class="form-control" id="wa_number" required>
                                </div>
                            </div>
                           
                            
                            <input type="hidden" name="form_content" id="form_content">
                            <input type="hidden" name="form_slug" value="<?php echo $random_slug; ?>">
                            <div class="fb-submission-action" id="fb-submission-action">
                                <a class="btn btn-white" href="<?php echo esc_url(home_url('dashboard/')); ?>">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="fb-editor-action" id="fb-editor-action">
                        <!-- <button type="button" class="btn btn-white" id="cleanData">Bersihkan</button> -->
                        <a class="btn btn-white" href="<?php echo esc_url(home_url('dashboard/')); ?>">Cancel</a>
                        <button type="button" class="btn btn-primary" id="saveData">Continue</button>
                    </div>
                </div>
            </div>
            
            **/
            ?>
      
       <script>
      			
                jQuery(function ($) {
                    const $formContainer = $('#fb-container'),
                    $fbEditor = $('#fb-editor'),
                    $formPreview = $('#fb-preview'),
                    $formSubmission = $('#form-submission');
                    
                    
                    function initializeSelectPicker() {
                        $('.formbuilder-select select').selectpicker();
                    }
                    
                    // Set default form data if 'id' is set in the query parameters
                    const defaultFormData = <?php echo isset($_GET['id']) ? json_encode(get_post_field('post_content', $_GET['id'])) : "''"; ?>;

                    // Hide the form preview by default
                    $formPreview.hide();
                    $formSubmission.hide();
                    const fbOptions = {
                        onSave: function () {
                            $fbEditor.toggle();
							document.getElementById("saveData").style.display="none";
                            document.getElementById("submitstep2").style.display="block";
                            $('.back-editor').show();
                            document.getElementById("fb-preview").style.display="flex";
                            document.getElementById("li1").setAttribute("class", "passed");
                            document.getElementById("li2").setAttribute("class", "current");
                            
                            // Update the form with ID 'preview' using formRender
                            $('#preview').formRender({
                                formData: formBuilder.formData
                            });
                            // Update the textarea with ID 'post_content' in the form with ID 'submission'
                            $('#form_content').val(formBuilder.formData);
                           if (document.getElementById('form_statuscek').value == "draft"){
                               document.getElementById('btnstep2').click();
                           }
							
	
                            // console.log('Form Data:', formBuilder.formData);
                            setTimeout(function() {
                                console.log($('.formbuilder-select select').length)
                                if($('.formbuilder-select select').length > 0){                                 
                            		$('.formbuilder-select select').selectpicker('refresh');
                                }
                            }, 200);

                            // Hide "Save form" button and show "#editData" button
                            $('#fb-editor-action').hide();
                            $formPreview.show();
                            $formContainer.addClass('box-preview');
                        }
                    };

                        const formBuilder = $fbEditor.formBuilder({
                        controlOrder: [
                            'header',
                            'paragraph',
                            'text',
                            'textarea',
                            'select',
                            'checkbox-group',
                            'radio-group',
                            'date',
                            // 'number',
                            'hidden',
                            // 'autocomplete',
                            // 'button',
                            //'file',
                            // 'starRating'
                        ],

                        disableFields: [
                            'autocomplete',
                            'file',
                            'button',
                            'number'
                        ],

                        disabledAttrs: [															
                        'access',
                        'className',
                        // 'description',
                        'inline',
                        // 'label',
                        'max',
                        'maxlength',
                        'min',
                        // 'multiple',
                        'name',
                        // 'options',
                        // 'other',
                        // 'placeholder',
                        // 'required',
                        // 'rows',
                        'step',
                        'style',
                        'subtype',
                        'toggle',
                        'value'
                        ],

                        subtypes: {
                        text: ['number']
                        },

                        disabledSubtypes: {
                            text: ['password'],
                        },

                        typeUserDisabledAttrs: {
                            'radio-group': [
                            'other'
                            ]
                        },
                        onOpenFieldEdit: function(editPanel) {
                            $('.frmb .form-elements .form-group.required-wrap').each(function() {
                                var t = $(this);
                                var toggle = t.find('.input-wrap');
                                var checkbox = t.find('input[type="checkbox"]');
                                var lbl = t.find('label');
                                
                                if(checkbox.is(':checked')) {
                                    lbl.addClass('active'); // Menggunakan ID target
                                }

                                lbl.on('click', function() {
                                    $(this).toggleClass('active');
                                });
                            });
                            $('.frmb .form-elements .form-group.multiple-wrap').each(function() {
                                var t = $(this);
                                var lbl = t.find('label');
                                lbl.on('click', function() {
                                    $(this).toggleClass('active');
                                });
                            });
                            $('.frmb .form-elements .form-group.other-wrap').each(function() {
                                var t = $(this);
                                var lbl = t.find('label');
                                lbl.on('click', function() {
                                    $(this).toggleClass('active');
                                });
                            });
                            if($('.add.add-opt').length > 0){
                              $('.add.add-opt').text('+ Add Option')
                            }
                            
                        },
                        onCloseFieldEdit: function(editPanel) {
                            initializeSelectPicker();
                            setTimeout(function() {
                                if($('select.form-control').length > 0){
                                    console.log($('select.form-control').length > 0)
                                    
                            		// $('.formbuilder-select select').selectpicker('refresh');
                                }
                            }, 200);
                            //if (editPanel.type === 'select') {
                                //initializeSelectPicker();
                            //}
                        },
                        onAddFieldAfter: function(fieldId, fieldData) {
                          // Your code that handles reacting to the added field
                          //console.log(fieldData)
                          if ($('select.form-control').length > 0 && fieldData.type === 'select') {
                            initializeSelectPicker();
                          }
                           
                        },
                        scrollToFieldOnAdd: true,
                        showActionButtons: false,
                        // Include default form data here
                        formData: defaultFormData,
                        ...fbOptions
                    });

                    $('#editData').on('click', function () {
                        $(this).hide();
                        $fbEditor.toggle();
                        $('#fb-editor-action').show();
                        $('#submitstep2').hide();
                        $('#saveData').show();
                        $formPreview.hide();
                        $formContainer.removeClass('box-preview');
                       
                    });

                    document.getElementById("saveData").addEventListener("click", () => formBuilder.actions.save());
                    document.getElementById("saveData2").addEventListener("click", () => formBuilder.actions.save());
                    // document.getElementById("cleanData").addEventListener("click", () => formBuilder.actions.clearFields());
                    
                });

			$('#fb-editor').on('formBuilder:elementAdded', function(event, element) {
                if (element.type === 'select') {
                    initializeSelectPicker();
                    $(this).css('background', 'red')
                }
            });
              setTimeout(function() {
                var listform = $('body').find('.form-builder .cb-wrap.sticky-controls');
                var dragarea = $('body').find('.form-builder.formbuilder-embedded-bootstrap');
                $('#custom-control-list').append(listform);
                $('#my-drop-area').append(dragarea);

                var $frmb = $('body').find('.frmb li');
                console.log($frmb.length)

            }, 93000);
                                                       
            </script>