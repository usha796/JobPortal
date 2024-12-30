<?php
class Admin {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function login($username, $password) {
        $password = md5($password); // Use a more secure hashing method in a real application
        $sql = "SELECT ID FROM tbladmin WHERE UserName=? AND Password=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();
            $_SESSION['jpaid'] = $id;
            $_SESSION['login'] = $username;

            if (!empty($_POST["remember"])) {
                setcookie("user_login", $username, time() + (10 * 365 * 24 * 60 * 60));
                setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if (isset($_COOKIE["user_login"])) {
                    setcookie("user_login", "");
                    if (isset($_COOKIE["userpassword"])) {
                        setcookie("userpassword", "");
                    }
                }
            }
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}
?>
