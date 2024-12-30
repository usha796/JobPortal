<?php
 session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signin']))
  {
 
    // Getting post values
    $email=$_POST['emailid'];
    $mobile=$_POST['mobileno'];
    $password=$_POST['password'];
    //new password hasing 
$options = ['cost' => 12];
$hashednewpass=password_hash($password, PASSWORD_BCRYPT, $options);
    // Fetch data from database on the basis of email and mobile
    $sql ="SELECT id FROM tbljobseekers WHERE (EmailId=:email and ContactNumber=:mobile)";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$sql="update  tbljobseekers set Password=:hashednewpass WHERE (EmailId=:email and ContactNumber=:mobile)";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':hashednewpass',$hashednewpass,PDO::PARAM_STR);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Password chnaged successfully');</script>";
echo "<script type='text/javascript'> document.location ='sign-in.php'; </script>";

}
//if username or email not found in database
else{
echo "<script>alert('Invalid details. Please try again');</script>";
  }
 
}
?>

<!doctype html>

<html>

<head>
<title>JobSeeker Reset Your Account Password | Job Portal</title>

<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>
</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

 <?php include('includes/header.php');?>
  <!--HEADER END--> 

  <section id="inner-banner">
    <div class="container">
      <h1>Reset Your Account Password</h1>
    </div>
  </section>



  

  <!--MAIN START-->

  <div id="main"> 
    <!--SIGNUP SECTION START-->

    <section class="signup-section">

      <div class="container">

        <div class="holder">

          <div class="thumb"><img src="images/account.png" alt="img"></div>

          <form method="post" name="changepassword" onsubmit="return checkpass();">

            <div class="input-box"> <i class="fa fa-envelope-square"></i>

<input type="text" placeholder="Registered Email id" name="emailid"  autocomplete="off" required>

            </div>

 <div class="input-box"> <i class="fa fa-phone"></i>

<input type="text" placeholder="Registered mobile number" name="mobileno"  autocomplete="off" required>

            </div>

            <div class="input-box"> <i class="fa fa-unlock"></i>
<input type="password" class="form-control" name="password" id="newpassword" required placeholder="New Password">

            </div>

   <div class="input-box"> <i class="fa fa-unlock"></i>
<input type="password" class="form-control" name="password" id="confirmpassword" required placeholder="Confirm Password">

            </div>
          
<div class="input-box"> 
       <input type="submit" value="Sign in" name="signin">
     </div>

            <b>OR</b>

            <div class="login-social">
              <em>If already have an Account? <a href="sign-in.php">SIGN IN NOW</a></em> </div>

          </form>
<a href="index.php"><i class="fa fa-home" aria-hidden="true" style="font-size: 30px;padding-top: 10px"></i>  Back Home!!!</a>
        </div>

      </div>

    </section>

    <!--SIGNUP SECTION END--> 

    

  </div>

  <!--MAIN END--> 

  

  <!--FOOTER START-->
  <?php include('includes/footer.php');?>
  <!--FOOTER END--> 

</div>

<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/jquery.velocity.min.js"></script> 
<script src="js/jquery.kenburnsy.js"></script> 
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="js/jquery.noconflict.js"></script> 
<script src="js/theme-scripts.js"></script> 
<script src="js/form.js"></script> 
<script src="js/custom.js"></script>

</body>

</html>

