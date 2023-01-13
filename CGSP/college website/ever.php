<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
    <style>*{
    padding: 0; /* Reset all padding to 0 */
    margin: 0; /* Reset all margin to 0 */
}
  
body{
    background: #F9F9F9; /* Set HTML background color */
    font: 14px "Lucida Grande";  /* Set global font size & family */
    color: #464646; /* Set global text color */
}
  
p{
    margin: 10px 0px 10px 0px; /* Add some padding to the top and bottom of the <p> tags */
}
  
/* Header */
  
#header{
    height: 45px; /* Set header height */
    background: #464646; /* Set header background color */
}
  
#header h3{
    color: #FFFFF3; /* Set header heading(top left title ) color */
    padding: 10px; /* Set padding, to center it within the header */
    font-weight: normal; /* Set font weight to normal, default it was set to bold */
}
  
/* Wrap */
  
#wrap{
    background: #FFFFFF; /* Set content background to white */
    width: 615px; /* Set the width of our content area */
    margin: 0 auto; /* Center our content in our browser */
    margin-top: 50px; /* Margin top to make some space between the header and the content */
    padding: 10px; /* Padding to make some more space for our text */
    border: 1px solid #DFDFDF; /* Small border for the finishing touch */
    text-align: center; /* Center our content text */
}
  
#wrap h3{
    font: italic 22px Georgia; /* Set font for our heading 2 that will be displayed in our wrap */
}
  
/* Form & Input field styles */
  
form{
    margin-top: 10px; /* Make some more distance away from the description text */
}
  
form .submit_button{
    background: #F9F9F9; /* Set button background */
    border: 1px solid #DFDFDF; /* Small border around our submit button */
    padding: 8px; /* Add some more space around our button text */
}
#wrap .statusmsg{
    font-size: 12px; /* Set message font size  */
    padding: 3px; /* Some padding to make some more space for our text  */
    background: #EDEDED; /* Add a background color to our status message   */
    border: 1px solid #DFDFDF; /* Add a border arround our status message   */
}
input{
    font: normal 16px Georgia; /* Set font for our input fields */
    border: 1px solid #DFDFDF; /* Small border around our input field */
    padding: 8px; /* Add some more space around our text */
}</style>
    <title>NETTUTS > Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- start header div -->
    <div id="header">
        <h3>NETTUTS > Sign up</h3>
    </div>
    <!-- end header div -->  
      
    <!-- start wrap div -->  
    <div id="wrap">
          
        <!-- start php code -->
        <?php
  
  define('DB_SERVER','localhost');
  define('DB_USER','root');
  define('DB_PASS' ,'');
  define('DB_NAME', 'Grievance');
  $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

  if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
    $name =  mysqli_real_escape_string($con, $_POST['name']); // Turn our post into a local variable
    $email = mysqli_real_escape_string($con, $_POST['email']); // Turn our post into a local variable
}
if(!mb_eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    // Return Error - Invalid Email
    $msg = 'The email you have entered is invalid, please try again.';
}else{
    // Return Success - Valid Email
    $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
    $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
    // Example output: f4552671f8909587cf485ea990207f3b
}$password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
// Example output: 4568
mysqli_query("INSERT INTO users (username, password, email, hash) VALUES(
    '". mysqli_escape_string($name) ."', 
    '". mysqli_escape_string(password_hash($password)) ."', 
    '". mysqli_escape_string($email) ."', 
    '". mysqli_escape_string($hash) ."') ") or die(mysql_error());
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
  
            
?>
        <!-- stop php code -->
      
        <!-- title and description -->   
        <h3>Signup Form</h3>
        <p>Please enter your name and email addres to create your account</p>
        <?php 
    if(isset($msg)){  // Check if $msg is not empty
        echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".
    } 
?>
        <!-- start sign up form -->  
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="" />
            <label for="email">Email:</label>
            <input type="text" name="email" value="" />
              
            <input type="submit" class="submit_button" value="Sign up" />
        </form>
        <!-- end sign up form -->
          
    </div>
    <!-- end wrap div -->
</body>
</html>