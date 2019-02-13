<?php include ('header.php')?>
	<!-- Wrapper -->
	<div id="wrapper" class="body">
		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="">
							<div class="row">
								<div class="col-sm-12">
									<small><b>Blogger Outreach/Link Building Order Details</b></small>
								</div>
							</div>
						</h5>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-5">
								<form action="thanks.php" class="form form-new" method="post">
									<div class="form-group">
										<label for="">First Name*</label>
										<div class="">
										  	<input name="First Name" type="text" class="form-control" placeholder="" required>
										</div>
									</div>
									<div class="form-group">
										<label for="">Last Name*</label>
										<div class="">
										  	<input name="Last Name" type="text" class="form-control" placeholder="" required>
										</div>
									</div>
									<div class="form-group">
										<label for="">Email*</label>
										<div class="">
										  	<input name="Email" type="email" class="form-control" placeholder="" required>
										</div>
									</div>
									<div class="form-group">
										<label for="pass">Password*</label>
										<div class="">
										  	<input name="pass" type="paswoed" class="form-control" placeholder="" required>
										</div>
									</div>
									<div class="form-group">
										<label for="">Phone*</label>
										<div class="">
										  	<input name="Phone" type="phone " class="form-control" placeholder="" required>
										</div>
									</div>
									<div class="form-group">
										<label for="">Country*</label>
										<div class="">
										  	<input name="Country" type="text" class="form-control" placeholder="" required>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn-trial">Place order</button>
									</div>
									<?php


									foreach($_POST as $k=>$v) {

											if(is_array($v))
												$v = implode(',', $v);

											echo "<input type='hidden' name=$k value='$v'>";
										}
										$file = '';
									if(!empty($_FILES)) {
										$target_dir = "uploads/";
										$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

										if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
									        echo "<input type='hidden' name='Excel File' value='http://".$_SERVER['HTTP_HOST']."/uploads/". basename( $_FILES["fileToUpload"]["name"]). "'>";
									        $file = "http://".$_SERVER['HTTP_HOST']."/uploads/". basename( $_FILES["fileToUpload"]["name"]);
									    } else {
									       // echo "Sorry, there was an error uploading your file.";
									    }

									}



										$table = "<p>Hi Admin,</p><p></p><p>Below are enquiry details</p><p></p><table>";
										foreach($_POST as $k=>$v) {
											if(is_array($v))
												$v = implode(',', $v);
											$tr = "<tr><td>$k: </td><td>$v</td>";
											$table .= $tr;
										}

										$tr = "<tr><td>Uploaded File: </td><td>".urldecode($file)."</td>";
										$table .= $tr;

										$table .= "</table>";
										//echo $table;


										$to = "tomparling@gmail.com, ben@ocere.com, tom@ocere.com, remi@ocere.com, info@ocere.com";
										//$to = "er.savindersingh@gmail.com";
										$subject = "Step 1 Completed: Enquiry Submitted on Ocere Web Tool";

										// Always set content-type when sending HTML email
										$headers = "MIME-Version: 1.0" . "\r\n";
										$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

										// More headers
										//$headers .= 'From: <hi@savindersingh.me>' . "\r\n";

										mail($to,$subject,$table,$headers);


									?>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>


		<?php include('footer.php') ?>
