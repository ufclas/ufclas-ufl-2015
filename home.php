<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Homepage</title>
	<link href="css/style.css" rel="stylesheet">
	<link rel="apple-touch-icon" href="img/client-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/client-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/client-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/client-icon-ipad-retina.png">
	<link rel="icon" href="favicon.png" >
</head>

<body class="loading home">
  <?php include 'inc/svg.php'; ?>
  <?php include 'inc/header.php'; ?>

  <?php
  //
  // Emergency modal demo purposes only
  //
  if (isset($_GET['alert']) && $_GET['alert'] == 'big') { ?>
  <div class="emergency-modal-wrap">
  	<div class="emergency-modal">
  		<div class="container">
  			<div class="emergency-modal-header">
  				<span class="icon-svg icon-alert">
  		    	<svg>
  		      	<use xlink:href="/img/spritemap.svg#alert"></use>
  		    	</svg>
  		    </span>
  		    <div class="alert-title">Emergency Alert</div>
  		    <a href="#" class="alert-link">More Information <span class="arw-right icon-svg"><svg><use xlink:href="/img/spritemap.svg#arw-right"></use></svg></span></a>
  		    <a href="#" class="emergency-modal-close">
  		   		<span class="arw-right icon-svg"><svg><use xlink:href="/img/spritemap.svg#close"></use></svg></span>
  		    </a>
  			</div>
  			<div class="emergency-modal-content">
  				<div class="row">
  					<div class="col-sm-8">
  						<h2>Severe Weather Alert</h2>
  						<h3>Campus Location</h3>

  						<p>Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna sed quia. Con sectetur adipiscing elit, sed do eiusmod.  Dolor sit amet.</p>

  						<p><strong>Dolor sit amet, consectetur adipiscing elit!</strong></p>

  						<p>Visit <a href="#">http://www.ufl.edu/emergency.html</a> for more information.</p>
  					</div>
  					<div class="col-sm-4 resources-wrap">
  						<h2>Resources</h2>
  						<ul>
  							<li><a href="#">Emergency Services</a></li>
  							<li><a href="#">Emergency Phone Numbers</a></li>
  							<li><a href="#">Campus Police</a></li>
  							<li><a href="#">Additional Resource</a></li>
  							<li><a href="#">Another Resource</a></li>
  							<li><a href="#">Additional Resource</a></li>
  						</ul>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

  <?php } ?>
	<div id="main">
		<?php include 'inc/home-section.php'; ?>
		<?php include 'inc/home-section.php'; ?>
		<?php include 'inc/home-section.php'; ?>
		<?php include 'inc/home-section.php'; ?>
	</div>
	<?php include 'inc/scripts.php'; ?>
</body>
</html>