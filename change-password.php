<?php
session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
//verifying Session
if(strlen($_SESSION['jsid'])==0)
  { 
header('location:logout.php');
}
else{
if(isset($_POST['change']))
{
//Getting User Id
$uid=$_SESSION['jsid'];
// Getting Post Values
$currentpassword=$_POST['currentpassword'];
$newpassword=$_POST['newpassword'];
//new password hasing 
$options = ['cost' => 12];
$hashednewpass=password_hash($newpassword, PASSWORD_BCRYPT, $options);

  // Fetch data from database on the basis of Employee session if
    $sql ="SELECT Password FROM tbljobseekers WHERE (id=:uid )";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $row) {
$hashpass=$row->Password;
}
//if current password verfied new password wil be updated in the databse
if (password_verify($currentpassword, $hashpass)) {
$sql="update  tbljobseekers set Password=:hashednewpass where id=:uid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':hashednewpass',$hashednewpass,PDO::PARAM_STR);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();


echo '<script>alert("Your password successully changed")</script>';
} else {
echo '<script>alert("Your current password is wrong")</script>';

}
}


}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Job Portal | User Change Password</title>
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/editor.css" type="text/css" rel="stylesheet"/>
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
</head>

<body class="theme-style-1">
<div id="wrapper"> 
<!--HEADER START-->
 <?php include('includes/header.php');?>
<!--HEADER END--> 

  
  <!--INNER BANNER START-->
  <section id="inner-banner">

    <div class="container">

      <h1>Change Password</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main">
    <!--Signup FORM START-->
    <form name="chngpwd" enctype="multipart/form-data" method="post" onSubmit="return valid();">
    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->
     <?php if(@$error){ ?><div class="errorWrap">
        <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>Success</strong> : <?php echo htmlentities($msg);?></div><?php } ?>





<div class="row">

<div class="col-md-6 col-sm-6">
<label>Current Password</label>
<input type="password" name="currentpassword" required>
</div>
</div>
<div class="row">
<div class="col-md-6 col-sm-6">
<label>New Password</label>
<input type="password"  name="newpassword" required>
</div>
</div>


<div class="row">

<div class="col-md-6 col-sm-6">
<label>Confirm Password</label>
<input type="password" name="confirmpassword" required>
</div>
</div>    <div class="col-md-12">

              <div class="btn-col">

                <input type="submit" name="change" value="Change">

              </div>

            </div>

          </div>

    

      </div>

    </section>
    </form>
    <!--RESUME FORM END--> 

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
<script src="js/editor.js"></script> 
<script src="js/jquery.accordion.js"></script> 
<script src="js/jquery.noconflict.js"></script> 
<script src="js/theme-scripts.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>
<?php }
?>

