<?php
include "dbconn.php";
//Log In Form Database Query Start Here

try {
    if (isset($_POST['LoginButton'])) {
        $usrname = trim(strtolower($_POST['LogInEmail']));
        //$usr_email = trim(strtolower($_POST['LogInEmail']));
        $usr_password = md5($_POST['LogInPassword']);

        $stmntusr = "SELECT * FROM `u241746118_ems`.`users` WHERE `nickname` = '$usrname' && `user_pass` = '$usr_password' && `user_role` = 'Admin' LIMIT 1 ";
        $resultusr = $conn->prepare($stmntusr);

        // $result->bindParam(':user_email', $usr_email, PDO::PARAM_STR);
        // $result->bindParam(':user_pass', $usr_password, PDO::PARAM_STR);        
        $resultusr->execute();
        $rowusr = $resultusr->fetch(PDO::FETCH_ASSOC);
        //print_r($rowusr);

        if ($rowusr) {
            $stmnt = "SELECT * FROM `u241746118_ems`.`users` WHERE `nickname`= '$usrname' OR `user_pass` ='$usr_password' LIMIT 1";
            $result = $conn->prepare($stmnt);

            // $result->bindParam(':user_email', $usr_email, PDO::PARAM_STR);
            // $result->bindParam(':user_pass', $usr_password, PDO::PARAM_STR);        
            $result->execute();
            $count = $result->rowCount();
            //echo $count;
            $row = $result->fetch(PDO::FETCH_ASSOC);
            //print_r($row);
            if ($row['nickname'] != $usrname) {
                $_SESSION['name_errmsg'] = "<p style='color:red;'>Your Username Doesn't Match!</p>";
                header('location:index.php');
            } elseif ($row['user_pass'] != $usr_password) {
                $_SESSION['pass_errmsg'] = "<p style='color:red;'>Your Paswword Doesn't Match!</p>";
                header('location:index.php');
            } elseif ($row['nickname'] != $usrname && $row['user_pass'] != $usr_password) {
                $_SESSION['name_errmsg'] = "<p style='color:red;'>Your Username Doesn't Match!</p>";
                $_SESSION['pass_errmsg'] = "<p style='color:red;'>Your Paswword Doesn't Match!</p>";
                header('location:index.php');
            } else {
                $_SESSION['usr_id'] = $row['user_id'];
                $_SESSION['usr_email'] = $row['user_email'];
                $_SESSION['usr_name'] = $row['user_name'];
                $_SESSION['username'] = $row['nickname'];
                // $_SESSION['logout'] = " <li class='ms-2'><a href='logout.php' style='color:#fff;' class='btn btn-secondary mt-3' href='/ems/logout.php' 
                // role='button' aria-haspopup='true' aria-expanded='false'>Log out</a></li>";
                header('location:admin/dashboard.php');
            }
        } else {
            $stmntaddusr = "SELECT * FROM `u241746118_ems`.`adduser` WHERE `addusr_name`= '$usrname' AND `addusr_password` ='$usr_password' LIMIT 1";
            $resultaddusr = $conn->prepare($stmntaddusr);

            // $resultaddusr->bindParam(':user_email', $usr_email, PDO::PARAM_STR);
            // $resultaddusr->bindParam(':user_pass', $usr_password, PDO::PARAM_STR);        
            $resultaddusr->execute();
            $countaddusr = $resultaddusr->rowCount();
            //echo $countaddusr;
            $rowaddusr = $resultaddusr->fetch(PDO::FETCH_ASSOC);
            print_r($rowaddusr);
            if ($rowaddusr['addusr_name'] != $usrname) {
                $_SESSION['name_errmsg'] = "<p style='color:red;'>Your Username Doesn't Match!</p>";
                header('location:index.php');
            } elseif ($rowaddusr['addusr_password'] != $usr_password) {
                $_SESSION['pass_errmsg'] = "<p style='color:red;'>Your Paswword Doesn't Match!</p>";
                header('location:index.php');
            } elseif ($rowaddusr['addusr_name'] != $usrname && $rowaddusr['addusr_password'] != $usr_password) {
                $_SESSION['name_errmsg'] = "<p style='color:red;'>Your Username Doesn't Match!</p>";
                $_SESSION['pass_errmsg'] = "<p style='color:red;'>Your Paswword Doesn't Match!</p>";
                header('location:index.php');
            } else {
                $_SESSION['addusr_id'] = $rowaddusr['addusr_id'];
                $_SESSION['addusr_name'] = $rowaddusr['addusr_name'];
                if ($rowaddusr['addusr_role'] == 'Super') {
                    header('location:super/dashboard.php');
                    $_SESSION['super_credit'] = $rowaddusr['addusr_credit'];
                } else {
                    header('location:users/dashboard.php');
                    $_SESSION['user_credit'] = $rowaddusr['addusr_credit'];
                }
            }
        }
    }
} catch (PDOException $e) {
    echo "Log In failed : " . $e->getMessage();
}
