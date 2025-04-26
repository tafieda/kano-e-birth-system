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
                        <h4 class="page-title">Between Dates Report</h4>
                    </div>
                </div>
                <form method="post" name="bwdatesreport" class="row filter-row">
                    <!--div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Purchased By</label>
                            <select class="select floating">
                            <option value="">Select buyer</option>
                            <option value="">buyer 1</option>
                            <option value="">buyer 2</option>
                            </select>
                        </div>
                    </div-->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <label class="focus-label">From</label>
                            <div class="cal-icon">
                                <input type="text" id="fromdate" name="fromdate" class="form-control floating datetimepicker" required='true'>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <label class="focus-label">To</label>
                            <div class="cal-icon">
                                <input type="text" id="todate" name="todate" class="form-control floating datetimepicker" required='true'>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-success btn-block" type="submit" name="search">Search</button>
                    </div>
                </form>
                <?php
                if(isset($_POST['search']))
                { 
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

?>
               <h4 class="page-title text-success text-center">Report from <?php echo $fdate?> to <?php echo $tdate?></h4>
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
                                          
                                          $sql="SELECT * from tblapplication where date(DateofApply) between '$fdate' and '$tdate'";
                                          
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
                                    <?php $cnt=$cnt+1;}}} ?> 
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
</html><?php } ?>