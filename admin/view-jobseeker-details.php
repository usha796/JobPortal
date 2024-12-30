<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
  } else{
 

?>
<!doctype html>
 <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
 <title>Job Portal - View Job Seeker</title>
<link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

</head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
     

             <?php include_once('includes/sidebar.php');?>

          <?php include_once('includes/header.php');?>

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                
                    <!-- Register Forms -->
                    <h2 class="content-heading">View Jobseeker Details</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">View Jobseeker Details</h3>
                                
                                </div>
                                <div class="block-content">
                                   
                                    <?php
                  $vid=$_GET['viewid'];

$sql="SELECT * from tbljobseekers where id=:vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                            <tr>
    <th>Full Name</th>
    <td><?php  echo $row->FullName;?></td>
    <th>Email ID</th>
    <td><?php  echo $row->EmailId;?></td>
  </tr>
  

  <tr>
    <th>Contact Number</th>
    <td><?php  echo $row->ContactNumber;?></td>
   <th>Resume</th>
    <td><a href="../Jobseekersresumes/<?php echo htmlentities($row->Resume);?>" width="100" height="100" target="_blank">Resume</a></td>
   
  </tr>
  <tr>
    <th colspan="6" style="text-align: center;color: blue">About Job Seeker</th></tr>
    <tr>
    <td colspan="6"><?php  echo $row->AboutMe;?></td>
  </tr>
   <tr>
    <th>Profile Pic</th>
    <td><img src="../images/<?php echo $row->ProfilePic;?>" width="100" height="100"></td>
    <th>Skills</th>
    <td><?php  echo $row->Skills;?></td>
    
  </tr>
    
<?php $cnt=$cnt+1;}} ?>

</table> 


                                </div>
                            </div>
                            <!-- END Bootstrap Register -->
                        </div>
                        
                       </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

          <?php include_once('includes/footer.php');?>
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>
    </body>
</html>
<?php }  ?>