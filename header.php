<?php
$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
?>

<!DOCTYPE html>
<html  <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <meta content="notranslate" name="google">

    <title><?php wp_title(); ?> </title>

<!--    <meta name="Keywords" content="--><?php //echo get_bloginfo('description'); ?><!--">-->
<!---->
<!--    <meta name="description" content="--><?php //bloginfo('name'); ?><!-- - --><?php //echo get_bloginfo('description'); ?><!--">-->

    <?php wp_head(); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<script>
    var adminAjax = '<?php echo $var['admin_ajax']; ?>';
    var home_url = '<?php echo $url; ?>';
</script>
<body>

    <div class="top-nav-sm">
        <div class="top-nav-sm__content">
            <a href="<?php echo $url; ?>" class="logo_sidebar">
                <img src="<?php the_field('logo', $set); ?>" alt="<?php bloginfo('name'); ?>">
            </a>
            <span class="open_sidebar">
            </span>
        </div>
    </div>

<main class="content <?php if (is_404()): ?>error_page<?php endif; ?>">

    <?php if (!is_404()): ?>

        <div class="main-content-group">

            <aside class="sidebar">

                <div class="sidebar-content">
                    <div class="sidebar-top">
                        <a href="<?php echo $url; ?>" class="logo_sidebar">
                            <img src="<?php the_field('logo', $set); ?>" alt="<?php bloginfo('name'); ?>">
                        </a>
                    </div>
                    <nav class="navigation">
                        <ul>
                            <?php wp_nav_menu( array('menu' => 'Menu 1', 'items_wrap' => '%3$s', 'container' => '') ); ?>
                        </ul>
                    </nav>
                    <div class="sidebar-contact">

                        <a href="tel:<?php the_field('phone', $set); ?>" class="tel_sidebar">
                            <?php the_field('phone', $set); ?>
                        </a>

                        <a href="mailto:<?php the_field('email', $set); ?>" class="email_sidebar">
                            <i class="zmdi zmdi-email"></i>
                            <?php the_field('email', $set); ?>
                        </a>

                        <p>
                            <?php the_field('working_hours', $set); ?>
                        </p>

                        <?php if (have_rows('messengers', $set)): ?>

                            <ul class="messenger">

                                <?php while (have_rows('messengers', $set)) : the_row(); ?>

                                    <li>
                                        <a href="<?php e('link'); ?>" target="_blank">
                                            <img src="<?php e('icon'); ?>" alt="">
                                        </a>

                                    </li>

                                <?php endwhile; ?>

                            </ul>

                        <?php endif; ?>


                        <a href="#callback" class="sidebar_btn open_modal">
                            <i class="zmdi zmdi-phone"></i> Заказать звонок
                        </a>
                    </div>
                </div>
            </aside>

            <div class="main-content">

    <?php endif; ?>