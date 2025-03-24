<?php 
// set in wp_login page in line 1559

//	$redirect_url = home_url('/dashboard/');
    //    wp_redirect($redirect_url);
     //   exit();
        

//mulai login, register, forgot password ?>
<?php
$regcekemail = "";
$action = "";
$ariaby = "";
if(isset($_SESSION['ariades'])){
    $ariaby = $_SESSION['ariades'];
}
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
   
if(isset($_GET['checkemail'])){
    $regcekemail = $_GET['checkemail'];
    
}

$pesannya = "";

if(isset($_SESSION['message'])){
    $pesannya = $_SESSION['message'];
}
else{
    $pesannya = "";
}

if($regcekemail == "registered") :
   
	require_once('regconfirmation.php');

elseif($regcekemail == "confirm") :

	require_once('confirmlostpassword.php');


elseif($action == "lostpassword") :

	require_once('lostpassword.php');

elseif($action == "rp") :

	require_once('rp.php');

elseif($action == "passwordcreated") :

	require_once('passwordcreated.php');

else:
    //mulai else not regcekemail == registered
    ?>
    
        
        <?php // mulai login page ?>
        
<style>
    .login .notice-error {
    border-left-color: #d63638;
}
</style>
	<div id="loginpage" style="display:block;">
	<div id="wrap">
      <div class="web-wrapper" id="page">
        <main>
          <div class="auth login">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
        		
                  <div class="box-auth"><span class="bd bd-top"></span><span class="bd bd-right"></span><span class="bd bd-bottom"></span><span class="bd bd-left"></span><span class="aksen aksen-tl"></span><span class="aksen aksen-tr"></span><span class="aksen aksen-bl"></span><span class="aksen aksen-br"></span>
                    <h1 class="logo-auth"><?php echo file_get_contents( plugin_dir_url(__FILE__) . 'assets/logo-hayform.svg' ); ?></h1>
                    <div class="desc">
                      <h3>Login to your account</h3>
                      <p>Creating your own forms is as easy as pie. Gather up all your data on your WhatsApp.</p>
                        <?php
                        
                        	print_r($pesannya);
                                    $_SESSION['message'] = "";
                		        
				?>
                    </div>
                    <form action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>" method="post">
                      <div class="form-group">
                        <label>Username </label>
                        <input class="form-control" type="text" name="log" id="username" <?php echo $ariaby; ?> placeholder="Enter username here"/>
                      </div>
                      <div class="form-group">
                        <label>Password </label>
                        <input class="form-control" name="pwd" id="password" type="password" <?php echo $ariaby; ?> placeholder="Enter password here"/>
                      </div>
                      <div class="row form-agreement">
                        <div class="col">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe"/>
                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                          </div>
                        </div>
                        <div class="col"><a id="forgotpassword" href="<?php echo get_home_url();?>/dashboard/?action=lostpassword">Forgot Password?</a></div>
                      </div>
                      <div class="form-action">
                        <button class="btn btn-primary btn-small btn-block" type="submit">Login</button>
						<?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                      </div>
                    </form>
                  </div>
				  <?php 
				  $user_registration_allowed = get_option('users_can_register');
				  if ($user_registration_allowed) {
            ?>
                  <div class="have-others text-center">
                    <p>Don’t have an account yet? <a href="#" onclick="showregpage()" id="creeateacc">Create account</a></p>
                  </div>
				  <?php } ?>
                </div>
              </div>
              <footer class="footer">
                <div class="footer-copyright text-center">
                  <p>© 2024 HayForm. All Rights Reserved.</p>
                </div>
              </footer>
            </div>
          </div>
        </main>
        <div class="back-to-top"></div>
      </div>
    </div>
    <div class="backdrop"></div>
	</div>
	<?php // selesai login page ?>
	
	<?php // mulai register page ?>
	<div id="regpage" style="display:none;">
	<div id="wrap">
      <div class="web-wrapper" id="page">
        <main>
          <div class="auth creataccount">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                  <div class="box-auth"><span class="bd bd-top"></span><span class="bd bd-right"></span><span class="bd bd-bottom"></span><span class="bd bd-left"></span><span class="aksen aksen-tl"></span><span class="aksen aksen-tr"></span><span class="aksen aksen-bl"></span><span class="aksen aksen-br"></span>
                    <h1 class="logo-auth"><?php echo file_get_contents( plugin_dir_url(__FILE__) . 'assets/logo-hayform.svg' ); ?></h1>
                    <div class="desc">
                      <h3>Create an account</h3>
                      <p>Creating your own forms is as easy as pie. Gather up all your data on your WhatsApp.</p>
                    </div>
                    <?php
                    if(isset($_GET['action'])){
                        if($_GET['action'] == "register"){
                            ?>
                            <div class="notice notice-info message register">
                                <p>Register For This Site</p>
                                </div>
                            <?php
                        }
                    }
                    ?>
                    
                    <form class="register-form" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')); ?>" method="post">
                      <div class="form-group">
                        <label>Username </label>
                        <input class="form-control" name="user_login" id="reg_username" type="text" placeholder="Enter username here"/>
                      </div>
                      <div class="form-group">
                        <label>Email </label>
                        <input class="form-control" name="user_email" id="reg_email" type="text" placeholder="Enter email here"/>
                      </div>
                      <div class="form-action">
                        <button class="btn btn-primary btn-small btn-block" type="submit">Create account</button>
						<?php wp_nonce_field('ajax-register-nonce', 'security'); ?>
                      </div>
                    </form>
                  </div>
                  <div class="have-others text-center">
                    <p>Already have an account? <a href="#" onclick="showloginpage()" >Login</a></p>
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
        </main>
        <div class="back-to-top"></div>
      </div>
    </div>
    <div class="backdrop"></div>
	</div>
	<?php // selesai register page ?>
	
	
<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
	
	function showregpage(){
		document.getElementById('regpage').style.display = "block";
		document.getElementById('loginpage').style.display = "none";
	}
	function showloginpage(){
		document.getElementById('regpage').style.display = "none";
		document.getElementById('loginpage').style.display = "block";
	}
</script>
<?php
                    if(isset($_GET['action'])){
                        if($_GET['action'] == "register"){
                            ?>
                           <script>
                               document.getElementById("creeateacc").click();
                           </script>
                            <?php
                        }
                    }
                    ?>
<?php
// selesai login, register, forgot password
?>
        
        
    <?php
endif; // end of else not regcekemail == registered
    
?>
    
	



<?php
/**
<div class="login-page">
    <div class="form">
        <h1>
            <?php // get_theme_mod('custom_logo') ?>
            <div><?php echo file_get_contents( plugin_dir_url(__FILE__) . 'assets/logo-hayform.svg' ); ?></div>
        </h1>
        <form class="login-form" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>" method="post">
            <label>Username</label>
            <input type="text" name="log" id="username" placeholder="Username">
            <label>Password</label>
            <input type="password" name="pwd" id="password" placeholder="Password">
            <button type="submit">Login</button>
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
            <?php // Get the value of the 'users_can_register' option
    $user_registration_allowed = get_option('users_can_register');
    // Check if user registration is allowed
    if ($user_registration_allowed) {
            ?>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
        <form class="register-form" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')); ?>" method="post">
            <label>Username</label>
            <input type="text" name="user_login" id="reg_username" placeholder="Username">
            <label>Email</label>
            <input type="email" name="user_email" id="reg_email" placeholder="Email">
            <!-- input type="password" name="user_password" id="reg_password" placeholder="Password:" -->
            <button type="submit">Register</button>
            <?php wp_nonce_field('ajax-register-nonce', 'security'); ?>
            <p class="info">Registration confirmation will be emailed to you.</p>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
            <?php } ?>
        </form>
    </div>
</div>
<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>

**/
?>