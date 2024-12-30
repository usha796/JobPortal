<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


$category=$_POST['category'];
$description=$_POST['description'];


$sql="insert into tblcategory(CategoryName,Description)values(:category,:description)";
$query=$dbh->prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);


 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Category has been created.")</script>';
echo "<script>window.location.href ='manage-category.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!doctype html>
 <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
 <title>Job Portal - Add Category</title>
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
                    <h2 class="content-heading">Add Category</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Add Category</h3>
                                   
                                </div>
                                <div class="block-content">
                                   
                                    <form method="post">
                                        
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Category:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" value="" name="category" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">Category Description:</label>
                                            <div class="col-12">
                                                 <textarea class="form-control" rows="5" name="description" required="true"></textarea>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success" name="submit"> ADD
                                                    <!-- <i class="fa fa-plus mr-5"></i> Add -->
                                                </button>
                                            </div>
                                        </div>
                                    </form>

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