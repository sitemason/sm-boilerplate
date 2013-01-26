<?php
	require_once('/web/shared/php/1.0/sitemason.inc');
	
	# Load the Main Content XML
	# http://developer.sitemason.com/library/methods/getxml.149741
	$content = new Content($content_xml);
	$content_xml = $content->getXML();

	# $site_url variable helpful for including assets when redeveloping or working on site without DNS pointed to Sitemason
	$site_url = 'http://www.site-url.com';
	# prepend the $secure_url variable when including asset files so they are transferred securely when on https connection
	$secure_url = $content_xml->secure_image_url;

	# Load Optional Side Content XML
	# http://developer.sitemason.com/library/methods/sidecontent.149750
	# $side = new SideContent($site_url . '/side?toolxml');
	# $side_xml = $side->getXML();

	# use the $layout variable for includes or layout specific functions
	if ($content_xml->current_nav->id == 'xxxxxx') {
		$layout = 'home';
	} else {
		$layout = 'interior';
	}
?>

<!-- http://developer.sitemason.com/library/methods/printinithtml.149561 -->
<?php $content->printInitHTML('HTML 5'); ?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- http://developer.sitemason.com/library/methods/printpagehead.149569 -->
		<?php $content->printPageHead(); ?>

        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?php echo $secure_url; ?>/sm_template/css/normalize.css">
        <link rel="stylesheet" href="<?php echo $secure_url; ?>/sm_template/css/main.css">
        <script src="<?php echo $secure_url; ?>/sm_template/js/vendor/modernizr-2.6.1.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
		<header>
			<!-- http://developer.sitemason.com/library/methods/printnavaslist.149568 -->
			<?php $content->printNavAsList(); ?>
		</header>
		<div role="main">
			<?php 
				# switch layout based on value of $layout variable
				if ($layout == 'home') {
					include('inc/home.php');
				} else {
					# http://developer.sitemason.com/library/methods/printcontent.149744
					$content->printContent();
				}
			?>		
		</div>
		<footer>
			<!-- In addition to using the library, you can always parse the XML directly
				http://developer.sitemason.com/parsing_xml_php#Retrieving_a_Single_Value_from_XML -->
			<?php echo $content_xml->footer; ?>
		</footer>
		<!-- Thanks for the props! -->
		<div id="sitemason"><span>Built on </span><a href="http://www.sitemason.com">SITEMASON</a></div>
	

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/sm_template/js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script src="<?php echo $secure_url; ?>/sm_template/js/plugins.js"></script>
        <script src="<?php echo $secure_url; ?>/sm_template/js/main.js"></script>

		<!-- http://developer.sitemason.com/library/methods/printbodylast.149552 -->
		<?php $content->printBodyLast(); ?>
    </body>
</html>
