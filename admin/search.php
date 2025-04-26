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
                    <div class="col-sm-12">
                        <h4 class="page-title">Search All Application</h4>
                    </div>
                </div>
                <form method="post" class="row filter-row">
                    
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group form-focus">
                                <label class="focus-label">Application ID</label>
                                <input id="searchdata" type="text" name="searchdata" required="true" class="form-control floating">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <button class="btn btn-block btn-success" type="submit" name="search">Search</button>
                        </div>
                    
  </form>
               
                <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 class="page-title text-success text-center">Result against "<?php echo $sdata;?>" keyword </h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th data-field="state" data-checkbox="true"></th>
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
                                          
                                          $sql="SELECT * from tblapplication where ApplicationID like '$sdata%'";
                                          
                                          $query = $dbh -> prepare($sql);
                                          $query->execute();
                                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                                          
                                          $cnt=1;
                                          if($query->rowCount() > 0)
                                          {
                                          foreach($results as $row)
                                          {               ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php  echo htmlentities($row->ApplicationID);?></td>
                                        <td><?php  echo htmlentities($row->FullName);?></td>
                                        <td><?php  echo htmlentities($row->NameofFather);?></td>
                                        <td><?php  echo htmlentities($row->NameofMother);?></td>
                                        <?php if($row->Status=="Pending"){ ?>

                                        <td><span class="custom-badge status-orange"><?php echo "Pending"; ?></span></td>
                                        <?php } elseif($row->Status=="Verified"){  ?>
                                        
                                        <td><span class="custom-badge status-green"><?php echo "Verified"; ?></span></td>
                                        <?php } else { ?>
                                        
                                        <td><span class="custom-badge status-red"><?php echo "Rejected"; ?></span></td>
                                        <?php } ?>
                                        
                                        <td><a href="detail.php?viewid=<?php echo htmlentities ($row->ID);?>" class="action-icon" aria-expanded="false"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                </tbody>
                                <?php 
$cnt=$cnt+1;
} } } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/scripts.php'?>
</body>
</html><?php } ?>