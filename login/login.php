<?php
include './includes/common.php';
if(isset($_SESSION['email'])){
    header('location: home.php');
}else{
?>

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
                                <input type="email" name="email" placeholder="e-mail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="password" autocomplete="off" class="form-control" required/>
                            </div>
                            <div class="form-group"><div class="row">
                            <div class="col-xs-5"><a href="forgot.php" style="color:#777">I forgot my password! </a></div>
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
<?php }?>
