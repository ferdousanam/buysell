<?php include 'inc/header.php';?>
<?php include 'inc/headerBottom.php';?>
<?php
  $user_login = new userLogin();
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $loginCheck = $user_login->adminLogin($user_email, $user_password);
  }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	$registrationCheck = $user_login->userRegistration($_POST);
  }

 ?>
			<section class="main-content">				
				<div class="row">
					<div class="span5">					
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<form action="" method="post">
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
										<input type="text" placeholder="Enter your email" id="user_email" class="input-xlarge" name="user_email">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">user_email</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" id="user_password" class="input-xlarge" name="user_password">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" value="Sign into your account" name="login">
								</div>
							</fieldset>
						</form>				
					</div>
					<div class="span7">					
						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
						<?php
							if(isset($registrationCheck)){
								echo $registrationCheck;
							}
						?>
						<form action="" method="post" class="form-stacked">
							<fieldset>
								<div class="control-group">
									<label class="control-label">First Name:</label>
									<div class="controls">
										<input type="text" placeholder="Enter your First Name" class="input-xlarge" name="first_name" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Last Name:</label>
									<div class="controls">
										<input type="text" placeholder="Enter your Last Name" class="input-xlarge" name="last_name" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Email Address:</label>
									<div class="controls">
										<input type="text" placeholder="Enter your email" class="input-xlarge" name="user_email" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Phone Number:</label>
									<div class="controls">
										<input type="text" placeholder="Enter your Phone Number" class="input-xlarge" name="phone" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password:</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" class="input-xlarge" name="user_pass" required>
									</div>
								</div>							                            
								<div class="control-group">
									<p>All Fields Are required. You can't update it later at this TOS Are you sure to register?</p>
								</div>
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Create your account" name="register"></div>
							</fieldset>
						</form>					
					</div>				
				</div>
			</section>			
			
<?php include 'inc/javascripts.php'; ?>
<?php include 'inc/footer.php'; ?>