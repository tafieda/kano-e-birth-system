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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Kano State Electronic Birth Registration System - Admin - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes/header.php'?>
        <?php include 'includes/sidebar.php'?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Users</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-user.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                </div>
                <div class="row doctor-grid">
                <?php

$sql="SELECT * from  tbluser";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
				
                    <div class="col-md-4 col-sm-4  col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="user.php?userid=<?php echo htmlentities ($row->ID);?>"><img alt="" src="assets/img/user.jpg"></a>
                            </div>
                            
                            <h4 class="doctor-name text-ellipsis"><a href="user.php?userid=<?php echo htmlentities ($row->ID);?>"><?php  echo $row->FirstName;?> <?php  echo $row->LastName;?></a></h4>
                            <div class="doc-prof"><?php  echo $row->Rank;?></div>
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i> <?php  echo $row->LocalGA;?>
                            </div>
                        </div>
                    </div>
                   
                    <?php $cnt=$cnt+1;}} ?>
                   
                    
                    
                </div>
				<!--div class="row">
                    <div class="col-sm-12">
                        <div class="see-all">
                            <a class="see-all-btn" href="javascript:void(0);">Load More</a>
                        </div>
                    </div>
                </div-->
            </div>
            
        </div>
        
    </div>
    <?php include 'includes/scripts.php'?>
</body>
</html>
<?php } ?>