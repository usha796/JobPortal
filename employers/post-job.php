<?php
session_start();
// Database Configuration File
include('includes/config.php');
error_reporting(0);

// Verifying Session
if(strlen($_SESSION['emplogin']) == 0) { 
    header('location:emp-login.php');
} else {
    // Generating CSRF Token
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    if(isset($_POST['submit'])) {
        // Verifying CSRF Token
        if (!empty($_POST['csrftoken']) && hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            // Getting Post Values
            $empid = $_SESSION['emplogin'];  
            $category = $_POST['category'];  
            $jontitle = $_POST['jobtitle']; 
            $jobtype = $_POST['jobtype']; 
            $salpackg = $_POST['salarypackage'];
            $skills = $_POST['skills'];
            $exprnce = $_POST['experience'];
            $joblocation = $_POST['joblocation'];
            $jobdesc = $_POST['description'];
            $jed = $_POST['jed'];
            $isactive = 1;

            $sql = "INSERT INTO tbljobs(employerId, jobCategory, jobTitle, jobType, salaryPackage, skillsRequired, experience, jobLocation, jobDescription, JobExpdate, isActive) 
                    VALUES(:empid, :category, :jontitle, :jobtype, :salpackg, :skills, :exprnce, :joblocation, :jobdesc, :jed, :isactive)";
            $query = $dbh->prepare($sql);
            // Binding Post Values
            $query->bindParam(':empid', $empid, PDO::PARAM_STR);
            $query->bindParam(':category', $category, PDO::PARAM_STR);
            $query->bindParam(':jontitle', $jontitle, PDO::PARAM_STR);
            $query->bindParam(':jobtype', $jobtype, PDO::PARAM_STR);
            $query->bindParam(':salpackg', $salpackg, PDO::PARAM_STR);
            $query->bindParam(':skills', $skills, PDO::PARAM_STR);
            $query->bindParam(':exprnce', $exprnce, PDO::PARAM_STR);
            $query->bindParam(':joblocation', $joblocation, PDO::PARAM_STR);
            $query->bindParam(':jobdesc', $jobdesc, PDO::PARAM_STR);
            $query->bindParam(':jed', $jed, PDO::PARAM_STR);
            $query->bindParam(':isactive', $isactive, PDO::PARAM_STR);
            
            try {
                $query->execute();
                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    $msg = "Your job posted Successfully";
                    unset($_SESSION['token']);
                } else {
                    $error = "Something went wrong. Please try again";
                }
            } catch (PDOException $e) {
                $error = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!doctype html>
<html>
<head>
<script>
function validateSalary() {
    let salaryInput = document.getElementById('salarypackage').value;
    let salary = parseFloat(salaryInput.trim());

    // Check if salary is a valid number and not negative
    if (isNaN(salary) || salary < 0) {
        alert('Please put valid salary');
        return false;
    }
    
    return true;
}


    function validateExperience() {
    let experienceInput = document.getElementById('experience').value;
    let experience = parseFloat(experienceInput.trim());

    // Check if experience is a valid number and not negative
    if (isNaN(experience) || experience < 0) {
        alert('Please enter a valid experience value greater than or equal to zero.');
        return false;
    }
    
    return true;
}


    document.addEventListener('DOMContentLoaded', () => {
        let postingDateElem = document.getElementById('postingDate');
        postingDateElem.value = new Date().toISOString().split('T')[0];
        let minDate = new Date(postingDateElem.value);
        minDate.setDate(minDate.getDate() + 5);
        document.getElementById('expirationDate').min = minDate.toISOString().split('T')[0];
    });

    function validateForm() {
        let expirationDate = new Date(document.getElementById('expirationDate').value);
        let postingDate = new Date(document.getElementById('postingDate').value);
        postingDate.setDate(postingDate.getDate() + 5);

        if (expirationDate < postingDate) {
            alert('The expiration date must be at least 5 days after the posting date.');
            return false;
        }

        if (!validateSalary()) {
            return false;
        }

        if (!validateExperience()) {
            return false;
        }

        return true;
    }
</script>

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
</head>
<body class="theme-style-1">
<div id="wrapper"> 
    <!--HEADER START-->
    <?php include('includes/header.php'); ?>
    <!--HEADER END--> 

    <!--INNER BANNER START-->
    <section id="inner-banner">
        <div class="container">
            <h1>Employers | Post a Job</h1>
        </div>
    </section>
    <!--INNER BANNER END--> 

    <!--MAIN START-->
    <div id="main">
        <!-- Signup FORM START -->
        <form name="empsignup" enctype="multipart/form-data" method="post" onsubmit="return validateForm()">
            <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
            <section class="resum-form padd-tb">
                <div class="container">
                    <!-- Success and error message -->
                    <?php if (@$error) { ?>
                        <div class="errorWrap">
                            <strong>ERROR</strong> : <?php echo htmlentities($error); ?>
                        </div>
                    <?php } ?>

                    <?php if (@$msg) { ?>
                        <div class="succMsg">
                            <strong>Success</strong> : <?php echo htmlentities($msg); ?>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label>Category*</label>
                            <div class="selector">
                                <select name="category" class="full-width" required>
                                    <option value="">Select</option>
                                    <?php 
                                        $sqlt = "SELECT CategoryName FROM tblcategory ORDER BY CategoryName ASC";
                                        $queryt = $dbh->prepare($sqlt);
                                        $queryt->execute();
                                        $results = $queryt->fetchAll(PDO::FETCH_OBJ);
                                        if ($queryt->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->CategoryName); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
                                            <?php }
                                        } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label>Job Title*</label>
                            <input type="text" name="jobtitle" required placeholder=" e.g. Manager,Waiter" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label>Job Type</label>
                            <div class="selector">
                                <select class="full-width" name="jobtype">
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Half Time">Half Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Temporary">Temporary</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label>Salary Package</label>
                            <input type="text" id="salarypackage" name="salarypackage" placeholder="e.g. 7000 - 9000" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label>Skill Required</label>
                            <input type="text" placeholder="" name="skills" required>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label>Experience</label>
                            <input type="text" id="experience" name="experience" placeholder="e.g. 0-5" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label>Job Location</label>
                            <input type="text" placeholder="e.g. Kathmandu,Pokhara" name="joblocation" required>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <input type="hidden" id="postingDate">
                            <label>Job Expiration Date</label>
                            <input type="date" id="expirationDate" name="jed" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Job Description</h4>
                            <div class="text-editor-box">
                                <textarea name="description" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="btn-col">
                            <input type="submit" name="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <!--RESUME FORM END--> 
    </div>
    <!--MAIN END--> 

    <!--FOOTER START-->
    <?php include('includes/footer.php'); ?>
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

