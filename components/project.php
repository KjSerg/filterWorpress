<?php
$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);
?>

<?php $img = (get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : $assets . 'img/project.png'; ?>

<a href="<?php the_permalink(); ?>" class="project-item">
    <div class="project-item__img">
        <img src="<?php echo $img; ?>" alt="">
        <div class="project-item__info">
            <div class="project-item__name">
                <?php echo get_the_title(); ?>
            </div>
            <div class="project-item__price">
                от <strong class="separator"><?php the_field('price'); ?></strong> руб.
            </div>
        </div>
    </div>
    <div class="project-item__description">
        <ul>
            <li>
                <i class="zmdi zmdi-home"></i>
                <?php the_field('square'); ?> м2
            </li>
            <li>
                <i class="zmdi zmdi-edit"></i>
                <?php the_field('sizes'); ?>  м2
            </li>
            <li>
                <i class="zmdi zmdi-hotel"></i>
                <?php the_field('number_room'); ?> комнаты
            </li>
        </ul>
    </div>
</a>