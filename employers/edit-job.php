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

//Genrating CSRF Token
if (empty($_SESSION['token2'])) {
    $_SESSION['token2'] = bin2hex(random_bytes(32));
}

if(isset($_POST['update']))
{

//Verifying CSRF Token
if (!empty($_POST['csrftoken2'])) {
if (hash_equals($_SESSION['token2'], $_POST['csrftoken2'])) {

//Getting Jobid
$jid=intval($_GET['jobid']);
//Geeting Employer Id
$empid=$_SESSION['emplogin'];  
//Getting Post Values
$category=$_POST['category'];  
$jontitle=$_POST['jobtitle']; 
$jobtype=$_POST['jobtype']; 
$salpackg=$_POST['salarypackage'];
$skills=$_POST['skills'];
$exprnce=$_POST['experience'];
$joblocation=$_POST['joblocation'];
$jobdesc=$_POST['description'];
$jed=$_POST['jed'];
$isactive=$_POST['status'];



$sql="Update tbljobs set jobCategory=:category,jobTitle=:jontitle,jobType=:jobtype,salaryPackage=:salpackg,skillsRequired=:skills,experience=:exprnce,jobLocation=:joblocation,jobDescription=:jobdesc,JobExpdate=:jed,isActive=:isactive where employerId=:eid and jobId=:jid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':jontitle',$jontitle,PDO::PARAM_STR);
$query->bindParam(':jobtype',$jobtype,PDO::PARAM_STR);
$query->bindParam(':salpackg',$salpackg,PDO::PARAM_STR);
$query->bindParam(':skills',$skills,PDO::PARAM_STR);
$query->bindParam(':exprnce',$exprnce,PDO::PARAM_STR);
$query->bindParam(':joblocation',$joblocation,PDO::PARAM_STR);
$query->bindParam(':jobdesc',$jobdesc,PDO::PARAM_STR);
$query->bindParam(':jed',$jed,PDO::PARAM_STR);
$query->bindParam(':isactive',$isactive,PDO::PARAM_STR);
$query->bindParam(':jid',$jid,PDO::PARAM_STR);
$query->bindParam(':eid',$empid,PDO::PARAM_STR);
$query->execute();

$msg=" Job updated Successfully";
unset( $_SESSION['token2']);




}}}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employers | Job Posting</title>
<link href="../css/custom.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../css/color.css" rel="stylesheet" type="text/css">
<link href="../css/responsive.css" rel="stylesheet" type="text/css">
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/editor.css" type="text/css" rel="stylesheet"/>
<link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>


</head>

<body class="theme-style-1">
<div id="wrapper"> 
<!--HEADER START-->
 <?php include('includes/header.php');?>
<!--HEADER END--> 

  
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

  <section id="inner-banner">

    <div class="container">

      <h1> Edit  <?php echo htmlentities($result->jobTitle);?> Job</h1>

    </div>

  </section>



  <div id="main">
    <form name="empsignup" enctype="multipart/form-data" method="post">
<input type="hidden" name="csrftoken2" value="<?php echo htmlentities($_SESSION['token2']); ?>" /> 
 

    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->
     <?php if(@$error){ ?><div class="errorWrap">
        <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>Success</strong> : <?php echo htmlentities($msg);?></div><?php } ?>

<div class="row">
<div class="col-md-6 col-sm-6" >
<label>Category*</label>
  <div class="selector">
       <select name='category' class="full-width">
 <option value="<?php echo htmlentities($result->jobCategory);?>"><?php echo htmlentities($result->jobCategory);?></option>
  <?php 
$sqlt = "SELECT CategoryName FROM tblcategory order by CategoryName asc";
$queryt = $dbh -> prepare($sqlt);
$queryt -> execute();
$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($queryt -> rowCount() > 0)
{
foreach($results as $row)
{?>
<option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php  }} ?>
              
</select>
</div>
</div>

<div class="col-md-6 col-sm-6">
<label>Job Title*</label>
<input type="text" name="jobtitle" required value="<?php echo htmlentities($result->jobTitle);?>" autocomplete="off">
</div>
</div>
      
<div class="row">
  <div class="col-md-6 col-sm-6">
 <label>Job Type</label>

              <div class="selector">

                <select class="full-width" name="jobtype">
<option value="<?php echo htmlentities($result->jobType);?>"><?php echo htmlentities($result->jobType);?></option>
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Half Time">Half Time</option>
                  <option value="Freelance">Freelance</option>
                  <option value="Contract">Contract</option>
                  <option value="Internship">Internship</option>
                  <option value="Temporary">Temporary</option>
                </select>

              </div>

            </div>

          <div class="col-md-6 col-sm-6">

              <label>Salary Package</label>
<input type="text" value="<?php echo htmlentities($result->salaryPackage);?>" name="salarypackage" required>

            </div>
            </div>


<div class="row">

<div class="col-md-6 col-sm-6">
<label>Skill Required</label>
<input type="text" value="<?php echo htmlentities($result->skillsRequired);?>" name="skills" required>
</div>

<div class="col-md-6 col-sm-6">
<label>Experience</label>
<input type="text" value="<?php echo htmlentities($result->experience);?>" name="experience" required>
</div>
</div>


<div class="row">

<div class="col-md-6 col-sm-6">
<label>Job Location</label>
<input type="text" value="<?php echo htmlentities($result->jobLocation);?>" name="joblocation" required>
</div>
<div class="col-md-6 col-sm-6">
<label>Job Expiration Date</label>
<input type="date" placeholder="e.g. 0-5" name="jed" value="<?php echo htmlentities($result->JobExpdate);?>" required class="form-control">
</div>
</div>


<div class="row">
 <div class="col-md-12">
<h4>Job Description</h4>
<div class="text-editor-box">
<textarea  name="description" required autocomplete="off" ><?php echo htmlentities($result->jobDescription);?></textarea>
</div>

</div>
</div>
<div class="row">
  <div class="col-md-6 col-sm-6">
 <label>Job Status</label>

              <div class="selector">

                <select class="full-width" name="status">

<!-- if job is active -->
<?php if($result->isActive==1):?>                 
<option value="<?php echo htmlentities($result->isActive);?>">Active</option>
<option value="0">In Active</option>
<option value="2">Job Filled</option>
<?php endif;?>

<!-- if job is Inactive -->
<?php if($result->isActive==0):?>                 
<option value="<?php echo htmlentities($result->isActive);?>">Active</option>
<option value="1"> Active</option>
<option value="2">Job Filled</option>
<?php endif;?>
  
<!-- if job is Filled -->
<?php if($result->isActive==2):?>                 
<option value="<?php echo htmlentities($result->isActive);?>">Job Filled</option>
<option value="1"> Active</option>
<?php endif;?>  
                </select>

              </div>

            </div>
          </div>

<?php }} ?>

            <div class="col-md-12">

              <div class="btn-col">

                <input type="submit" name="update" value="Update">

              </div>

            </div>

          </div>

    

      </div>

    </section>
    </form>
    <!--RESUME FORM END--> 

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
<script src="../js/editor.js"></script> 
<script src="../js/jquery.accordion.js"></script> 
<script src="../js/jquery.noconflict.js"></script> 
<script src="../js/theme-scripts.js"></script> 
<script src="../js/custom.js"></script>

</body>

</html>
<?php } ?>

