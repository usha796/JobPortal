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
else{ 
if(isset($_POST['submit']))
  {
    
    
    $jobid=$_GET['jobid'];
    $jsid=$_GET['jsid'];
    $status=$_POST['status'];
 $msg=$_POST['message'];
  

    $sql="insert into tblmessage(JobID,UserID,Message,Status) value(:jobid,:jsid,:msg,:status)";

    $query=$dbh->prepare($sql);
$query->bindParam(':jobid',$jobid,PDO::PARAM_STR); 
$query->bindParam(':jsid',$jsid,PDO::PARAM_STR); 
    $query->bindParam(':msg',$msg,PDO::PARAM_STR); 
    $query->bindParam(':status',$status,PDO::PARAM_STR); 
       $query->execute();
      $sql1= "update tblapplyjob set Status=:status where JobId=:jobid and UserId=:jsid";

    $query1=$dbh->prepare($sql1);
     $query1->bindParam(':jobid',$jobid,PDO::PARAM_STR);
      $query1->bindParam(':jsid',$jsid,PDO::PARAM_STR);
$query1->bindParam(':status',$status,PDO::PARAM_STR);

 $query1->execute();
 echo '<script>alert("Status has been updated")</script>';
 echo "<script>window.location.href ='candidates-listings.php'</script>";
}


  ?>
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

  <section id="inner-banner">

    <div class="container">

      <h1><?php echo htmlentities($_GET['name']);?>'s Application</h1>

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
 <?php
//Getting User Id
$jobid=$_GET['jobid'];
$name=$_GET['name'];
$jsid=$_GET['jsid'];
// Fetching User Details
$sql = "SELECT tbljobs.*,tblapplyjob.*  from tblapplyjob join tbljobs on tblapplyjob.JobId=tbljobs.jobId  where tbljobs.jobId=:jobid and tblapplyjob.UserId=:jsid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':jobid', $jobid, PDO::PARAM_STR);
$query-> bindParam(':jsid', $jsid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{
 ?>
              

            


     <div class="text-box">

                  <h2 style="color: red">Jobs Details</h2>


                  <table class="table table-bordered table-hover data-tables">
    <tr>
  <th>Job Title</th>
  <td><?php  echo $result->jobTitle;?></td>
  <th>Salary Package</th>
  <td>Rs<?php  echo $result->salaryPackage;?></td>
  </tr>
   <tr>
  <th>Job Descriptions</th>
  <td colspan="3"><?php  echo $result->jobDescription;?></td>
  </tr>
  <tr>
  <th>Job Location</th>
  <td><?php  echo $result->jobLocation;?></td>
  <th>Skills Required</th>
  <td><?php  echo $result->skillsRequired;?></td>
  </tr>
  <tr>
  <th>Apply Date</th>
  <td><?php  echo $result->Applydate;?></td>
  <th>Last Date</th>
  <td><?php  echo $result->JobExpdate;?></td>
  </tr>
  
  
    <th>Status</th>
    <td colspan="3"> <?php  
if($result->Status=="")
{
  echo "Not Responded Yet";
}
else
{
  echo $pstatus=$result->Status;
}

     ;?></td>
  </tr>
</table>
                </div>


              </div>
<?php  if($result->Status!=''){
$ret="select tblmessage.* from tblmessage  where tblmessage.JobID=:jobid order by tblmessage.ID desc";
$query1 = $dbh -> prepare($ret);
$query1-> bindParam(':jobid', $jobid, PDO::PARAM_STR);
$query1->execute();
$cnt=1;
$results=$query1->fetchAll(PDO::FETCH_OBJ);

 ?>
              <div class="summary-box">

                <h4>Message History</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
 
  <tr>
    <th>#</th>
<th>Message</th>
<th>Status</th>
<th>Time</th>
</tr>
<?php  
foreach($results as $row1)
{
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row1->Message;?></td> 
  <td><?php  echo $row1->Status;?></td> 
   <td><?php  echo $row1->ResponseDate;?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>

</table>
<?php  }  
if($result->Status=="" || $result->Status=="Sort Listed")
{
?> 
               

              </div>

              <div class="summary-box">


                
<p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button></p>  

<?php } } ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
 </button>
</div>
<div class="modal-body">
<table class="table table-bordered table-hover data-tables">

 <form method="post" name="submit">
                              
<tr>
<th>Message :</th>
<td>
<textarea name="message" placeholder="Message" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>                           

  <tr>
    <th>Status :</th>
    <td>

   <select name="status" class="form-control wd-450" required="true" >
    <option value="">Select Option</option>
  <?php if($result->Status==""):?>
    <option value="Sort Listed">Sort Listed</option>
    <option value="Hired">Hired</option>
     <option value="Rejected">Rejected</option>
     <?php  elseif($result->Status=="Sort Listed"): ?>
         <option value="Hired">Hired</option>
     <option value="Rejected">Rejected</option>
   <?php endif;?>
   </select></td>
  </tr>
</table>
</div>
 <div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name="submit" class="btn btn-primary">Update</button>
  
  </form>
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

