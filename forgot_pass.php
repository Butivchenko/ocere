<?php
  include_once('functions.php');
  if(is_logged_in()){
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/profile.php');
  }
  include_once('header.php')
?>
<div id="wrapper" class="body login-page">
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="password-change">
            <form action="php/forgot_recovery.php" method="post">
              <label for="email">Input here your email</label>
              <input type="email" name="email">
              <input type="submit" id="send_new_pass" class="btn-trial" value="Password recovery">

            </form>

          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<?php include_once('footer.php') ?>
