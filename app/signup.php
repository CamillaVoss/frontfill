<?php 
	include 'include/db_functions.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frontfill | Sign up</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" 
      		  type="image/png" 
      		  href="gfx/favicon.png">
    </head>
    <body>
    	<div class="full-size">
			<div class="content">
				<div class="content-image"></div>
				<div class="form">
					<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
						<h1>Create new user</h1>
						<?php
                        if ($exists) { ?>
                            <h2>An user with this email already exists</h2>
                        <?php    
                        }
                        ?>
						<div class="form-group">
		                	<input type="email" name="email" placeholder="Email" required autofocus>
		                </div>

		                <div class="form-group">
		                	<input type="password" name="password" placeholder="Password" required>
		                </div>

						<button type="submit" name="signup" value="signup" class="CTA-btn">Sign up</button>
						<p>Already a user? <a href="signin.php">Log in now!</a></p>
					</form>					
				</div>
			</div>
    	</div> 
    </body>
</html>