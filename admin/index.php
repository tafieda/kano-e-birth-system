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
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php 
$sql ="SELECT * from tblapplication";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalnewapp=$query->rowCount();
?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-database" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo htmlentities($totalnewapp);?></h3>
                                <span class="widget-title1">All Records <a href="all.php"><i class="fa fa-database" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php 
$sql ="SELECT ID from tblapplication where Status='Verified' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalverapp=$query->rowCount();
?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo htmlentities($totalverapp);?></h3>
                                <span class="widget-title2">Verified Records <a href="verify.php"><i class="fa fa-check" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php 
$sql ="SELECT ID from tblapplication where Status='Rejected' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalrejapp=$query->rowCount();
?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-ban" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo htmlentities($totalrejapp);?></h3>
                                <span class="widget-title3">Rejected Records <a href="reject.php"><i class="fa fa-ban" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php 
$sql ="SELECT ID from tblapplication where Status='Pending' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalpendapp=$query->rowCount();
?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-hourglass" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo htmlentities($totalpendapp);?></h3>
                                <span class="widget-title4">Pending Records <a href="add.php"><i class="fa fa-hourglass" aria-hidden="true"></i></a></span>
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
<?php } ?>