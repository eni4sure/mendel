<?php require '../config.php'; ?>
<?php
	// Check if the user is logged in, if not then redirect him to login page
	if( !isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
	    header("location:../login.php");
	}
?>
<!DOCTYPE html>
<html>

<?php $page_title = "Dashboard"; ?>
<?php require '../constant/head.php'; ?>

<body>

	<?php require '../constant/dashboard_header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php require '../constant/dashboard_sidebar.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div class="container">
                	<div class="row">
           				<div class="col-md-3">
					      <div class="card-counter primary">
					        <i class="fa fa-code-fork"></i>
							<?php
								$sql = "SELECT * FROM tbl_family WHERE user_id = '".$_SESSION['unique_id']."'";
								$result = mysqli_query($conn, $sql);
							?>
					        <span class="count-numbers"><?php echo mysqli_num_rows($result); ?></span>
					        <span class="count-name">Family Member(s)</span>
					      </div>
					    </div>
					</div>
		        </div>
            </main>
        </div>
    </div>

    <?php require '../constant/footer_scripts.php'; ?>

</body>

</html>