<?php
session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
//verifying Session
if(strlen($_SESSION['emplogin'])==0)
  { 
header('location:logout.php');
}
else{ ?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Jobseekers |  Profile </title>

<!--CUSTOM CSS-->

<link href="../css/custom.css" rel="stylesheet" type="text/css">

<!--BOOTSTRAP CSS-->

<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">

<!--COLOR CSS-->

<link href="../css/color.css" rel="stylesheet" type="text/css">

<!--RESPONSIVE CSS-->

<link href="../css/responsive.css" rel="stylesheet" type="text/css">

<!--OWL CAROUSEL CSS-->

<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">

<!--FONTAWESOME CSS-->

<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--SCROLL FOR SIDEBAR NAVIGATION-->

<link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">

<!--FAVICON ICON-->

<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<!--GOOGLE FONTS-->

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

  <!--HEADER START-->

 <?php include('includes/header.php');?>

  <!--HEADER END--> 

  

  <!--INNER BANNER START-->
<?php
//Getting User Id
$canid=$_GET['canid'];

// Fetching User Details
$sql = "SELECT * from  tbljobseekers  where id=:canid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':canid', $canid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{
  ?>
  <section id="inner-banner">

    <div class="container">

      <h1><?php echo htmlentities($result->FullName);?>'s Profile</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main"> 

    <!--RECENT JOB SECTION START-->

    <section class="resumes-section padd-tb">

      <div class="container">

        <div class="row">

          <div class="col-md-12 col-sm-8">

            <div class="resumes-content">

              <div class="box">

                <div class="frame">
              <?php if($row->ProfilePic==''): ?>
            <img src="../images/account.png" width="60" height="60" >
          <?php  else: ?>
 <img src="../images/<?php echo $row->ProfilePic;?>" width="100" height="100" >
          <?php endif;?></div>

            


     <div class="text-box">

                  <h2><a href="#"><?php echo htmlentities($result->FullName);?></a></h2>


                  <h4>Reg Date: <?php echo htmlentities($result->RegDate);?></h4>

                  <div class="clearfix"> <strong><i class="fa fa-envelope"></i><?php echo htmlentities($result->EmailId);?></strong> <strong>
                    <i class="fa fa-phone"></i><a href="#"><?php echo htmlentities($result->ContactNumber);?></a></strong> </div>

                  <div class="btn-row"> 
                    <a href="../Jobseekersresumes/<?php echo htmlentities($result->Resume);?>" class="resume" target="_blank">
                      <i class="fa fa-file-text-o"></i>Resume</a></div>

                </div>


              </div>

              <div class="summary-box">

                <h4>Summary</h4>

                <p><?php echo htmlentities($result->AboutMe);?>.</p>

               

              </div>
<?php } ?>
              <div class="summary-box">

                <h4>Qualifications</h4>
<?php
//Getting User Id
$canid=$_GET['canid'];
// Fetching User Education Details
$sql = "SELECT * from  tbleducation  where UserID=:canid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':canid', $canid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{
 ?>
                <div class="outer"> <strong class="title"><?php echo htmlentities($result->Qualification);?></strong>

                  <div class="col"> <span><?php echo htmlentities($result->PassingYear);?></span>

                    <p><strong style="color: blue">College/ School Name</strong>: <?php echo htmlentities($result->ClgorschName);?></p>
                    <p><strong style="color: blue">Stream</strong>: <?php echo htmlentities($result->Stream);?></p>
                    <p><strong style="color: blue">CGPA</strong>: <?php echo htmlentities($result->CGPA);?></p>
                    <p><strong style="color: blue">Percentage</strong>: <?php echo htmlentities($result->Percentage);?></p>
                  </div>

                </div>

              
               
<?php } ?>
              </div>

              <div class="summary-box">

                <h4>Work Experience</h4>
<?php
//Getting User Id
$canid=$_GET['canid'];
// Fetching User Education Details
$sql = "SELECT * from  tblexperience  where UserID=:canid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':canid', $canid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{
 ?>
                <div class="outer"> <strong class="title"><?php echo htmlentities($result->Designation);?> at <b>(<?php echo htmlentities($result->EmployerName);?>)</b></strong>

                  <div class="col"> <span><?php echo htmlentities($result->FromDate);?> - <?php echo htmlentities($result->ToDate);?></span>

                   <p><strong style="color: blue">Type of Employment: </strong>: <?php echo htmlentities($result->EmployementType);?></p>
                   <p><strong style="color: blue">CTC: </strong>: <?php echo htmlentities($result->Ctc);?>(per month)</p>
                    <p><strong style="color: blue">Skills: </strong>: <?php echo htmlentities($result->Skills);?></p>

                  </div>

                </div>

               

               
<?php } ?>
              </div>

              

            </div>

          </div>



        </div>

      </div>

    </section>

    <!--RECENT JOB SECTION END--> 

  </div>

  <!--MAIN END--> 

  

  <!--FOOTER START-->
 <?php include('includes/footer.php');?>

  <!--FOOTER END--> 

</div>

<!--WRAPPER END--> 




<script src="../js/jquery-1.11.3.min.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/owl.carousel.min.js"></script> 
<script src="../js/jquery.velocity.min.js"></script> 
<script src="../js/jquery.kenburnsy.js"></script> 
<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="../js/form.js"></script> 
<script src="../js/custom.js"></script>
</body>
</html>
<?php } ?>

