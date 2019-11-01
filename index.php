<?php
/* Template Name: Шаблон главной страницы */

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);
?>

<?php if (have_rows('screens', $set)): ?>

    <?php while (have_rows('screens', $set)) : the_row(); ?>

        <?php if (get_row_layout() == 'screen_1'): ?>

            <?php if (!get_sub_field('screen_off')) : ?>

                <section class="section-head" style="background: url(<?php e('screen_bg'); ?>) no-repeat top center/cover">
                    <img src="<?php e('img_section'); ?>" alt="">
                    <div class="head-content">
                        <h1 class="head-content__title">
                            <?php e('title'); ?>
                        </h1>
                        <h2 class="head-content__text">
                            <?php e('description'); ?>
                        </h2>
                        <a href="#order-modal" class="btn_st open_modal">
                            <?php e('button_text'); ?>
                            <i class="zmdi zmdi-chevron-right"></i>
                        </a>
                    </div>
                </section>

            <?php endif; ?>
        <?php elseif ( get_row_layout() == 'screen_2' ): ?>
            <?php if (!get_sub_field('screen_off')) : ?>

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
        <?php elseif ( get_row_layout() == 'screen_3' ): ?>
            <?php if (!get_sub_field('screen_off')) : ?>

                <section class="section-house-info pad_section" style="background: url(<?php e('screen_bg'); ?>) no-repeat top center/cover;">
                    <div class="title-section">
                        <div class="title-section__text">
                            <?php e('title'); ?>
                        </div>
                    </div>
                    <div class="house-info">
                        <div class="house-info__img">
                            <img src="<?php e('img'); ?>" alt="">
                        </div>
                        <div class="house-info__text">
                            <div class="house-info__price">
                                <div class="house-info__title"><?php e('type'); ?></div>
                                <p>цена от</p>
                                <div class="house-info__price-text">
                                    <?php e('price'); ?> <span>руб.</span>
                                </div>
                            </div>
                            <div class="house-info__text-description">
                                <?php e('description'); ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        <?php elseif ( get_row_layout() == 'screen_4' ): ?>
            <?php if (!get_sub_field('screen_off')) : ?>

                <section class="section-project pad_section" style="background:<?php e('screen_bg'); ?>">
                    <div class="title-section">
                        <div class="title-section__text">
                            <?php e('title'); ?>
                        </div>
                    </div>

                    <?php if (have_rows('categories')): ?>

                        <?php while (have_rows('categories')) : the_row(); ?>

                            <?php
                            $cat = g('category');
                            $title = ($cat->description) ? $cat->description : $cat->name;
                            $link = get_term_link($cat);

                            $projects = g('projects');
                            ?>

                            <div class="project-group">
                                <div class="project-item-category">
                                    <div class="project-item-category__title">
                                        <?php echo $title; ?>
                                    </div>
                                    <div class="project-item-category__img">
                                        <span></span>
                                        <img src="<?php the_field('category_image', $cat); ?>" alt="<?php echo $title; ?>">
                                    </div>
                                    <a href="<?php echo $link; ?>" class="btn_st">
                                        Смотреть все
                                        <i class="zmdi zmdi-chevron-right"></i>
                                    </a>
                                </div>

                                <?php if($projects): ?>

                                    <?php foreach ($projects as $project): ?>

                                        <?php $img = (get_the_post_thumbnail_url($project)) ? get_the_post_thumbnail_url($project) : $assets . 'img/project.png'; ?>

                                        <a href="<?php the_permalink($project); ?>" class="project-item">
                                            <div class="project-item__img">
                                                <img src="<?php echo $img; ?>" alt="<?php echo get_the_title($project); ?>">
                                                <div class="project-item__info">
                                                    <div class="project-item__name">
                                                        <?php echo get_the_title($project); ?>
                                                    </div>
                                                    <div class="project-item__price">
                                                        от <strong class="separator"><?php the_field('price', $project); ?></strong> руб.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="project-item__description">
                                                <ul>
                                                    <li>
                                                        <i class="zmdi zmdi-home"></i>
                                                        <?php the_field('square', $project); ?> м2
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-edit"></i>
                                                        <?php the_field('sizes', $project); ?> м2
                                                    </li>
                                                    <li>
                                                        <i class="zmdi zmdi-hotel"></i>
                                                        <?php the_field('number_room', $project); ?> комнаты
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </div>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </section>

            <?php endif; ?>
        <?php elseif ( get_row_layout() == 'screen_reviews' ): ?>
            <?php if (!get_sub_field('screen_off')) : ?>

                <?php $reviews = g('reviews'); ?>

                <section class="section-reviews pad_section">
                    <div class="title-section">
                        <div class="title-section__text">
                            <?php e('title'); ?>
                        </div>
                    </div>

                    <?php if($reviews): ?>
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
                                                <?php if($link_to_video): ?>
                                                    <a href="<?php echo $link_to_video; ?>"
                                                       class="reviews-item__media">

                                                        <?php if($img): ?>
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

                                                        <?php if($img): ?>
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
        <?php elseif ( get_row_layout() == 'screen_instagram' ): ?>
            <?php if (!get_sub_field('screen_off')) : ?>

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
        <?php elseif ( get_row_layout() == 'screen_from_form' ): ?>
            <?php if (!get_sub_field('screen_off')) : ?>

                <section class="section-order pad_section" style="background:<?php e('screen_bg'); ?>;">
                    <div class="order-group">
                        <div class="order-form">
                            <div class="title-section left">
                                <div class="title-section__text">
                                    <?php e('title'); ?>
                                </div>
                            </div>
                            <div class="order-form-group">

                                <?php if (have_rows('form')): ?>

                                    <?php while (have_rows('form')) : the_row(); ?>

                                        <form action="<?php echo $url_home; ?>mail.php" id="order-form" method="POST" autocomplete="off">
                                            <input type="hidden" name="project_name" value="<?php bloginfo('name'); ?>">
                                            <input type="hidden" name="form_subject" value="<?php e('subject'); ?>">
                                            <input type="hidden" name="admin_email" value="<?php echo $email; ?>">
                                            <div class="form-group">
                                                <input type="text" class="input_st" name="Имя" required="" placeholder="<?php e('placeholder_1'); ?>">
                                                <i class="zmdi zmdi-account"></i>
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="input_st" name="Телефон" required=""
                                                       placeholder="<?php e('placeholder_2'); ?>">
                                                <i class="zmdi zmdi-phone"></i>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="input_st" name="Почта" required=""
                                                       placeholder="<?php e('placeholder_3'); ?>">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="form-group">
                                                <label class="up_file">
                                                    <input class="upfile_hide" type="file" name="upfile[]" id="upfile" required="">
                                                    <span><?php e('placeholder_4'); ?></span>
                                                    <img class="svg" src="<?php echo $assets; ?>img/attach.svg" alt="">
                                                </label>
                                                <div class="upload_file"></div>
                                            </div>
                                            <button class="btn_st " type="submit">
                                                <?php e('button_text'); ?>
                                                <i class="zmdi zmdi-chevron-right"></i>
                                            </button>
                                            <div class="form-consent">
                                                <label>
                                                    <input type="checkbox" checked class="checked_st consent_input" name="consent">
                                                    <span></span>
                                                    <?php e('consent'); ?>
                                                </label>
                                            </div>
                                        </form>

                                    <?php endwhile; ?>

                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="order-img">
                            <img src="<?php e('img'); ?>" alt="">
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        <?php elseif ( get_row_layout() == 'screen_socials' ): ?>
            <?php if (!get_sub_field('screen_off')) : ?>

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

        <?php endif; ?>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>