<?php session_start(); ?>
<?php include 'header.php'; ?>
<?php include '../dbconn.php' ?>
<section class="content-height">
    <div class="container mt-5">
        <div class="row text-center py-3">
            <?php
            if (isset($_SESSION['addusr_id']) && isset($_SESSION['addusr_name'])) {
                echo strtoupper('<small> WELCOME TO YOUR <strong>SUPER</strong> DASHBOARD, ' . strtoupper($_SESSION['addusr_name']) . "</small>");
                 $user_sellr = $_SESSION['addusr_id'];
            } else {
                unset($_SESSION['addusr_name']);
                unset($_SESSION['addusr_id']);
                header('location:index.php');
            }
            
             if(isset( $_SESSION['credit_empty'])){
                echo  $_SESSION['credit_empty'];
                unset( $_SESSION['credit_empty']);
            }
            ?>
        </div>
        <style>
            input.invalid {
                background-color: #ffdddd;
            }
        </style>
        <div class="row text-left py-3 form-validate">
            <?php
            if (isset($_SESSION['delseid'])) {
                echo $_SESSION['delseid'];
                unset($_SESSION['delseid']);
            }
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            ?>
            <form class="row g-2" method="post" action="addnew_user.php" enctype="multipart/form-data" onsubmit="return dataValidatelogIn();">
                <div class="col-md-3 offset-md-1">
                    <label for="inputUsrName" class="form-label">User Name</label>
                    <input type="text" class="form-control" name="new_user" id="new_userfor" placeholder="User Name">
                    <small id="UserName" class="form-text text-muted"><?php
                                                                        if (isset($_SESSION['add_username'])) {
                                                                            echo $_SESSION['add_username'];
                                                                            unset($_SESSION['add_username']);
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        if (isset($_SESSION['username_exits'])) {
                                                                            echo $_SESSION['username_exits'];
                                                                            unset($_SESSION['username_exits']);
                                                                        } else {
                                                                            echo "<code>Please Use an Unique User Name.</code>";
                                                                        }
                                                                        ?></small>
                </div>
                <div class="col-md-2">
                    <label for="inputUser" class="form-label">User Role</label>
                    <select id="UserRoleFor" name="UserRoleFor" class="form-select">
                        <option selected>Choose User Role</option>
                        <option name="UserRoleFor">Seller</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputUsrCredit" class="form-label">Credit</label>
                    <input type="number" value="0" min="0" max="100" class="form-control" id="credit_quantity" name="credit_quantity">
                </div>
                <div class="col-md-2">
                    <label for="inputUsrPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Enter a Password">
                </div>

                <!--<div class="col-md-1">-->
                <!--    <label for="inputUsrCredit" class="form-label">Credit</label>-->
                <!--    <input type="number" value="0" min="0" max="100" class="form-control" id="credit_quantity" name="credit_quantity">                    -->
                <!--</div>-->
                <div class="col-md-1">
                    <button type="submit" style="margin-top: 35px;" name="addnew_user" class="btn app-btn-primary w-100 theme-btn mx-auto">Add</button>
                </div>

            </form>
        </div>




        <body class="app">
            <header class="app-header fixed-top">
                <div class="app-header-inner">
                    <div class="container-fluid py-2">
                        <div class="app-header-content">
                            <div class="row justify-content-between align-items-center">

                                <div class="col-auto">
                                    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                            <title>Menu</title>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                        </svg>
                                    </a>
                                </div>
                                <!--//col-->
                                <div class="search-mobile-trigger d-sm-none col">
                                    <i class="search-mobile-trigger-icon fas fa-search"></i>
                                </div>
                                <!--//col-->
                                <div class="app-search-box col">
                                    <form class="app-search-form">
                                        <input type="text" placeholder="Search..." name="search" class="form-control search-input">
                                        <button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                                <!--//app-search-box-->

                                <div class="app-utilities col-auto">
                                    <div class="app-utility-item">
                                        <strong>
                                            Your Total Remaining Credit : <?php
                                                                            if (isset($_SESSION['super_credit'])) {
                                                                                echo  $_SESSION['super_credit'];
                                                                            }
                                                                            ?>
                                        </strong>
                                    </div>
                                    <!--<div class="app-utility-item app-notifications-dropdown dropdown">-->
                                    <!--    <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Notifications">-->
                                    <!--        //Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <!--        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
                                    <!--            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />-->
                                    <!--            <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />-->
                                    <!--        </svg>-->
                                    <!--        <span class="icon-badge">3</span>-->
                                    <!--    </a>-->
                                    <!--    //dropdown-toggle-->

                                    <!--    <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">-->
                                    <!--        <div class="dropdown-menu-header p-3">-->
                                    <!--            <h5 class="dropdown-menu-title mb-0">Notifications</h5>-->
                                    <!--        </div>-->
                                    <!--        //dropdown-menu-title-->
                                    <!--        <div class="dropdown-menu-content">-->
                                    <!--            <div class="item p-3">-->
                                    <!--                <div class="row gx-2 justify-content-between align-items-center">-->
                                    <!--                    <div class="col-auto">-->
                                    <!--                        <img class="profile-image" src="../images/avatar.png" alt="">-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                    <div class="col">-->
                                    <!--                        <div class="info">-->
                                    <!--                            <div class="desc">Amy shared a file with you. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>-->
                                    <!--                            <div class="meta"> 2 hrs ago</div>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                </div>-->
                                    <!--                //row-->
                                    <!--                <a class="link-mask" href="notifications.html"></a>-->
                                    <!--            </div>-->
                                    <!--            //item-->
                                    <!--            <div class="item p-3">-->
                                    <!--                <div class="row gx-2 justify-content-between align-items-center">-->
                                    <!--                    <div class="col-auto">-->
                                    <!--                        <div class="app-icon-holder">-->
                                    <!--                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
                                    <!--                                <path fill-rule="evenodd" d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />-->
                                    <!--                                <path fill-rule="evenodd" d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />-->
                                    <!--                            </svg>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                    <div class="col">-->
                                    <!--                        <div class="info">-->
                                    <!--                            <div class="desc">You have a new invoice. Proin venenatis interdum est.</div>-->
                                    <!--                            <div class="meta"> 1 day ago</div>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                </div>-->
                                    <!--                //row-->
                                    <!--                <a class="link-mask" href="notifications.html"></a>-->
                                    <!--            </div>-->
                                    <!--            //item-->
                                    <!--            <div class="item p-3">-->
                                    <!--                <div class="row gx-2 justify-content-between align-items-center">-->
                                    <!--                    <div class="col-auto">-->
                                    <!--                        <div class="app-icon-holder icon-holder-mono">-->
                                    <!--                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
                                    <!--                                <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />-->
                                    <!--                            </svg>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                    <div class="col">-->
                                    <!--                        <div class="info">-->
                                    <!--                            <div class="desc">Your report is ready. Proin venenatis interdum est.</div>-->
                                    <!--                            <div class="meta"> 3 days ago</div>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                </div>-->
                                    <!--                //row-->
                                    <!--                <a class="link-mask" href="notifications.html"></a>-->
                                    <!--            </div>-->
                                    <!--            //item-->
                                    <!--            <div class="item p-3">-->
                                    <!--                <div class="row gx-2 justify-content-between align-items-center">-->
                                    <!--                    <div class="col-auto">-->
                                    <!--                        <img class="profile-image" src="assets/images/profiles/profile-2.png" alt="">-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                    <div class="col">-->
                                    <!--                        <div class="info">-->
                                    <!--                            <div class="desc">James sent you a new message.</div>-->
                                    <!--                            <div class="meta"> 7 days ago</div>-->
                                    <!--                        </div>-->
                                    <!--                    </div>-->
                                    <!--                    //col-->
                                    <!--                </div>-->
                                    <!--                //row-->
                                    <!--                <a class="link-mask" href="notifications.html"></a>-->
                                    <!--            </div>-->
                                    <!--            //item-->
                                    <!--        </div>-->
                                    <!--        //dropdown-menu-content-->

                                    <!--        <div class="dropdown-menu-footer p-2 text-center">-->
                                    <!--            <a href="notifications.html">View all</a>-->
                                    <!--        </div>-->

                                    <!--    </div>-->
                                    <!--    //dropdown-menu-->
                                    <!--</div>-->
                                    <!--//app-utility-item-->
                                    <!--<div class="app-utility-item">-->
                                    <!--    <a href="#" title="Settings">-->
                                    <!--        //Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <!--        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
                                    <!--            <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />-->
                                    <!--            <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />-->
                                    <!--        </svg>-->
                                    <!--    </a>-->
                                    <!--</div>-->
                                    <!--//app-utility-item-->

                                    <div class="app-utility-item app-user-dropdown dropdown">
                                        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="../images/avatar.png" alt="user profile"></a>
                                        <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                            <li><a class="dropdown-item" href="dashboard.php">Change Password</a></li>
                                            <!--<li><a class="dropdown-item" href="#">Settings</a></li>-->
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                                        </ul>
                                    </div>
                                    <!--//app-user-dropdown-->
                                </div>
                                <!--//app-utilities-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-header-content-->
                    </div>
                    <!--//container-fluid-->
                </div>
                <!--//app-header-inner-->

            </header>
            <!--//app-header-->

            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <?php
                                        $displaytable = "";
                                        $sttab = "SELECT * FROM `u241746118_ems`.`adduser`  WHERE `usraccnt_by` = '$user_sellr'";
                                        $resulttab = $conn->query($sttab);
                                        $resulttab->execute();
                                        $datatab = $resulttab->rowCount();
                                        //echo $datatab;
                                        if ($datatab > 0) {
                                            $displaytable = "";
                                        } else {
                                            $displaytable = " displaynotable";
                                        }
                                        ?>
                                        <style>
                                            .displaynotable {
                                                display: none;
                                            }
                                        </style>
                                        <table class="table app-table-hover mb-0 text-center <?php echo $displaytable; ?>">
                                            <thead>
                                                <tr>
                                                    <th class="cell">Sr. No.</th>
                                                    <th class="cell">Username</th>
                                                    <th class="cell">Creation Date</th>
                                                    <th class="cell">Remaining Credit</th>
                                                    <!--<th class="cell">Left Days</th>-->
                                                    <th class="cell">Status</th>
                                                    <th colspan="5" class="cell text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <?php
                                                    
                                                    $i = 1;
                                                    $stmnt = "SELECT * FROM `u241746118_ems`.`adduser` WHERE `usraccnt_by` = '$user_sellr'";
                                                    $result = $conn->prepare($stmnt);

                                                    // $result->bindParam(':user_email', $usr_email, PDO::PARAM_STR);
                                                    // $result->bindParam(':user_pass', $usr_password, PDO::PARAM_STR);        
                                                    $result->execute();
                                                    $count = $result->rowCount();
                                                    //echo $count;
                                                    if ($count > 0) {
                                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                            $expiredate = strtotime($row['addusr_exipre']);
                                                            $todaydate = strtotime(date('Y-m-d h:i:sa'));
                                                            $daysleft = ceil(($expiredate - $todaydate) / 60 / 60 / 24);

                                                            $user_nid = $row['addusr_id'];
                                                            if ($todaydate) {
                                                                $status = "Active";
                                                            } else {
                                                                $status = "Expire";
                                                            }

                                                    ?>
                                                                <script type="text/javascript">
                                                                    var status = "Active";
                                                                    if (status == "Active") {
                                                                        document.getElementById('deactivationbtn').innerHTML = "Deactivate";
                                                                    } else {
                                                                        document.getElementById('deactivationbtn').innerHTML = "Active";
                                                                    }
                                                                </script>
                                                                <td class="cell"><?php echo $i; ?></td>
                                                                <td class="cell"><?PHP echo $row['addusr_name']; ?></td>
                                                                <td class="cell"><?PHP echo $row['addusr_signup_date']; ?></td>
                                                                <td class="cell"><?PHP echo $row['addusr_credit']; ?></td>
                                                                <td class="cell"><?php echo $status; ?></td>
                                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">Add</a></td>
                                                                <!--<td class="cell"><a class="btn-sm app-btn-secondary" href="#">Reset</a></td>-->
                                                                <td class="cell"><a class="btn-sm app-btn-secondary" id="deactivationbtn" href="deactivae_user.php?id=<?php echo $row['addusr_id']; ?>">Deactivate</a></td>

                                                </tr> <?php 
                                                            $i++;
                                                        }
                                                    } else {
                                                        $record =  "<h4 class='text-center p-5'>No Record is Founded!</h4>";
                                                        echo $record;
                                                    }
                                                        ?>


                                            </tbody>
                                        </table>


                                    </div>
                                    <!--//table-responsive-->

                                </div>
                                <!--//app-card-body-->
                            </div>
                            <!--//app-card-->
                            <?php
                            $displaynav  = " ";
                            $st = "SELECT * FROM `u241746118_ems`.`adduser`  WHERE `usraccnt_by` = '$user_sellr'";
                            $resultpage = $conn->query($st);
                            $resultpage->execute();
                            $datapage = $resultpage->rowCount();
                            $page = 0;;
                            $limit = 20;
                            $total_pages = ceil($datapage / $limit);
                            // echo $data;
                            if ($datapage >= 20) {
                                $displaynav = "";
                                echo $datapage;
                            } else {
                                $displaynav = " displaynonav";
                            }
                            ?>
                            <style>
                                .displaynonav {
                                    display: none;
                                }
                            </style>
                            <?php

                            if (!isset($_GET['page'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }
                            $start = ($page - 1) * $limit;

                            ?>
                            <nav class="app-pagination <?php echo $displaynav; ?>">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?= $page == $p ? 'active' : ''; ?>"><a class="page-link" href="?page=1" tabindex="-1" aria-disabled="true">Previous</a></li>
                                    <?php for ($p = 1; $p <= $total_pages; $p++) { ?>
                                        <li class=" page-item <?= $page == $p ? 'active' : ''; ?>"><a class="page-link" href="<?= '?page=' . $p; ?>"><?= $p; ?></a></li>
                                    <?php } ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $total_pages; ?>">Next</a></li>
                                </ul>
                            </nav>
                            <!--//app-pagination-->

                        </div>
                        <!--//tab-pane-->


                        <!--//table-responsive-->
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>



    </div>
    <!--//container-fluid-->
    </div>
    <!--//app-content-->




    </div>

</section>
<script type="text/javascript">
    function dataValidatelogIn() {
        var username = $('#new_userfor').val();
        if (username == "") {
            alert("Please Input a User Name!");
            return false;
        }
        var userrole = $('#UserRoleFor').val();
        if (userrole == " " || userrole == "Choose User Role") {
            alert("Please Select User Role!");
            return false;
        }
        var selectstate = $('#inputStateFor').val();

        if (selectstate == " " || selectstate == "Choose State") {
            alert("Please Select an State!");
            return false;
        }
        var usserpassword = $('#userPassword').val();
        var usserpasswordlenght = $('#userPassword').val().length;
        if (usserpassword == "") {
            alert("Please Enater a strong password!");
            return false;
        } else if (usserpasswordlenght <= 4) {
            alert("Please Enater min 5 digit password!");
            return false;
        }

        var supercredit= $('#credit_quantity').val();
        if(supercredit < 0){
             alert("Please Enater a Credit!");
            return false;
        }

    }
</script>
<?php include 'footer.php'; ?>