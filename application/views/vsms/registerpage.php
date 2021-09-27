<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url();?>bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
    <title>Registration Page</title>
</head>
<body>
        
       
       <form class="main-div" action="<?php echo site_url('Register');?>" method="post">
            <h2 class="center">VS Monitor Registration</h2>
            <div class="form-group">
                <input type="text" placeholder="Firstname . . ." name="fname" class="form-control">
                <?php echo form_error('fname','<div class="alert alert-danger">','</div>') ?>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Lastname . . ." name="lname" class="form-control">
                <?php echo form_error('lname','<div class="alert alert-danger">','</div>') ?>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Username . . ." name="username" class="form-control">
                <?php echo form_error('username','<div class="alert alert-danger">','</div>') ?>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password . . ." name="password" class="form-control">
                <?php echo form_error('password','<div class="alert alert-danger">','</div>') ?>
            </div>
            <div class="form-group center">
                <input type="submit" name="submit" value="Register" class="btn btn-primary">
            </div>
                <p class="center">Already have an account? <a href="<?php echo ('loginpage');?>"><u style="color: white">Click here</u></a></p>
        </form>



       


</body>
</html>