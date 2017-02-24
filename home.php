<?php
require_once("connect.php");
if($_SESSION['loggedin'] != 1){
	header("Location: /");
}
require_once('header.php');
$activeuser = getCurrentUsername($uid);

?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>The Biggest Tracker</h1>
				<hr />
			</div>
		</div>
		<?php 
			$update = getLatestUpdate($uid);
			if($update < $today){
				$needsupdate = true;
			} //date check

			$leaderboard = getLeaderboard();
				?>
			<div id="update-area" class="row">
				<div class="col-xs-12">
					<h2>ohai <?php echo $activeuser; ?>!</h2>
					<h3>Time to update your progress for today</h3>
					<?php if($needsupdate){ ?>
						<div class="row">
							<form method="POST" action="">
								<div class="col-xs-12 col-sm-2">
									<input type="hidden" name="uid" value="<?php echo $uid; ?>">
									<div class="input-group">
      									<input type="text" class="form-control" id="weight"  placeholder="100.5" name="weight" aria-describedby="pound-weight">
      									<span class="input-group-addon">lbs.</span>
    								</div>
								</div>
								<div class="col-xs-12 col-sm-2"><button class="btn btn-success" type="submit">Update</button></div>
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
				<div class="col-xs-12">
					<h3>The Latest</h3>
				</div>
			</div>
			<div class="row">
				<?php foreach($leaderboard as $user){
					$thisuid = $user['uid'];
					$percentchange = percentChangeTotal($thisuid);
					$lost = weightLossTotal($thisuid);
					$lastupdate = lastUpdate($thisuid);
					$nick = $user['username'];
					if($thisuid == $uid){ $thisuser = "highlight"; }else{ $thisuser = ""; }
					?>
					<div id="<?php echo $thisuser; ?>" class="col-xs-12 col-sm-4">
						<h4><?php echo $nick; ?></h4>
						<div class="stat-wrap">
							<div class="large-stat"><?php echo $percentchange; ?>%</div>
							<div class="large-stat-label">total lost</div>
						</div>
						<div class="stat-wrap">
							<div class="large-stat"><?php echo $lost; ?> lbs.</div>
							<div class="large-stat-label">lost overall</div>
						</div>
						<div class="stat-update">Last Update: <?php echo $lastupdate; ?></div>
					</div>
				<?php
				}
				?>
			</div>
	</div>
<?php require_once('footer.php'); ?>