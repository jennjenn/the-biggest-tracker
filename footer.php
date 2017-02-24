<div id="footer" class="container">
    <div class="row">
        <div class="col-xs-12">
	        <p class="text-center">Brought to you by <a href="http://mostlybrilliant.co" target="_blank">Mostly Brilliant</a>. 
	        <?php if($loggedin == 1){ ?>
			<a href="/logout.php">Log out</a>
				<?php
			} // logout link conditional 
		?>
		</p>
       	</div>
    </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/app.js"></script>
</body>
</html>