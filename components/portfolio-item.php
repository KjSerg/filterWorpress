
<?php

$id = get_the_ID();

$gallery = get_field('gallery');

$url_imgs = array();

foreach ($gallery as $img) {
    $url_imgs[] = $img['url'];
}

$img = $gallery[0]['url'];

$year = get_the_terms($id, 'year_of_work');

?>

<a href="#gallery" class="work-item" data-gallery="<?php echo implode(', ', $url_imgs); ?>">
    <img src="<?php echo $img; ?>" alt="">
    <div class="work-item__info">
        <strong><?php echo $year[0]->name; ?></strong>
        <span><?php the_title(); ?></span>
    </div>
</a>