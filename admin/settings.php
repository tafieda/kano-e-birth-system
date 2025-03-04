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
                    <div class="col-md-6 offset-md-3">
                        <h4 class="page-title">Change Password</h4>
                        <form>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center m-t-20">
                                    <button type="button" class="btn btn-primary submit-btn">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <?php include 'includes/scripts.php'?>
</body>
</html>