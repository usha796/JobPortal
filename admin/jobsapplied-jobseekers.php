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
        <title>Job Portal - Jobseeker Lists</title>

        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">

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
                    <h2 class="content-heading">Jobs Applied by <?php echo $_GET['jsname'];?></h2>

                   

                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Job Applied List</h3>
                                  
                                </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Full Name</th>
                                       <th>Job Title</th>
                                       <th>Job Category</th>
                                       <th>Company Name</th>
                                        <th>Applied Date</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                           
                                       </tr>
                                </thead>
                                <tbody>
                                    <?php $jsid=intval($_GET['jobsid']);
$sql="SELECT tbljobseekers.FullName,tbljobs.jobTitle,tbljobs.jobCategory,tblapplyjob.Applydate,tblapplyjob.Status,tblemployers.CompnayName from tblapplyjob
join tbljobseekers on tbljobseekers.id=tblapplyjob.UserId
join tbljobs on tbljobs.jobId=tblapplyjob.JobId
join tblemployers on tblemployers.id=tbljobs.employerId
where tblapplyjob.UserId='$jsid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <tr>
                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                        <td><?php  echo htmlentities($row->FullName);?></td>
                                        <td><?php  echo htmlentities($row->jobTitle);?></td>
                                        <td><?php  echo htmlentities($row->jobCategory);?></td>
                                         <td><?php  echo htmlentities($row->CompnayName);?></td>
                                         <td><?php  echo htmlentities($row->Applydate);?></td>
                                        <td><?php  echo htmlentities($row->Status);?></td>
                                        
                                    </tr>
                                    <?php $cnt=$cnt+1;}} ?> 
                                
                                
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full Pagination -->

                    <!-- END Dynamic Table Simple -->
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

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/be_tables_datatables.js"></script>
    </body>
</html>
<?php }  ?>