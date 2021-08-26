<?php session_start(); ?>
<?php include 'dbconn.php' ?>
<?php 

$user_id = $_GET['id'];
//echo $user_id;
try {    
  
    // sql to delete a record
    $sql = "DELETE FROM `u241746118_ems`.`adduser` WHERE 'addusr_id'='$user_id'";
  
    // use exec() because no results are returned
    $result = $conn->prepare($sql);
    $result->bindParam(':addusr_id', $user_id, PDO::PARAM_INT);     
   
    if($result->execute()){
        $_SESSION['delseid'] = "<p class='ms-5' style='color:#40ff00;'> Record Deleted Successfully!</p>";
        header('location:dashboard.php');
    }
    else{
        $_SESSION['delseid'] = "<p class='ms-5' style='color:#40ff00;'> Record Deleted Failed!</p>";
        header('location:dashboard.php');
    }
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }