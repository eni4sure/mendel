<?php require 'config.php'; ?>
<?php

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if( isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ){
        header("location:dashboard/index.php");
    }

    $error = array();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Validate email
        if(empty(trim($_POST["email"]))){

            $error[] = "Please enter a email.";
        } else {

            $sql = "SELECT * FROM tbl_users WHERE user_email = '".$_POST['email']."'";
            $result = mysqli_query($conn, $sql);

            if ($result) {

                if (mysqli_num_rows($result) > 0) {

                    $error[] = "This email is already taken.";
                } else {

                    $email = trim($_POST["email"]);
                }
            } else {

                $error[] = "Connection Error Occurred.";
            }

        }

        if(empty(trim($_POST["first_name"]))){

            $error[] = "Please enter a First Name.";     
        } else {
            $first_name = trim($_POST["first_name"]);
        }

        if(empty(trim($_POST["last_name"]))){

            $error[] = "Please enter a Last Name.";     
        } else {
            $last_name = trim($_POST["last_name"]);
        }

        if(empty(trim($_POST["password"]))){

            $error[] = "Please enter a password.";     
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty(trim($_POST["group"]))){

            $error[] = "Please select a group.";     
        } else {
            $group = trim($_POST["group"]);
        }
        
        if(count($error) == 0){

            $query = "INSERT INTO `tbl_users` (`user_fname`, `user_lname`, `user_group`, `user_email`, `user_password`, `user_unique_id`) VALUES ( '".$first_name."', '".$last_name."', '".$group."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."', '".uniqid()."')";
            $result = mysqli_query($conn,$query);

            print_r( $query );

            if ($result) {
               
                // Redirect to login page
                header("location: login.php");

            } else {

                $error[] = "Something went wrong. Please try again later.";
            }
            
        }    
    }
?>
<!DOCTYPE html>
<html>

<?php $page_title = "Register"; ?>
<?php require 'constant/head.php'; ?>

<body class="auth_bridge_backg">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>

                <div class="col-lg-12 login-title">
                    REGISTER | <?php echo $config['app_name']; ?>
                </div>

                <?php
                    if(count($error) != 0){
                        echo '<div class="col-lg-12 error_list">';
                        foreach ($error as $value) {
                            echo "<li>".$value."</li>";
                        }
                        echo "</div>";
                    }
                ?>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">First Name</label>
                                <input required type="text" name="first_name" class="form-control auth_bridges">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Last Name</label>
                                <input required type="text" name="last_name" class="form-control auth_bridges">
                            </div>
                            <select name="group" class="form-control auth_bridges" required>
                                <option value="" selected disabled>Choose a group</option>
                                <option>Cold</option>
                                <option>Cool</option>
                                <option>Bold</option>
                            </select>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input required type="email" name="email" class="form-control auth_bridges">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input required type="password" name="password" class="form-control auth_bridges">
                            </div>
                            <div class="col-lg-12 login-btm login-button">
                                <button name="submitted" type="submit" class="btn btn-outline-primary">REGISTER</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <p class="text-white">Already registered?, <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php require 'constant/footer_scripts.php'; ?>

</body>

</html>