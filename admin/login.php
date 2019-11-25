<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2373254366323696',
      cookie     : true,
      xfbml      : true,
      version    : 'v5.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

	function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
	}
</script>

<?php
	if(!defined('SECURITY')){
		header("location:index.php");
	}
	if(isset($_POST['sbm'])){
		$mail = $_POST['mail'];
		$pass = $_POST['pass'];
		$sql = "SELECT * FROM user WHERE user_mail = '$mail' AND user_pass = '$pass'";
		$query = mysqli_query($con, $sql);
		$num_row = mysqli_num_rows($query);

		$sql1 = "SELECT user_full FROM user WHERE user_mail = '$mail' AND user_pass = '$pass'";
		$query1 = mysqli_query($con, $sql1);
		$user_full_arr = $query1->fetch_assoc();
		// foreach ($user_full_arr as $key => $value) {
		// 	$_SESSION['user_full'] = $value;
		// }
		if(isset($user_full_arr)){
			$_SESSION['user_full'] = $user_full_arr[key($user_full_arr)];
		}

		if($num_row > 0){
			$_SESSION['mail'] = $mail;
			$_SESSION['pass'] = $pass;
			header('location:index.php');
		}
		else
			$error = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
	}
	else if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
		if($_SESSION['mail']=='admin@gmail.com' && $_SESSION['pass']=='123456'){
			header('location:admin.php');
		}
	}
?>
<body>
		<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Vietpro Mobile Shop - Administrator</div>
				<div class="panel-body">
					<?php  if(isset($error)) echo $error; ?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="" required>
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button type="submit" class="btn btn-primary" name='sbm'>Đăng nhập</button>
							<!-- 98-102 -->
							<fb:login-button 
							scope="public_profile,email"
							onlogin="checkLoginState();">
							</fb:login-button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
