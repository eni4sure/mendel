<?php require '../config.php'; ?>
<?php
	// Check if the user is logged in, if not then redirect him to login page
	// if( !isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
	//     header("location:../login.php");
	// }
?>
<!DOCTYPE html>
<html>

<?php $page_title = "Users"; ?>
<?php require '../constant/head.php'; ?>

<body>

	<?php require '../constant/dashboard_header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
			    <div class="sidebar-sticky pt-3">
			        <ul class="nav flex-column">

			            <li class="nav-item">
			                <a class="nav-link" href="./">
			                    <span data-feather="home"></span>
			                    Dashboard
			                </a>
			            </li>
			            <li class="nav-item">
			                <a class="nav-link" href="./users.php">
			                    <span data-feather="user"></span>
			                    Users
			                </a>
			            </li>
			            <li class="nav-item">
			                <a class="nav-link" href="./families.php">
			                    <span data-feather="users"></span>
			                    Families
			                </a>
			            </li>

			        </ul>
			    </div>
			</nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Users</h1>
                </div>

                <div class="container">
                	<div class="row">

					    <div class="table-responsive">
		                    <table class="table table-striped table-lg">
		                        <thead>
		                            <tr>
		                                <th>#</th>
		                                <th>First Name</th>
		                                <th>Last Name</th>
		                                <th>Group</th>
		                                <th>Email Address</th>
		                            </tr>
		                        </thead>
		                        <tbody>
			                		<?php
										$sql = "SELECT * FROM tbl_users";
										$result = mysqli_query($conn, $sql);

										$sn = 1;
										while ($row = mysqli_fetch_assoc($result)) {
											?>
				                            <tr>
				                            	<th><?php echo $sn; ?></th>
				                                <td><?php echo $row['user_fname']; ?></td>
				                                <td><?php echo $row['user_lname']; ?></td>
				                                <td><?php echo $row['user_group']; ?></td>
				                                <td><?php echo $row['user_email']; ?></td>
				                            </tr>
				                            <?php
				                            $sn++;
										}
									?>
		                        </tbody>
		                    </table>
		                </div>

					</div>
                </div>
            </main>
        </div>
    </div>

    <?php require '../constant/footer_scripts.php'; ?>

</body>

</html>