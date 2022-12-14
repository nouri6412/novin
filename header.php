<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="enamad" content="313675"/>
        <link href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/respansive.css">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?ver=1.1.25">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/owlcarousel/owl.theme.default.min.css">
    <?php wp_head(); ?>
</head>

<body style="background-image: url(<?php echo get_field("option-header-bg", 'option'); ?>);">
    <?php
    wp_body_open();
    ?>
    <?php
    get_template_part('template-parts/header/header', 'content-order');
    ?>