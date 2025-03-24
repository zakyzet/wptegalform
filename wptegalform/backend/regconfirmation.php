<?php
// set url redirect on wp-login.php line 1123
//	$redirect_to = ! empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
//  to
//  $redirect_to = ! empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'dashboard/?checkemail=registered';

?>
<div class="auth creataccount">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                  <div class="box-auth"><span class="bd bd-top"></span><span class="bd bd-right"></span><span class="bd bd-bottom"></span><span class="bd bd-left"></span><span class="aksen aksen-tl"></span><span class="aksen aksen-tr"></span><span class="aksen aksen-bl"></span><span class="aksen aksen-br"></span>
                    <h1 class="logo-auth"><?php echo file_get_contents( plugin_dir_url(__FILE__) . 'assets/logo-hayform.svg' ); ?></h1>
                    <div class="desc">
                      <h3>Registration complete</h3>
                      <p>Congrats! Please check your email, then click this login button below.</p><a class="btn btn-small btn-primary btn-block" href="<?php echo esc_url(home_url('dashboard/')); ?>">Login</a>
                    </div>
                  </div>
                </div>
              </div>
              <footer class="footer">
                <div class="footer-copyright text-center">
                  <p>© <?php echo date("Y");?> HayForm. All Rights Reserved.</p>
                </div>
              </footer>
            </div>
          </div>