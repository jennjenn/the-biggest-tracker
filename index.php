<?php
require_once('connect.php');
require_once('functions.php');
?>

<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>J&D Do TBL</title>

	<link rel="stylesheet" href="css/foundation.min.css" />
	<link rel="stylesheet" href="css/app.css" />
	<link rel="author" href="humans.txt" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="js/vendor/custom.modernizr.js"></script>

</head>
<body>

	<div class="row">
		<div class="large-12 columns">
			<h1>The Biggest Winner</h1>
			<hr />
		</div>
	</div>

	<div class="row">
		<?php if($loggedin != 1){ ?>
			<div class="large-12 columns">
				<p><a href="#" id="login-toggle">Log In</a></p>
				<div id="login-panel">
					<form method="POST" action="">
						<div class="row">
							<div class="large-4 columns"><input name="username" type="text" placeholder="username" /></div>
							<div class="large-4 columns"><input name="password" type="password" placeholder="password" /></div>
							<button class="button small" type="submit">Log In</button>
						</div>
					</form>
				</div>
				<?php
			}else{
				$update = getLatestUpdate($uid);
				if($update < $today){
					$needsupdate = true;
				} //date check
				?>
				<div id="update-area" class="large-12 columns">
					<h2>ohai <?php echo $user; ?>!</h2>
					<h3>Time to update your progress for today</h3>
					<?php if($needsupdate){ ?>
						<div class="row collapse">
							<form method="POST" action="">
								<div class="large-2 columns">
									<input type="hidden" name="uid" value="<?php echo $uid; ?>">
									<input type="text" name="weight" placeholder="100.5" />
								</div>
								<div class="large-1 columns"><span class="postfix">lbs.</span></div>
								<div class="large-2 columns large-offset-1 left"><button class="small button" type="submit">Update</button></div>
							</form>
						</div>
						<?php
					}else{
						echo "<p>You're all up to date! Go eat a burger! (err... or not).</p>";
					} // update panel ?>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns"><h3>The Latest</h3></div>
				<div id="danielle" class="large-6 columns">
					<h4>DP</h4>
					<div class="stat-wrap">
						<div class="large-stat"><?php echo percentChangeTotal(2); ?>%</div>
						<div class="large-stat-label">total lost</div>
					</div>
					<div class="stat-wrap">
						<div class="large-stat"><?php echo weightLossTotal(2); ?> lbs.</div>
						<div class="large-stat-label">lost overall</div>
					</div>
				</div>
				<div id="jenn" class="large-6 columns">
					<h4>JV</h4>
					<div class="stat-wrap">
						<div class="large-stat"><?php echo percentChangeTotal(1); ?>%</div>
						<div class="large-stat-label">total lost</div>
					</div>
					<div class="stat-wrap">
						<div class="large-stat"><?php echo weightLossTotal(1); ?> lbs.</div>
						<div class="large-stat-label">lost overall</div>
					</div>
				</div>
			</div>
			<?php if($loggedin == 1){ ?>
				<div class="large-12 columns">
					<p><a href="?q=logout">Log out</a></p>
				</div>
				<?php
			} // logout link conditional 
		} // not logged in
		?>
	</div>

	<script>
	document.write('<script src=' +
	('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
	'.js><\/script>')
	</script>

	<script src="js/foundation.min.js"></script>


	<script>
	$(document).foundation();
	</script>
	<script>
	$('#login-toggle').click(function(e){
		e.preventDefault();
		$('#login-panel').slideToggle();
		return false;
	});
	</script>
</body>
</html>