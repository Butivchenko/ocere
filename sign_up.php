<?php
  include_once('functions.php');
  if(is_logged_in()){
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/dashboard.php');
  }
  include_once('header.php');

?>
<div id="wrapper" class="body account-creation">
  <section>
    <div class="container">

      <div class="row">

        <div class="col-md-6">


              <h1>Create account</h1>

              <h3>or <a href="/login.php">Login</a></h3>

          <div class="sign-up-form">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">

                <div class="input-group">
                    <input name="first_name" type="text"  class="form-control" placeholder="First name" required>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                <div class="input-group">
                    <input name="last_name" type="text"  class="form-control" placeholder="Last name" required>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">

                <div class="input-group">
                    <input name="email" type="email"  class="form-control" placeholder="Email Address*" required>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                <div class="input-group">
                    <input name="password" type="password" minlength="6" class="form-control" placeholder="Password*" required >
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">

                <div class="input-group">
                  <select class="" name="bill_country">
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Israel">Israel</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Australia">Australia</option>
                    <option value="Other">Other</option>
                  </select>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                <div class="input-group">
                    <label for="terms">
                      <input name="terms" type="checkbox"  class="form-control" placeholder="Billing country" required>
                      I agree to the <a href="https://www.ocere.com/dm-terms/">Terms & Conditions</a></label>
                </div>

              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <!-- Recaptcha -->
              <div class="g-recaptcha" data-sitekey="6LfJD2gUAAAAAI-kvY1wqjOv0g4Go_tJhAtZoscJ"></div>
              <script src='https://www.google.com/recaptcha/api.js'></script>
            </div>
            <?php

            ?>
          </div>
          <div class="submit-holder">
            <button class="btn-trial" id="submit_signup" value="">Create account</button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <h2>Over 500 Agencies and growing.</h2>
        <ul class="perks ">
          <li><span>Blogger Outreach Done Right. No Networks.</span></li>
          <li><span>Leading the way in High-grade placement.</span></li>
          <li><span>Can work to DA, TF, SEMrush + more.</span></li>
          <li><span>High Quality, Native Copywriting.</span></li>
          <li><span>Worldwide Client base. UK, USA, Israel etc</span></li>
          <li><span>UK-based Support. Email, Phone, Skype etc.</span></li>
          <li><span>Trusted by top agencies & brands.</span></li>
          <li><span>Strength In Gaming and Foreign Language.</span></li>

        </ul>
      </div>

    </div>
  </section>
</div>

<?php include_once('footer.php') ?>
