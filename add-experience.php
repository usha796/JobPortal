<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if(strlen($_SESSION['jsid'])==0)
  { 
header('location:logout.php');
}
else{
if(isset($_POST['submit']))
{
//Getting Post Values
$employername=$_POST['employername'];  
$toe=$_POST['toe']; 
$desi=$_POST['designation'];  
$ctc=$_POST['ctc']; 
$fdate=$_POST['fdate'];  
$tdate=$_POST['tdate'];
$skills=$_POST['skills'];
//Getting User Id
$uid=$_SESSION['jsid'];
$sql="insert into tblexperience(UserID,EmployerName,EmployementType,Designation,Ctc,FromDate,ToDate)values(:uid,:employername,:toe,:desi,:ctc,:fdate,:tdate)";
$query = $dbh->prepare($sql);
// Binding Post Values
$query-> bindParam(':employername', $employername, PDO::PARAM_STR);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':toe',$toe,PDO::PARAM_STR);
$query->bindParam(':desi',$desi,PDO::PARAM_STR);
$query->bindParam(':ctc',$ctc,PDO::PARAM_STR);
$query->bindParam(':fdate',$fdate,PDO::PARAM_STR);
$query->bindParam(':tdate',$tdate,PDO::PARAM_STR);

$query->execute();

$LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("experience details has been added.")</script>';
echo "<script>window.location.href ='my-profile.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }




}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User | Add Experience Details</title>
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/editor.css" type="text/css" rel="stylesheet"/>
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>

<body class="theme-style-1">
<div id="wrapper"> 
<!--HEADER START-->
 <?php include('includes/header.php');?>
<!--HEADER END--> 

  
  <!--INNER BANNER START-->
  <section id="inner-banner">

    <div class="container">

      <h1>User Experience Details</h1>

    </div>

  </section>

  <!--INNER BANNER END--> 

  

  <!--MAIN START-->

  <div id="main">
    <!--Signup FORM START-->
    <form name="" enctype="multipart/form-data" method="post">
    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->

     <?php if(@$error){ ?><div class="errorWrap">
        <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>Success</strong> : <?php echo htmlentities($msg);?></div><?php } ?>

          <div class="row">




<div class="col-md-6 col-sm-6">
<label>Employer Name *</label>
<input type="text" name="employername" placeholder="Name of Employer" required="true"  autocomplete="off" value="" class="form-control">
</div>

<div class="col-md-6 col-sm-6">
<label>Type of Employment *</label>
<input type="text" name="toe" required="true" placeholder="eg fulltime,parttime etc" autocomplete="off" value="" class="form-control">
</div>
          
<div class="col-md-6 col-sm-6">
<label>Designation</label>
<input type="text" name="designation" placeholder="Enter Designation" autocomplete="off" value="" required="true" class="form-control">
<label>CTC(per month)</label>
<input type="text" name="ctc" autocomplete="off" placeholder="Enter CTC" value="" class="form-control" pattern="[0-9]+">
</div>

<div class="col-md-6 col-sm-6">
 <label>From Date</label>
<input type="date" name="fdate" autocomplete="off" value="" class="form-control">
</div>
 
<div class="col-md-6 col-sm-6">
<label>To Date</label>
 <input type="date" name="tdate" autocomplete="off" value="" class="form-control">
</div>

</div>


            <div class="col-md-12">

              <div class="btn-col">

                <input type="submit" name="submit" value="Add">

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


<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/jquery.velocity.min.js"></script> 
<script src="js/jquery.kenburnsy.js"></script> 
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="js/editor.js"></script> 
<script src="js/jquery.accordion.js"></script> 
<script src="js/jquery.noconflict.js"></script> 
<script src="js/theme-scripts.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>
<?php }
?>

