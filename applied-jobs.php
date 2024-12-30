<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['jsid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Job Portal-History of Applied Jobs</title>

<!--CUSTOM CSS-->

<link href="css/custom.css" rel="stylesheet" type="text/css">

<!--BOOTSTRAP CSS-->

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<!--COLOR CSS-->

<link href="css/color.css" rel="stylesheet" type="text/css">

<!--RESPONSIVE CSS-->

<link href="css/responsive.css" rel="stylesheet" type="text/css">

<!--OWL CAROUSEL CSS-->

<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

<!--FONTAWESOME CSS-->

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--SCROLL FOR SIDEBAR NAVIGATION-->

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
</head>



<body class="theme-style-1">

<!--WRAPPER START-->

<div id="wrapper"> 

  <!--HEADER START-->

  <?php include_once('includes/header.php');?>

  <!--HEADER END--> 

  

  <!--INNER BANNER START-->

  <section id="inner-banner">

    <div class="container">

      <h1>History of Applied Jobs</h1>

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
$uid=$_SESSION['jsid']; 

$sql="SELECT  tblapplyjob.*,tbljobs.*,tblemployers.* from tblapplyjob join tbljobs on tblapplyjob.JobId=tbljobs.jobId join tblemployers on tblemployers.id=tbljobs.employerId where tblapplyjob.UserId=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
  <hr />
              <div class="box"  style="padding-top: 20px">

                <div class="thumb"><img src="employers/employerslogo/<?php echo $row->CompnayLogo;?>" width="100" height="100" alt="img"></div>

                <div class="text-col">

                  <h2><a href="#"><?php  echo htmlentities($row->jobTitle);?></a></h2>

                  <p><?php  echo htmlentities($row->CompnayName);?> <em><a href="index.php">(View All Jobs)</a></em></p>

                  <a href="#" class="text"><i class="fa fa-map-marker"></i><?php  echo htmlentities($row->jobLocation);?></a> <a href="#" class="text"><i class="fa fa-calendar"></i><?php  echo htmlentities($row->postinDate);?> </a> <strong class="price"><i class="fa fa-money"></i>
                  Rs <?php  echo htmlentities($row->salaryPackage);?></strong>
                  <div class="tags" style="padding-top: 10px"> <a href="app-details.php?jobid=<?php echo ($row->JobId);?>"><i class="fa fa-tags"></i><?php  
if($row->Status=="")
{
  echo "Not Responded Yet";
}
else
{
  echo $pstatus=$row->Status;
}

     ;?></a>  </div>

     <div class="btn-row"> 
      <!-- <a href="Jobseekersresumes/<?php echo htmlentities($row->Resume);?>" class="resume"><i class="fa fa-file-text-o"></i>Resume</a> -->
      <a href="app-details.php?jobid=<?php echo ($row->JobId);?>" class="contact">View Detail</a></div>

                </div>            
<?php $cnt=$cnt+1;}} else{ ?>
  <h3 align="center" style="color:red">No applied for any job yet</h3>
<?php } ?>
          
              </div>

            </div>

          </div>

        
        </div>

      </div>

    </section>

    <!--RECENT JOB SECTION END--> 



  <!--MAIN END--> 

  

  <!--FOOTER START-->

 <?php include_once('includes/footer.php');?>

</div>

<!--WRAPPER END--> 



<!--jQuery START--> 

<!--JQUERY MIN JS--> 

<script src="js/jquery-1.11.3.min.js"></script> 

<!--BOOTSTRAP JS--> 

<script src="js/bootstrap.min.js"></script> 

<!--OWL CAROUSEL JS--> 

<script src="js/owl.carousel.min.js"></script> 

<!--BANNER ZOOM OUT IN--> 

<script src="js/jquery.velocity.min.js"></script> 

<script src="js/jquery.kenburnsy.js"></script> 

<!--SCROLL FOR SIDEBAR NAVIGATION--> 

<script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 

<!--FOR CHECKBOX--> 

<script src="js/form.js"></script> 

<!--CUSTOM JS--> 

<script src="js/custom.js"></script>

</body>

</html>
<?php }  ?>
