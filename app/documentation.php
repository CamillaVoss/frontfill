<?php 
    include 'include/db_functions.php';
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frontfill | Documentation</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" 
              type="image/png" 
              href="gfx/favicon.png">
    </head>
    <body>
        <div class="dashboard">
        	<div class="sidebar">
        		<div class="sidebar-logo"></div>
        		<div class="divider"></div>
        		<div class="TOC">
        			<ol>
                        <li>Getting started</li>
                        <ol type="i">
                            <li>Step one</li>
                            <li>Step two</li>
                        </ol>
                    </ol>
        		</div>
        	</div>

        	<div class="content documentation">
        		<nav class="navigation">
		        	<div class="navigation-right">
		            	<ul>
			             	<li><button class="api-btn">API Key</button></li>
			             	<li><a href="index.php">Dashboard</a></li>
			             	<li><a href="include/signout.php">Sign Out</a></li>
			            </ul>
		            </div>
		        </nav>
                
                <div class="documentation-text">
                    <h1>Documentation</h1>
                    <h2>1. Get Started</h2>
                    <h3>1.i Step one</h3>
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>

                    <h3>1.ii Step two</h3>
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
                </div>
        	</div>
        </div>

        <?php include 'include/modals.php'; ?>
        <?php include 'include/scripts.php';?>
    </body>
</html>