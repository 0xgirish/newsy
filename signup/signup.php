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
        <div class="panel panel-primary">
            <div class="panel-heading panel-improve" style="text-align: center">
                <div class="container-fluid">
                    <b>Sign Up</b>
                </div>
            </div>
            <div class="panel-body">
                <form method="post" action="Signup_script.php">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name" id="firstname" required/>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="e-mail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" placeholder="username" minlength="5" class="form-control" title="Username should have minimum length 5" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" placeholder="password" minlength="7" class="form-control" title='Password should have minimum lenght 7' required/>
                    </div>
                    <div class="form-group">
                        <?php $error = filter_input(INPUT_GET,'error'); echo '<div  style="color:red"><b>'.$error.'</b></div>';?>
                    </div>
                    <input type="submit" value="submit" class="btn btn-primary">
                </form>
            </div>
            <div class="panel-footer">
                <p>Already have an account? <a href="?mode=login" style="color: blueviolet">Log-In</a></p>
            </div>
        </div> 
    </body>
</html>