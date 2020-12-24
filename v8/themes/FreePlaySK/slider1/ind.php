<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>

	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

	

	<meta name="description" content="Slideshow flexible with many options for customizations. This jQuery Slideshow is free!" />

	<meta name="keywords" content="jquery slideshow, slides, slide, slideshow, gallery, images, effects, easing, transitions, jquery, plugin, gpl license, free, customizations, flexible" />

	<meta name="author" content="Thiago S.F. - http://thiagosf.net" />

	

	<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Rosario' rel='stylesheet' type='text/css'>

	

	<link rel="shortcut icon" href="images/favicon.ico">

	<link href="css/styles.css" type="text/css" media="all" rel="stylesheet" />

	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />

	<link href="css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />

	<link href="css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />

	

	<script src="js/jquery-1.6.3.min.js"></script>

	<script src="js/jquery.easing.1.3.js"></script>

	<script src="js/jquery.animate-colors-min.js"></script>

	

	<script src="js/jquery.skitter.min.js"></script>

	<script src="js/highlight.js"></script>

	<script src="js/sexy-bookmarks-public.js"></script>

	

	<script>

	$(document).ready(function() {

		

		var options = {};

	

		if (document.location.search) {

			var array = document.location.search.split('=');

			var param = array[0].replace('?', '');

			var value = array[1];

			

			if (param == 'animation') {

				options.animation = value;

			}

			else if (param == 'type_navigation') {

				if (value == 'dots_preview') {

					$('.border_box').css({'marginBottom': '40px'});

					options['dots'] = true;

					options['preview'] = true;

				}

				else {

					options[value] = true;

					if (value == 'dots') $('.border_box').css({'marginBottom': '40px'});

				}

			}

		}

		

		$('.box_skitter_large').skitter(options);

		

		// Highlight

		$('pre.code').highlight({source:1, zebra:1, indent:'space', list:'ol'});

		

	});

	</script>

</head>

<body>

<div id="page">

	<div id="content">

		<div class="border_box">

			<div class="box_skitter box_skitter_large">

				<ul>                        

                                  	<li><img src="http://freezy.sk/themes/gzsknew/slider/images/8.png" alt="" class="swapBarsBack"/></a></li> 
                                   	<li><img src="http://freezy.sk/themes/gzsknew/slider/images/8.png" alt="" class="swapBarsBack"/></a></li>
    
				</ul>

			</div>

		</div>

		

	

		<pre class="code" lang="html">

// Styles

&lt;link href=&quot;css/skitter.styles.css&quot; type=&quot;text/css&quot; media=&quot;all&quot; rel=&quot;stylesheet&quot; /&gt;



// Scripts

&lt;script src=&quot;js/jquery-1.5.2.min.js&quot;&gt;&lt;/script&gt;

&lt;script src=&quot;js/jquery.skitter.min.js&quot;&gt;&lt;/script&gt;

&lt;script src=&quot;js/jquery.easing.1.3.js&quot;&gt;&lt;/script&gt;

&lt;script src=&quot;js/jquery.animate-colors-min.js&quot;&gt;&lt;/script&gt;



</pre>

		

	

	

</div>

</body>

</html>