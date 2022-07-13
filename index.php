<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Vdofy</title>
	<!--favicon-->
	<link rel="icon" href="https://vdofyfilex.com/assets/images/favicon-32x32.pngs" type="image/png" />
	<!-- Vector CSS -->
	<link href="https://vdofyfilex.com/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="https://vdofyfilex.com/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="https://vdofyfilex.com/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="https://vdofyfilex.com/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="https://vdofyfilex.com/assets/css/pace.min.css" rel="stylesheet" />
	<script src="https://vdofyfilex.com/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://vdofyfilex.com/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://vdofyfilex.com/https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="https://vdofyfilex.com/assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="https://vdofyfilex.com/assets/css/app.css" />
	
	
	<link href="https://vdofyfilex.com/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
	<link href="https://vdofyfilex.com/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	
	
</head>

<body class="bg-theme bg-theme1">
    <div class="wrapper">
        
        <input type="hidden" id="sub_id" value="0" />
        
        <div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-12 mx-auto" style="margin-top: 35px;">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-12">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="chat-assets/chatr_box.png" class="logo-icon-2" alt="" style="width:100%;" />
										<!--<h3 class="mt-4 font-weight-bold">CHAT</h3>-->
									</div>
								    <form action="logincheck.php" method="post" id="logincheck" ></form>
									<div class="form-group mt-4">
										<label>Email Address</label>
										<input type="text" name="login_form_email" form="logincheck" class="form-control" placeholder="Enter your email address" />
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="login_form_password" form="logincheck" class="form-control" placeholder="Enter your password" />
									</div>
									<div class="btn-group mt-3 w-100">
										<button type="submit" form="logincheck" class="btn btn-light btn-block login_submit_btn">Log In</button>
									</div>
									<hr>
								<?php if(isset($_GET["alert"])) { ?>
									<div class="login_form_error_message" style="display:block;text-align: center;font-size: 11px;background: #0c2255;padding: 5px 0px;border-radius: 7px">
									    <p>Email or Password seems to be incorrect. <br/> Please try again.</p>
									</div>
								<?php } else { } ?>
									<div class="login_form_error_message_2" style="display:none;text-align: center;font-size: 11px;background: #0c2255;padding: 5px 0px;border-radius: 7px">
									    <p>Email and Password are mandatory</p>
									</div>
								</div>
							</div>
						
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
        
        

    </div>
    
<!-- JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://vdofyfilex.com/assets/js/popper.min.js"></script>
<script src="https://vdofyfilex.com/assets/js/bootstrap.min.js"></script>
<!--plugins-->
<script src="https://vdofyfilex.com/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<!-- Vector map JavaScript -->
<script src="https://vdofyfilex.com/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>
<script src="https://vdofyfilex.com/assets/js/index.js"></script>


<script src="https://vdofyfilex.com/assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
<script src="https://vdofyfilex.com/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
<script>
	$('#fancy-file-upload').FancyFileUpload({
		params: {
			action: 'fileuploader'
		},
		maxfilesize: 1000000
	});
</script>
<script>
	$(document).ready(function () {
		$('#image-uploadify').imageuploadify();
	})
</script>
<script src="https://vdofyfilex.com/assets/js/app.js"></script>


    </body>
</html>