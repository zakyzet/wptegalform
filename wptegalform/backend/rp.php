<?php
    /**
    wp-login line 932
    	case 'resetpass':
	case 'rp':
		list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
		$rp_cookie       = 'wp-resetpass-' . COOKIEHASH;
        
        
         $_SESSION['keyrp'] = $_GET['key'];
        $_SESSION['userloginrp'] = $_GET['login'];
        
        
        **/
    $user = "";
if(isset($_SESSION['userloginrp'])){
    $user = $_SESSION['userloginrp'];
    
}
$rp_key = "";
if(isset($_SESSION['keyrp'])){
    $rp_key = $_SESSION['keyrp'];
    
}

    ?>
    
    <div class="auth creataccount">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                  <div class="box-auth"><span class="bd bd-top"></span><span class="bd bd-right"></span><span class="bd bd-bottom"></span><span class="bd bd-left"></span><span class="aksen aksen-tl"></span><span class="aksen aksen-tr"></span><span class="aksen aksen-bl"></span><span class="aksen aksen-br"></span>
                    <h1 class="logo-auth"><?php echo file_get_contents( plugin_dir_url(__FILE__) . 'assets/logo-hayform.svg' ); ?></h1>
                    <div class="desc">
                      <h3>Create new password</h3>
                      <p>Enter your new password below or generate one.</p>
                    </div>
                    <form name="resetpassform" id="resetpassform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=resetpass', 'login_post' ) ); ?>" method="post" autocomplete="off">
                      <div class="form-group">
                        <label>New password</label>
                        
                        <input type="password" name="pass1" id="pass1" class="input password-input form-control" value="" autocomplete="new-password" spellcheck="false" data-reveal="1" data-pw="<?php echo esc_attr( wp_generate_password( 16 ) ); ?>" aria-describedby="pass-strength-result" />
                        
                        <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password' ); ?>">
						<span class="dashicons dashicons-hidden" aria-hidden="true"></span>
					</button>
					<div id="pass-strength-result" class="hide-if-no-js" aria-live="polite"><?php _e( 'Strength indicator' ); ?></div>
                        
                        
                      </div>
                      <div class="hint"><?php echo wp_get_password_hint(); ?></div>
                      
                      <?php

			/**
			 * Fires following the 'Strength indicator' meter in the user password reset form.
			 *
			 * @since 3.9.0
			 *
			 * @param WP_User $user User object of the user whose password is being reset.
			 */
			do_action( 'resetpass_form', $user );

			?>
			<input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>" />
                      <div class="form-action row">
                        <div class="col">
                          <button type="button" class="button wp-generate-pw hide-if-no-js skip-aria-expanded"><?php _e( 'Generate Password' ); ?></button>
                        </div>
                        <div class="col">
                          <button class="btn btn-primary btn-small btn-block" name="wp-submit" id="wp-submit" type="submit">Save password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="have-others text-center">
                    <p>Go to <a href="login.html">Login</a></p>
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