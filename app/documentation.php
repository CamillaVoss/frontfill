<?php 
    include 'include/db_functions.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frontfill | Documentation</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
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
                        <li>Getting started
                            <ol type="i">
                                <li>Retrieve all data within user profile</li>
                                <li>Retrieve all data within section</li>
                                <li>Retrieve content from single item</li>
                            </ol>
                        </li>
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
                    <div class="documentation-section">
                        <h1>Documentation</h1>
                        <h2>1. Get Started</h2>
                        <p>An API request requires a request in the following form: </p>
                        <p class="code">http://frontfill.com/api.php?[parameters]</p>
                        <p>There are three different parameters to use when retrieving content from the API</p>
                    </div>
                    <div class="documentation-section">
                        <h3>1.i Retrieve all data within user profile</h3>
                        <p class="code">http://frontfill.com/api.php?api-key=[your_API_key]</p>
                        <p>This will give you an output of all the sections withing a user, and all content withing the sections</p>
                    </div>
                    <div class="documentation-section">
                        <h3>1.ii Retrieve all data within section</h3>
                        <p class="code">http://frontfill.com/api.php?api-key=[your_API_key]&amp;section=[section_title]</p>
                        <p>This will give you an output of all the content withing the sections</p>
                    </div>
                    <div class="documentation-section">
                        <h3>1.iii Retrieve content from single item</h3>
                        <p class="code">http://frontfill.com/api.php?api-key=[your_API_key]&amp;section=[section_title]&item=[item_title]</p>
                        <p>This will give you the content of a single item</p>
                    </div>
                </div>
        	</div>
        </div>

        <?php include 'include/modals.php'; ?>
        <?php include 'include/scripts.php';?>
    </body>
</html>