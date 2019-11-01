<?php

/* Template Name: Шаблон страницы отзывов */

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);

$switch_instagram = get_field('switch_instagram');
$switch_projects = get_field('switch_projects');
$switch_socials = get_field('switch_socials');
?>

    <section class="section-reviews pad_bot_section" style="background: #f3f6fa;">
        <ul class="breadcrumbs">
            <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
            <li><?php echo get_the_title(); ?></li>
        </ul>
        <div class="title-section left">
            <div class="title-section__text">
                <?php echo get_the_title(); ?>
            </div>
        </div>

        <?php if (have_rows('sliders')): ?>

            <?php while (have_rows('sliders')) : the_row(); ?>

                <?php $reviews = g('reviews'); ?>

                <?php if($reviews): ?>

                    <div class="reviews-slider-item">
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
                    </div>

                <?php endif; ?>

            <?php endwhile; ?>

        <?php endif; ?>

    </section>

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

<?php if ($switch_projects): ?>

    <?php if (have_rows('screens', $set)): ?>

        <?php while (have_rows('screens', $set)) : the_row(); ?>

            <?php if (get_row_layout() == 'screen_4'): ?>

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