<?php

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);

$count_publish_posts = wp_count_posts('portfolio')->publish;

$terms_type_of_work = get_terms([
    'taxonomy' => 'type_of_work',
    'hide_empty' => false,
]);

$terms_year_of_work = get_terms([
    'taxonomy' => 'year_of_work',
    'hide_empty' => false,
]);


$switch_reviews = get_field('switch_reviews', 429);
$switch_instagram = get_field('switch_instagram', 429);
$switch_form = get_field('switch_form', 429);
$switch_socials = get_field('switch_socials', 429);

$int = 0;
?>

    <section class="section-work pad_bot_section" style="background:#f3f6fa; ">
        <ul class="breadcrumbs">
            <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
            <li>Наши работы</li>
        </ul>
        <div class="title-section left">
            <h1 class="title-section__text">
                Наши работы
            </h1>
        </div>

        <div class="work-filter">
            <div class="work-filter__title">
                Найдено <?php echo $count_publish_posts; ?> проектов:
            </div>
            <div class="work-filter__form">
                <form action="">
                    <div class="work-filter__form-group">

                        <?php if ($terms_type_of_work): ?>

                            <div class="work-filter__form-item">
                                <label>Тип:</label>
                                <select name="type_of_work" class="select_st select-filter-js">
                                    <option>Сделайте выбор</option>
                                    <?php foreach ($terms_type_of_work as $item): $link = get_term_link($item); ?>

                                        <option value="<?php echo $link; ?>"><?php echo $item->name; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>

                        <?php endif; ?>

                        <?php if ($terms_year_of_work): ?>

                            <div class="work-filter__form-item">
                                <label>Год:</label>
                                <select name="year_of_work" class="select_st select-filter-js">
                                    <option>Сделайте выбор</option>
                                    <?php foreach ($terms_year_of_work as $item): $link = get_term_link($item); ?>

                                        <option value="<?php echo $link; ?>"><?php echo $item->name; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>

                        <?php endif; ?>

                    </div>
                </form>
            </div>
        </div>

        <div class="work-group">

            <?php  if (have_posts()) : $i=1; while (have_posts()) : the_post(); ?>

                <?php if($i<4): ?>

                    <?php get_template_part('components/portfolio-item'); ?>

                <?php endif; ?>

            <?php $i++; $int++; endwhile; endif; ?>

            <div class="work-group__in">

                <?php  if (have_posts()) : $i=1; while (have_posts()) : the_post(); ?>

                    <?php if($i==4): ?>

                        <?php get_template_part('components/portfolio-item'); ?>

                    <?php endif; ?>

                    <?php $i++; endwhile; endif; ?>

                <div class="work-group__in-sm">
                    <?php  if (have_posts()) : $i=1; while (have_posts()) : the_post(); ?>

                        <?php if($i>4 && $i<7): ?>

                            <?php get_template_part('components/portfolio-item'); ?>

                        <?php endif; ?>

                        <?php $i++;  endwhile; endif; ?>
                </div>

            </div>

        </div>

        <?php if ($int < 7): ?>

            <div class="pagination">
                <?php wp_pagenavi(); ?>
            </div>

        <?php endif; ?>

    </section>


    <?php if (have_rows('section_1', 429)): ?>

        <?php while (have_rows('section_1', 429)) : the_row(); ?>

            <section class="section-house-info pad_section"
                     style="background: url(<?php echo $assets; ?>img/bg_patern.jpg) no-repeat top center/cover;">
                <div class="house-info">
                    <div class="house-info__img">
                        <img src="<?php e('img'); ?>" alt="">
                    </div>
                    <div class="house-info__text">
                        <div class="house-info__price">
                            <div class="house-info__title"><?php e('title'); ?></div>
                            <p><strong><?php e('subtitle'); ?></strong></p>
                        </div>
                        <div class="house-info__text-description">
                            <p><?php e('description'); ?></p>
                        </div>
                        <a href="#callback" class="btn_st open_modal">
                            <?php e('button_text'); ?>
                            <i class="zmdi zmdi-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </section>

        <?php endwhile; ?>

    <?php endif; ?>

    <?php if ($int > 6): ?>

        <section class="section-work pad_section" style="background:#f3f6fa; ">
            <div class="work-group">
                <div class="work-group__in">
                    <?php if (have_posts()) : $i = 1;
                        while (have_posts()) : the_post(); ?>

                            <?php if ($i == 7): ?>

                                <?php get_template_part('components/portfolio-item'); ?>

                            <?php endif; ?>

                            <?php $i++; endwhile; endif; ?>

                    <div class="work-group__in-sm">
                        <?php if (have_posts()) : $i = 1;
                            while (have_posts()) : the_post(); ?>

                                <?php if ($i > 7 && $i < 10): ?>

                                    <?php get_template_part('components/portfolio-item'); ?>

                                <?php endif; ?>

                                <?php $i++; endwhile; endif; ?>
                    </div>

                </div>
            </div>

            <?php if ($int > 6 && $int < 10): ?>

                <div class="pagination">
                    <?php wp_pagenavi(); ?>
                </div>

            <?php endif; ?>

        </section>

    <?php endif; ?>

    <?php if ($int > 9): ?>

        <?php if (have_rows('section_2', 429)): ?>

            <?php while (have_rows('section_2', 429)) : the_row(); ?>

                <section class="section-house-info pad_section"
                         style="background: url(<?php echo $assets; ?>img/bg_patern.jpg) no-repeat top center/cover;">
                    <div class="house-info">
                        <div class="house-info__img">
                            <img src="<?php e('img'); ?>" alt="">
                        </div>
                        <div class="house-info__text">
                            <div class="house-info__price">
                                <div class="house-info__title"><?php e('title'); ?></div>
                                <p><strong><?php e('subtitle'); ?></strong></p>
                            </div>
                            <div class="house-info__text-description">
                                <p><?php e('description'); ?></p>
                            </div>
                            <a href="#callback" class="btn_st open_modal">
                                <?php e('button_text'); ?>
                                <i class="zmdi zmdi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </section>

            <?php endwhile; ?>

        <?php endif; ?>

        <section class="section-work pad_section" style="background:#f3f6fa; ">
            <div class="work-group">


                <?php  if (have_posts()) : $i=1; while (have_posts()) : the_post(); ?>

                    <?php if($i>9 && $i<13): ?>

                        <?php get_template_part('components/portfolio-item'); ?>

                    <?php endif; ?>

                    <?php $i++; endwhile; endif; ?>



                <div class="work-group__in">
                    <div class="work-group__in-sm">
                        <?php  if (have_posts()) : $i=1; while (have_posts()) : the_post(); ?>

                            <?php if($i>12 && $i<15): ?>

                                <?php get_template_part('components/portfolio-item'); ?>

                            <?php endif; ?>

                            <?php $i++; endwhile; endif; ?>
                    </div>
                    <?php  if (have_posts()) : $i=1; while (have_posts()) : the_post(); ?>

                        <?php if($i==15): ?>

                            <?php get_template_part('components/portfolio-item'); ?>

                        <?php endif; ?>

                        <?php $i++; endwhile; endif; ?>
                </div>
            </div>
            <?php if ($int > 9): ?>
                <div class="pagination">
                    <?php wp_pagenavi(); ?>
                </div>
            <?php endif; ?>
        </section>

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

<?php if ($switch_form): ?>

    <?php if (have_rows('screens', $set)): ?>

        <?php while (have_rows('screens', $set)) : the_row(); ?>

            <?php if (get_row_layout() == 'screen_from_form'): ?>

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