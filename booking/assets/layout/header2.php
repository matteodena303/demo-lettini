<?php
include 'class/CONFIG.php';
?>
<!doctype html>
<html lang="it" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Prenotazioni - Bibione Residence Apartments</title>

    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <link rel="stylesheet" id="hello-elementor-theme-style-css" href="https://<?= $domain ?>/wp-content/themes/hello-elementor/theme.min.css?ver=3.2.1" media="all" />
    <link rel="stylesheet" id="chld_thm_cfg_child-css" href="https://<?= $domain ?>/wp-content/themes/hello-elementor-child/style.css?ver=2.4.1.1636533896" media="all" />
    <link rel="stylesheet" id="elementor-frontend-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="elementor-post-126-css" href="https://<?= $domain ?>/wp-content/uploads/elementor/css/post-126.css?ver=1736418476" media="all" />
    <link rel="stylesheet" id="widget-image-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-image.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="e-animation-fadeIn-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/animations/styles/fadeIn.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="widget-nav-menu-css" href="https://<?= $domain ?>/wp-content/plugins/elementor-pro/assets/css/widget-nav-menu.min.css?ver=3.26.3" media="all" />
    <link rel="stylesheet" id="widget-text-editor-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-text-editor.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="e-animation-float-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/animations/styles/e-animation-float.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="widget-social-icons-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-social-icons.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="e-apple-webkit-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/conditionals/apple-webkit.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="widget-heading-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-heading.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="widget-icon-list-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="elementor-icons-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.34.0" media="all" />
    <link rel="stylesheet" id="e-animation-fadeInUp-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/animations/styles/fadeInUp.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="widget-spacer-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-spacer.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="swiper-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css?ver=8.4.5" media="all" />
    <link rel="stylesheet" id="e-swiper-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/conditionals/e-swiper.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="widget-image-carousel-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-image-carousel.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="widget-google_maps-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/css/widget-google_maps.min.css?ver=3.26.4" media="all" />
    <link rel="stylesheet" id="elementor-post-207-css" href="https://<?= $domain ?>/wp-content/uploads/elementor/css/post-207.css?ver=1736418475" media="all" />
    <link rel="stylesheet" id="elementor-post-252-css" href="https://<?= $domain ?>/wp-content/uploads/elementor/css/post-252.css?ver=1736418476" media="all" />
    <link rel="stylesheet" id="elementor-post-256-css" href="https://<?= $domain ?>/wp-content/uploads/elementor/css/post-256.css?ver=1738141021" media="all" />
    <link rel="stylesheet" id="eael-general-css" href="https://<?= $domain ?>/wp-content/plugins/essential-addons-for-elementor-lite/assets/front-end/css/view/general.min.css?ver=6.1.0" media="all" />
    <link rel="stylesheet" id="elementor-icons-shared-0-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.3" media="all" />
    <link rel="stylesheet" id="elementor-icons-fa-solid-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.3" media="all" />
    <link rel="stylesheet" id="elementor-icons-fa-brands-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css?ver=5.15.3" media="all" />
    <link rel="stylesheet" id="elementor-icons-fa-regular-css" href="https://<?= $domain ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min.css?ver=5.15.3" media="all" />
</head>

<style>
    @media (max-width: 1024px) {
        .elementor-nav-menu--dropdown-tablet .elementor-nav-menu--main {
            display: inline !important;
        }

        .elementor-nav-menu--main .elementor-nav-menu a,
        .elementor-nav-menu--main .elementor-nav-menu a.highlighted,
        .elementor-nav-menu--main .elementor-nav-menu a:focus,
        .elementor-nav-menu--main .elementor-nav-menu a:hover {
            padding: 2px 8px !important;
        }
    }
</style>




<header class="p-3 mb-3 border-bottom" style="padding: 0 !important;">
    <!-- <div class="container"> -->


    <div data-elementor-type="header" data-elementor-id="252" class="elementor elementor-252 elementor-location-header" data-elementor-post-type="elementor_library" bis_skin_checked="1">
        <section class="elementor-section elementor-top-section elementor-element elementor-element-244fe2b6 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="244fe2b6" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default" bis_skin_checked="1">
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-387baa98 animated fadeIn" data-id="387baa98" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:200}" bis_skin_checked="1">
                    <div class="elementor-widget-wrap elementor-element-populated" bis_skin_checked="1">
                        <div class="elementor-element elementor-element-6c158a1d elementor-widget elementor-widget-image" data-id="6c158a1d" data-element_type="widget" data-widget_type="image.default" bis_skin_checked="1">
                            <div class="elementor-widget-container" bis_skin_checked="1">
                                <a href="https://<?= $backend ?>">
                                    <img width="344" height="58" src="https://<?= $domain ?>/wp-content/uploads/2024/01/BRA_logo-2022.png" class="attachment-large size-large wp-image-13" alt="Bibione Residence Apartments Logo" srcset="https://<?= $domain ?>/wp-content/uploads/2024/01/BRA_logo-2022.png 344w, https://<?= $domain ?>/wp-content/uploads/2024/01/BRA_logo-2022-300x51.png 300w" sizes="(max-width: 344px) 100vw, 344px"> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-4a4915c1" data-id="4a4915c1" data-element_type="column" bis_skin_checked="1">
                    <div class="elementor-widget-wrap elementor-element-populated" bis_skin_checked="1">
                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-264b0987 elementor-section-full_width elementor-reverse-tablet elementor-reverse-mobile elementor-section-height-default elementor-section-height-default" data-id="264b0987" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default" bis_skin_checked="1">
                                <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-5875ae85" data-id="5875ae85" data-element_type="column" bis_skin_checked="1">
                                    <div class="elementor-widget-wrap elementor-element-populated" bis_skin_checked="1">
                                        <div class="elementor-element elementor-element-52cb09b elementor-nav-menu__align-end elementor-nav-menu--stretch elementor-nav-menu__text-align-center elementor-nav-menu--dropdown-tablet elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu" data-id="52cb09b" data-element_type="widget" data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;submenu_icon&quot;:{&quot;value&quot;:&quot;<i class=\&quot;fas fa-caret-down\&quot;><\/i>&quot;,&quot;library&quot;:&quot;fa-solid&quot;},&quot;toggle&quot;:&quot;burger&quot;}" data-widget_type="nav-menu.default" bis_skin_checked="1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>








    <!-- </div> -->
</header>