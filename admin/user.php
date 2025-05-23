<?php
session_start();
error_reporting(0);
include('includes/security.php');
if (strlen($_SESSION['kano_ebs_aid']==0)) {
  header('location:logout.php');
  } 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Kano State Electronic Birth Registration System - Admin - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes/header.php'?>
        <?php include 'includes/sidebar.php'?>
    </div>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-7 col-6">
                    <h4 class="page-title">User Profile</h4>
                </div>

                
            </div>
            <div class="card-box profile-header">
            <?php
$uid=$_GET['userid'];
$sql="SELECT * from  tbluser where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img src="assets/img/user.jpg" alt="" class="avatar"></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0"><?php  echo $row->FirstName;?> <?php  echo $row->LastName;?></h3>
                                            <small class="text-muted"><?php  echo $row->Rank;?></small>
                                            <div class="staff-id">Employee ID : <?php  echo $row->ID_CODE;?> - <?php  echo $row->ID;?></div>
                                            <!--div class="staff-msg"><a href="chat.php" class="btn btn-primary">Send Message</a></div-->
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="tel:+234<?php  echo $row->MobileNumber;?>">0<?php  echo $row->MobileNumber;?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="mailto:<?php  echo $row->Email;?>"><?php  echo $row->Email;?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Local G. Area:</span>
                                                    <span class="text"><?php  echo $row->LocalGA;?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php  echo $row->Gender;?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php $cnt=$cnt+1;}} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/scripts.php'?>
</body>
</html>