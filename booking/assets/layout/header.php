<?php include 'class/CONFIG.php';



// // Forza il browser a non usare la cache
// header("Cache-Control: no-cache, no-store, must-revalidate");
// header("Pragma: no-cache");
// header("Expires: 0");

// Aggiunge un parametro di versione alle risorse statiche
$version = time(); // Usa il timestamp per cambiare versione ogni volta

?>

<!doctype html>
<html lang="it" data-bs-theme="auto">

<head>
    <!-- Meta e informazioni generali -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Prenotazioni - Bibione Residence Apartments</title>

    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <link rel='stylesheet' id='hello-elementor-theme-style-css' href='https://<?php echo $domain; ?>/wp-content/themes/hello-elementor/theme.min.css?ver=3.2.1' media='all' />
    <link rel='stylesheet' id='chld_thm_cfg_child-css' href='https://<?php echo $domain; ?>/wp-content/themes/hello-elementor-child/style.css?ver=2.4.1.1636533896' media='all' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel='stylesheet' id='hello-elementor-header-footer-css' href='https://<?php echo $domain; ?>/wp-content/themes/hello-elementor/header-footer.min.css?ver=3.2.1' media='all' />
    <link rel='stylesheet' id='elementor-frontend-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='elementor-post-126-css' href='https://<?php echo $domain; ?>/wp-content/uploads/elementor/css/post-126.css?ver=1736418476' media='all' />
    <link rel='stylesheet' id='widget-image-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-image.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='e-animation-fadeIn-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/animations/styles/fadeIn.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='widget-nav-menu-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor-pro/assets/css/widget-nav-menu.min.css?ver=3.26.3' media='all' />
    <link rel='stylesheet' id='widget-text-editor-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-text-editor.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='e-animation-float-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/animations/styles/e-animation-float.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='widget-social-icons-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-social-icons.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='e-apple-webkit-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/conditionals/apple-webkit.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='widget-heading-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-heading.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='widget-icon-list-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='elementor-icons-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.34.0' media='all' />
    <link rel='stylesheet' id='e-animation-fadeInUp-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/animations/styles/fadeInUp.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='widget-spacer-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-spacer.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='swiper-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css?ver=8.4.5' media='all' />
    <link rel='stylesheet' id='e-swiper-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/conditionals/e-swiper.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='widget-image-carousel-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-image-carousel.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='widget-google_maps-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/css/widget-google_maps.min.css?ver=3.26.4' media='all' />
    <link rel='stylesheet' id='elementor-post-207-css' href='https://<?php echo $domain; ?>/wp-content/uploads/elementor/css/post-207.css?ver=1736418475' media='all' />
    <link rel='stylesheet' id='elementor-post-252-css' href='https://<?php echo $domain; ?>/wp-content/uploads/elementor/css/post-252.css?ver=1736418476' media='all' />
    <link rel='stylesheet' id='elementor-post-256-css' href='https://<?php echo $domain; ?>/wp-content/uploads/elementor/css/post-256.css?ver=1738141021' media='all' />
    <link rel='stylesheet' id='eael-general-css' href='https://<?php echo $domain; ?>/wp-content/plugins/essential-addons-for-elementor-lite/assets/front-end/css/view/general.min.css?ver=6.1.0' media='all' />
    <link rel='stylesheet' id='elementor-icons-shared-0-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css?ver=5.15.3' media='all' />
    <link rel='stylesheet' id='elementor-icons-fa-solid-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css?ver=5.15.3' media='all' />
    <link rel='stylesheet' id='elementor-icons-fa-brands-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css?ver=5.15.3' media='all' />
    <link rel='stylesheet' id='elementor-icons-fa-regular-css' href='https://<?php echo $domain; ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min.css?ver=5.15.3' media='all' />
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
                                <a href="https://<?php echo $domain; ?>">
                                    <img width="344" height="58" src="https://<?php echo $domain; ?>/wp-content/uploads/2024/01/BRA_logo-2022.png" class="attachment-large size-large wp-image-13" alt="Bibione Residence Apartments Logo" srcset="https://<?php echo $domain; ?>/wp-content/uploads/2024/01/BRA_logo-2022.png 344w, https://<?php echo $domain; ?>/wp-content/uploads/2024/01/BRA_logo-2022-300x51.png 300w" sizes="(max-width: 344px) 100vw, 344px"> </a>
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

                                            <div class="elementor-widget-container" bis_skin_checked="1">
                                                <nav aria-label="Menu" class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-underline e--animation-fade">
                                                    <ul id="menu-1-52cb09b" class="elementor-nav-menu" data-smartmenus-id="17383999207561785">
                                                        <li class="lang-item lang-item-15 lang-item-it current-lang lang-item-first menu-item menu-item-type-custom menu-item-object-custom current_page_item menu-item-home menu-item-2589-it"><a href="https://<?= $subdomain ?>/" hreflang="it-IT" lang="it-IT" class="elementor-item"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAUVBMVEUAiQAAgADk5OTe3t7vAAB3yXf9/f36+vr5Vlb3RkZjwWNYvVj4+Pj1MzP1KChQuFD1GxviAABHtUf19fXzDw4/sT8AcAA2qzYAWgDLy8vDw8ObXclsAAAAVElEQVR4AQXBSwoCQRQEsNT70CC69P5XdCUMA2ISSAiBWAQScg8bN7GJWxFDrCivwhCLMipGx3LKUOi2HAZluy2HgXprxQGfGL6G63B5MJ5FCD/4A3DaCLvbBle5AAAAAElFTkSuQmCC" alt="Italiano" width="16" height="11" style="width: 16px; height: 11px;"></a></li>
                                                        <li class="lang-item lang-item-8 lang-item-en menu-item menu-item-type-custom menu-item-object-custom menu-item-2589-en"><a href="https://<?= $subdomain ?>/index-en.php" hreflang="en-GB" lang="en-GB" class="elementor-item"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAt1BMVEWSmb66z+18msdig8La3u+tYX9IaLc7W7BagbmcUW+kqMr/q6n+//+hsNv/lIr/jIGMnNLJyOP9/fyQttT/wb3/////aWn+YWF5kNT0oqz0i4ueqtIZNJjhvt/8gn//WVr/6+rN1+o9RKZwgcMPJpX/VFT9UEn+RUX8Ozv2Ly+FGzdYZrfU1e/8LS/lQkG/mbVUX60AE231hHtcdMb0mp3qYFTFwNu3w9prcqSURGNDaaIUMX5FNW5wYt7AAAAAjklEQVR4AR3HNUJEMQCGwf+L8RR36ajR+1+CEuvRdd8kK9MNAiRQNgJmVDAt1yM6kSzYVJUsPNssAk5N7ZFKjVNFAY4co6TAOI+kyQm+LFUEBEKKzuWUNB7rSH/rSnvOulOGk+QlXTBqMIrfYX4tSe2nP3iRa/KNK7uTmWJ5a9+erZ3d+18od4ytiZdvZyuKWy8o3UpTVAAAAABJRU5ErkJggg==" alt="English" width="16" height="11" style="width: 16px; height: 11px;"></a></li>
                                                        <li class="lang-item lang-item-11 lang-item-de menu-item menu-item-type-custom menu-item-object-custom menu-item-2589-de"><a href="https://<?= $subdomain ?>/index-de.php" hreflang="de-DE" lang="de-DE" class="elementor-item"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAIAAAD5gJpuAAABLElEQVR4AY2QgUZEQRSGz9ydmzbYkBWABBJYABHEFhJ6m0WP0DMEQNIr9AKrN8ne2Tt3Zs7MOdOZmRBEv+v34Tvub9R6fdNlAzU+snSME/wdjbjbbJ6EiEg6BA8102QbjKNpoMzw8v6qD/sOALbbT2MC1NgaAWOKOgxf5czY+4dbAX2G/THzcozLrvPV85IQyqVz0rvg2p9Pei4HjzSsiFbV4JgyhhxCjpGdZ0RhdikLB9/b8Qig7MkpSovR7Cp59q6CazaNFiTt4J82o6uvdMVwTsztKTXZod4jgOJJuqNAjFyGrBR8gM6XwKfIC4KanBSTZ0rClKh08D9DFh3egW7ebH7NcRDQWrz9rM2Ne+mDOXB2mZJ8agL19nwxR2iZXGm1gDbQKhDjd4yHb2oW/KR8xHicAAAAAElFTkSuQmCC" alt="Deutsch" width="16" height="11" style="width: 16px; height: 11px;"></a></li>
                                                    </ul>
                                                </nav>

                                            </div>


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