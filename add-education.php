<?php
session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
//verifying Session
if(strlen($_SESSION['jsid'])==0)
  { 
header('location:logout.php');
}
else{
if(isset($_POST['submit']))
{
//Getting Post Values
$quali=$_POST['qualification'];  
$sorcname=$_POST['schorclgname']; 
$yop=$_POST['yop'];  
$stream=$_POST['stream']; 
$per=$_POST['percentage'];  
$cgpa=$_POST['cgpa'];
//Getting User Id
$uid=$_SESSION['jsid'];

$ret="select Qualification from tbleducation where Qualification=:quali and  UserID=:uid";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':quali', $quali, PDO::PARAM_STR);
    $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
  $ff=array();
foreach($results as $rt)
{
array_push($ff,$rt->Qualification);
}

if(in_array($quali,$ff))
{
    
echo "<script>alert('Qualification details already exist. Please try again');</script>";

} else {


$sql="insert into tbleducation(UserID,Qualification,ClgorschName,PassingYear,Stream,CGPA,Percentage )values(:uid,:quali,:sorcname,:yop,:stream,:cgpa,:per)";
$query = $dbh->prepare($sql);
// Binding Post Values
$query-> bindParam(':quali', $quali, PDO::PARAM_STR);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->bindParam(':sorcname',$sorcname,PDO::PARAM_STR);
$query->bindParam(':yop',$yop,PDO::PARAM_STR);
$query->bindParam(':stream',$stream,PDO::PARAM_STR);
$query->bindParam(':per',$per,PDO::PARAM_STR);
$query->bindParam(':cgpa',$cgpa,PDO::PARAM_STR);
$query->execute();

$LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("education details has been added.")</script>';
echo "<script>window.location.href ='my-profile.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }



}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User | Add Education Details</title>
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

      <h1>User Education Details</h1>

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
<label>Qualification *</label>
<select type="text" name="qualification" required="true" autocomplete="off" value="" class="form-control"/>
<option value="">Chose Qualification</option>
  <option value="10th std">10th std</option>
  <option value="12th std">12th std</option>
  <option value="Graduation">Graduation</option>
  <option value="Post Graduation">Post Graduation</option>
  <option value="Others">Others</option>
</select>
</div>

<div class="col-md-6 col-sm-6">
<label>School/College Name *</label>
<input type="text" name="schorclgname" required="true"  autocomplete="off" value="" class="form-control">
</div>
          
<div class="col-md-6 col-sm-6">
<label>Year of Passing</label>
<input type="text" name="yop" autocomplete="off" value="" required="true" class="form-control" pattern="[0-9]+" maxlength="4">
<label>Stream(if any)</label>
<input type="text" name="stream" autocomplete="off" value="" class="form-control">
</div>

<div class="col-md-6 col-sm-6">
 <label>Percentage(if any)</label>
<input type="text" name="percentage" autocomplete="off" value="" class="form-control" maxlength="5">
</div>
 
<div class="col-md-6 col-sm-6">
<label>CGPA</label>
 <input type="text" name="cgpa" required="true" autocomplete="off" value="" class="form-control" maxlength="2">
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

