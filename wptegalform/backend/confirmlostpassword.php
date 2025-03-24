 <?php
/**
wp-login line 825 
case 'retrievepassword':
		if ( $http_post ) {
			$errors = retrieve_password();

			if ( ! is_wp_error( $errors ) ) {
			//	$redirect_to = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : 'wp-login.php?checkemail=confirm';
                $redirect_to = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : 'dashboard/?checkemail=confirm';
				wp_safe_redirect( $redirect_to );
				exit;
			}
		}

**/
     
     $emailnya = "";
	if(isset($_SESSION['emailresetpassword'])){
        $emailnya = $_SESSION['emailresetpassword'];
        $_SESSION['emailresetpassword'] = "";
    }
    else{
        $emailnya = "";
    }
     ?>
     
     <div class="auth creataccount">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                  <div class="box-auth"><span class="bd bd-top"></span><span class="bd bd-right"></span><span class="bd bd-bottom"></span><span class="bd bd-left"></span><span class="aksen aksen-tl"></span><span class="aksen aksen-tr"></span><span class="aksen aksen-bl"></span><span class="aksen aksen-br"></span>
                    <h1 class="logo-auth"><?php echo file_get_contents( plugin_dir_url(__FILE__) . 'assets/logo-hayform.svg' ); ?></h1>
                    <div class="desc">
                      <h3>Forget password</h3>
                      <p>We have sent you a password reset instruction to <b><?php echo $emailnya;?></b></p>
                    </div>
                    <div class="didnt-recive">
                      <p>Didn’t receive the email? <a href="<?php echo get_home_url();?>/dashboard/?action=lostpassword">Click to resend</a></p>
                    </div>
                  </div>
                </div>
              </div>
              <footer class="footer">
                <div class="footer-copyright text-center">
                  <p>© 2024 HayForm. All Rights Reserved.</p>
                </div>
              </footer>
            </div>
          </div>