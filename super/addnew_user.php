<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
include "../dbconn.php";
//Query for Registration Page
try {
    if (isset($_POST['addnew_user'])) {
        $usr_nickname = trim(strtolower($_POST['new_user']));
        $usr_state = trim($_POST['checkstate']);
        $signup_date = date('Y-m-d h:i:sa');
        $sellercredit  = $_POST['credit_quantity'];
        $addusr_role = $_POST['UserRoleFor'];
        $addusr_passwords = md5($_POST['userPassword']);

        // first check the database to make sure
        // a user does not already exist with the same username and/or email
        $query = "SELECT * FROM `u241746118_ems`.`adduser` WHERE `addusr_name`= '$usr_nickname' LIMIT 1";
        $results = $conn->prepare($query);

        // $result->bindParam(':user_email', $usr_email, PDO::PARAM_STR);
        // $result->bindParam(':user_pass', $usr_password, PDO::PARAM_STR);        
        $results->execute();
        $count = $results->rowCount();
        //echo $count;
        $row = $results->fetch(PDO::FETCH_ASSOC);
        //print_r($row['user_email']);
        if (isset($_SESSION['addusr_id'])) {
            $usercrt_sellr = $_SESSION['addusr_id'];
        }
        if ($row) {
            if ($row['addusr_name'] == $usr_nickname) {
                $_SESSION['username_exits'] = "<p style='color:red;'>Username Already Exists</p>";
                header('location:dashboard.php');
            }
        } else {
            $querycredit = "SELECT * FROM `u241746118_ems`.`adduser` WHERE `addusr_id`= '$usercrt_sellr' LIMIT 1";
            $resultscredit = $conn->prepare($querycredit);

            // $result->bindParam(':user_email', $usr_email, PDO::PARAM_STR);
            // $result->bindParam(':user_pass', $usr_password, PDO::PARAM_STR);        
            $resultscredit->execute();
            $countcredit = $resultscredit->rowCount();
            //echo $count;
            $rowcredit = $resultscredit->fetch(PDO::FETCH_ASSOC);
            //print_r($row['user_email']);
            $super_credit = $rowcredit['addusr_credit'];
            if ($super_credit == $sellercredit || $super_credit > $sellercredit) {
                $super_credit = ($super_credit - $sellercredit);
                //echo  $super_credit;
                $sql = "UPDATE `u241746118_ems`.`adduser` SET `addusr_credit`='$super_credit' WHERE `addusr_id`='$usercrt_sellr'";
                $creditresult =  $conn->query($sql);
                $creditresult->execute();
                
                $stmnt = "INSERT INTO `u241746118_ems`.`adduser`(`addusr_id`, `addusr_name`,`addusr_signup_date`,`addusr_state`,`addusr_role`,`addusr_credit`,`addusr_password`,`usraccnt_by`) VALUES ('','$usr_nickname','$signup_date','$usr_state','$addusr_role','$sellercredit','$addusr_passwords','$usercrt_sellr')";
                //print_r($stmnt);
                $result = $conn->query($stmnt);
                
                if (!empty($result)) {
                    $_SESSION['success'] = "<p class='ms-5' style='color:green;'> Data Inserted Successfully..</p>";
                    header("Location:dashboard.php");
                    $_SESSION['super_credit'] = $super_credit;
                } else {
                    $_SESSION['fail'] = "<p style='color:red;'> Data Inserted Failed..</p>";
                }
            } else {
                $_SESSION['credit_empty'] = "<p style='color:red;'> You Have No Enough Credit....</p>";
                 header('location:dashboard.php');
            }
        }
    }
} catch (PDOException $e) {
    echo "Registration Failed" . $e->getMessage();
}
