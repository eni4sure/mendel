<?php require '../config.php'; ?>
<?php
	// Check if the user is logged in, if not then redirect him to login page
	if( !isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
	    header("location:../login.php");
    }
    
    $error = array();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

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

        if(empty(trim($_POST["segment"]))){

            $error[] = "Please select a segment.";     
        } else {
            $segment = trim($_POST["segment"]);
        }

        if(count($error) == 0){

            $sql = "SELECT * FROM tbl_family WHERE user_id = '".$_SESSION['unique_id']."'";
            $result = mysqli_query($conn, $sql);

            if ($result) {

                if (mysqli_num_rows($result) > 4) {

                    $error[] = "You already have a max of 4 family members added";
                } else {
                    
                    $query = "INSERT INTO `tbl_family` (`family_user_fname`, `family_user_lname`, `family_user_segment`, `user_id`) VALUES ( '".$first_name."', '".$last_name."', '".$segment."', '".$_SESSION['unique_id']."')";
                    $result = mysqli_query($conn,$query);
        
                    // print_r( $query );
        
                    if ($result) {
                       
                        // Redirect to home page
                        header("location:./");
        
                    } else {
        
                        $error[] = "Something went wrong. Please try again later.";
                    }
                }
            } else {

                $error[] = "Connection Error Occurred.";
            }
        }
    }
?>
<!DOCTYPE html>
<html>

<?php $page_title = "Add Family member"; ?>
<?php require '../constant/head.php'; ?>

<body>

	<?php require '../constant/dashboard_header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php require '../constant/dashboard_sidebar.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Add Family Member</h1>
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

                <form action="" method="POST">
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input name="first_name" type="text" required class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                            <input name="last_name" type="text" required class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Segment</label>
                        <div class="col-sm-10">
                            <select class="form-control" required name="segment">
                                <option value="" selected disabled>---</option>
                                <option>White</option>
                                <option>Black</option>
                                <option>No Colour</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>

                <!-- <div class="table-responsive">
                    <table class="table table-striped table-lg">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Header</th>
                                <th>Header</th>
                                <th>Header</th>
                                <th>Header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1,001</td>
                                <td>Lorem</td>
                                <td>ipsum</td>
                                <td>dolor</td>
                                <td>sit</td>
                            </tr>
                            <tr>
                                <td>1,002</td>
                                <td>amet</td>
                                <td>consectetur</td>
                                <td>adipiscing</td>
                                <td>elit</td>
                            </tr>
                            <tr>
                                <td>1,003</td>
                                <td>Integer</td>
                                <td>nec</td>
                                <td>odio</td>
                                <td>Praesent</td>
                            </tr>
                            <tr>
                                <td>1,003</td>
                                <td>libero</td>
                                <td>Sed</td>
                                <td>cursus</td>
                                <td>ante</td>
                            </tr>
                            <tr>
                                <td>1,004</td>
                                <td>dapibus</td>
                                <td>diam</td>
                                <td>Sed</td>
                                <td>nisi</td>
                            </tr>
                            <tr>
                                <td>1,005</td>
                                <td>Nulla</td>
                                <td>quis</td>
                                <td>sem</td>
                                <td>at</td>
                            </tr>
                            <tr>
                                <td>1,006</td>
                                <td>nibh</td>
                                <td>elementum</td>
                                <td>imperdiet</td>
                                <td>Duis</td>
                            </tr>
                            <tr>
                                <td>1,007</td>
                                <td>sagittis</td>
                                <td>ipsum</td>
                                <td>Praesent</td>
                                <td>mauris</td>
                            </tr>
                            <tr>
                                <td>1,008</td>
                                <td>Fusce</td>
                                <td>nec</td>
                                <td>tellus</td>
                                <td>sed</td>
                            </tr>
                            <tr>
                                <td>1,009</td>
                                <td>augue</td>
                                <td>semper</td>
                                <td>porta</td>
                                <td>Mauris</td>
                            </tr>
                            <tr>
                                <td>1,010</td>
                                <td>massa</td>
                                <td>Vestibulum</td>
                                <td>lacinia</td>
                                <td>arcu</td>
                            </tr>
                            <tr>
                                <td>1,011</td>
                                <td>eget</td>
                                <td>nulla</td>
                                <td>Class</td>
                                <td>aptent</td>
                            </tr>
                            <tr>
                                <td>1,012</td>
                                <td>taciti</td>
                                <td>sociosqu</td>
                                <td>ad</td>
                                <td>litora</td>
                            </tr>
                            <tr>
                                <td>1,013</td>
                                <td>torquent</td>
                                <td>per</td>
                                <td>conubia</td>
                                <td>nostra</td>
                            </tr>
                            <tr>
                                <td>1,014</td>
                                <td>per</td>
                                <td>inceptos</td>
                                <td>himenaeos</td>
                                <td>Curabitur</td>
                            </tr>
                            <tr>
                                <td>1,015</td>
                                <td>sodales</td>
                                <td>ligula</td>
                                <td>in</td>
                                <td>libero</td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </main>
        </div>
    </div>

    <?php require '../constant/footer_scripts.php'; ?>

</body>

</html>