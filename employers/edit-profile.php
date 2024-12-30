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
//Getting Post Values
$conrnper=$_POST['concernperson'];  
$emaill=$_POST['emailid']; 
$cmpnyname=$_POST['companyname']; 
$tagline=$_POST['tagline'];
$description=$_POST['description'];
$website=$_POST['website'];
$nemp=$_POST['noofempl'];
$industry=$_POST['industry'];
$bentity=$_POST['typebusinessentity'];
$location=$_POST['location'];
$estin=$_POST['estin'];
//Getting Employer Id
$empid=$_SESSION['emplogin'];

$sql="update  tblemployers set ConcernPerson=:conrnper,CompnayName=:cmpnyname,CompanyTagline=:tagline,CompnayDescription=:description,CompanyUrl=:website,noOfEmployee=:nemp,industry=:industry,typeBusinessEntity=:bentity,lcation=:location,establishedIn=:estin where id=:eid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':conrnper',$conrnper,PDO::PARAM_STR);
$query->bindParam(':cmpnyname',$cmpnyname,PDO::PARAM_STR);
$query->bindParam(':tagline',$tagline,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':website',$website,PDO::PARAM_STR);
$query->bindParam(':nemp',$nemp,PDO::PARAM_STR);
$query->bindParam(':industry',$industry,PDO::PARAM_STR);
$query->bindParam(':bentity',$bentity,PDO::PARAM_STR);
$query->bindParam(':location',$location,PDO::PARAM_STR);
$query->bindParam(':estin',$estin,PDO::PARAM_STR);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query->execute();

$msg="Account details updated Successfully";

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

      <h1>Employers Account Details</h1>

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
$sql = "SELECT * from  tblemployers  where id=:eid";
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
<label>Concern Person Name *</label>
<input type="text" name="concernperson" placeholder="Concern Person Name" required autocomplete="off" value="<?php echo htmlentities($result->ConcernPerson)?>" />
</div>

<div class="col-md-6 col-sm-6">
<label>Email *</label>
<input type="email" name="emailid" readonly  autocomplete="off" value="<?php echo htmlentities($result->EmpEmail)?>">
</div>
          
<div class="col-md-6 col-sm-6">
<label>Company Name</label>
<input type="text" name="companyname" placeholder="Enter the Name of your Company" autocomplete="off" value="<?php echo htmlentities($result->CompnayName)?>" required>
</div>

<div class="col-md-6 col-sm-6">
<label>Tagline</label>
<input type="text" name="tagline" placeholder="Briefly Describe about your Company" autocomplete="off" value="<?php echo htmlentities($result->CompanyTagline)?>" required>
</div>

 <div class="col-md-12">
<h4>Description</h4>
<div class="text-editor-box">
<textarea  name="description" autocomplete="off"  required><?php echo $result->CompnayDescription; ?></textarea>
</div>
</div>

         

<div class="col-md-6 col-sm-6">
<label>Website</label>
 <input type="url" name="website" placeholder="e.g. http://www.jobsalert.com" autocomplete="off" value="<?php echo htmlentities($result->CompanyUrl)?>" >
</div>

          
<div class="col-md-6 col-sm-6">
<label>No. of Employees</label>
 <input type="text" name="noofempl" placeholder="e.g. 100" autocomplete="off" value="<?php echo htmlentities($result->noOfEmployee)?>" >
</div>

<div class="col-md-6 col-sm-6">
<label>Industry</label>
 <input type="text" name="industry" placeholder="Hotel/Trekking Agency" autocomplete="off" value="<?php echo htmlentities($result->industry)?>">
</div>

          
<div class="col-md-6 col-sm-6">
<label>Type of Business Entity</label>
 <input type="text" name="typebusinessentity" placeholder="e.g. Sole Proprietorship,Partnership" autocomplete="off" value="<?php echo htmlentities($result->typeBusinessEntity)?>">
</div>

<div class="col-md-6 col-sm-6">
<label>Location</label>
 <input type="text" name="location" placeholder="e.g. Kathmandu,Pokhara" autocomplete="off" value="<?php echo htmlentities($result->lcation)?>">
</div>

<div class="col-md-6 col-sm-6">
<label>Established In</label>
 <input type="text" name="estin" placeholder="13th August,2001" autocomplete="off" value="<?php echo htmlentities($result->establishedIn)?>">
</div>


<div class="col-md-6 col-sm-6">
<label>Company Logo</label>
<img src="employerslogo/<?php echo htmlentities($result->CompnayLogo)?>" width="200"><br />
<a href="change-logo.php">Change Logo</a>
</div>

</div>


<?php 
}}
?>

            <div class="col-md-12">

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

