<?php
session_start();
error_reporting(0);

include('includes/config.php');
$vid=$_GET['viewid'];
?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Job Portal || Home Page</title>

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
<?php include_once('includes/header.php');?>
  <!--HEADER END--> 

  <!--MAIN START-->

  <div id="main"> 

    <!--POPULAR JOB CATEGORIES START-->

   

    <!--POPULAR JOB CATEGORIES END--> 

    

    <!--RECENT JOB SECTION START-->

    <section class="recent-row padd-tb">

      <div class="container">

        <div class="row">

          <div class="col-md-12 col-sm-8">

            <div id="content-area">
             

              <h2 style="color: red">Job search against <?php  echo htmlentities($_POST['jobtitle']);?></h2> 
<hr />
              <ul id="myList">

                <li>
<?php
$jobtitle=$_POST['jobtitle'];
$company=$_POST['company'];
         if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }
        // Formula for pagination
        $no_of_records_per_page = 10;
        $offset = ($page_no-1) * $no_of_records_per_page;
        $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 
$ret = "SELECT jobId FROM tbljobs join tblemployers on tblemployers.id=tbljobs.employerId where (tbljobs.jobTitle like '%$jobtitle%' || tblemployers.CompnayName='$company') and isActive='1'";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1
  $vid=$_GET['viewid'];
$sql="SELECT tbljobs.*,tblemployers.CompnayLogo,tblemployers.CompnayName from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId where (tbljobs.jobTitle like '%$jobtitle%' || tblemployers.CompnayName='$company') and isActive='1' order by jobId desc  LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);
// $query->bindParam(':jobtitle',$jobtitle,PDO::PARAM_STR);
// $query->bindParam(':company',$company,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>

  
                  <div class="box">

                    <div class="thumb"><a href="jobs-details.php?jid=<?php echo ($row->jobId);?>"><img src="employers/employerslogo/<?php echo $row->CompnayLogo;?>" width="100" height="100"></a></div>

                    <div class="text-col">

                      <h4><a href="jobs-details.php?jid=<?php echo ($row->jobId);?>"><?php  echo htmlentities($row->jobTitle);?></a></h4>

                      <p><?php  echo htmlentities($row->CompnayName);?></p>

                      <a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="text"><i class="fa fa-map-marker"></i><?php  echo htmlentities($row->jobLocation);?></a> <a href="#" class="text"><i class="fa fa-calendar"></i><?php  echo htmlentities($row->postinDate);?> </a> </div>

                    <strong class="price"><i class="fa fa-money"></i>$<?php  echo htmlentities($row->salaryPackage);?></strong> 
                    <?php if($row->jobType=="Full Time"){ ?><a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-2 ripple"><?php  echo htmlentities($row->jobType);?></a>
<?php } if($row->jobType=="Contract") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-4 ripple"><?php  echo htmlentities($row->jobType);?></a>
<?php } if($row->jobType=="Freelance") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-3 ripple"><?php  echo htmlentities($row->jobType);?></a>
<?php } if($row->jobType=="Part Time") { ?>
<a href="jobs-details.php?jid=<?php echo ($row->jobId);?>" class="btn-1 btn-color-1 ripple"><?php  echo htmlentities($row->jobType);?></a>

<?php } ?> 
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

    

    <!--CALL TO ACTION SECTION START-->

    <section class="call-action-section">

      <div class="container">

        <div class="text-box">

          <h2>Better Results with Standardized Hiring Process</h2>

          <p>Your quality of hire increases when you treat everyone fairly and equally. Having multiple recruiters

            working on your hiring is beneficial.</p>

        </div>

        <a href="#" class="btn-get">Get Registered &amp; Try Now</a> </div>

    </section>

    <!--CALL TO ACTION SECTION END--> 
  </div>

  <!--MAIN END--> 

  

  <!--FOOTER START-->
<?php include_once('includes/footer.php');?>
  <!--FOOTER END--> 

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

<!--CUSTOM JS--> 

<script src="js/custom.js"></script>

</body>

</html>

