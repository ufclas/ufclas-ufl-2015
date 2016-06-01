<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Article</title>
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
    <div class="col-sm-8 col-sm-offset-3">
      <ul class="breadcrumb-wrap">
        <li><a href="#">Breadcrumb</a></li>
        <li><a href="#">Breadcrumb</a></li>
      </ul>
      <h1>Article Page Title</h1>
    </div>
  </div>
  	<div class="row">
  		<div class="col-sm-3">
  			<div class="ul sidenav">
          <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">Pages <span class="arw-right icon-svg"><svg><use xlink:href="/img/spritemap.svg#arw-right"></use></svg></span></a></li>
  				<li><a href="#">Link</a></li>
  				<li><a href="#">Link</a>
            <ul>
              <li><a href="#">Child Link</a></li>
              <li><a href="#">Child Link</a></li>
              <li><a href="#">Child Link</a></li>
            </ul>
          </li>
  				<li class="active"><a href="#">Link</a></li>
  				<li><a href="#">Link</a></li>
  				<li><a href="#">Link</a></li>
  				<li><a href="#">Link</a></li>
  			</div>
  		</div>
  		<div class="col-sm-8">
  			<img src="/img/_temp-rect.jpg" alt="" class="img-full m-bottom">
  			<h2>Heading Two</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate odio iste omnis nihil culpa est pariatur voluptatem neque, eaque maxime reprehenderit rem quo fuga dignissimos quas. Libero, aut, sapiente. Unde.</p>
        <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, fuga sed. Nisi excepturi, odit deleniti officiis quis minus sed placeat mollitia ad qui error voluptates laudantium illo libero expedita itaque!</blockquote>
        <h3>Heading Three</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur nihil beatae minus sunt voluptatum provident quidem possimus voluptate iure odit, id! <a href="#">Inline link</a> Voluptates excepturi sapiente aut sed ullam! Vitae exercitationem, repudiandae!</p>
        <dl>
          <dt>Definition Term</dt>
          <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam accusantium soluta iste nemo, sequi perferendis nesciunt rem ipsam aspernatur hic quos voluptas consequatur, officiis, quod quibusdam deserunt, repudiandae numquam odio!</dd>
          <dt>Definition Term</dt>
          <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam accusantium soluta iste nemo, sequi perferendis nesciunt rem ipsam aspernatur hic quos voluptas consequatur, officiis, quod quibusdam deserunt, repudiandae numquam odio!</dd>
        </dl>
        <h4>Heading Four</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, adipisci, cumque veritatis ipsam, quod eos debitis voluptate ipsum magni consequuntur labore ipsa nisi, ad perspiciatis alias laboriosam quis sequi quibusdam?</p>
        <ul>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
        </ul>
        <h5>Heading Five</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, adipisci, cumque veritatis ipsam, quod eos debitis voluptate ipsum magni consequuntur labore ipsa nisi, ad perspiciatis alias laboriosam quis sequi quibusdam?</p>
        <ol>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
        </ol>
  		</div>
  	</div>
  </div>

	<?php include 'inc/footer.php'; ?>
  <?php include 'inc/scripts.php'; ?>
</body>
</html>