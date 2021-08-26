<?php
    include 'admin/dbconn.php';

    $result = [
    	'success' => false,
    	'message' => "Your license key is expired",
    	'leftDays' => 0,
    	'tokens' => null,
    	'appVersion' => null,
    	'ipList' => null,
    	'ShortMessage' => null,
    	'News' => null,
    	'KeyType' => null,
    	'PaidStatus' => null,
    ];

    $query = "SELECT addusr_id, addusr_name, usr_mac, addusr_exipre FROM `u241746118_ems`.`adduser` WHERE `addusr_name` = :user_name";
    $stmnt = $conn->prepare($query);
    $stmnt->bindParam(':user_name', $_REQUEST['userName']);
    $stmnt->execute();
    $count = $stmnt->rowCount();
    
    if ($count > 0) {
        $user = $stmnt->fetch();
        $today = date('Y-m-d H:i:s');
        if (empty($user["usr_mac"])) {
            $query = "UPDATE `u241746118_ems`.`adduser` SET `usr_mac` = :user_mac WHERE `addusr_id` = :user_id";
            $stmnt = $conn->prepare($query);
            $stmnt->bindParam(':user_mac', $_REQUEST['macAddress']);
            $stmnt->bindParam(':user_id', $user['addusr_id']);
            $stmnt->execute();
        } else if (($user["usr_mac"] != $_REQUEST['macAddress']) || ($user['addusr_exipre'] < $today)) {
            exit(json_encode($result));
        }
        
        $expireDateTime = new DateTime($user['addusr_exipre']);
        $todayDateTime = new DateTime($today);
        $interval = $todayDateTime->diff($expireDateTime);

        $result = [
        	'success' => true,
        	'leftDays' => intval($interval->format('%a')),
        	'tokens' => null,
        	'appVersion' => '1.0.2.69',
        	'ipList' => null,
        	'ShortMessage' => "Dear User :- Google Chrome Latest Version ( 92 ) Install Kar Len@@A NGET KA COPY NEHI HE NGET K JAISA BANAYA GEYA HE Q KI O SAB USER KO SAMAJ YA GEYA HE@Hum Aapka Koi Data Apne Server per Nahi Magate Hain Like( IRCRC ID / BANK / PNR )@@agar Aapko Passenger Submit ke Baar Relogin ya ReSumbit ki Problem aa Rahi hait Ccleaner Chala Kar System Re-Start Kar Len, Aur Net Disconnect karaoke Connect kar len, agar VPS hai to VPS ko shutDown karke Wapas Chalu kar len, Yeh Problem Software ki nahi",
        	'News' => null,
        	'KeyType' => "monthly",
        	'PaidStatus' => "Paid",
        ];
    }

echo json_encode($result);