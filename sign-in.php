<?php
 session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signin']))
  {
 
    // Getting username/ email and password
    $uname=$_POST['emailmbile'];
    $password=$_POST['password'];
    // Fetch data from database on the basis of username/email and password
    $sql ="SELECT id,FullName,Password FROM tbljobseekers WHERE (EmailId=:usname || ContactNumber=:usname)";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':usname', $uname, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $row) {
$dbhashpass=$row->Password;
$_SESSION['jsid']=$row->id;
$_SESSION['jsfname']=$row->FullName;

}
//verifying Password
if (password_verify($password, $dbhashpass)) {
echo "<script type='text/javascript'> document.location ='my-profile.php'; </script>";
  } else {
echo "<script>alert('Wrong Password');</script>";
 
  }
}
//if username or email not found in database
else{
echo "<script>alert('User not registered with us');</script>";
  }
 
}
?>

<!doctype html>

<html>

<head>
<title>JobSeeker SignIn | Job Portal</title>

<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

 <?php include('includes/header.php');?>
  <!--HEADER END--> 

  <section id="inner-banner">
    <div class="container">
      <h1>Login To Your Account</h1>
    </div>
  </section>



  

  <!--MAIN START-->

  <div id="main"> 
    <!--SIGNUP SECTION START-->

    <section class="signup-section">

      <div class="container">

        <div class="holder">

          <div class="thumb"><img src="images/account.png" alt="img"></div>

          <form method="post" name="emplsignin">

            <div class="input-box"> <i class="fa fa-user"></i>

<input type="text" placeholder="Email-Id" name="emailmbile"  autocomplete="off" required>

            </div>

            <div class="input-box"> <i class="fa fa-unlock"></i>
<input type="password" class="form-control" name="password" required placeholder="Password">

            </div>

          
<div class="input-box"> 
       <input type="submit" value="Sign in" name="signin">
     </div>

            <!-- <a href="forgot-password.php" class="login">Forgot your Password</a> <b>OR</b> -->
<br>
            <div class="login-social">
              You Don't have an Account? <a href="sign-up.php">SIGN UP NOW</a></div>

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

