<?php

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);

$img = get_the_post_thumbnail_url();


$switch_advantages = get_field('switch_advantages');
$switch_reviews = get_field('switch_reviews');
$switch_instagram = get_field('switch_instagram');
$switch_socials = get_field('switch_socials');
?>

    <section class="section-about pad_bot_section">
        <ul class="breadcrumbs">
            <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
            <li><?php echo get_the_title(); ?></li>
        </ul>
        <div class="about-content">

            <?php if ($img): ?>
                <div class="about-content__img">
                    <img src="<?php echo $img; ?>" alt="">
                </div>
            <?php endif; ?>

            <div class="about-content__text">
                <div class="title-section left">
                    <h1 class="title-section__text">
                        <?php echo get_the_title(); ?>
                    </h1>
                </div>
                <div class="text-group">
                    <?php the_post();
                    the_content(); ?>
                </div>
            </div>
        </div>
        <div class="about-content__bot">
            <div class="text-group">
                <?php the_field('text'); ?>
            </div>
        </div>
    </section>

<?php if ($switch_advantages): ?>

    <?php if (have_rows('screens', $set)): ?>

        <?php while (have_rows('screens', $set)) : the_row(); ?>

            <?php if (get_row_layout() == 'screen_2'): ?>

                <section class="section-advantages pad_section" style="background: <?php e('screen_bg'); ?>;">
                    <div class="title-section">
                        <div class="title-section__text">
                            <?php e('title'); ?>
                        </div>
                    </div>

                    <?php if (have_rows('list')): ?>

                        <div class="advantages">

                            <?php while (have_rows('list')) : the_row(); ?>

                                <div class="advantage-item">
                                    <div class="advantage-item__img">
                                        <img src="<?php e('icon'); ?>" alt="">
                                    </div>
                                    <div class="advantage-item__title">
                                        <?php e('title'); ?>
                                    </div>
                                    <div class="advantage-item__hide">
                                        <img src="<?php e('bg_img'); ?>" alt="">
                                        <div class="advantage-item__title">
                                            <?php e('title'); ?>
                                        </div>
                                        <div class="advantage-item__text">
                                            <?php e('description'); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; ?>

                        </div>

                    <?php endif; ?>

                </section>

            <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>

<?php endif; ?>

<?php if ($switch_reviews): ?>

    <?php if (have_rows('screens', $set)): ?>

        <?php while (have_rows('screens', $set)) : the_row(); ?>

            <?php if (get_row_layout() == 'screen_reviews'): ?>

                <?php $reviews = g('reviews'); ?>

                <section class="section-reviews pad_section">
                    <div class="title-section">
                        <div class="title-section__text">
                            <?php e('title'); ?>
                        </div>
                    </div>

                    <?php if ($reviews): ?>
                        <div class="slider-group">
                            <div class="reviews js-reviews-slider">

                                <?php foreach ($reviews as $review): ?>

                                    <?php
                                    $is_photo = get_field('switch', $review);
                                    ?>

                                    <?php if ($is_photo): ?>
                                        <?php
                                        $photo = get_field('photo_review', $review);
                                        if ($photo):
                                            ?>

                                            <div>
                                                <a href="<?php echo $photo; ?>" class="reviews-item ri_fancy">
                                                    <img src="<?php echo $photo; ?>" alt="">
                                                </a>
                                            </div>

                                        <?php endif; ?>

                                    <?php else: ?>

                                        <?php

                                        $img = get_field('img', $review);
                                        $link_to_video = get_field('link_to_video', $review);
                                        $description = get_field('description', $review);
                                        $text = get_field('text', $review);

                                        ?>

                                        <div>
                                            <div class="reviews-item">
                                                <?php if ($link_to_video): ?>
                                                    <a href="<?php echo $link_to_video; ?>"
                                                       class="reviews-item__media">

                                                        <?php if ($img): ?>
                                                            <img src="<?php echo $img; ?>" alt="">
                                                        <?php endif; ?>


                                                        <span>
                                                                <span>
                                                                    <i class="zmdi zmdi-play"></i>
                                                                </span>
                                                                Смотреть ведео
                                                            </span>
                                                    </a>
                                                <?php else: ?>
                                                    <div class="reviews-item__media" style="pointer-events: none">

                                                        <?php if ($img): ?>
                                                            <img src="<?php echo $img; ?>" alt="">
                                                        <?php endif; ?>

                                                    </div>
                                                <?php endif; ?>

                                                <div class="reviews-item__text">
                                                    <div class="reviews-item__top">
                                                        <div class="reviews-item__title">
                                                            <?php echo get_the_title($review); ?>
                                                        </div>
                                                        <div class="reviews-item__subtitle">
                                                            <?php echo $description; ?>
                                                        </div>
                                                    </div>
                                                    <div class="reviews-item__text-group scroll">
                                                        <?php echo $text; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </div>

                            <div class="slider-nav-group">
                                <div class="slider-dots"></div>
                                <div class="slider-nav__btn">
                                    <span class="prev-slide"><i class="zmdi zmdi-chevron-left"></i></span>
                                    <span class="next-slide"><i class="zmdi zmdi-chevron-right"></i></span>
                                </div>
                            </div>

                        </div>

                    <?php endif; ?>

                </section>

            <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>

<?php endif; ?>

<?php if ($switch_instagram): ?>

    <?php if (have_rows('screens', $set)): ?>

        <?php while (have_rows('screens', $set)) : the_row(); ?>

            <?php if (get_row_layout() == 'screen_instagram'): ?>

                <section class="section-instagram pad_section" style="background: url(<?php e('screen_bg'); ?>) no-repeat top center/cover;">
                    <div class="title-section ">
                        <div class="title-section__text">
                            <?php e('title'); ?><br>
                            <?php if(g('logo')) {echo '<img src="'.g('logo').'" alt="">';} ?>
                        </div>
                    </div>
                    <div class="slider-group">
                        <div id="instafeed"
                             class="instafeed-slider js-insta-slider"
                             data-id="<?php e('userid'); ?>"
                             data-accessToken="<?php echo g('accessToken') . md5('str'); ?>"
                             data-p="<?php e('accessToken'); ?>"
                             data-limit="<?php e('limit'); ?>"
                        ></div>
                        <div class="slider-nav-group">
                            <div class="slider-dots"></div>
                            <div class="slider-nav__btn">
                                <span class="prev-slide"><i class="zmdi zmdi-chevron-left"></i></span>
                                <span class="next-slide"><i class="zmdi zmdi-chevron-right"></i></span>
                            </div>
                        </div>
                    </div>
                </section>

            <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>

<?php endif; ?>

<?php if ($switch_socials): ?>

    <?php if (have_rows('screens', $set)): ?>

        <?php while (have_rows('screens', $set)) : the_row(); ?>

            <?php if (get_row_layout() == 'screen_socials'): ?>

                <section class="section-social" style="background: #fff;">
                    <div class="social-group">
                        <div class="social-group__title">
                            <span><?php e('title'); ?></span>
                            <?php e('subtitle'); ?>
                        </div>

                        <?php if (have_rows('list')): ?>

                            <ul class="social-list">

                                <?php while (have_rows('list')) : the_row(); ?>

                                    <li>
                                        <a href="<?php e('link'); ?>" target="_blank">
                                            <img src="<?php e('icon'); ?>" alt="">
                                            <?php e('name'); ?>
                                        </a>
                                    </li>

                                <?php endwhile; ?>

                            </ul>

                        <?php endif; ?>

                    </div>
                </section>

            <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>

<?php endif; ?>


<?php get_footer(); ?>
