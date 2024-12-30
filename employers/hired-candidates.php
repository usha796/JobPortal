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
else{?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Jobportal-Candidates Profiles</title>

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

      <h1>Latest Resumes</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 
  <!--SEARCH BAR SECTION START-->

  <section class="candidates-search-bar">

    <div class="container">

      <form action="candidates-search.php" method="post">

        <div class="row">

          <div class="col-md-10">

            <input type="text" placeholder="Enter Job Title" name="jobtitle">

          </div>
          <div class="col-md-2">

            <button type="submit" name="search"><i class="fa fa-search"></i></button>

          </div>

        </div>

      </form>

    </div>

  </section>

  <!--SEARCH BAR SECTION END--> 

  

  <!--MAIN START-->

  <div id="main"> 

    <!--RECENT JOB SECTION START-->

    <section class="resumes-section padd-tb">

      <div class="container">

        <div class="row">

          <div class="col-md-12 col-sm-8">

            <div class="resumes-content">
              <h2>Showing Resumes of Hired Candidates</h2>

              <div class="box">
<?php
$eid=$_SESSION['emplogin'];
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
$ret = "SELECT tbljobs.jobId FROM tblapplyjob join tbljobs on tblapplyjob.JobId=tbljobs.jobId join tbljobseekers  on tblapplyjob.UserId=tbljobseekers.id where tbljobs.employerId=:eid and (tblapplyjob.Status='Hired')";
$query1 = $dbh -> prepare($ret);
$query1-> bindParam(':eid', $eid, PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1


$sql="SELECT tbljobseekers.*,tbljobs.*,tblapplyjob.Status, tblapplyjob.UserId, tblapplyjob.JobId,tblapplyjob.Applydate, tblapplyjob.ResponseDate from tblapplyjob join tbljobs on tblapplyjob.JobId=tbljobs.jobId join tbljobseekers  on tblapplyjob.UserId=tbljobseekers.id where tbljobs.employerId=:eid and (tblapplyjob.Status='Hired') order by tblapplyjob.id desc  LIMIT $offset, $no_of_records_per_page";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <div class="frame"> <?php if($row->ProfilePic==''): ?>
            <img src="../images/account.png" width="60" height="60" >
          <?php  else: ?>
 <img src="../images/<?php echo $row->ProfilePic;?>" width="100" height="100" >
          <?php endif;?>
        </div>

                <div class="text-box">

                  <h2><a href="#"><?php echo htmlentities($row->FullName);?></a></h2>


                  <h4>Applied Date: <?php echo htmlentities($row->Applydate);?></h4>
<h4><a href="#">Applied For Job: <?php echo htmlentities($row->jobTitle);?>(<?php echo htmlentities($row->jobType);?>)</a></h4>
                  <div class="clearfix"> <strong><i class="fa fa-phone"></i><?php echo htmlentities($row->ContactNumber);?></strong> <strong><i class="fa fa-envelope"></i><a href="#"><?php echo htmlentities($row->EmailId);?></a></strong> </div>

                  <div class="tags"> <a href="#"><i class="fa fa-tags"></i><?php  
if($row->Status=="")
{
  echo "Not Responded Yet";
}
else
{
  echo $pstatus=$row->Status;
}

     ;?></a>  </div>


                  <div class="btn-row"> <a href="../Jobseekersresumes/<?php echo htmlentities($row->Resume);?>" class="resume" target="_blank"><i class="fa fa-file-text-o"></i>Resume</a> 
                    <a href="candidates-details.php?canid=<?php echo ($row->id);?>" class="contact" target="_blank">View Candidate Detail</a> 
                    <a href="app-details.php?jobid=<?php echo ($row->JobId);?> && name=<?php echo htmlentities ($row->FullName);?>&& jsid=<?php echo htmlentities ($row->id);?>" class="login" target="_blank">Application Details</a></div>

                </div>
                <hr />
<?php $cnt=$cnt+1;}} else{ ?>
<h3 align="center" style="color:red;">No record found</h3>
<?php } ?>  
              </div>
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

<!--WRAPPER END--> 



<!--jQuery START--> 

<!--JQUERY MIN JS--> 

<script src="../js/jquery-1.11.3.min.js"></script> 

<!--BOOTSTRAP JS--> 

<script src="../js/bootstrap.min.js"></script> 

<!--OWL CAROUSEL JS--> 

<script src="../js/owl.carousel.min.js"></script> 

<!--BANNER ZOOM OUT IN--> 

<script src="../js/jquery.velocity.min.js"></script> 

<script src="../js/jquery.kenburnsy.js"></script> 

<!--SCROLL FOR SIDEBAR NAVIGATION--> 

<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script> 

<!--FOR CHECKBOX--> 

<script src="../js/form.js"></script> 

<script src="../js/custom.js"></script>

</body>

</html>
<?php }?>
