<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if(is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
	wp_head(); 
	global $redux_options, $themePrefix;
	if(!empty($redux_options[$themePrefix.'favicon_url'])){
		echo '<link href="'.$redux_options[$themePrefix.'favicon_url']['url'].'" rel="shortcut icon" type="image/x-icon" />';
	} ?>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- **Google - Fonts** -->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Dosis:500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
</head>
<body <?php body_class(); ?>>
	<div id="loader-wrapper">
	    <div id="loading">
	        <div id="loading-center">
	            <div id="loading-center-absolute">
	                <div class="object" id="object_four"></div>
	                <div class="object" id="object_three"></div>
	                <div class="object" id="object_two"></div>
	                <div class="object" id="object_one"></div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="wrapper">
        <div class="inner-wrapper">
        	<header id="header" class="type1">
            	<div class="container">
                    <div class="main-menu-container">
                      <div class="main-menu">
                        <div id="logo">
                          <?php if(!empty($redux_options[$themePrefix.'logo_url'])){
                            echo '<a title="NeoCut" href="'.get_home_url().'"><img title="'.get_bloginfo('name').'" alt="'.get_bloginfo('description').'" src="'.$redux_options[$themePrefix.'logo_url']['url'].'"></a>';
                          } ?>
                        </div>
                        <div id="primary-menu">
                           <div class="dt-menu-toggle" id="dt-menu-toggle">Menu<span class="dt-menu-toggle-icon"></span></div>
                               <div class="social">
                                    <ul>
                                    <?php
                                    if(!empty($redux_options[$themePrefix.'facebook_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'facebook_url'].'" target="_BLANK" title="Facebook"> <i class="fa fa-facebook"></i></a></li>';
                                    }
                                    if(!empty($redux_options[$themePrefix.'instagram_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'instagram_url'].'" target="_BLANK" title="Instagram"> <i class="fa fa-instagram"></i></a></li>';
                                    }
                                    if(!empty($redux_options[$themePrefix.'twitter_url'])){
                                        echo '<li><a href="'.$redux_options[$themePrefix.'twitter_url'].'" target="_BLANK" title="Twitter"> <i class="fa fa-twitter"></i></a></li>';
                                    } ?>
                                    </ul>
                                </div>
                            <nav id="main-menu">
                                <?php 
                                wp_nav_menu(array('name'=>'main'))?>
                                </nav>
                       	</div>
                      </div>
                    </div>             
            	</div>
            </header>
            <div class="hr-separator"></div>
            <div id="main">
                <?php if(is_home()){ ?>
                <div id="slider">
                    <div id="layerslider_30" class="ls-wp-container" style="width:100%;height:500px;max-width:1920px;margin:0 auto;margin-bottom: 0px;">
                        <div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;">
                            <img src="<?php echo $redux_options[$themePrefix.'welcome_thumbnail']['url']; ?>" class="ls-bg" alt="bg1" />
                            <div class="ls-l" style="top:188px;left:25px;text-align:center; text-shadow: 1px 1px #000; z-index:500;width:300px;padding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:30px;line-height:46px;color:#fff;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-100;durationin:2000;delayin:1500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">
                                <span class="wel"><?php echo $redux_options[$themePrefix.'welcome_message']; ?></span>
                            </div>
                            <div class="ls-l" style="top:275px;left:25px;font-weight:300;z-index:300;background: rgba(0, 0, 0, 0.80);font-family:'Lato';font-size:24px;line-height:80px;color:#ffffff;padding-right:50px;padding-bottom:;padding-left:50px;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:2500;rotatexin:90;">
                                <?php echo $redux_options[$themePrefix.'secondary_message']; ?>
                            </div>
                        </div>
                        <?php $highlights = get_posts(array('post_type'=>'product', 'posts_per_page'=>5, 'meta_key'=> '_featured', 'meta_value'=>'yes'));
                        if(!empty($highlights)){
                            foreach($highlights as $featured){ ?>
                                <div class="ls-slide" data-ls="slidedelay:10000;transition2d:4;">
                                <?php echo get_the_post_thumbnail($featured->ID, 'mainSlider', array('class'=>'ls-bg')); ?>
                                <div class="ls-l" style="top:188px;left:25px;text-align:center; text-shadow: 1px 1px #000; z-index:500;width:300px;padding-left:0px;font-family:'Lato', 'Open Sans', sans-serif;font-size:30px;line-height:46px;color:#fff;white-space: nowrap;" data-ls="offsetxin:0;offsetyin:-100;durationin:2000;delayin:1500;transformoriginin:left 50% 0;offsetxout:0;rotateyout:-90;transformoriginout:left 50% 0;">
                                <span class="wel"><?php echo $featured->post_title; ?></span>
                                </div>
                                <div class="ls-l" style="top:275px;left:25px;font-weight:300;z-index:300;background: rgba(0, 0, 0, 0.80);font-family:'Lato';font-size:24px;line-height:80px;color:#ffffff;padding-right:50px;padding-bottom:;padding-left:50px;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:2500;rotatexin:90;">
                                <?php echo limitText($featured->post_excerpt, 10).'</div></div>';
                            }
                        } ?>
                    </div>
                </div>
                <?php } ?>
                <div class="container">