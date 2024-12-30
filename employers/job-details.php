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
else{?>
<!doctype html>
<html>
<head>
<title>Job Details | Employers</title>
<link href="../css/custom.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../css/color.css" rel="stylesheet" type="text/css">
<link href="../css/responsive.css" rel="stylesheet" type="text/css">
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

  <!--HEADER START-->
  <?php include('includes/header.php');?>
  <!--HEADER END--> 
  <!--INNER BANNER START-->

  <section id="inner-banner">

    <div class="container">

      <h1>Job Details</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main"> 

    <!--RECENT JOB SECTION START-->

    <section class="recent-row padd-tb job-detail">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-8">
            <div id="content-area">

<?php
//Getting Jobid
$jid=intval($_GET['jobid']);
//Geeting Employer Id
$empid=$_SESSION['emplogin'];
// Fetching jobs
$sql = "SELECT tbljobs.*,tblemployers.CompnayLogo from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId  where tbljobs.employerId=:eid and tbljobs.jobId=:jid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query-> bindParam(':jid', $jid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
 ?>

              <div class="box">
                <div class="thumb">

        <a href="#">
          <img src="employerslogo/<?php echo htmlentities($result->CompnayLogo);?>" alt="img" width="165" height="165"></a></div>
                <div class="text-col">

<h2><?php echo htmlentities($result->jobTitle);?></h2>
  <p>Required Exp : <?php echo htmlentities($result->experience);?></p>

<a class="text"><i class="fa fa-map-marker"></i><?php echo htmlentities($result->jobLocation);?></a> 

<a class="text"><i class="fa fa-calendar"></i><?php echo htmlentities($result->postinDate); ?></a> 

<strong class="price"><i class="fa fa-money"></i>$<?php echo htmlentities($result->salaryPackage); ?></strong>

<div class="clearfix"> 
  <!--Full Time -->
<?php if($result->jobType=='Full Time'):?>
<a class="btn-1 btn-color-2 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?>

<!--Part Time -->
<?php if($result->jobType=='Part Time'):?>
<a class="btn-1 btn-color-1 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?>

<!--Half Time -->
<?php if($result->jobType=='Half Time'):?>
<a class="btn-1 btn-color-3 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?>

<!--Freelance -->
<!-- <?php if($result->jobType=='Freelance'):?>
<a class="btn-1 btn-color-3 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?> -->

<!--Contract -->
<?php if($result->jobType=='Contract'):?>
<a class="btn-1 btn-color-4 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?>

<!--Internship -->
<?php if($result->jobType=='Internship'):?>
<a class="btn-1 btn-color-2 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?>


<!--Temporary -->
<?php if($result->jobType=='Temporary'):?>
<a class="btn-1 btn-color-4 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?></a> 
</div>

</div>

<div class="clearfix">

<h4>Skills Required</h4>

<p><?php echo htmlentities($result->skillsRequired); ?> </p>

<h4>Description</h4>

<p><?php echo $result->jobDescription; ?></p>

<a href="#" class="btn-style-1 style-big">List of Canditates apllied for this job</a> </div>

              </div>
<?php }} ?>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!--MAIN END--> 

  

  <!--FOOTER START-->
  <?php include('includes/footer.php');?>

</div>

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
<?php }?>
