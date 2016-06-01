<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Programs List</title>
	<link href="css/style.css" rel="stylesheet">
	<link rel="apple-touch-icon" href="img/client-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/client-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/client-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/client-icon-ipad-retina.png">
	<link rel="icon" href="favicon.png" >
</head>

<body class="loading">
  <?php include 'inc/svg.php'; ?>
  <?php include 'inc/header.php'; ?>

  <div id="main" class="container">
  	<div class="row">
  		<div class="col-sm-9 col-sm-offset-1">
  			<h1>Article Page Title</h1>
        <div class="kicker">
  		    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat iusto sapiente et unde velit reprehenderit, sunt.</p>
        </div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-sm-10 col-sm-offset-1 col-md-11">
  			<ul class="academic-list">
          <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">Filter <span class="arw-right icon-svg"><svg><use xlink:href="/img/spritemap.svg#arw-right"></use></svg></span></a></li>
  				<li><a href="#">Sort item</a></li>
  				<li><a href="#">Another Sort item</a></li>
          <li><a href="#">Sort item</a></li>
          <li><a href="#">Another Sort item</a></li>
  			</ul>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-1">
  			<ul class="majors-list" data-category="A">
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  			</ul>
  			<ul class="majors-list" data-category="B">
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  			</ul>
  		</div>

      <div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-3">
        <div class="filter-wrap">
          <ul>
            <li><a href="#">College of Education</a></li>
            <li><a href="#">College of Nursing</a></li>
            <li><a href="#">College of The Arts</a></li>
            <li><a href="#">College of Education</a></li>
            <li><a href="#">College of Nursing</a></li>
            <li><a href="#">College of The Arts</a></li>
          </ul>
        </div>
      </div>
  	</div>
  </div>

	<?php include 'inc/footer.php'; ?>
  <?php include 'inc/scripts.php'; ?>
</body>
</html>