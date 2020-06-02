
<?php
session_start();

if (isset($_SESSION['user_id'])) 
{
	header('location:index.php');
}


?>
<?php
include 'mysqli.php';
?>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title>Sign In – Swipe</title>
		<meta name="description" content="#">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="dist/css/lib/bootstrap.min.css" type="text/css" rel="stylesheet">
		<link href="dist/css/swipe.min.css" type="text/css" rel="stylesheet">
		<link href="dist/img/favicon.png" type="image/png" rel="icon">
	</head>
	<body class="start">
		<main>
		 <div class="layout">
		  <div class="main order-md-1">
			 <div class="start">
			  <div class="container">
				<div class="col-md-12">
				 <div class="content">
				 <h1>Enter your information</h1>
				 <div class="third-party">
		 <button class="btn item bg-blue">
				 <i class="material-icons">pages</i>
		 </button>
		 <button class="btn item bg-teal">
		  <i class="material-icons">party_mode</i>
	    </button>
		 <button class="btn item bg-purple">
			 <i class="material-icons">whatshot</i>
		 </button>
	 </div>
	 <p>or use your email account:</p>
	  <div class="form-group">
	   <input name="username" type="username" id="username" class="form-control" placeholder="Username" required>
	 <button class="btn icon"><i class="material-icons">mail_outline</i></button>
    </div>
    <div class="form-group">
	 <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
		 <button class="btn icon"><i class="material-icons">lock_outline</i></button>
      </div>
    	<h5 class="tsl" style="color:red;"></h5>
    <div class="form-group">  
     <input type="checkbox" id="remember" name="remember"  />  
     <label for="remember-me">Remember me</label>  
    </div>  
    <button type="submit" name="login" class="btn button login">Sign In</button>
	  <div class="callout">
		 <span>Don't have account? <a href="#">Create Account</a></span>
	 </div>
		 </div>
			 </div>
				 </div>
					</div>
				</div>
				<div class="aside order-md-2">
					<div class="container">
						<div class="col-md-12">
							<div class="preference">
								<h2>Hello, Friend!</h2>
								<p>Enter your personal details and start your journey with Swipe today.</p>
								<a href="sign-up.php" class="btn button">Sign Up</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<script src="dist/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="dist/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="dist/js/vendor/popper.min.js"></script>
		<script src="dist/js/bootstrap.min.js"></script>
	</body>
	<?php include 'jquery.php'; ?>
  </html>