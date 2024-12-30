<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if(strlen($_SESSION['emplogin'])==0)
  { 
header('location:emp-login.php');
}
else{
if(isset($_POST['update']))
{
//getting logo
$logo=$_FILES["logofile"]["name"];
// get the image extension
$extension = substr($logo,strlen($logo)-4,strlen($logo));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid logo format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$logoname=md5($logo).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["logofile"]["tmp_name"],"employerslogo/".$logoname);

//Getting Employer Id
$empid=$_SESSION['emplogin'];

$sql="update  tblemployers set CompnayLogo=:logoname where id=:eid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':logoname',$logoname,PDO::PARAM_STR);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query->execute();

$msg="Logo updated Successfully";

}

}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employers | Update Account Details</title>
<link href="../css/custom.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../css/color.css" rel="stylesheet" type="text/css">
<link href="../css/responsive.css" rel="stylesheet" type="text/css">
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/editor.css" type="text/css" rel="stylesheet"/>
<link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
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

      <h1>Company logo</h1>

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
$empid=$_SESSION['emplogin'];
// Fetching jobs
$sql = "SELECT CompnayLogo from  tblemployers  where id=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{


 ?>





<div class="col-md-6 col-sm-6">
<label>Current Company Logo</label>
<img src="employerslogo/<?php echo htmlentities($result->CompnayLogo)?>" width="200"><br />
</div>


<div class="col-md-6 col-sm-12">
<label>New Logo</label>
<div class="upload-box">
<div class="hold">
<input type="file" name="logofile"  required>
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


<script src="../js/jquery-1.11.3.min.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/owl.carousel.min.js"></script> 
<script src="../js/jquery.velocity.min.js"></script> 
<script src="../js/jquery.kenburnsy.js"></script> 
<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="../js/editor.js"></script> 
<script src="../js/jquery.accordion.js"></script> 
<script src="../js/jquery.noconflict.js"></script> 
<script src="../js/theme-scripts.js"></script> 
<script src="../js/custom.js"></script>
</body>
</html>
<?php }
?>

