<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'grievance');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['Username']);
  $email = mysqli_real_escape_string($db, $_POST['Email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['Password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['Confirmpassword']);
  
// form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($password_2)) { array_push($errors, "Confirmpassword is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE Email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    

    if ($user['Email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
    $otp = sprintf( "%04d", rand(0,9999)); 
  	$query = "INSERT INTO user (Username,Email, Password ,otp) 
  			  VALUES('$username','$email', '$password','$otp')";
  	mysqli_query($db, $query);
    $link = 'http://localhost/college%20website/email_verification.php?code='.$otp.'';
    $to = $email;
    $subject = "Email verification link";
    $txt = "please  click on link  to verify your email";
    $headers = "From: info@college-project.com" . "\r\n" ;
    
    mail($to,$subject,$txt,$headers);
  
  	// $_SESSION['Username'] = $username;
  	// $_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {


  $recaptcha = $_POST['g-recaptcha-response'];
  
    // Put secret key here, which we get
    // from google console
    $secret_key = '6LeI6awhAAAAAF7CWAokGJuJrldOeiUAaOoVfAqh';
  
    // Hitting request to the URL, Google will
    // respond with success or error scenario
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key .'&response='. $recaptcha;
  
    // Making request to verify captcha
    $response = file_get_contents($url);
  
    // Response return by google is in
    // JSON format, so we have to parse
    // that json
    $response = json_decode($response);
  
    // Checking, if response is true or not
    if ($response->success == true) {
    $email = mysqli_real_escape_string($db, $_POST['Email']);
    $password = mysqli_real_escape_string($db, $_POST['Password']);
  
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE Email='$email' AND password='$password' AND status='yes'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['Email'] = $email;
          $_SESSION['success'] = "You are now logged in";
          header('location: unext.php');
        }else {
            array_push($errors, "Wrong email/password combination");
        }
    }
  }

  }

  ?>