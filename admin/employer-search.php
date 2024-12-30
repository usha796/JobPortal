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
        <title>Job Portal- Employer Search</title>

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
                    <h2 class="content-heading">Employer Search</h2>

                   

                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Employer Search</h3>
                                  
                                </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                            <form id="basic-form" method="post">
                                <div class="form-group">
                                    <label>Search by Company Name</label>
                                    <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Company Name"></div>
                                
                                <br>
                                <button type="submit" class="btn btn-alt-success" name="search" id="submit"><i class="fa fa-plus mr-5"></i>Search</button>
                            </form>
                            <hr />
                            <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  
  <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title" align="center">Result against "<?php echo $sdata;?>" keyword</h3>
                                  
                                </div>
                                <hr />
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                     <tr>
                                        <th class="text-center"></th>
                                        <th>Company Name</th>
                                       <th>Concern Person</th>
                                       <th>Email</th>
                                        <th>Status</th>
                                        <th class="d-none d-sm-table-cell">Registration Date</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                                       </tr>
                                </thead>
                                <tbody>
                                    <?php
$sql="SELECT * from tblemployers where CompnayName like '$sdata%'";
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
                                        <td><?php  echo htmlentities($row->CompnayName);?></td>
                                        <td><?php  echo htmlentities($row->ConcernPerson);?></td>
                                        <td><?php  echo htmlentities($row->EmpEmail);?></td>
                                        <?php if($row->Is_Active=='1'){ ?>
                                        <td><?php echo "Active"; ?></td>
                                        <?php } else { ?>

                                            <td class="font-w600"><?php echo "Inactive"; ?></td><?php } ?>

                                        <td class="d-none d-sm-table-cell"><?php  echo htmlentities($row->RegDtae);?></td>
                                        
                                         <td class="d-none d-sm-table-cell"><a href="view-employer-details.php?viewid=<?php echo htmlentities ($row->id);?>" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                   
                                
                                
                                  
                                </tbody>
                                <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
  <?php } }?>
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