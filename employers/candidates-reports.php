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

<title>Jobportal- Between Dates Report</title>

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

      <h1>Between Dates Report</h1>

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
                <h2>Between dates Report of Applied Candidates</h2>
<form action="candidates-bwdates-reports-details.php" method="post" enctype="multipart/form-data">
                                  <div class="row">

<div class="col-md-9 col-sm-9">
<label>From Date:</label>
<input type="date" name="fromdate" id="fromdate" value="" required="true" 
                                 class="form-control" />
</div>
</div>
                                 <div class="row" style="padding-top: 20px">

<div class="col-md-9 col-sm-9">
<label>To Date: </label>
<input type="date" name="todate" required="true" id="todate" class="form-control" />
</div>
</div>

 <div class="col-lg-9" style="padding-top: 20px">
                          <div class="login-horizental cancel-wp pull-left">
                         <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit" id="submit">Submit</button>
                        </div>
                        </div>
                               </div>
                                
                         
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

<!--CUSTOM JS--> 

<script src="../js/custom.js"></script>

</body>

</html>
<?php }?>
