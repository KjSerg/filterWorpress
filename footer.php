<?php
$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('admin_email', $set);

$policy_page_id = (int) get_option( 'wp_page_for_privacy_policy' );
?>

<?php if (!is_404()): ?>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-text">
            <?php the_field('copyright', $set); ?>
        </div>
        <a href="<?php echo get_privacy_policy_url(); ?>" class="policy_link">
            Политика конфиденциальности
        </a>
    </div>
</footer>

</div>
</div>
<?php endif; ?>
</main>

<?php wp_footer(); ?>

<!-- modal callback-->
<?php if (have_rows('modal_callback', $set)): ?>

    <?php while (have_rows('modal_callback', $set)) : the_row(); ?>

        <div class="modal modal-sm" id="callback">
            <div class="modal-content">
                <span class="close_modal"><i class="zmdi zmdi-close"></i></span>
                <div class="modal-title">
                    <div class="modal-title__main">
                        <?php e('title'); ?>
                    </div>
                    <div class="modal-title__text">
                        <?php e('subtitle'); ?>
                    </div>
                </div>
                <div class="modal-callback-form">
                    <form action="<?php echo $url_home; ?>mail.php" id="callback-form-modal" method="POST" autocomplete="off">
                        <input type="hidden" name="project_name" value="<?php bloginfo('name'); ?>">
                        <input type="hidden" name="form_subject" value="<?php e('subject'); ?>">
                        <input type="hidden" name="admin_email" value="<?php echo $email; ?>">
                        <div class="form-group">
                            <input type="tel" class="input_st" name="Телефон" required=""
                                   placeholder="<?php e('placeholder'); ?>">
                            <i class="zmdi zmdi-phone"></i>
                        </div>
                        <button class="btn_st " type="submit">
                        <span>
                            <?php e('button_text'); ?>
                            <i class="zmdi zmdi-chevron-right"></i>
                        </span>
                        </button>
                        <div class="form-consent">
                            <label>
                                <input type="checkbox" checked class="checked_st consent_input" name="consent">
                                <span></span>
                                <?php e('consent'); ?>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

<?php endif; ?>

<!-- modal thanks-->

<?php if (have_rows('modal_thanks', $set)): ?>

    <?php while (have_rows('modal_thanks', $set)) : the_row(); ?>

        <div class="modal modal-sm" id="thanks">
            <div class="modal-content">
                <span class="close_modal"><i class="zmdi zmdi-close"></i></span>
                <div class="modal-title">
                    <div class="modal-title__main">
                        <?php e('title'); ?>
                    </div>
                    <div class="modal-title__text">
                        <?php e('subtitle'); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

<?php endif; ?>

<!-- modal order-->

<?php if (have_rows('modal_order', $set)): ?>

    <?php while (have_rows('modal_order', $set)) : the_row(); ?>

        <div class="modal modal-md" id="order-modal">
            <div class="modal-content">
                <span class="close_modal"><i class="zmdi zmdi-close"></i></span>
                <div class="modal-title">
                    <div class="modal-title__main">
                        <?php e('title'); ?>
                    </div>
                    <div class="modal-title__text">
                        <?php e('subtitle'); ?>
                    </div>
                </div>
                <div class="modal-order-form">
                    <form action="<?php echo $url_home; ?>mail.php" id="order-form-modal" method="POST" autocomplete="off">
                        <input type="hidden" name="project_name" value="<?php bloginfo('name'); ?>">
                        <input type="hidden" name="form_subject" value="<?php e('subject'); ?>">
                        <input type="hidden" name="admin_email" value="<?php echo $email; ?>">
                        <div class="order-form__content">
                            <div class="order-form__filter">

                                <?php if (have_rows('list_1')): ?>

                                    <?php while (have_rows('list_1')) : the_row(); ?>

                                        <div class="catalog-filter__item">
                                            <div class="catalog-filter__item-title">
                                                <?php echo $name = g('name'); ?>
                                            </div>
                                            <div class="checked-group">
                                                <?php if (have_rows('list_selected')): ?>

                                                    <?php while (have_rows('list_selected')) : the_row(); ?>
                                                        <label class="checked-item">
                                                            <input type="checkbox" class="checked_st_filter"
                                                                   name="<?php echo $name; ?>:<?php e('val'); ?>">
                                                            <span></span>
                                                            <?php e('val'); ?>
                                                        </label>
                                                    <?php endwhile; ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php endwhile; ?>

                                <?php endif; ?>

                                <?php if (have_rows('list_2')): ?>

                                    <?php while (have_rows('list_2')) : the_row(); ?>

                                        <div class="catalog-filter__item">
                                            <div class="catalog-filter__item-title">
                                                <?php echo $name = g('name'); ?>
                                            </div>
                                            <div class="storeys-group">
                                                <?php if (have_rows('list_selected')): ?>

                                                    <?php while (have_rows('list_selected')) : the_row(); ?>
                                                        <label class="storeys_item">
                                                            <input type="checkbox" class="storeys_checked"
                                                                   name="<?php echo $name; ?>: <?php e('val'); ?>">
                                                            <span><?php e('val'); ?></span>
                                                        </label>
                                                    <?php endwhile; ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php endwhile; ?>

                                <?php endif; ?>

                            </div>
                            <div class="order-form__fill">
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

<?php endif; ?>

<!-- modal policy-->
<div class="modal modal-md" id="policy">
    <div class="modal-content">
        <span class="close_modal"><i class="zmdi zmdi-close"></i></span>
        <div class="modal-title">
            <div class="modal-title__main">
                <?php echo get_the_title($policy_page_id); ?>
            </div>
        </div>
        <div class="text-group">
           <?php echo apply_filters('the_content', get_post_field('post_content', $policy_page_id)); ?>
           <?php the_field('text', $policy_page_id); ?>
        </div>
    </div>
</div>

<div class="modal modal-md" id="gallery">
    <div class="modal-content">
        <span class="close_modal"><i class="zmdi zmdi-close"></i></span>
        <div class="modal-slider"></div>
        <div class="slider-nav-group">
            <div class="slider-nav__btn">
                <span class="prev-slide"><i class="zmdi zmdi-chevron-left"></i></span>
                <span class="next-slide"><i class="zmdi zmdi-chevron-right"></i></span>
            </div>
        </div>
    </div>
</div>

</body>

</html>