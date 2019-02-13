<?php
  include_once('functions.php');
  if(!is_logged_in()){
    header('Location:http://'.$_SERVER['SERVER_NAME'].'/login.php');
  }
  include_once('header.php')
?>
<div id="wrapper" class="body login-page">
  <section>
    <div class="container">
      <?php
      $user = $_COOKIE['user'];
      $secret = $_COOKIE['secret'];
      include('php/db.php');
      $result = $conn->query("SELECT * FROM users WHERE Email = '".$user."' AND Password = '". $secret ."'");

        if ($result > 0)
        {
           if ($result->num_rows > 0)
           {
             while ($row = $result->fetch_assoc())
             {
               $curr_user["first_name"] = $row["First Name"];
               $curr_user["last_name"] = $row["Last Name"];
               $curr_user["country"] = $row["Billing County"];
               $curr_user["user_id"] = $row["Id"];
               $curr_user["email"] = $row["Email"];
              }
           }
        }


      ?>
      <table id="order-approving" class="profile-table">
        <tr>
          <th>First Name</th>
          <td><input type="text" name="first_name" value="<?php echo $curr_user["first_name"]?>"></td>
        </tr>
        <tr>
          <th>Last Name</th>
          <td><input type="text" name="last_name" value="<?php echo $curr_user["last_name"]?>"></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><input type="email" name="email" value="<?php echo $curr_user["email"]?>"></td>
        </tr>
        <tr>
          <th>Billing Country</th>
          <td>
            <?php $countries = ['United States', 'Canada', 'United Kingdom', 'Israel', 'France', 'Germany', 'South Africa', 'Australia','Other']?>
            <select class="" name="bill_country">
              <?php foreach ($countries as $country): ?>
                <option value="<?php echo $country?>" <?php if($country == $curr_user['country']){echo "selected";}?>>
                  <?php echo $country?>
                </option>
              <?php endforeach; ?>


            </select>
        </td>
        </tr>
        <tr>
          <th>Password</th>
          <td><button id="open-pass">Change password</button></td>
        </tr>

      </table>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="password-change non-visible">

              <div class="">
                <label for="old_pass">Old password</label>
                <input type="password" name="old_pass">
              </div>
              <div class="">
                <label for="new_pass">New password</label>
                <input type="password" name="new_pass">
              </div>
              <div class="">
                <label for="repeat_pass">New password again</label>
                <input type="password" name="repeat_pass">
              </div>
              <div class="text-center">
                <button id="change-pass" class="btn-trial">Save new password</button>
              </div>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-md-offset-9">
          <button id="save-changes" class="btn-trial">Save changes</button>

        </div>
      </div>
    </div>

  </section>
</div>

<?php include_once('footer.php') ?>
