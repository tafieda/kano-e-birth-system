<?php
session_start();
error_reporting(0);
include('includes/security.php');
if (strlen($_SESSION['kano_ebs_aid']==0)) {
  header('location:logout.php');
  } else{



  ?>
        <div class="header">
            <div class="header-left">
                <a href="index.php" class="logo">
                <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Kano EBRS</span>
                </a>
            </div>
            <a href="javascript:void(0);" id="toggle_btn"><i class="fa fa-bars"></i></a>
            <a href="#sidebar" class="mobile_btn float-left" id="mobile_btn"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
            <?php 
                        $sql ="SELECT tblapplication.*,tbluser.FirstName,tbluser.LastName from  tblapplication join  tbluser on tblapplication.UserID=tbluser.ID where Status ='Pending' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totneworder=$query->rowCount();
?>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"><span class="badge badge-pill bg-danger float-right"><?php echo htmlentities($totneworder);?></span></i></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                            <?php
foreach($results as $row)
{ 

  ?>
                            <li class="notification-message">      
                                    <a href="detail.php?viewid=<?php echo htmlentities ($row->ID);?>">
                                    
                                        <div class="media">
                                            <span class="avatar">
                                            <img alt="John Doe" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title"><?php  echo $row->FirstName;?> <?php  echo $row->LastName;?></span> added new record <span class="noti-title"><?php echo $row->ApplicationID;?></span></p>
                                                <p class="noti-time"><span class="notification-time"><?php echo $row->DateofApply;?></span></p>
                                            </div>
                                        </div>
                                        
                                    </a>
                                </li>
                                <?php  } ?>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.php">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <!--li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li-->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                    <?php
$aid=$_SESSION['kano_ebs_aid'];
$sql="SELECT * from  tbladmin where ID=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span><?php  echo $row->Ad;?> <?php  echo $row->LastName;?></span>
                    </a>
                    <?php $cnt=$cnt+1;}} ?>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<!--a class="dropdown-item" href="edit-profile.php">Edit Profile</a-->
						<a class="dropdown-item" href="settings.php">Settings</a>
						<a class="dropdown-item" href="logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <!--a class="dropdown-item" href="edit-profile.php">Edit Profile</a-->
                    <a class="dropdown-item" href="settings.php">Settings</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
            <!--div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>                      
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div-->
            <?php }  ?>