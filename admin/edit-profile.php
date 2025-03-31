
    <?php
    session_start();
    error_reporting(0);
    include('includes/security.php');
    if (strlen($_SESSION['kano_ebs_aid']==0)) {
      header('location:logout.php');
      } else{
        if(isset($_POST['submit']))
      {
        $adminid=$_SESSION['kano_ebs_aid'];
        $AName=$_POST['firstname'];
      $mobno=$_POST['mobilenumber'];
      $email=$_POST['email'];
      $sql="update tbladmin set FirstName=:firstname,MobileNumber=:mobilenumber,Email=:email where ID=:aid";
         $query = $dbh->prepare($sql);
         $query->bindParam(':firstname',$AName,PDO::PARAM_STR);
         $query->bindParam(':email',$email,PDO::PARAM_STR);
         $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
         $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
    $query->execute();
    
            echo '<script>alert("Profile has been updated")</script>';
             echo "<script>window.location.href ='edit-profile.php'</script>";
         
    
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
                <div class="col-sm-12">
                    <h4 class="page-title">Edit Profile</h4>
                </div>
            </div>
                <form method="post">
                <?php

$sql="SELECT * from  tbladmin";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="assets/img/user.jpg" alt="user">
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" type="file">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" class="form-control floating" name="firstname" value="<?php  echo $row->FirstName;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" class="form-control floating" name="lastname" value="<?php  echo $row->LastName;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating datetimepicker" name="dob" type="text" value="<?php  echo $row->DoB;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Gender</label>
                                                <select name="gender" class="select form-control floating">
                                                <option value="selected"><?php  echo $row->Gender;?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Address</label>
                                    <input type="text" class="form-control floating" name="address" value="734 Engr. Rabiu Suleiman Bichi Street">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Area</label>
                                    <input type="text" class="form-control floating" value="Rimin Gata">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">State</label>
                                    <input type="text" class="form-control floating" value="Kano">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Pin Code</label>
                                    <input type="text" class="form-control floating" name="email" value="10523">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Phone Number</label>
                                    <input type="text" class="form-control floating" name="mobilenumber" value="0816-775-5485">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $cnt=$cnt+1;}} ?>
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary submit-btn" type="submit" name="submit">Save</button>
                    </div>
                </form>
        </div>
    </div>
    </div>
   
    <?php include 'includes/scripts.php'?>
</body>
</html>
<?php }  ?>