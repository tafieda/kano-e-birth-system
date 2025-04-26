<?php
session_start();
error_reporting(0);
include('includes/security.php');
if (strlen($_SESSION['kano_ebs_aid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
    {
  
  
  $vid=$_GET['viewid'];
      $bookingid=$_GET['bookingid'];
      $status=$_POST['status'];
     $remark=$_POST['remark'];
    
  
  $sql= "UPDATE tblapplication set Status=:status,Remark=:remark where ID=:vid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':status',$status,PDO::PARAM_STR);
  $query->bindParam(':remark',$remark,PDO::PARAM_STR);
  $query->bindParam(':vid',$vid,PDO::PARAM_STR);
  
   $query->execute();
  
    echo '<script>alert("Remark has been updated")</script>';
   echo "<script>window.location.href ='all.php'</script>";
  }

  ?>
<!DOCTYPE html>
<html lang="en">


<!-- salary-view23:28-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Kano State Electronic Birth Registration System - Admin - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
    <?php include 'includes/header.php'?>
    <?php include 'includes/sidebar.php'?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Detail of Application</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white">CSV</button>
                            <button class="btn btn-white">PDF</button>
                            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            
                            
                            <?php
                               $vid=$_GET['viewid'];

$sql="SELECT tblapplication.*,tbluser.FirstName,tbluser.LastName,tbluser.UserName,tbluser.LocalGA from  tblapplication join  tbluser on tblapplication.UserID=tbluser.ID where tblapplication.ID=:vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                                
 <h4 class="page-title text-primary text-uppercase text-center">Application Number:   <?php  echo $row->ApplicationID;?></h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div>

                                        <h4 class="m-b-10"><strong>User Details</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th><strong>First Name</strong></th> 
                                                    <td><?php  echo $row->FirstName;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Last Name</th>
                                                    <td><?php  echo $row->LastName;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>User Name</th>
                                                    <td><?php  echo $row->UserName;?></td>
                                                </tr>
                                                <tr>
                                                    <th>L. G. A.</th>
                                                    <td><?php  echo $row->LocalGA;?></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div>
                                        <h4 class="m-b-10"><strong>Application Details</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>                                  
                                                    <th scope>Full Name</th>
                                                    <td><?php  echo $row->FullName;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Gender</th>
                                                    <td><?php  echo $row->Gender;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Date of Birth</th>
                                                    <td><?php  echo $row->DateofBirth;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Place of Birth</th>
                                                    <td><?php  echo $row->PlaceofBirth;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Name of Father</th>
                                                    <td><?php  echo $row->NameofFather;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Name of Mother</th>
                                                    <td><?php  echo $row->NameofMother;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Father's Residence</th>
                                                    <td><?php  echo $row->FathersResident;?></td>
                                                </tr>
                                                <tr>                                                              
                                                    <th scope>Father's Occupation</th>
                                                    <td><?php  echo $row->FathersOccupation;?></td>
                                                </tr>
                                                <tr>
                                                    <th scope>Father's Email</th>
                                                    <td><?php  echo $row->Email;?></td>
                                                </tr>
                                                <tr>                                                              
                                                    <th scope>Date of apply</th>
                                                    <td><?php  echo $row->DateofApply;?></td>
                                                </tr>
                                                <tr>

                                                    <th>Application Remark</th>
                                                    <td>
                                                        <?php

                                                            if($row->Status=="Verified")
                                                            {
                                                                echo ($row->Remark);
                                                            }
                                                            if($row->Status=="Rejected")
                                                            {
                                                                echo ($row->Remark);
                                                            }
                                                        
                                                        
                                                            if($row->Status=="Pending")
                                                            {
                                                                echo "Your application is still Pending";
                                                            }
                                                        
                                                        
                                                        ;?>
                                                     </td>
                                                </tr>
                                                <tr>
                                                    <th >Application Status</th>
                                                        <?php if($row->Status=="Pending"){ ?>

                                                    <td><?php echo "Your application is still pending"; ?></td>
                                                        <?php } else { ?>                
                                                    <td><?php  echo htmlentities($row->Status);?></td>
                                                        <?php } ?>
                                                </tr>
                                                <?php $cnt=$cnt+1;}} ?>
                                            </tbody>
                                        </table>
                                        <?php 

if ($status=="Pending"){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button class="tn btn-primary submit-btn" data-toggle="modal" data-target="#decide-detail">Decide</button></p>  

<?php } ?>
                                        <div id="decide-detail" class="modal fade delete-modal" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="m-b-10">Decide </h4>
                        </div>
						<div class="modal-body text-center">
                        <form method="post" name="submit">
                            <table class="table table-bordered table-hover data-tables">   
                                <tr>
                                    <th>Application Remark :</th>
                                    <td><textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
                                </tr> 


                                <tr>
                                    <th>Application Status :</th>
                                    <td>
                                        <select name="status" class="form-control wd-450" required="true" >
                                            <option value="Pending" selected="true">Pending</option>
                                            <option value="Verified">Verified</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
							<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
								<button type="submit" name="submit" class="btn btn-primary">Update</button>
							</div>
                        </form>
						</div>
					</div>
				</div>
			</div>
                                    </div>
                                </div>
                                <!--div class="col-sm-12">
                                    <p><strong>Net Salary: $59698</strong> (Fifty nine thousand six hundred and ninety eight only.)</p>
                                </div-->
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