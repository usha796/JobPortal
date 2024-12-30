<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

class Admin {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function isLoggedIn() {
        return isset($_SESSION['jpaid']) && strlen($_SESSION['jpaid']) > 0;
    }

    public function updateProfile($adminid, $AName, $mobno, $email) {
        $sql = "UPDATE tbladmin SET AdminName=?, MobileNumber=?, Email=? WHERE ID=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param("sssi", $AName, $mobno, $email, $adminid);
        $stmt->execute();
        echo '<script>alert("Profile has been updated")</script>';
    }

    public function getProfileData() {
        $sql = "SELECT * FROM tbladmin";
        $result = $this->dbh->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}

$admin = new Admin($dbh);

if (!$admin->isLoggedIn()) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['jpaid'];
        $AName = $_POST['adminname'];
        $mobno = $_POST['mobilenumber'];
        $email = $_POST['email'];
        $admin->updateProfile($adminid, $AName, $mobno, $email);
    }
    ?>
<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
<head>
    <title>Job Portal - Admin Profile</title>
    <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
</head>
<body>
    <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>
        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="content">
                <!-- Register Forms -->
                <h2 class="content-heading">Admin Profile</h2>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Bootstrap Register -->
                        <div class="block block-themed">
                            <div class="block-header bg-gd-emerald">
                                <h3 class="block-title">Admin Profile</h3>
                            </div>
                            <div class="block-content">
                                <?php
                                $results = $admin->getProfileData();
                                if (count($results) > 0) {
                                    foreach ($results as $row) {
                                        ?>
                                        <form method="post">
                                            <div class="form-group row">
                                                <label class="col-12" for="register1-username">Admin Name:</label>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" name="adminname" value="<?php echo $row->AdminName; ?>" required='true'>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12" for="register1-email">User Name:</label>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" name="username" value="<?php echo $row->UserName; ?>" readonly="true">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12" for="register1-password">Email:</label>
                                                <div class="col-12">
                                                    <input type="email" class="form-control" name="email" value="<?php echo $row->Email; ?>" required='true'>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12" for="register1-password">Contact Number:</label>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" name="mobilenumber" value="<?php echo $row->MobileNumber; ?>" required='true' maxlength='10'>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12" for="register1-password">Admin Registration Date:</label>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" id="email2" name="" value="<?php echo $row->AdminRegdate; ?>" readonly="true">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-alt-success" name="submit">
                                                        <i class="fa fa-plus mr-5"></i> Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- END Bootstrap Register -->
                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
        <?php include_once('includes/footer.php'); ?>
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
<?php } ?>
