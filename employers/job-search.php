<?php
session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
//verifying Session
if(strlen($_SESSION['emplogin'])==0)
  { 
header('location:emp-login.php');
}
else{
  ?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Employer | Search Job</title>

<!--CUSTOM CSS-->

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

      <h1>Employer | Search Jobs</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  

  

  <!--MAIN START-->

  <div id="main"> 


    <!--RECENT JOB SECTION START-->

    <section class="recent-row padd-tb">

      <div class="container">

        <div class="row">

          <div class="col-md-12 col-sm-8">


            <div id="content-area">

              <h2 style="color: red">Job search against <?php  echo htmlentities($_POST['jobtitle']);?></h2> 

              <ul id="myList">

<?php
$jobtitle=$_POST['jobtitle'];
//Geeting Employer Id
$empid=$_SESSION['emplogin'];
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }
        // Formula for pagination
        $no_of_records_per_page = 5;
        $offset = ($page_no-1) * $no_of_records_per_page;
        $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 
$ret = "SELECT jobId FROM tbljobs";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

// Fetching jobs
$sql = "SELECT tbljobs.*,tblemployers.CompnayLogo from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId  where employerId=:eid && tbljobs.jobTitle=:jobtitle LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query->bindParam(':jobtitle',$jobtitle,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{


 ?>

 <li>
<div class="box">
<div class="thumb">
 <!-- logo --> 
  <a href="job-details.php?jobid=<?php echo htmlentities($result->jobId);?>"><img src="employerslogo/<?php echo htmlentities($result->CompnayLogo);?>" alt="img" width="60" height="60"></a></div>

<div class="text-col">
<div class="hold" style="width:100%">

 <!-- Job Title -->  
<h4><a href="job-details.php?jobid=<?php echo htmlentities($result->jobId);?>" title='View Details'><?php echo htmlentities($result->jobTitle);?></a> --------- <em><a href="edit-job.php?jobid=<?php echo htmlentities($result->jobId);?>" title='Edit Job Details'>(Edit this job)</a></em></h4>

<!-- Job Title limit 250 chars-->  
<p> <?php echo substr($result->jobDescription,0,300);?></p>

<!-- Job Location --> 
<a href="job-details.php?jobid=<?php echo htmlentities($result->jobId);?>" class="text" title='View Details'><i class="fa fa-map-marker"></i>

  <?php echo htmlentities($result->jobLocation);?></a> 

<!-- Job Posting date --> 
<a href="job-details.php?jobid=<?php echo htmlentities($result->jobId);?>" class="text" title='View Details'><i class="fa fa-calendar"></i>
<?php echo htmlentities($result->postinDate); ?>
 </a> 

</div>
</div>

<!-- Job Package --> 
<strong class="price"><i class="fa fa-money"></i>
  <?php echo htmlentities($result->salaryPackage); ?></strong> <br />



<!-- Job Type--> 
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
<a class="btn-1 btn-color-1 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?>

<!--Freelance -->
<?php if($result->jobType=='Freelance'):?>
<a class="btn-1 btn-color-3 ripple"><?php echo htmlentities($result->jobType); ?> 
</a> 
<?php endif;?>

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
<?php endif;?>



</div>

</li>

 <?php 
$cnt=$cnt+1;
} } else { ?>
 
    <h4> No record found against this search</h4>

  
  <?php } ?>     

              </ul>

           <div align="left">
    <ul class="pagination">

<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
</li>

<?php
if ($total_no_of_pages <= 10){
for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
}
elseif($total_no_of_pages > 10){

if($page_no <= 4) {
for ($counter = 1; $counter < 8; $counter++){
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
}

elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
echo "<li><a href='?page_no=1'>1</a></li>";
echo "<li><a href='?page_no=2'>2</a></li>";
echo "<li><a>...</a></li>";
for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
}

else {
echo "<li><a href='?page_no=1'>1</a></li>";
echo "<li><a href='?page_no=2'>2</a></li>";
echo "<li><a>...</a></li>";

for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
if ($counter == $page_no) {
echo "<li class='active'><a>$counter</a></li>";
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}
}
}
}
?>

<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
</li>
<?php if($page_no < $total_no_of_pages){
echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
} ?>
</ul>
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
