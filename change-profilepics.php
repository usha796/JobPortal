<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if(strlen($_SESSION['jsid'])==0)
  { 
header('location:emp-login.php');
}
else{
if(isset($_POST['update']))
{
//getting logo
$img=$_FILES["image"]["name"];
$uid=$_SESSION['jsid'];
$extension = substr($img,strlen($img)-4,strlen($img));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('profile image has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$img=md5($img).time().$extension;
 move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$img);

$sql="update  tbljobseekers set ProfilePic=:img where id=:uid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':img',$img,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Your profile pic has been updated")</script>';
    echo "<script>window.location.href ='profile.php'</script>";

}

}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employers | Update Account Details</title>
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
</head>

<body class="theme-style-1">
<div id="wrapper"> 
<!--HEADER START-->
 <?php include('includes/header.php');?>
<!--HEADER END--> 

  
  <!--INNER BANNER START-->
  <section id="inner-banner">

    <div class="container">

      <h1>Profile Pic</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main">
    <!--Signup FORM START-->
    <form name="empsignup" enctype="multipart/form-data" method="post">
    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->
     <?php if(@$error){ ?><div class="errorWrap">
        <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>Success</strong> : <?php echo htmlentities($msg);?></div><?php } ?>

          <div class="row">
<?php
//Getting Employer Id
$uid=$_SESSION['jsid'];

$sql = "SELECT * from  tbljobseekers  where id=:uid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{


 ?>
<div class="col-md-6 col-sm-6">
<label>Current Profile Pic</label>
<img src="images/<?php echo $result->ProfilePic;?>" width="100" height="100" value="<?php  echo $result->ProfilePic;?>"><br />
</div>


<div class="col-md-6 col-sm-12">
<label>New Profile Pic</label>
<div class="upload-box">
<div class="hold">
<input type="file" name="image"  required>
 </span> </div>
</div>
</div>


<?php 
}}
?>

            <div class="col-md-12" >

              <div class="btn-col">

                <input type="submit" name="update" value="Update">

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

