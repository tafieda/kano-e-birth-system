<?php
session_start();
error_reporting(0);
include('includes/security.php');
if (strlen($_SESSION['kano_ebs_aid']==0)) {
  header('location:logout.php');
  } else{



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
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Activities</h4>
                    </div>
                </div>
                <?php 
                        $sql ="SELECT tblapplication.*,tbluser.FirstName,tbluser.LastName from  tblapplication join  tbluser on tblapplication.UserID=tbluser.ID where Status ='Pending' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="activity">
                            <div class="activity-box">
                                <ul class="activity-list">
                                <?php
foreach($results as $row)
{ 

  ?>   
                                    <li>
                                        <div class="activity-user">
                                            <a href="user.php?userid=<?php echo htmlentities ($row->ID);?>" title="<?php  echo $row->FirstName;?> <?php  echo $row->LastName;?>" data-toggle="tooltip" class="avatar">
                                                <img alt="Lesley Grauer" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="activity-content">
                                            <div class="timeline-content">
                                                <a href="user.php?userid=<?php echo htmlentities ($row->ID);?>" class="name"><?php  echo $row->FirstName;?> <?php  echo $row->LastName;?></a> added new record <a href="detail.php?viewid=<?php echo htmlentities ($row->ID);?>"><?php  echo $row->FullName;?></a>
                                                <span class="time"><?php  echo $row->DateofApply;?></span>
                                            </div>
                                        </div>
										
                                    </li>
                                    <?php  } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/scripts.php'?>
</body>
</html><?php }  ?>