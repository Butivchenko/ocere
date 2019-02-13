<?php
  include_once('functions.php');
  if(is_logged_in()){
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/dashboard.php');
  }
  include_once('header.php')
?>
<div id="wrapper" class="body login-page">
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <h1>Login</h1>

          <h3>or <a href="/sign_up.php">Create account</a></h3>

          <div class="sign-up-form">
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">

                    <div class="input-group">
                        <input name="email" type="email"  class="form-control" placeholder="Email Address*" required>
                    </div>

                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                  <div class="input-group">
                      <input name="password" type="password" minlength="6" class="form-control" placeholder="Password*" required>
                  </div>

                </div>
              </div>
            </div>
            <div class="forgot">
              <a href="forgot_pass.php">Forgot your password?</a>
            </div>
            <div class="submit-holder">
              <button class="btn-trial" name="login_btn" id="login" value="">Login</button>
            </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<?php include_once('footer.php') ?>
