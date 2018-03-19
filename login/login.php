<?php
include '../includes/common.php';
if(isset($_SESSION['email'])){
    header('location: home.php');
}else{
?>
<html>
    <head>
        <title>Newsy</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="../includes/bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="../includes/bootstrap/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Inconsolata|Shadows+Into+Light" rel="stylesheet">
    </head>
    <body>
        <div class="container" style="z-index: 30;opacity: 1;margin-top: 120px">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading panel-improve" style="text-align: center">
                        <div class="container-fluid">
                                <b>Log In</b>
                        </div>
                    </div>
                    <div class="panel-body">
                        <br/>
                        <form method="post" action="login_submit.php">
                            <div class="form-group">
                                <input type="text" name="username" placeholder="username" class="form-control" minlength="5"  required/>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="password" autocomplete="off" class="form-control" required/>
                            </div>
                            <div class="form-group"><div class="row">
                            <?php $error = filter_input(INPUT_GET,'error'); echo '<div class="col-xs-4 col-xs-offset-3" style="color:red"><b>'.$error.'</b></div>';?>
                            </div></div>
                            <input type="hidden" name="pid" value=<?php echo filter_input(INPUT_GET,'pid');?>>
                            <input type="hidden" name="quantity" value=<?php echo filter_input(INPUT_GET,'quantity');?>>
                            <input type="submit" value="submit" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="panel-footer">
                        <p>Don't have an account? <a href="signUp.php" style="color: blueviolet">Register</a></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php }?>