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

            $error[] = "Please enter an email.";
        } else {
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["password"]))){

            $error[] = "Please enter a password.";     
        } else {
            $password = trim($_POST["password"]);
        }

        if(count($error) == 0){

            $query = "SELECT * FROM `tbl_users` WHERE user_email = '".$email."'";
            $result = mysqli_query($conn,$query);

            if ($result) {

                $row = mysqli_fetch_assoc($result);

                if ( mysqli_num_rows($result) == 1 ){

                    if (password_verify($password, $row["user_password"])){

                        $_SESSION['email'] = $row['user_email'];
                        $_SESSION['unique_id'] = $row['user_unique_id'];
                        $_SESSION["loggedin"] = true;
                        header("Location:dashboard/index.php");

                    } else{
                        $error[] = "The password you entered is not correct.";
                    }
                } else {
                    $error[] = "This email does not exist";
                }               
            } else {
                $error[] = "Something went wrong. Please try again later.";
            }
        }    
    }

?>
<!DOCTYPE html>
<html>

<?php $page_title = "Login"; ?>
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
                    LOGIN | <?php echo $config['app_name']; ?>
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
                                <label class="form-control-label">Email</label>
                                <input type="email" name="email" class="form-control auth_bridges">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input type="password" name="password" class="form-control auth_bridges">
                            </div>
                            <div class="col-lg-12 login-btm login-button">
                                <button name="submitted" type="submit" class="btn btn-outline-primary">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <p class="text-white">Not registered?, <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>

    <?php require 'constant/footer_scripts.php'; ?>

</body>

</html>