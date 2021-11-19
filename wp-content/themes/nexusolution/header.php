<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nexusolution
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body>
	<div class="top_wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-9 top_wrap_info">
					<i class="fas fa-map-marker-alt"></i>
					<span> Tinpaini , Biratnagar , Nepal. </span>
				</div>
				<div class="col-md-2 top_wrap_info">
					<i class="fas fa-phone-alt"></i>
					<span> (+977) 980-1410666</span>
				</div>
				<div class="col-md-1 top_wrap_info social_icon">
					<a href="#"> <i class="fab fa-facebook-f"></i> </a>
					<a href="#"> <i class="fab fa-twitter"></i> </a>
					<a href="#"> <i class="fab fa-youtube"></i> </a>
				</div>
			</div>
		</div>
	</div>
	<!-- :: Header -->
	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container">
			<a class="navbar-brand" href="<?php site_url() ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png" alt=""></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php main_menu() ?>
		</div>
	</nav>