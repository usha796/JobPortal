<?php



     

    // EDIT THE 2 LINES BELOW AS REQUIRED

    $email_to = "crunchpress@info.com";

    $email_subject = "New Membership Form Submission";

  $error_message = '';



     



     

    // validation

    if(

        !isset($_POST['name']) ||

    !isset($_POST['email']) ||

    !isset($_POST['subject']) ||

    !isset($_POST['comments']))

    

    {

      

      echo "Fields are not filled properly";

      die();

    }

     

    $name = $_POST['name']; // required

  $email = $_POST['email']; // required

  $subject = $_POST['subject']; // required

  $comments = $_POST['comments'];

  

     

$email_message = '<html>';

$email_message = '<body>';

$email_message = '<head>';

$email_message = '<title>Your Details Are Below</title>';

$email_message = '</head>';

$email_message .= '<h1>Your Details Are Below</h1>';

$email_message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

$email_message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";

$email_message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";

$email_message .= "<tr><td><strong>subject:</strong> </td><td>" . strip_tags($_POST['subject']) . "</td></tr>";

$email_message .= "<tr><td><strong>Comments:</strong> </td><td>" . strip_tags($_POST['comments']) . "</td></tr>";

$email_message .= "</table>";

$email_message .= "</body></html>"; 













$headers = "From: " . $email . "\r\n";

$headers .= "Reply-To: ". $email . "\r\n";

$headers .= "CC: susan@example.com\r\n";

$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";





@mail($email_to, $email_subject, $email_message, $headers); 

?>



<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>JobInn-Job Directory</title>

<!--CUSTOM CSS-->

<link href="css/custom.css" rel="stylesheet" type="text/css">

<!--BOOTSTRAP CSS-->

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<!--COLOR CSS-->

<link href="css/color.css" rel="stylesheet" type="text/css">

<!--RESPONSIVE CSS-->

<link href="css/responsive.css" rel="stylesheet" type="text/css">

<!--OWL CAROUSEL CSS-->

<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

<!--FONTAWESOME CSS-->

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--SCROLL FOR SIDEBAR NAVIGATION-->

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">

<!--FAVICON ICON-->

<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<!--GOOGLE FONTS-->

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>

<!--Wrapper Start-->

<div id="wrapper"> 

  <!--Headre Start-->

  <header id="header"> 

    <!--BURGER NAVIGATION SECTION START-->

    <div class="cp-burger-nav"> 

      <!--BURGER NAV BUTTON-->

      <div id="cp_side-menu-btn" class="cp_side-menu"><a href="#" class=""><img src="images/menu-icon.png" alt="img"></a></div>

      <!--BURGER NAV BUTTON--> 

      

      <!--SIDEBAR MENU START-->

      <div id="cp_side-menu"> <a href="#" id="cp-close-btn" class="crose"><i class="fa fa-close"></i></a>

        <div class="cp-top-bar">

          <h4>For any Queries: +800 123 4567</h4>

          <div class="login-section"> <a href="login.html" class="btn-login">Log in</a> <a href="signup.html" class="btn-login">Signup</a> </div>

        </div>

        <strong class="logo-2"><a href="index.html"><img src="images/sidebar-logo.png" alt="img"></a></strong>

        <div class="content mCustomScrollbar">

          <div id="content-1" class="content">

            <div class="cp_side-navigation">

              <nav>

                <ul class="navbar-nav">

                  <li class="active"><a href="index.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Home<span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">

                      <li><a href="index-1.html">Home 1</a></li>

                      <li><a href="index-2.html">Home 2</a></li>

                      <li><a href="index-3.html">Home 3</a></li>

                      <li><a href="index-4.html">Home 4</a></li>

                    </ul>

                  </li>

                  <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Jobseeker<span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">

                      <li><a href="candidates-listings.html">Jobseeker Listing</a></li>

                      <li><a href="candidate-details.html">Jobseeker Details</a></li>

                      <li><a href="job-seekers.html">Jobseeker From</a></li>

                    </ul>

                  </li>

                  <li><a href="employers.html">Employers</a></li>

                  <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Jobs<span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">

                      <li><a href="jobs.html">Latest Jobs</a></li>

                      <li><a href="jobs-detail.html">Jobs Details</a></li>

                      <li><a href="job-seekers.html">Jobs Form</a></li>

                    </ul>

                  </li>

                  <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Companies<span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">

                      <li><a href="companies.html">Companies</a></li>

                      <li><a href="company-detail.html">Company Details</a></li>

                    </ul>

                  </li>

                  <li class="dropdown"><a href="#">Categories</a></li>

                  <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Blogs<span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">

                      <li><a tabindex="-1" href="#">Post a Job</a></li>

                      <li><a tabindex="-1" href="companies.html">Companies</a></li>

                      <li><a tabindex="-1" href="#">Resumes</a></li>

                    </ul>

                  </li>

                  <li><a href="#">Features</a> </li>

                  <li><a href="contact.html">Contact</a> </li>

                </ul>

              </nav>

            </div>

          </div>

        </div>

        <div class="cp-sidebar-social">

          <ul>

            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

            <li><a href="#"><i class="fa fa-twitter"></i></a></li>

            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>

            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>

          </ul>

        </div>

        <strong class="copy">JobInn &copy; 2016, All Rights Reserved</strong> </div>

      <!--SIDEBAR MENU END--> 

      

    </div>

    <!--BURGER NAVIGATION SECTION END-->

    <div class="container"> 

      <!--NAVIGATION START-->

      <div class="navigation-col">

        <nav class="navbar navbar-inverse">

          <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

            <strong class="logo"><a href="index.html"><img src="images/logo.png" alt="logo"></a></strong> </div>

          <div id="navbar" class="collapse navbar-collapse">

            <ul class="nav navbar-nav" id="nav">

              <li><a href="#">Home</a>

                <ul>

                  <li><a href="index.html">Home 1</a></li>

                  <li><a href="index-2.html">Home 2</a></li>

                  <li><a href="index-3.html">Home 3</a></li>

                  <li><a href="index-4.html">Home 4</a></li>

                </ul>

              </li>

              <li><a href="candidates-listings.html">Jobseekers</a>

                <ul>

                  <li><a href="candidates-listings.html">Jobseeker Listing</a></li>

                  <li><a href="candidate-details.html">Jobseeker Details</a></li>

                  <li><a href="job-seekers.html">Jobseeker From</a></li>

                </ul>

              </li>

              <li><a href="employers.html">Employers</a></li>

              <li><a href="jobs.html">Jobs</a>

                <ul>

                  <li><a href="jobs.html">Latest Jobs</a></li>

                  <li><a href="jobs-detail.html">Jobs Details</a></li>

                  <li><a href="job-seekers.html">Jobs Form</a></li>

                </ul>

              </li>

              <li><a href="companies.html">Companies</a>

                <ul>

                  <li><a href="companies.html">Companies</a></li>

                  <li><a href="company-detail.html">Company Details</a></li>

                </ul>

              </li>

              <li><a href="#">Features</a>

                <ul>

                  <li><a href="blog-full.html">Blogs<i class="fa fa-caret-right"></i></a>

                    <ul>

                      <li><a href="blog-medium.html">Blog Medium</a></li>

                      <li><a href="blog-post.html">Blog Post</a></li>

                      <li><a href="blog-detail.html">Blog Detail</a></li>

                      <li><a href="#">Post a Job</a></li>

                    </ul>

                  </li>

                  <li><a href="companies.html">Companies</a></li>

                  <li><a href="#">Resumes</a></li>

                  <li><a href="price.html">Job Plans &amp; Pricing</a></li>

                  <li><a href="testimonials.html">Testimonials</a></li>

                  <li><a href="privacy-policy.html">Privacy Policy</a></li>

                  <li><a href="our-terms.html">Our Terms</a></li>

                  <li><a href="login.html">Login</a></li>

                  <li><a href="signup.html">Register</a></li>

                  <li><a href="privacy-policy.html">Privacy Policy</a></li>

                </ul>

              </li>

              <li><a href="contact.html">Contact</a></li>

            </ul>

          </div>

        </nav>

      </div>

      <!--NAVIGATION END--> 

    </div>

    

    <!--USER OPTION COLUMN START-->

    <div class="user-option-col">

      <div class="thumb">

        <div class="dropdown">

          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="images/user-img.png" alt="img"></button>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a href="#">Manage Account</a></li>

            <li><a href="#">Change Password</a></li>

            <li><a href="#">Edit Profile</a></li>

            <li><a href="#">Log off</a></li>

          </ul>

        </div>

      </div>

      <div class="dropdown-box">

        <div class="dropdown">

          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="images/option-icon.png" alt="img"> </button>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">

            <li> <a href="#" class="login-round"><i class="fa fa-sign-in"></i></a> <a href="#" class="btn-login">Log in with Jobinn</a> </li>

            <li> <a href="#" class="login-round"><i class="fa fa-user-plus"></i></a> <a href="#" class="btn-login">Log in with Jobinn</a> </li>

          </ul>

        </div>

      </div>

    </div>

    <!--USER OPTION COLUMN END--> 

    

  </header>

  <!--Headre End-->

  

  <div id="main"> 

   <!--INNER BANNER START-->

  <section id="inner-banner">

    <div class="container">

      <h1>Thank You</h1>

    </div>

  </section>

  <!--INNER BANNER END-->

    <!-- Start of Thank -->

    <section id="content_Wrapper">

      <section class="container">

          <section class="error-page">

              <h2>Thank You</h2>

              <p>Thank you for your form submission, as soon as we get this we will get back to you shortly.</p>

          </section>      </section>

    </section>

    <!-- End of Thank --> 

    <!--Footer Start-->

    <footer id="footer">

    <div class="text-box box">

      <h4>About Jobs Alert</h4>

      <p>Person usually begins a job by becoming an employee, volunteering, or starting a business. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusant doloremque laudantium, totam rem aperiam eaque ipsa quae.</p>

    </div>

    <div class="box">

      <h4>Keywords by Role</h4>

      <ul>

        <li><a href="#">Administrator</a></li>

        <li><a href="#">Accounts Officer</a></li>

        <li><a href="#">PHP Developer</a></li>

        <li><a href="#">UI/UX Designer</a></li>

        <li><a href="#">Project Manager</a></li>

        <li><a href="#">Public Relation Officer</a></li>

      </ul>

    </div>

    <div class="box">

      <h4>Keywords by Skills</h4>

      <ul>

        <li><a href="#">Administrator</a></li>

        <li><a href="#">Accounts Officer</a></li>

        <li><a href="#">PHP Developer</a></li>

        <li><a href="#">UI/UX Designer</a></li>

        <li><a href="#">Project Manager</a></li>

        <li><a href="#">Public Relation Officer</a></li>

      </ul>

    </div>

    <div class="box">

      <h4>Keywords by Location</h4>

      <ul>

        <li><a href="#">Administrator</a></li>

        <li><a href="#">Accounts Officer</a></li>

        <li><a href="#">PHP Developer</a></li>

        <li><a href="#">UI/UX Designer</a></li>

        <li><a href="#">Project Manager</a></li>

        <li><a href="#">Public Relation Officer</a></li>

      </ul>

    </div>

    <div class="box">

      <h4>Keywords by Market</h4>

      <ul>

        <li><a href="#">Administrator</a></li>

        <li><a href="#">Accounts Officer</a></li>

        <li><a href="#">PHP Developer</a></li>

        <li><a href="#">UI/UX Designer</a></li>

        <li><a href="#">Project Manager</a></li>

        <li><a href="#">Public Relation Officer</a></li>

      </ul>

    </div>

    <form action="#">

      <h4>Subscribe for Latest Jobs Alerts</h4>

      <input type="text" placeholder="Name" required>

      <input type="text" placeholder="Email" required>

      <input type="submit" value="Subscribe Alerts">

    </form>

    <div class="container">

      <div class="bottom-row"> <strong class="copyrights">JobInn &copy; 2016, All Rights Reserved, Design &amp; Developed By: <a href="http://crunchpress.com/" target="_blank">CrunchPress</a></strong>

        <div class="footer-social">

          <ul>

            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

            <li><a href="#"><i class="fa fa-twitter"></i></a></li>

            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>

            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>

          </ul>

        </div>

      </div>

    </div>

  </footer>

    <!--Footer End--> 

  </div>

</div>

<!--Wrapper End--> 

<!--JQUERY MIN JS--> 

<script src="js/jquery-1.11.3.min.js"></script> 

<!--BOOTSTRAP JS--> 

<script src="js/bootstrap.min.js"></script> 

<!--OWL CAROUSEL JS--> 

<script src="js/owl.carousel.min.js"></script> 

<!--BANNER ZOOM OUT IN--> 

<script src="js/jquery.velocity.min.js"></script> 

<script src="js/jquery.kenburnsy.js"></script> 

<!--SCROLL FOR SIDEBAR NAVIGATION--> 

<script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 

<!--CUSTOM JS--> 

<script src="js/custom.js"></script>

</body>

</html>

