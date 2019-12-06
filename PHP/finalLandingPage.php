<?php

define("MAIN_APP_RUN", true);
require_once("library.php");

if(isset($_POST["add_user"])) {
	if ($_POST["password"] == $_POST["passwordConfirm"]) {
		$successful = registerUser($_POST["username"], $_POST["real_name"], $_POST["password"], $_POST["group_name"], $_POST["group_id"]);
		$message = $successful["message"];
		echo "<script type='text/javascript'>window.onload = function() { alert('$message'); };</script>";
	} else {
		$message = "Passwords did not match";
		echo "<script type='text/javascript'>window.onload = function() { alert('$message'); };</script>";
	}
} else if (isset($_POST["log_out"])) {
	$successful = logoutUser();
}

?>


<!DOCTYPE HTML>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../landingpage/landingPage.css">
    <title>Collude.IT</title>
  </head>
  <body>
    <!--Navigation Bar-->
	<header class="navbar navbar-expand-sm navbar-light">
		<a class="navbar-brand" href="#" >
    	    <img src="../res/logo2.png" width="60" height="50" class="d-inline-block align-top" alt="">
      	</a>

      <!--Toggle Button-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
          <span class="navbar-toggler-icon"></span>
      </button>

      <!--Navigation Links-->
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        </ul>
        <!--Log in and Sign up link-->

      </div>
      <a class="headerMenuLink mr-3" href="#" data-toggle="modal" data-target="#modalLoginForm">Log In</a>
      <a class="headerMenuLink d-inline-block border border-gray-dark rounded-1 px-2 py-1" href="#" data-toggle="modal" data-target="#modalRegisterForm">Sign Up</a>
    </header>

    <div class ="leftSect">
    	<h2 class = "mt-5"> Collude.it </h1>
    	<h2 class = "mt-1"> Small team collaboration. </h1>
    	<h2 class = "mt-1"> Built by our team, for your team. </h1>

	</div>
    <div class ="rightSect">
	    <h1 class = "mt-4"> Collude.IT </h1>
	    <div class="text-center mt-4" class = "mainBody">
	      <img src="../res/logo.png" class="img-fluid" width="400" height="400" class="rounded" draggable = "false" alt="...">
		  <div class="justify-content-center">
		    <div class="text-center mt-2">
		      <button href="#" data-toggle="modal" data-target="#modalLoginForm" class="GetStartedBtn">Login</button>
		    </div>
		    <div class="text-center mt-2">
		      <button href="#" data-toggle="modal" data-target="#modalRegisterForm" class="GetStartedBtn">Sign-Up</button>
		    </div>
		  </div>
	    </div>
	</div>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header text-center">
		        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form class="modal-body mx-3" method="POST" action="finalHomePage.php">
		        <div class="md-form mb-3">
		          <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
		          <label for="loginUsername">Username:</label>
                  <input type="text" id="loginUsername" class="form-control validate" placeholder="Please enter username" name="username">
		        </div>

		        <div class="md-form mb-3">
		          <!-- <i class="fas fa-lock prefix grey-text"></i> -->
		          <label for="loginPassword">Password:</label>
				  <input type="password" id="loginPassword" class="form-control validate" placeholder="Please enter password" name="password">
				</div>
				
				<div class="modal-footer d-flex justify-content-center">
		            <input type="submit" class="btn btn-default" name="login" value="Log In">
				</div>
              </form>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header text-center">
		        <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form class="modal-body mx-3" method="POST" action="finalLandingPage.PHP">
		        <div class="md-form mb-3">
		          <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
		          <label for="inputUsername">Username:</label>
		          <input type="text" class="form-control" id="inputEmail" placeholder="Please enter username" name="username">
		        </div>
		        <div class="md-form mb-3">
		          <!-- <i class="fas fa-user prefix grey-text"></i> -->
		          <label for="inputFullName">Name:</label>
		          <input type="text" class="form-control" id="inputFullName" placeholder="Please enter full name" name="real_name">
		        </div>
		        <div class="md-form mb-3">
		          <!-- <i class="fas fa-user prefix grey-text"></i> -->
		          <label for="inputPassword">Password (At least 12 characters):</label>
		          <input type="password" class="form-control" id="inputPassword" placeholder="Please enter password" name="password">
		        </div>
				<div class="md-form mb-3">
		          <!-- <i class="fas fa-user prefix grey-text"></i> -->
		          <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" name="passwordConfirm">
				</div>
				<div class="md-form mb-3">
				  <!-- <i class="fas fa-user prefix grey-text"></i> -->
				  <label for="inputPassword">Group ID: Enter ID for Group</label>
		          <input type="text" class="form-control" id="inputGroupID" placeholder="Enter Group ID" name="group_id">
				</div>
				<div class="md-form mb-3">
				  <!-- <i class="fas fa-user prefix grey-text"></i> -->
				  <label for="inputPassword">Group Name: Enter a Name to Create a New Group</label>
		          <input type="text" class="form-control" id="inputGroupName" placeholder="Enter Group Name" name="group_name">
		        </div>
                <div class="modal-footer d-flex justify-content-center">
		            <input type="submit" class="btn btn-deep-orange" name="add_user" value="Sign Up">
				</div>
              </form>
		      
		    </div>
		  </div>
		</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
