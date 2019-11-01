<?php
/* Template Name: Шаблон страницы контактов */

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);
?>

    <section class="section-contact ">
        <ul class="breadcrumbs">
            <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
            <li><?php echo get_the_title(); ?></li>
        </ul>
        <div class="title-section left">
            <div class="title-section__text">
                <?php echo get_the_title(); ?>
            </div>
        </div>
        <div class="contact-list">
            <div class="contact-item">
                <div class="contact-item__ico">
                    <img src="<?php echo $assets; ?>img/contact_ico1.svg" alt="">
                </div>
                <div class="contact-item__text">
                    <div class="contact-item__title">
                        Телефон:
                    </div>
                    <div class="contact-item__main">
                        <a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone'); ?></a>
                    </div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-item__ico">
                    <img src="<?php echo $assets; ?>img/contact_ico2.svg" alt="">
                </div>
                <div class="contact-item__text">
                    <div class="contact-item__title">
                        График работы:
                    </div>
                    <div class="contact-item__main">
                        <?php the_field('work_time'); ?>
                    </div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-item__ico">
                    <img src="<?php echo $assets; ?>img/contact_ico3.svg" alt="">
                </div>
                <div class="contact-item__text">
                    <div class="contact-item__title">
                        Email:
                    </div>
                    <div class="contact-item__main">
                        <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
                    </div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-item__ico">
                    <img src="<?php echo $assets; ?>img/contact_ico4.svg" alt="">
                </div>
                <div class="contact-item__text">
                    <div class="contact-item__title">
                        Адрес:
                    </div>
                    <div class="contact-item__main">
                        <a href="<?php the_field('link_to_map'); ?>" target="_blank"><?php the_field('address'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="map" id="map"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD41ju8fEBULLIEGvSODoqTUIGcX5nQxA4&amp;"></script>
        <script>
            var mapElement = document.getElementById('map');
            google.maps.event.addDomListener(window, 'load', init);
            var arrayCoords = [
                ['<?php the_field('address'); ?>', <?php the_field('latitude'); ?>, <?php the_field('longitude'); ?>]

            ];
            var map;

            function init() {
                var zoom = 16;
                var mapOptions = {

                    zoom: zoom,
                    center: new google.maps.LatLng(<?php the_field('latitude'); ?>, <?php the_field('longitude'); ?>),
                    scrollwheel: false,
                    disableDefaultUI: true
                };
                map = new google.maps.Map(mapElement, mapOptions);
                setMarkers(map);

                function setMarkers(map) {
                    var image = {
                        url: '<?php echo $assets; ?>img/pin.png',
                        size: new google.maps.Size(42, 60),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(0, 30)
                    };

                    for (var i = 0; i < arrayCoords.length; i++) {
                        var coords = arrayCoords[i];
                        var marker = new google.maps.Marker({
                            position: {
                                lat: coords[1],
                                lng: coords[2]
                            },
                            map: map,
                            icon: image,
                            title: coords[0],
                            zIndex: coords[3]
                        });
                    }
                }
                console.log("Map " + Boolean($(mapElement).length));
                setMarkers(map);
            }
        </script>
    </section>

<?php if(get_field('switch_socials')): ?>

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