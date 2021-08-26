<?php include 'header.php' ?>
<?php
if (isset($_SESSION['usr_id'])) {
	header('location:index.php');
}

?>
<style>
	input.invalid {
		background-color: #ffdddd;
	}
</style>

<body class="app app-login p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="images/ems.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to Panel</h2>
					<div class="auth-form-container text-start">
						<!-- Log In Form Start Here-------------------------->
						<fieldset>
							<?php
							if (isset($_SESSION['success'])) {
								echo $_SESSION['success'];
								unset($_SESSION['success']);
							}
							?>

							<form class="auth-form login-form" method="post" action="login_account.php" onsubmit="return dataValidatelogIn();" enctype="multipart/form-data">
								<div class="form-validate">
									<div class="email mb-3">
										<label class="sr-only" for="signin-email">Email ID/User Name</label>
										<input id="LogInEmail" name="LogInEmail" type="text" class="form-control signin-email" placeholder="Email address">
										<small id="emailHelp" class="form-text text-muted">
											<?php
											if (isset($_SESSION['name_errmsg'])) {
												echo $_SESSION['name_errmsg'];
												unset($_SESSION['name_errmsg']);
											} else {
												echo "Please Use Your Email Address or User Name for Log In.";
											}
											?>
										</small>
									</div>
									<!--//form-group-->
									<div class="password mb-3">
										<label class="sr-only" for="signin-password">Password</label>
										<input id="LogInPassword" name="LogInPassword" type="password" class="form-control signin-password" placeholder="Password">
										<small id="passwordHelp" class="form-text text-muted">
											<?php
											if (isset($_SESSION['pass_errmsg'])) {
												echo  $_SESSION['pass_errmsg'];
												unset($_SESSION['pass_errmsg']);
											} else {
												echo "Please Use Your Password for Log In.";
											}
											?>
										</small>
										<div class="extra mt-3 row justify-content-between">
											<div class="col-6">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
													<label class="form-check-label" for="RememberPassword">
														Remember me
													</label>
												</div>
											</div>
											<!--//col-6-->
											<div class="col-6">
												
											</div>
											<!--//col-6-->
										</div>
										<!--//extra-->
									</div>
									<!--//form-group-->
									<div class="text-center">
										<button type="submit" onclick="return ValidateForm();" name="LoginButton" id="LoginButton" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
									
									</div>
								</div>

							</form>
						</fieldset>
						<!-- Log In End Here-------------------------->
					</div>
					<!--//auth-form-container-->

				</div>
				<!--//auth-body-->
				<!--//app-auth-footer-->
			</div>
			<!--//flex-column-->
		</div>
		<!--//auth-main-col-->
		<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
			<div class="auth-background-holder">
			</div>
			<div class="auth-background-mask"></div>
			<div class="auth-background-overlay p-3 p-lg-5">
				<div class="d-flex flex-column align-content-end h-100">
					<div class="h-100"></div>
					<!-- <div class="overlay-content p-3 p-lg-4 rounded">
						<h5 class="mb-3 overlay-title">Explore Portal Admin Template</h5>
						<div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license <a href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">here</a>.</div>
					</div> -->
				</div>
			</div>
			<!--//auth-background-overlay-->
		</div>
		<!--//auth-background-col-->

	</div>
	<!--//row-->
	<!-- <script type="text/javascript">
		function dataValidatelogIn() {
			var email = $('#LogInEmail').val();
			if (email == "") {
				alert("Enter Your email or user name Here!");
				return false;
			}
			var password = $('#LogInPassword').val();

			if (password == "") {
				alert("Enter The Password Here!");
				return false;
			}
		}
	</script> -->
	<script type="text/javascript">
		function ValidateForm() {
			var x, y, i,currenttab=0;
			x = document.getElementsByClassName("form-validate");
			y = x[currenttab].getElementsByTagName("input");
			for (i = 0; i < y.length; i++) {
				if (y[i].value == "") {
					y[i].className += " invalid";					
				}
			}			
		}
	</script>

	<?php include "footer.php" ?>