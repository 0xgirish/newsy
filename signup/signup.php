
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
                                <input type="password" name="pass" placeholder="password" minlength="7" class="form-control" title='Password should have minimum lenght 7' required/>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="contact" placeholder="contact e.g. 9990011122" class="form-control" pattern="[0-9]{10}" id="contact" required/>
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