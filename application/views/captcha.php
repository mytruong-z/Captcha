<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>Admin</title>
	</head>
	<style>
		/*
/* Created by Filipe Pina
 * Specific styles of signin, register, component
 */
		/*
		 * General styles
		 */

		body, html{
			height: 100%;
			background-repeat: no-repeat;
			background-color: #d3d3d3;
			font-family: 'Oxygen', sans-serif;
		}

		.main{
			margin-top: 70px;
		}

		h1.title { 
			font-size: 50px;
			font-family: 'Passion One', cursive; 
			font-weight: 400; 
		}

		hr{
			width: 10%;
			color: #fff;
		}

		.form-group{
			margin-bottom: 15px;
		}

		label{
			margin-bottom: 15px;
		}

		input,
		input::-webkit-input-placeholder {
			font-size: 11px;
			padding-top: 3px;
		}

		.main-login{
			background-color: #fff;
			/* shadows and rounded borders */
			-moz-border-radius: 2px;
			-webkit-border-radius: 2px;
			border-radius: 2px;
			-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

		}

		.main-center{
			margin-top: 30px;
			margin: 0 auto;
			max-width: 330px;
			padding: 40px 40px;

		}



	</style>

	<body>
		<div class="container">
			<div class="row main">

				<div class="main-login main-center">
<form class="form-horizontal" method="post" action="" onsubmit="return validateForm(this);">
	<div class="form-group">
		<label for="email" class="cols-sm-2 control-label">Your Email</label>
		<div class="cols-sm-10">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
				<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="username" class="cols-sm-2 control-label">Username</label>
		<div class="cols-sm-10">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
				<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="password" class="cols-sm-2 control-label">Password</label>
		<div class="cols-sm-10">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
				<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label"></label>
		<div class="input-box">
			<div class="btn-group btn-input">

				<div id="imgdiv" style="display: inline;"><img id="img" src="<?php echo base_url()?>captcha/getcaptchaimage" /></div><img id="reload" src="<?php echo base_url() ?>img/reload.png" />	

			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Enter Image Text <sup>*</sup></label>
		<div class="input-box">
			<input type="text" class="form-control" id="captcha1"  >
			<div id="capacha_error" class="error_alertbox" style="display:none; color: red;"></div>
		</div>
	</div>

	<div class="form-group ">
		<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
	</div>

</form>
				</div>
			</div>
		</div>


	</body>
</html>
<script type="text/javascript">


    //change CAPTCHA on each click or on refreshing page
$("#reload").click(function () {
	$("img#img").remove();
	var id = Math.random();
	$('<img id="img" src="<?php echo base_url() ?>captcha/getcaptchaimage?id=' + id + '"/>').appendTo("#imgdiv");
	id = '';
});



function validateForm(form) {
	var flag = 0;
	var status = false;
	var captcha = $('#captcha1').val();
	if (captcha == '') {
		flag = 1;
		var error_text = 'Please enter Image Text.';
		$('#capacha_error').html(error_text);
		$('#capacha_error').show();
	}
	if (flag == 1)
	{
		return status;
	} else
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url() ?>captcha/checkcaptcha",
			global: false,
			data: {captcha: captcha},
			dataType: 'JSON',
			async: false, //blocks window close
			success: function (data) {
				if (data.error)
				{
					var error_text = 'Captcha Code does not Match Please check.';
					$('#capacha_error').html(error_text);
					$('#capacha_error').show();
					status = false;
				} else if (data.success)
				{
					status = true;
				}
			}
		});
		return status;
	}
}

</script>