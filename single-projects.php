<?php

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);

$id = get_the_ID();

$gallery = get_field('gallery');
$thumbnail = get_the_post_thumbnail_url();

$title = get_the_title();

$cat_names = wp_get_post_terms( $id, 'house_type', array('fields' => 'names') );

$layout = get_field('layout');

$switch_reviews = get_field('switch_reviews');
$switch_instagram = get_field('switch_instagram');
$switch_socials = get_field('switch_socials');

?>

<section class="section-project-gallery pad_bot_section">
    <div class="project-gallery">
        <div class="project-gallery__title">
            <?php echo $title; ?>
        </div>
        <div class="project-gallery__main slider-for">


            <?php if($gallery): ?>
                <?php foreach ($gallery as $item): ?>

                    <div>
                        <img src="<?php echo $item['url']; ?>" alt="<?php echo $title; ?>">
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <?php if($thumbnail): ?>
                    <div>
                        <img src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>">
                    </div>
                <?php endif; ?>
            <?php endif; ?>


        </div>

        <div class="project-gallery__nav slider-nav">

            <?php if($gallery): ?>
                <?php foreach ($gallery as $item): ?>

                    <div>
                        <div class="pg-nav__item">
                            <img src="<?php echo $item['url']; ?>" alt="<?php echo $title; ?>">
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="project-info">
        <div class="project-info__group">
            <div class="project-info__item">
                <div class="project-info__item-img">
                    <img src="<?php echo $assets; ?>img/project-info1.svg" alt="">
                </div>
                <div class="project-info__item-text">
                    <span>Тип дома:</span>
                    <strong><?php echo implode(",", $cat_names); ?></strong>
                </div>
            </div>
            <div class="project-info__item">
                <div class="project-info__item-img">
                    <img src="<?php echo $assets; ?>img/project-info2.svg" alt="">
                </div>
                <div class="project-info__item-text">
                    <span>Площадь:</span>
                    <strong><?php the_field('square'); ?> м2</strong>
                </div>
            </div>
            <div class="project-info__item">
                <div class="project-info__item-img">
                    <img src="<?php echo $assets; ?>img/project-info3.svg" alt="">
                </div>
                <div class="project-info__item-text">
                    <span>Размер:</span>
                    <strong><?php the_field('sizes'); ?> м</strong>
                </div>
            </div>
            <div class="project-info__item">
                <div class="project-info__item-img">
                    <img src="<?php echo $assets; ?>img/project-info4.svg" alt="">
                </div>
                <div class="project-info__item-text">
                    <span>Комнаты:</span>
                    <strong><?php the_field('number_room'); ?></strong>
                </div>
            </div>
        </div>
        <div class="project-info__btn">
            <a href="#callback" class="btn_st open_modal">
                Получить смету
                <i class="zmdi zmdi-chevron-right"></i>
            </a>
        </div>
    </div>
</section>

<?php if (have_rows('house_configuration') || $layout): ?>

<section class="section-project-description pad_section" style="background: #f3f6fa;">
    <div class="project-description js-tab">
        <div class="project-description__nav">
            <div class="project-description__nav-item active js-tab-link" data-target="target1">
                Планировка дома
            </div>
            <div class="project-description__nav-item js-tab-link" data-target="target2">
                Комплектации дома
            </div>
        </div>
        <div class="project-description__content ">
            <div class="project-description__item js-tab-item active" data-target="target1">
                <div class="project-description__layout">
                    <?php if($layout): ?>
                        <?php foreach ($layout as $item): ?>

                            <a data-fancybox="layout" href="<?php echo $item['url']; ?>" class="project-description__layout-item">
                                <img src="<?php echo $item['url']; ?>" alt="">
                            </a>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="project-description__item js-tab-item" data-target="target2">
                <div class="project-description__options">

                    <?php if (have_rows('house_configuration')): ?>

                        <?php while (have_rows('house_configuration')) : the_row(); ?>

                            <table class="options-table">
                                <?php if (have_rows('table_header')): ?>

                                    <?php while (have_rows('table_header')) : the_row(); ?>
                                        <thead>
                                        <tr>
                                            <th><?php e('column_1'); ?></th>
                                            <th>
                                                <?php if (have_rows('column_2')): ?>

                                                    <?php while (have_rows('column_2')) : the_row(); ?>
                                                        <span><?php e('name'); ?></span>
                                                        <strong><?php e('price'); ?></strong>
                                                    <?php endwhile; ?>

                                                <?php endif; ?>
                                            </th>
                                            <th>
                                                <?php if (have_rows('column_3')): ?>

                                                    <?php while (have_rows('column_3')) : the_row(); ?>
                                                        <span><?php e('name'); ?></span>
                                                        <strong><?php e('price'); ?></strong>
                                                    <?php endwhile; ?>

                                                <?php endif; ?>
                                            </th>
                                            <th>
                                                <?php if (have_rows('column_4')): ?>

                                                    <?php while (have_rows('column_4')) : the_row(); ?>
                                                        <span><?php e('name'); ?></span>
                                                        <strong><?php e('price'); ?></strong>
                                                    <?php endwhile; ?>

                                                <?php endif; ?>
                                            </th>
                                        </tr>
                                        </thead>
                                    <?php endwhile; ?>

                                <?php endif; ?>

                                <tbody>
                                <?php if (have_rows('table')): ?>

                                    <?php while (have_rows('table')) : the_row(); ?>
                                        <tr>
                                            <td>
                                                <?php e('column_1'); ?>
                                            </td>
                                            <td>

                                                <?php $has_check = g('column_2'); ?>
                                                <?php if($has_check): ?>
                                                    <img src="<?php echo $assets; ?>img/check.png" alt="">
                                                <?php else: ?>
                                                    <img src="<?php echo $assets; ?>img/uncheck.png" alt="">
                                                <?php endif; ?>

                                            </td>
                                            <td>
                                                <?php $has_check = g('column_3'); ?>
                                                <?php if($has_check): ?>
                                                    <img src="<?php echo $assets; ?>img/check.png" alt="">
                                                <?php else: ?>
                                                    <img src="<?php echo $assets; ?>img/uncheck.png" alt="">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php $has_check = g('column_4'); ?>
                                                <?php if($has_check): ?>
                                                    <img src="<?php echo $assets; ?>img/check.png" alt="">
                                                <?php else: ?>
                                                    <img src="<?php echo $assets; ?>img/uncheck.png" alt="">
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>

                                <?php endif; ?>
                                </tbody>
                            </table>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php if (have_rows('section_form')): ?>

    <?php while (have_rows('section_form')) : the_row(); ?>

        <section class="section-callbac pad_section marg_top_30" style="background: url(<?php e('screen_bg'); ?>) no-repeat top center/cover;">
            <div class="callback-content">
                <div class="title-section left">
                    <div class="title-section__text">
                        <?php e('title'); ?>
                    </div>
                </div>
                <div class="callback-form">
                    <form action="<?php echo $url_home; ?>mail.php" id="callback-form" method="POST" autocomplete="off">
                        <input type="hidden" name="project_name" value="<?php bloginfo('name'); ?>">
                        <input type="hidden" name="form_subject" value="<?php e('subject'); ?>">
                        <input type="hidden" name="admin_email" value="<?php echo $email; ?>">
                        <div class="form-group-horizontal">
                            <div class="form-group">
                                <input type="tel" class="input_st" name="Телефон" required="" placeholder="<?php e('placeholder'); ?>">
                                <i class="zmdi zmdi-phone"></i>
                            </div>
                            <div class="form-group">
                                <button class="btn_st " type="submit">
                                    <span>
                                        <?php e('button_text'); ?>
                                        <i class="zmdi zmdi-chevron-right"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

<?php endif; ?>

<?php if($switch_reviews): ?>

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

        <?php endwhile; ?>

    <?php endif; ?>

<?php endif; ?>

<?php if($switch_instagram): ?>

    <?php if (have_rows('screens', $set)): ?>

        <?php while (have_rows('screens', $set)) : the_row(); ?>

            <?php if (get_row_layout() == 'screen_instagram'): ?>

                <section class="section-instagram pad_section"
                         style="background: url(<?php e('screen_bg'); ?>) no-repeat top center/cover;">
                    <div class="title-section ">
                        <div class="title-section__text">
                            <?php e('title'); ?><br>
                            <?php if (g('logo')) {
                                echo '<img src="' . g('logo') . '" alt="">';
                            } ?>
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

<?php if($switch_socials): ?>

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
