<?php
class Employer {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function signup($data) {
        $conrnper = $data['concernperson'];
        $emaill = $data['email'];
        $cmpnyname = $data['companyname'];
        $tagline = $data['tagline'];
        $description = $data['description'];
        $website = $data['website'];
        $password = $data['empppassword'];
        $options = ['cost' => 12];
        $hashedpass = password_hash($password, PASSWORD_BCRYPT, $options);
        $logo = $_FILES["logofile"]["name"];
        $extension = substr($logo, strlen($logo) - 4, strlen($logo));
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

        if (!in_array($extension, $allowed_extensions)) {
            return "Invalid logo format. Only jpg / jpeg/ png /gif format allowed";
        } else {
            $logoname = md5($logo) . $extension;
            move_uploaded_file($_FILES["logofile"]["tmp_name"], "employerslogo/" . $logoname);

            $sql = "SELECT * FROM tblemployers WHERE EmpEmail=?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bind_param("s", $emaill);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 0) {
                $isactive = 1;
                $sql = "INSERT INTO tblemployers (ConcernPerson, EmpEmail, EmpPassword, CompnayName, CompanyTagline, CompnayDescription, CompanyUrl, CompnayLogo, Is_Active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bind_param("ssssssssi", $conrnper, $emaill, $hashedpass, $cmpnyname, $tagline, $description, $website, $logoname, $isactive);
                if ($stmt->execute()) {
                    return "You have signed up Successfully";
                } else {
                    return "Something went wrong. Please try again";
                }
            } else {
                return "Email-id already exists. Please try again";
            }
        }
    }
}
?>
