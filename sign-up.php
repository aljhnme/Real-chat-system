
<?php
session_start();
if (isset($_SESSION['user_id'])) 
{
	header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<title>Sign Up – Swipe</title>
		<meta name="description" content="#">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap core CSS -->
		<link href="dist/css/lib/bootstrap.min.css" type="text/css" rel="stylesheet">
		<!-- Swipe core CSS -->
		<link href="dist/css/swipe.min.css" type="text/css" rel="stylesheet">
		<!-- Favicon -->
		<link href="dist/img/favicon.png" type="image/png" rel="icon">
	</head>
	<body class="start">
    <main>
	 <div class="layout">
		<div class="main order-md-2">
		 <div class="start">
		  <div class="container">
			<div class="col-md-12">
			  <div class="content">
			 <h1>Create Account</h1>
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
	   <p>or use your email for registration:</p>
		   <div class="form-parent">
	      <div class="form-group">
			 <input type="text" id="username" class="form-control" placeholder="Username" required>
	       <button class="btn icon"><i class="material-icons">person_outline</i></button>
		 </div>
		 <div class="form-group">
			 <input type="password" id="password" class="form-control" placeholder="" required>
			 <button class="btn icon"><i class="material-icons">lock_outline</i></button>
		 </div>
		 </div>
		 <div class="form-group">
			 <input type="password" id="passwordc" class="form-control" placeholder="password confirmation" required>
		    <button class="btn icon"><i class="material-icons">lock_outline</i></button>
		 </div>
		     <div class="mass">
		     	
		     </div>
			 <button type="submit" class="btn button register" >Sign Up</button>
			 </div>
				 </div>
					 </div>
					     </div>
				                </div>

				              <div class="aside order-md-1">
				     	<div class="container">
			    <div class="col-md-12">
			 <div class="preference">
				 <h2>Welcome Back!</h2>
			     <p>To keep connected with your friends please login with your personal info.</p>
		    <a href="sign-in.php" class="btn button">Sign In</a>
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
		<?php include 'jquery.php'; ?>

	</body>
</html>