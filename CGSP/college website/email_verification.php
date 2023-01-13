<?php
include 'emailverify/config.php';
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=$_GET['code'];
$sql=mysqli_query($con,"SELECT * FROM user WHERE otp='$code'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
$st='no';
$result =mysqli_query($con,"SELECT id FROM user WHERE otp='$code' and status='$st'");
$result4=mysqli_fetch_array($result);
if($result4>0)
 {
$st='yes';
$result1=mysqli_query($con,"UPDATE user SET status='$st' WHERE otp='$code'");
echo $msg="Your account is activated";
}
else
{
echo $msg ="Your account is already active, no need to activate again";
}
}
else
{
echo $msg ="Wrong activation code.";
}
}
?>