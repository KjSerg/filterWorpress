<?php

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
?>

<section class="section-error pad_section">
    <div class="error-content">
        <img src="<?php echo $assets; ?>img/404.png" alt="">
        <div class="error-content__text">
            <div class="error-content__title">
                <span>Упс!</span><br>
                Ваша страница не найдена!
            </div>
            <div class="error-content__description">
                Запрашиваемая страница не найдена. Но ничего страшного. Вы уже видели наши дома? Скорее смотрите!
            </div>
            <div class="error-content__btn">
                <a href="<?php the_permalink($set); ?>" class="btn_st">
                    На главную
                    <i class="zmdi zmdi-chevron-right"></i>
                </a>
                <a href="<?php echo get_post_type_archive_link( 'projects' ); ?>" class="btn_st green">
                    Наши проекты
                    <i class="zmdi zmdi-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
