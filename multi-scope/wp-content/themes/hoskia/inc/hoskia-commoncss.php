<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
} 
/**
 * @Packge     : Hoskia
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 

// enqueue css
function hoskia_common_custom_css(){
    
    wp_enqueue_style( 'color-schemes', get_template_directory_uri().'/css/color-schemes.css' );
		
		// main color
        $mainColor     = hoskia_opt( 'hoskia_unlimited-color' );
        $secondary     = hoskia_opt( 'hoskia_unlimited-secondarycolor' );
				
		// page header media settings
		if( hoskia_meta( 'page_header_settings' ) != 'pageset' ){
			// Global Settings
			$pagehederbgcolor 	= '';
			$pagehedertextcolor = '';
			$pagehederovcolor = hoskia_opt( 'hoskia_allHeader_ovbg' );
			$pagehederovopct  = hoskia_opt( 'hoskia_allHeader_ovopacity' );
		}else{
			// Page Settings
			$pagehederbgcolor 	= hoskia_meta( 'header-bgcolor' );
			$pagehedertextcolor = hoskia_meta( 'header-textcolor' );
			$pagehederovcolor 	= hoskia_meta( 'header_overlaycolor' );
			$pagehederovopct  	= hoskia_meta( 'header_overlayopacity' );
		}
		// 404 page Options
		$fofovopct  = hoskia_opt( 'hoskia_fof_ovopacity' );

		$footeroverlay = hoskia_opt( 'hoskia_footer_widget_ovcolor' );
		$footerovopct  = hoskia_opt( 'hoskia_footer_widget_ovopct' );
		
        $customcss ="
			a:hover,
			a:focus,
			.btn-link:hover,
			.btn-link:focus,
			.bg-color--theme .btn-default:hover,
			.bg-color--theme .btn-default:focus,
			.bg-color--theme .btn-default:active,
			.bg-color--theme .btn-default:active:hover,
			.bg-color--theme .btn-default:active:focus,
			.bg-color--theme .btn-default:active.focus,
			.bg-color--theme .btn-default.focus,
			.bg-color--theme .btn-default.active,
			.bg-color--theme .btn-default.active:hover,
			.bg-color--theme .btn-default.active:focus,
			.bg-color--theme .btn-default.active.focus,
			.bg-color--theme .open > .dropdown-toggle.btn-default,
			.bg-color--theme .open > .dropdown-toggle.btn-default:hover,
			.bg-color--theme .open > .dropdown-toggle.btn-default:focus,
			.bg-color--theme .open > .dropdown-toggle.btn-default.focus,
			.panel-title a,
			.panel-title a.collapsed:hover,
			.panel-title a.collapsed:focus,
			.owl--dots .owl-nav,
			.tags--widget .nav li a:hover,
			.page--sidebar-nav .nav > li:hover > a,
			.page--sidebar-nav .nav > li.active > a,
			.header--logo.text-logo,
			.header--topbar .nav > li > a:hover,
			.header--topbar .nav > li > a:focus,
			.header--nav-links > li > a:hover,
			.header--nav-links > li > a:focus,
			.header--nav-links > li.active > a,
			.header--nav-links > li.active > a,
			.header--nav-links > li.open > a,
			.header--nav-links > li.dropdown > .dropdown-menu > li > a:hover,
			.header--nav-links > li.dropdown > .dropdown-menu > li > a:focus,
			.header--nav-links > li.dropdown > .dropdown-menu > li.active > a,
			.header--nav-links > li.dropdown.megamenu > .dropdown-menu > .nav > li > a:hover,
			.header--nav-links > li.dropdown.megamenu > .dropdown-menu > .nav > li > a:focus,
			.header--nav-links > li.dropdown.megamenu > .dropdown-menu > .nav > li.active > a,
			.banner--slider-nav li:hover .content .h3,
			.banner--slider-nav li.active .content .h3,
			.banner--offer-content .h2,
			.feature--icon .fa,
			.features-grid--item .step,
			.services-tab--nav ul li a:hover,
			.services-tab--nav ul li a:focus,
			.services-tab--nav ul li.active a,
			.team--member-socai .nav > li > a:hover,
			.team--member-socai .nav > li > a:focus,
			.gallery--content-sidebar .tags a:hover,
			.gallery--content-sidebar .tags a:focus,
			.gallery--content-sidebar .social li a:hover,
			.gallery--content-sidebar .social li a:focus,
			.product--rating,
			.product--rating .br-theme-bootstrap-stars .br-widget a.br-selected:after,
			.product--rating .br-theme-bootstrap-stars .br-widget a.br-active:after,
			.product--img figcaption .nav > li > a:hover,
			.product--single-summery-meta .table td a.active,
			.product--single-summery-meta .tags a:hover,
			.product--single-summery-meta .tags a:focus,
			.post--meta a:hover,
			.post--action .social > li > a:hover > .fa,
			.posts--cat .nav > li > a:hover,
			.posts--tags .nav > li > a:hover,
			.login--form .checkbox a:hover,
			.f0f--content p a,
			.coming-soon--content .social .nav > li > a:hover,
			.footer--widget > ul > li:hover > a,
			.footer--widget > ul > li:hover:before,
			.page-header--breadcrumb .breadcrumb li a:hover,
			.calendar_wrap table #today,
			.header--nav-links .dropdown-menu .dropdown-menu > li > a:hover,
			.product--img figcaption .add_to_cart_button:hover,
			.product--img figcaption .add_to_cart_button.added,
			.product--img .yith-wcwl-wishlistaddedbrowse a:before,
			.product--img .yith-wcwl-wishlistexistsbrowse a:before,
			.woocommerce-MyAccount-navigation ul li.is-active a,
			.product--img .nav > li > .button.compare.added,
			.navbar-main .navbar-nav .dropdown-menu > li > a:hover,
			.navbar-main .navbar-nav .dropdown-menu > li > a:focus,
			#hoskiaWhmcsPage #main-body a:not(.btn):not(.label):not(.list-group-item),
			.contact-info--icon,
			.contact-info--item:hover .h3,
			.counter-style--3 .icon,
			.post--content blockquote p:before,
			.post--content blockquote p:after,
			.wpb_text_column blockquote p:before,
			.wpb_text_column blockquote p:after,
			.footer--copyright p a:hover,
			.woocommerce .star-rating {
				color: {$mainColor};
			}
			.mega-menu-link:hover,
			.mega-current-menu-item > .mega-menu-link,
			.mega-current-menu-ancestor > .mega-menu-link,
			.mega-toggle-on > .mega-menu-link,
			.mega-sub-menu .mega-menu-link:hover,
			.mega-sub-menu .mega-current-menu-item > .mega-menu-link {
				color: {$mainColor} !important;
			}
			#preloader,
			#backToTop a:before,
			.btn-default:hover,
			.btn-default:focus,
			.btn-default:active,
			.btn-default:active:hover,
			.btn-default:active:focus,
			.btn-default:active.focus,
			.btn-default.focus,
			.btn-default.active,
			.btn-default.active:hover,
			.btn-default.active:focus,
			.btn-default.active.focus,
			.open > .dropdown-toggle.btn-default,
			.open > .dropdown-toggle.btn-default:hover,
			.open > .dropdown-toggle.btn-default:focus,
			.open > .dropdown-toggle.btn-default.focus,
			.btn-primary,
			.btn-black:hover,
			.btn-black:focus,
			.btn-black:active,
			.btn-black:active:hover,
			.btn-black:active:focus,
			.btn-black:active.focus,
			.btn-black.focus,
			.btn-black.active,
			.btn-black.active:hover,
			.btn-black.active:focus,
			.btn-black.active.focus,
			.open > .dropdown-toggle.btn-black,
			.open > .dropdown-toggle.btn-black:hover,
			.open > .dropdown-toggle.btn-black:focus,
			.open > .dropdown-toggle.btn-black.focus,
			.bg-color--theme,
			.nav-tabs > li > a:hover,
			.nav-tabs > li > a:focus,
			.nav-tabs > li.active > a,
			.nav-tabs > li.active > a:hover,
			.nav-tabs > li.active > a:focus,
			.pagination > li > a:hover,
			.pagination > li > a:focus,
			.pagination > li.active > a,
			.pagination > li.active > a:hover,
			.pagination > li.active > a:hover,
			.pagination > li > span:hover,
			.pagination > li > span:focus,
			.pagination > li.active > span,
			.pagination > li.active > span:hover,
			.pagination > li.active > span:hover,
			.header--navbar .navbar-toggle,
			.header--nav-links > li > a:before,
			.banner--slider .owl-nav > div,
			.banner--slider-nav li .icon:before,
			.banner--slider-nav li .icon .fa:after,
			.pricing--header,
			.pricing--icon:before,
			.pricing--icon i,
			.pricing--icon i:after,
			.vps-pricing--slider.ui-widget:after,
			.vps-pricing--slider .ui-slider-range,
			.vps-pricing--slider .ui-slider-handle,
			.service--icon:before,
			.services-tab--nav ul li .tooltip-inner,
			.services-tab--nav ul li a:hover:before,
			.services-tab--nav ul li a:focus:before,
			.services-tab--nav ul li.active a:before,
			.product--sale-tag,
			.product--single-img a.expend:after,
			.product--img figcaption .nav > li .tooltip-inner,
			.product--single-summery-meta .btn-group .btn.cart .fa,
			.product--single-summery-meta .btn-group .btn-default:hover,
			.product--single-summery-meta .btn-group .btn-default:focus,
			.product--single-summery-meta .btn-group .btn-default.active,
			.product--single-summery-meta .yith-wcwl-wishlistaddedbrowse a:before,
			.product--single-summery-meta .yith-wcwl-wishlistexistsbrowse a:before,
			.page-links > a:hover,
			.page-links > span + span,
			.post-password-form input[type='submit']:hover,
			.mega-menu-link:before,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			nav.woocommerce-pagination ul.page-numbers > li > a:hover,
			nav.woocommerce-pagination ul.page-numbers > li > a:focus,
			nav.woocommerce-pagination ul.page-numbers > li > span.current,
			.woocommerce-product-search [type='submit']:hover,
			.product--single-summery-meta .tooltip-inner,
			.yith-wcqv-main .summary-content > .cart .btn.cart .fa,
			.woocommerce #respond input#submit.disabled:hover,
			.woocommerce #respond input#submit:disabled:hover,
			.woocommerce #respond input#submit:disabled[disabled]:hover,
			.woocommerce a.button.disabled:hover,
			.woocommerce a.button:disabled:hover,
			.woocommerce a.button:disabled[disabled]:hover,
			.woocommerce button.button.disabled:hover,
			.woocommerce button.button:disabled:hover,
			.woocommerce button.button:disabled[disabled]:hover,
			.woocommerce input.button.disabled:hover,
			.woocommerce input.button:disabled:hover,
			.woocommerce input.button:disabled[disabled]:hover,
			.product--single-summery-meta .btn-group .btn.compare.added,
			.yith-wcqv-main .summary-content > .cart .btn.compare.added,
			.yith-wcqv-main .summary-content > .cart .yith-wcwl-wishlistaddedbrowse a,
			.yith-wcqv-main .summary-content > .cart .yith-wcwl-wishlistexistsbrowse a,
			#hoskiaWhmcsPage .btn-success,
			#hoskiaWhmcsPage .btn-primary,
			ul.top-nav > li.primary-action > a.btn,
			#hoskiaWhmcsPage nav.navbar-main,
			#hoskiaWhmcsPage #home-banner .btn.search,
			#hoskiaWhmcsPage div.home-shortcuts,
			.contact-info--item,
			.contact-info--item:hover .contact-info--icon:before,
			.counter--item-border:after,
			.pricing--filter ul li.indicator,
			.page--sidebar-widget .tagcloud a:hover,
			.social--widget .nav > li > a:hover,
			.pricing--table th:before {
				background-color: {$mainColor};
			}
			::-moz-selection {
				background-color: {$mainColor};
			}

			::selection {
				background-color: {$mainColor};
			}
			.btn-default:hover,
			.btn-default:focus,
			.btn-default:active,
			.btn-default:active:hover,
			.btn-default:active:focus,
			.btn-default:active.focus,
			.btn-default.focus,
			.btn-default.active,
			.btn-default.active:hover,
			.btn-default.active:focus,
			.btn-default.active.focus,
			.open > .dropdown-toggle.btn-default,
			.open > .dropdown-toggle.btn-default:hover,
			.open > .dropdown-toggle.btn-default:focus,
			.open > .dropdown-toggle.btn-default.focus,
			.btn-primary,
			.btn-black:hover,
			.btn-black:focus,
			.btn-black:active,
			.btn-black:active:hover,
			.btn-black:active:focus,
			.btn-black:active.focus,
			.btn-black.focus,
			.btn-black.active,
			.btn-black.active:hover,
			.btn-black.active:focus,
			.btn-black.active.focus,
			.open > .dropdown-toggle.btn-black,
			.open > .dropdown-toggle.btn-black:hover,
			.open > .dropdown-toggle.btn-black:focus,
			.open > .dropdown-toggle.btn-black.focus,
			.nav-tabs > li > a:hover,
			.nav-tabs > li > a:focus,
			.nav-tabs > li.active > a,
			.nav-tabs > li.active > a:hover,
			.nav-tabs > li.active > a:focus,
			.tags--widget .nav li a:hover,
			.header--navbar .navbar-toggle,
			.header--nav-links > li.dropdown.megamenu > .dropdown-menu > .nav > li > a:hover,
			.header--nav-links > li.dropdown.megamenu > .dropdown-menu > .nav > li > a:focus,
			.header--nav-links > li.dropdown.megamenu > .dropdown-menu > .nav > li.active > a,
			.banner--slider-nav li:hover .icon .fa,
			.banner--slider-nav li.active .icon .fa,
			.gallery--content-sidebar .tags a:hover,
			.gallery--content-sidebar .tags a:focus,
			.posts--tags .nav > li > a:hover,
			.posts--tags .nav > li > a:focus,
			.login--form .checkbox a:hover,
			.page-links > a:hover,
			.page-links > span + span,
			nav.woocommerce-pagination ul.page-numbers > li > a:hover,
			nav.woocommerce-pagination ul.page-numbers > li > a:focus,
			nav.woocommerce-pagination ul.page-numbers > li > span.current,
			.feature--icon img,
			#hoskiaWhmcsPage .btn-success,
			#hoskiaWhmcsPage .btn-primary,
			.pricing--filter ul,
			.post--item.sticky {
				border-color: {$mainColor};
			}

			.mega-sub-menu .mega-sub-menu .mega-current-menu-item > .mega-menu-link,
			.mega-sub-menu .mega-sub-menu .mega-menu-link:hover {
				border-color: {$mainColor} !important;
			}

			.services-tab--nav ul li:after,
			.services-tab--nav ul li .tooltip.top .tooltip-arrow,
			.product--img figcaption .nav > li .tooltip.top .tooltip-arrow,
			.product--single-summery-meta .tooltip.top .tooltip-arrow {
				border-top-color: {$mainColor};
			}

			.checkout--info,
			.page--sidebar-nav .nav > li:hover > a,
			.page--sidebar-nav .nav > li.active > a {
				border-left-color: {$mainColor};
			}
			.product--single-summery-meta .tags a:hover,
			.product--single-summery-meta .tags a:focus {
				border-bottom-color: {$mainColor};
			}
			.btn-secondary,
			.pricing--header > span:first-child,
			.pricing--ribbon,
			.testimonial--item blockquote p:before,
			.testimonial--item blockquote p:after,
			.owl--dots .owl-nav .fa:hover,
			.post--content blockquote footer:before,
			.wpb_text_column blockquote footer:before,
			.hoskia-textblock blockquote footer:before,
			.pager li > a,
			.pager li > span,
			.post-author--action,
			.post-author--action:hover,
			.comment-respond .logged-in-as a:last-child {
				color: {$secondary};
			}
			.btn-secondary:hover,
			.btn-secondary:focus,
			.btn-secondary:active,
			.btn-secondary:active:hover,
			.btn-secondary:active:focus,
			.btn-secondary:active.focus,
			.btn-secondary.focus,
			.btn-secondary.active,
			.btn-secondary.active:hover,
			.btn-secondary.active:focus,
			.btn-secondary.active.focus,
			.open > .dropdown-toggle.btn-secondary,
			.open > .dropdown-toggle.btn-secondary:hover,
			.open > .dropdown-toggle.btn-secondary:focus,
			.open > .dropdown-toggle.btn-secondary.focus,
			.section--title h2:before,
			.header--nav-links.cart > li > a > span,
			.banner--content .h1:before,
			.banner--slider .owl-nav > div:hover,
			.domain-search--form .input-group-addon,
			.pricing--content:hover .pricing--header,
			.pricing--content.active .pricing--header,
			.pricing--content:hover .pricing--icon:before,
			.pricing--content.active .pricing--icon:before,
			.pricing--content:hover .pricing--icon i,
			.pricing--content.active .pricing--icon i,
			.pricing--content:hover .pricing--icon i:after,
			.pricing--content.active .pricing--icon i:after,
			.features-grid--item-wrap:hover,
			.features-grid--item-wrap.active,
			.contact-info--item:hover .contact-info--icon {
				background-color: {$secondary};
			}
			.btn-secondary,
			.page-header--title .h1:before,
			.header--nav-links.client-area > li > a,
			.quotes-form--content,
			.quotes-form--content .h3:before,
			.feature--icon .fa {
				border-color: {$secondary};
			}
			#f0f.bg--overlay:before {
				opacity: {$fofovopct}
			}
			#pageHeader.globpageheader.bg--overlay:before {
				background-color: {$pagehederovcolor};
				opacity: {$pagehederovopct};
			}
        ";
       
    wp_add_inline_style( 'color-schemes', $customcss );
    
}
add_action( 'wp_enqueue_scripts', 'hoskia_common_custom_css', 50 );