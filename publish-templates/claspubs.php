<?php
/*
Template Name: AEM Mobile - CLAS Publications
*/
?>

<?php
	/* =================== */
	/* AEM Mobile Required */
	/* =================== */
	
	
	/* FILE PATH FOR THE BUNDLER */
	/* Sets the file path based on the plugin or theme folder */ 
	$isInPlugin = (strpos(__FILE__, DPSFA_DIR_NAME . "/publish-templates") !== FALSE); 
	if($isInPlugin){
		// Create file path based on plugin folder
    	$filePath = ($_SERVER['SERVER_NAME'] == 'localhost') ? plugins_url(). '/' . DPSFA_DIR_NAME . '/publish-templates/' : plugin_dir_url( (__DIR__) . "/publish-templates/");
	}else{
		// Create file path based on template folder
    	$filePath = get_template_directory_uri(). "/publish-templates/";
	}

?>


<?php	 

	/* =========================================== */
	/* == WP Filter to include additional files == */
	/* =========================================== */
	/*
	    You can add additional files to the article using the filter below. You can add file two ways:
	    	    
	    1. Automatic: Specify full url to file (array of images)
	    Specifying the full url will create the necessary folder scructure in the article and download the external file
	    Folder struture for external resources: ARTICLE > sanitized hostname > path > file
	    Example: array('http://www.domain.com/wp-content/themes/theme/file.jpg') will put that file in the article as: domaincom/wp-content/themes/theme/file.jpg
	    
	    2. Manual: Specify the full paths array( "file path relative in article" => "filepath relative to server (or url)" )
	    You can have control over where the file is placed in the article and where to pull it from the server
	    Example: array( array('slideshow/image/file.jpg' => 'www/wp-content/themes/theme/file.jpg') ) will put that file in the article as: domaincom/wp-content/themes/theme/file.jpg
	*/
	
	add_filter('dpsfa_bundle_article', function($entity){
		
		// $entity will contain all of the info of the article (metadata / template / etc.)
		
		/* FILE PATH FOR BUNDLE (publish templates in the plugin folder vs theme folder) */ 
		$isInPlugin = (strpos(__FILE__, DPSFA_DIR_NAME . "/publish-templates") !== FALSE); 
		if($isInPlugin){
			// Create file path based on plugin folder
	    	$filePath = ($_SERVER['SERVER_NAME'] == 'localhost') ? plugins_url(). '/' . DPSFA_DIR_NAME . '/publish-templates/' : plugin_dir_url( (__FILE__) . "/publish-templates/");
		}else{
			// Create file path based on template folder
	    	$filePath = get_template_directory_uri(). "/publish-templates/";
		}
		
		return array(
			$filePath . 'HTMLResources/fonts/glyphicons-halflings-regular.eot',
			$filePath . 'HTMLResources/fonts/glyphicons-halflings-regular.svg',
			$filePath . 'HTMLResources/fonts/glyphicons-halflings-regular.ttf',
			$filePath . 'HTMLResources/fonts/glyphicons-halflings-regular.woff',
			$filePath . 'HTMLResources/fonts/glyphicons-halflings-regular.woff2',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book-webfont.eot',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book-webfont.svg',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book-webfont.ttf',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book-webfont.woff',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book_italic-webfont.eot',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book_italic-webfont.svg',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book_italic-webfont.ttf',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_book_italic-webfont.woff',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_heavy-webfont.eot',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_heavy-webfont.svg',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_heavy-webfont.ttf',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_gentona_heavy-webfont.woff',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_extrabolditalic-webfont.eot',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_extrabolditalic-webfont.svg',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_extrabolditalic-webfont.ttf',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_extrabolditalic-webfont.woff',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_medium-webfont.eot',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_medium-webfont.svg',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_medium-webfont.ttf',
			$filePath . 'HTMLResources/fonts/rene_bieder_-_quadon_medium-webfont.woff',
			$filePath . 'HTMLResources/fonts/SurveyorText-Book-Pro.otf',
			$filePath . 'HTMLResources/fonts/SurveyorText-BookItalic-Pro.otf',
		);
		
	});
	
?>

<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

<title><?php the_title(); ?></title>

<link rel="stylesheet" href="<?php echo $filePath; ?>HTMLResources/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $filePath; ?>HTMLResources/css/claspubs.min.css">
</head>

<body class="single-post type-post">

<div id="main" class="container">
<div class="row">
<div class="col-sm-12">
  
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-header">
        <?php if ( has_post_thumbnail() ): ?>
            <?php
             $image_id = get_post_thumbnail_id();
             $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
             $image_description = get_post(get_post_thumbnail_id())->post_content; ?>
             <?php echo do_shortcode('[ufclas-image-full-width image="' . $image_id . '" caption="' . $image_description . '" credit="' . $image_caption . '"]'); ?>
        <?php endif; ?>   
    </div>
    
    <div class="entry-content">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    <?php the_content(); ?>
    </div><!-- .entry-content -->
    
    </article><!-- #post-## -->
  
</div><!-- .col -->
</div><!-- .row -->
</div><!-- #main -->

<footer class="footer">
    <div class="container">
        <p>Spring – May 2016</p>
        <p><a href="http://clas.ufl.edu/" target="_blank"><img src="<?php echo $filePath; ?>HTMLResources/images/UF-LAS.svg" style="padding:10px 0px" class="img-responsive" alt="Placeholder image"></a></p>
        <p>University of Florida College of Liberal Arts and Sciences</p>
        <h6>— SHARE THE STORY —</h6>
        <p>Tap screen for sharing within your mobile OS.<br>Check browser preferences for desktop share options.</p>
        <p><a href="http://gatorgood.ufl.edu/" target="_blank"><img src="<?php echo $filePath; ?>HTMLResources/images/GatorGood.svg" class="img-responsive" alt="Placeholder image"></a></p>
    </div>
</footer>


    <script src="<?php echo $filePath; ?>HTMLResources/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $filePath; ?>HTMLResources/js/bootstrap.min.js"></script>
    <script src="<?php echo $filePath; ?>HTMLResources/js/main.js"></script>

</body>

</html>

<?php endwhile; endif; ?>