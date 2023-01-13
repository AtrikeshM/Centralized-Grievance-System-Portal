<?php
include_once("emailverify/config.php");
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$status=0;
$activationcode=md5($email.time());
$query=mysqli_query($con,"insert into user(Username,Email,Password,activationcode,status) values('$name','$email','$password','$activationcode','$status')");
 if($query)
 {
$to=$email;
$msg= "Thanks for new Registration.";
$subject="Email verification (Grievance Portal)";
$headers .= "MIME-Version: 1.0"."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:Grievance Portal | <info@grievance.com>'."\r\n";
$ms.="<html></body><div><div>Dear $name,</div></br></br>";
$ms.="<div style='padding-top:8px;'>Please click The following link For verifying and activation of your account</div>
<div style='padding-top:10px;'><a href='http://locahost/COLLEGE%20WEBSITE/emailverify/email_verification.php?code=$activationcode'>Click Here</a></div>
<div style='padding-top:4px;'>Powered by Grievance Portal</div></div>
</body></html>";
mail($to,$subject,$ms,$headers);
echo "<script>alert('Registration successful, please verify in the registered Email-Id');</script>";
echo "<script>window.location = 'nlogin.php';</script>";;
}
else
{
echo "<script>alert('Data not inserted');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="wrapper">
        <div class="title-text">
           <div class="title login">
              Login Form
           </div>
           <div class="title signup">
              Signup Form
           </div>
        </div>
        <div class="form-container">
           <div class="slide-controls">
              <input type="radio" name="slide" id="login" checked>
              <input type="radio" name="slide" id="signup">
              <label for="login" class="slide login">Login</label>
              <label for="signup" class="slide signup">Signup</label>
              <div class="slider-tab"></div>
           </div>
           <div class="form-inner">
              <form action="" name="" method="post" class="login">
              
<?php session_start();

include_once("emailverify/config.php");

if(isset($_POST['login']))

{
$email=$_POST['email'];

$password=md5($_POST['password']);

$ret= mysqli_query($con,"SELECT * FROM user WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($ret);
$status=$num['status'];
if($num>0)
{	
if($status==0)
{
$_SESSION['action1']="Verify  your Email Id by clicking  the link In your mailbox";
}
else {
$_SESSION['login']=$email;
$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['name'];
$extra="unext.php";
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
else
{
$_SESSION['action1']="Invalid username or password";
$extra="nlogin.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

header("location:http://$host$uri/$extra");

exit();

}

}?><?php echo $_SESSION['action1']; ?><?php echo $_SESSION['action1']="";?>
                 <div class="field">
                    <input type="email" name="email" placeholder="Email Address" required>
                 </div>
                 <div class="field">
                    <input type="password" name="password" placeholder="Password" required>
                 </div>
                 <div class="pass-link">
                    <a href="#">Forgot password?</a>
                 </div>
                 <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" name="login" value="Login">
                 </div>
                 <div class="signup-link">
                    Not a member? <a href="">Signup now</a>
                 </div>
              </form>
              <form action="" name="insert" method="post" class="signup">
                <div class="field">
                    <input type="text" placeholder="User Name" name="name" required>
                 </div>
                 <div class="field">
                    <input type="text" placeholder="Email Address" name="email" required>
                 </div>
                 <div class="field">
                    <input type="password" placeholder="Password" name="password" required>
                 </div>
                 <div class="field">
                    <input type="password" placeholder="Confirm password" name="confirmpassword" required>
                 </div>
                 <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" name="submit" value="Signup">
                 </div>
              </form>
           </div>
        </div>
     </div>
     <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (()=>{
          loginForm.style.marginLeft = "-50%";
          loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (()=>{
          loginForm.style.marginLeft = "0%";
          loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (()=>{
          signupBtn.click();
          return false;
        });
     </script>
    
</body>
</html>