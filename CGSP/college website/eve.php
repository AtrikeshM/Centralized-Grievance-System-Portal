<!-- start PHP code -->
<?php
  mysql_connect("localhost", "", "") or die(mysql_error()); // Connect to database server(localhost) with username and password.
  mysql_select_db("grievance") or die(mysql_error()); // Select registrations database.
// Return Success - Valid Email
$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';

	
$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
$password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
// Example output: 4568
mysql_query("INSERT INTO users (username, password, email, hash) VALUES(
    '". mysql_escape_string($name) ."', 
    '". mysql_escape_string(password_hash($password)) ."', 
    '". mysql_escape_string($email) ."', 
    '". mysql_escape_string($hash) ."') ") or die(mysql_error());
// Example output: f4552671f8909587cf485ea990207f3b

$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
  
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
------------------------
Username: '.$name.'
Password: '.$password.'
------------------------
  
Please click this link to activate your account:
http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
  
'; // Our message above including the link
                      
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

    if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
        $name = mysql_escape_string($_POST['name']); // Turn our post into a local variable
        $email = mysql_escape_string($_POST['email']); // Turn our post into a local variable
    }
    $name = mysql_escape_string($_POST['name']);
    $email = mysql_escape_string($_POST['email']);             
                  
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
        // Return Error - Invalid Email
    }else{
        // Return Success - Valid Email
    }
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
        // Return Error - Invalid Email
        $msg = 'The email you have entered is invalid, please try again.';
    }else{
        // Return Success - Valid Email
        $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
    }           
?>
<!-- stop PHP Code -->

<!-- title and description -->    
<h3>Signup Form</h3>
<p>Please enter your name and email address to create your account</p>
      
<?php 
    if(isset($msg)){  // Check if $msg is not empty
        echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".
    } 
?>
      
<!-- start sign up form -->