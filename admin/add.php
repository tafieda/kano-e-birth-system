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
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
                        <h4 class="page-title">New Application</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Application Number</th>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>Mother's Name</th>
									<th>Status</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                          
                                          $sql="SELECT * from tblapplication where Status='Pending'";
                                          
                                          $query = $dbh -> prepare($sql);
                                          $query->execute();
                                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                                          
                                          $cnt=1;
                                          if($query->rowCount() > 0)
                                          {
                                          foreach($results as $row)
                                          {               ?>

                               <tr>
                                   
                                    <td><?php echo htmlentities($cnt);?></td>
									<td><?php  echo htmlentities($row->ApplicationID);?></td>
									<td><?php  echo htmlentities($row->FullName);?></td>
									<td><?php  echo htmlentities($row->NameofFather);?></td>
                                    <td><?php  echo htmlentities($row->NameofMother);?></td>
                                    <td><span class="custom-badge status-orange"><?php echo  htmlentities ($row->Status); ?></span></td>
                                    

									<td><a href="detail.php?viewid=<?php echo htmlentities ($row->ID);?>" class="action-icon" aria-expanded="false"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <?php $cnt=$cnt+1;}} ?> 
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/scripts.php'?>
</body>
</html><?php }  ?>