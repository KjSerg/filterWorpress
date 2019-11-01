<?php

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';

$s = $_GET;

$terms_house_type = get_terms( [
    'taxonomy' => 'house_type',
    'hide_empty' => false,
] );

$terms_storeys = get_terms([
    'taxonomy' => 'storeys',
    'hide_empty' => false,
]);

global $wp_query;

$req = array(
    'post_type' => 'projects',
    'paged' => get_query_var('paged') ?: 1
);

$req = custom_sort_by_square_and_price($s, $req);

if($s['house_type'] || $s['storeys']) {
    $req['tax_query'] = array(
        'relation' => 'AND',
    );
}

if($s['house_type']) {
    $house_types = explode(',', $s['house_type']);

    $term = array(
        'taxonomy'  => 'house_type',
        'field'     => 'slug',
        'terms'     => $house_types
    );

    $req['tax_query'][] = $term;
}

if($s['storeys']) {
    $storeys = explode(',', $s['storeys']);

    $term = array(
        'taxonomy'  => 'storeys',
        'field'     => 'slug',
        'terms'     => $storeys
    );

    $req['tax_query'][] = $term;
}

$wp_query = new WP_Query( $req );

$count_publish_posts = $wp_query->found_posts;
?>

    <section class="section-catalog pad_bot_section" style="background:#f3f6fa; ">
        <ul class="breadcrumbs">
            <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
            <li>Фильтр</li>
        </ul>
        <div class="title-section left">
            <div class="title-section__text">
                Проекты домов
            </div>
        </div>
        <div class="catalog-filter">
            <form action="<?php echo $url; ?>/?s=" class="filter-js" id="filter-js" method="get">
                <input type="hidden" name="" class="sort-input-js" value="">
                <input type="hidden" name="paged"  value="<?php echo $paged; ?>">

                <input type="hidden" name="house_type" class="house_type-js" value="">

                <input type="hidden" name="storeys" class="storeys-js" value="">

                <input type="hidden" name="price-min" class="price-min-js" value="">
                <input type="hidden" name="price-max" class="price-max-js" value="">

                <div class="catalog-filter__group">
                    <div class="catalog-filter__item">
                        <div class="catalog-filter__item-title">
                            Тип дома
                        </div>

                        <?php if($terms_house_type): ?>
                            <div class="checked-group">
                                <?php foreach ($terms_house_type as $item):
                                    $checked = '';
                                if($s['house_type']) {
                                    $house_types = explode(',', $s['house_type']);

                                    foreach ($house_types as $type) {
                                        if($type == $item->slug) {
                                            $checked = 'checked';
                                        }
                                    }
                                }

                                    ?>
                                    <label class="checked-item">
                                        <input type="checkbox"
                                               <?php echo $checked; ?>
                                               data-taxonomy="<?php echo $item->taxonomy; ?>"
                                               data-slug="<?php echo $item->slug; ?>"
                                               data-term_id="<?php echo $item->term_id; ?>"
                                               class="checked_st_filter"
                                               value="<?php echo $item->slug; ?>">
                                        <span></span>
                                        <?php echo $item->name; ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="catalog-filter__item">
                        <div class="catalog-filter__item-title">
                            Площадь
                        </div>
                        <div class="checked-group">
                            <label class="checked-item">
                                <input type="radio" name="square" value="0-100" class="checked_st_filter">
                                <span></span>
                                0-100 м2
                            </label>
                            <label class="checked-item">
                                <input type="radio" name="square" value="100-150" class="checked_st_filter">
                                <span></span>
                                100-150 м2
                            </label>
                            <label class="checked-item">
                                <input type="radio" name="square" value="150-200" class="checked_st_filter">
                                <span></span>
                                150-200 м2
                            </label>

                            <label class="checked-item">
                                <input type="radio" name="square" value="200-1000" class="checked_st_filter">
                                <span></span>
                                Свыше 200 м2
                            </label>
                        </div>
                    </div>
                    <div class="catalog-filter__item storeys_column">
                        <div class="catalog-filter__item-title">
                            Этажность
                        </div>
                        <?php if($terms_storeys): ?>
                            <div class="storeys-group">

                                <?php foreach ($terms_storeys as $item):

                                    $checked = '';
                                    if($s['storeys']) {
                                        $house_types = explode(',', $s['storeys']);

                                        foreach ($house_types as $type) {
                                            if($type == $item->slug) {
                                                $checked = 'checked';
                                            }
                                        }
                                    }

                                    ?>

                                    <label class="storeys_item">
                                        <input type="checkbox"
                                               <?php echo $checked; ?>
                                               data-taxonomy="<?php echo $item->taxonomy; ?>"
                                               data-slug="<?php echo $item->slug; ?>"
                                               data-term_id="<?php echo $item->term_id; ?>"
                                               value="<?php echo $item->slug; ?>"
                                               class="storeys_checked">
                                        <span><?php echo $item->name; ?></span>
                                    </label>

                                <?php endforeach; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="catalog-filter__item">
                        <div class="catalog-filter__item-title">
                            Бюджет
                        </div>
                        <div class="range-group">
                            <?php $range_min = $s['price-min'] ? $s['price-min'] : 22500; ?>
                            <?php $range_max = $s['price-max'] ? $s['price-max'] : 2222000; ?>
                            <input type="text"
                                   class="range"
                                   data-min="<?php echo $range_min; ?>"
                                   data-max="<?php echo $range_max; ?>"
                                   data-values="22500, 54750, 651000, 751250, 861500, 971750, 2222000">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="work-filter">
            <div class="work-filter__title">
                Найдено <?php echo $count_publish_posts; ?> проектов:
            </div>
            <div class="work-filter__form">
                <div class="work-filter__form-group">
                    <div class="work-filter__form-item">
                        <label>Сортировать по:</label>
                        <div class="sort-group">
                            <div class="sort-group__item" data-value="price" >
                                <a href="#" class=" sort-by-price-js sort-js" data-result="ASC">Цене</a>
                            </div>
                            <div class="sort-group__item" data-value="area">
                                <a href="#" class=" sort-by-square-js sort-js"  data-result="ASC">Площади</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="project-group" data-url="<?php echo $protocol . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI']; ?>">

            <?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                <?php get_template_part('components/project'); ?>

            <?php endwhile;

            else : ?>
                <p>Записей нет.</p>
            <?php endif; ?>

        </div>
        <div class="pagination">
            <?php
            wp_pagenavi();
//            posts_nav_link();
            wp_reset_query(); ?>
        </div>
    </section>

<?php if (have_rows('screens', 338)): ?>

    <?php while (have_rows('screens', 338)) : the_row(); ?>

        <?php if (get_row_layout() == 'screen_1'): ?>

            <section class="section-project-result pad_section">
                <div class="title-section">
                    <div class="title-section__text">
                        <?php e('title'); ?>
                    </div>
                </div>
                <div class="project-result">
                    <div class="text-group">
                        <?php e('text_1'); ?>

                        <div class="project-result__list">

                            <?php if (have_rows('list_1')): ?>

                                <?php while (have_rows('list_1')) : the_row(); ?>

                                    <div class="project-result__list-item">
                                        <div class="project-result__list-item-img">
                                            <img src="<?php e('icon'); ?>" alt="">
                                        </div>
                                        <div class="project-result__list-item-title">
                                            <?php e('text'); ?>
                                        </div>
                                    </div>

                                <?php endwhile; ?>

                            <?php endif; ?>

                        </div>

                        <?php e('text_2'); ?>

                        <div class="project-result__list thir_column">
                            <?php if (have_rows('list_2')): ?>

                                <?php while (have_rows('list_2')) : the_row(); ?>

                                    <div class="project-result__list-item">
                                        <div class="project-result__list-item-img">
                                            <img src="<?php e('icon'); ?>" alt="">
                                        </div>
                                        <div class="project-result__list-item-title">
                                            <?php e('text'); ?>
                                        </div>
                                    </div>

                                <?php endwhile; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ( get_row_layout() == 'screen_2' ): ?>

            <section class="section-about pad_section" style="background:#f3f6fa;">
                <div class="title-section">
                    <div class="title-section__text">
                        <?php e('title'); ?>
                    </div>
                </div>
                <div class="about-content">
                    <div class="about-content__img">
                        <img src="<?php e('img'); ?>" alt="">
                    </div>
                    <div class="about-content__text">
                        <div class="text-group">
                            <?php e('text_1'); ?>
                        </div>
                    </div>
                </div>
                <div class="about-content__bot">
                    <div class="text-group">
                        <?php e('text_2'); ?>
                    </div>
                </div>
            </section>

        <?php endif; ?>

    <?php endwhile; ?>

<?php endif; ?>


<?php if(get_field('switch_reviews', 338)): ?>

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

<?php if (have_rows('screens', 338)): ?>

    <?php while (have_rows('screens', 338)) : the_row(); ?>

        <?php if (get_row_layout() == 'screen_3'): ?>

            <section class="section-instagram pad_section" style="background: url(<?php echo $assets; ?>img/bg_patern1.jpg) no-repeat top center/cover;">
                <div class="title-section ">
                    <div class="title-section__text">
                        <?php e('title'); ?>
                    </div>
                </div>

                <?php
                $gallery = g('gallery');

                if($gallery):
                    ?>

                    <div class="slider-group">
                        <div class="project-slider">

                            <?php foreach ($gallery as $item): ?>

                                <div>
                                    <a href="<?php echo $item['url']; ?>" class="project-slider__item">
                                        <img src="<?php echo $item['url']; ?>" alt="">
                                    </a>
                                </div>

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

<?php if(get_field('switch_form', 338)): ?>

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

<?php if(get_field('switch_socials', 338)): ?>

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