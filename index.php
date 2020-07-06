<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>

<?php $page_title = "Home"; ?>
<?php require 'constant/head.php'; ?>

<body>

	<div class="container-fluid home-main">
	    <h2>Welcome to <span class="blinker"><?php echo $config['app_name']; ?></span></h2>
	    <a href="login.php" class="btn btn-default">Login</a>
	</div>
	<div class="container-fluid home-content1">
	    <div class="row">
	        <div class="col-md-6 content1-left">
	            <h3>What is it about <span class="blinker">?</span></h3>
	            <p>Build responsive, mobile-first projects on the web with the world’s most popular front-end component library.</p>
	            <!-- <div class="content1-left"></div> -->
	        </div>
	        <div class="col-md-6 content1-right">
	        	<h3>More about it <span class="blinker">?</span></h3>
	            <p>Bootstrap is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with our Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful plugins built on jQuery.</p>
	        </div>
	    </div>
	</div>

    <?php require 'constant/footer_scripts.php'; ?>

</body>

</html>