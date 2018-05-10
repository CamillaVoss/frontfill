<?php 
    include 'include/db_functions.php';
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frontfill | Sign in</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="full-size">
            <div class="content">
                <div class="content-image"></div>
                <div class="form">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <h1>Sign in to your account</h1>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>

                        <button type="submit" name="signin" value="signin" class="CTA-btn">Sign in</button>
                        <p>New user? <a href="signup.php">Sign up now!</a></p>
                    </form>                 
                </div>
            </div>
        </div> 
    </body>
</html>