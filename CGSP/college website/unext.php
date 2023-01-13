<?php
session_start();
error_reporting(0);
include('config.php');



if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $mobile =  mysqli_real_escape_string($con, $_POST['Mobile']);
    $problem =  mysqli_real_escape_string($con, $_POST['Problem']);
    //  if (isset($_FILES['Files']['name']))
    //  {
    //    $file_name = $_FILES['Files']['name'];
    //    $file_tmp = $_FILES['Files']['tmp_name'];

    //    move_uploaded_file($file_tmp,"./pdf/".$file_name);

    //  }
    //  else
    //  {
        ?>
         <div class=
        "alert alert-danger alert-dismissible
         fade show text-center">
           <!-- <a class="close" data-dismiss="alert" -->
              <!-- aria-label="close">×</a> -->
          <!-- <strong>Failed!</strong> -->
              
        </div> 
       <?php
     }

$query=mysqli_query($con,"insert into userproblem(username,email,mobile,problem) values('$username','$email','$mobile','$problem')");
	if($query)
	{
        echo "<script>alert('Your Problem is successfully Registered');</script>";
        //header('location:booking-success.php');
	}

// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="unext.css">
</head>
<body>
    <nav class="text-box">
       <center> <h1>Enter Grievance</h1></center></nav>
    <div class="container">
        <form action="unext.php" method="POST" enctype="multipart/form-data">
      
          <label for="fname">User Name</label>
           <input type="text" id="fname" name="Username" > 
      
          <label for="lname">Email Address</label>
          <input type="text" id="lname" name="Email"> 
          <label for="country">Mobile No.</label>
          <input type="text" id="lname" name="Mobile"> 
        
      
          <label for="subject">PROBLEM</label>
          <textarea id="lname" name="Problem" rows="7" cols="150">
</textarea>
        <!-- <input type="text" id="lname" name="Problem"style="height:100px">  -->
          
         
         <!--<textarea id="text" name="subject"></textarea>-->
          
            <!-- <input type="file" id="myFile" accept=".pdf" title="Upload PDF" name="Files"> -->
          
          <br><br>
      
          <input type="submit" name="submit" value="Submit"></br>
      </form>
</body>
</html>