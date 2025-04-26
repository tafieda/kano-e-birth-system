<?php
session_start();
error_reporting(0);
include('includes/security.php');
if (strlen($_SESSION['kano_ebs_aid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
    {
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $usern=$_POST['usern'];
      $email=$_POST['email'];
      $rank=$_POST['rank'];
      $bdate=$_POST['bdate'];
      $gender=$_POST['gender'];
      $phone=$_POST['phone'];
      $lga=$_POST['lga'];
      $password=md5($_POST['password']);
      $ret="select Username from tbluser where Username=:usern";
      $query= $dbh -> prepare($ret);
      $query-> bindParam(':usern', $uname, PDO::PARAM_STR);
      $query-> execute();
      $results = $query -> fetchAll(PDO::FETCH_OBJ);
  if($query -> rowCount() == 0)
  {
  $sql="Insert Into tbluser(FirstName,LastName,Username,Rank,Gender,MobileNumber,Email,LocalGA,Password)Values(:fname,:lname,:usern,:rank,:gender,:phone,:email,:lga,:password)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':fname',$fname,PDO::PARAM_STR);
  $query->bindParam(':lname',$lname,PDO::PARAM_STR);
  $query->bindParam(':usern',$uname,PDO::PARAM_STR);
  $query->bindParam(':rank',$rank,PDO::PARAM_STR);
  $query->bindParam(':gender',$gender,PDO::PARAM_STR);
  $query->bindParam(':phone',$phone,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':lga',$lga,PDO::PARAM_STR);
  
  $query->bindParam(':password',$password,PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId)
  {
    $alertsuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your Profile has been added successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
} elseif ($lastInsertId(0)){
$alertwarn = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Warning!</strong> There was a problem with your network connection.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
} else {
$alerterror = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Error!</strong> This User Name Already exist. Please try different username.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';

} 
  
  }

} 
  
 
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add User</h4>
                        <?php echo $alertsuccess;?>
                        <?php echo $alertwarn;?>
                        <?php echo $alerterror;?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="fname" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text" name="lname">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="usern" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="password" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="cpassword" required="true">
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Male" class="form-check-input">Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Female" class="form-check-input">Female
											</label>
										</div>
									</div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>Rank</label>
												<select class="form-control select" name="rank">
                                                    <?php include 'equip/rank.php'?>
												</select>
											</div>
										</div>
										
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>Local Government Area</label>
												<select class="form-control select" name="lga">
                                                    <?php include 'equip/localga.php'?>
												</select>
											</div>
										</div>
										
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" type="text" name="phone">
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group">
										<label>Avatar</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" class="form-control">
											</div>
										</div>
									</div>
                                </div>
                            </div>
							                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="submit">Create User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			
        </div>
        
    </div>
    <?php include 'includes/scripts.php'?>
</body>
</html><?php } ?>
