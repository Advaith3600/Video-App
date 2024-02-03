<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="https://devmarketer.io/xmlrpc.php" />
    <title>Ultimate Guide: Deploy Laravel 5.3 App on LEMP Stack (Ubuntu 16 and Nginx) - DevMarketer</title>
    <script>
        /* You can add more configuration options to webfontloader by previously defining the WebFontConfig with your options */
                            if ( typeof WebFontConfig === "undefined" ) {
                                WebFontConfig = new Object();
                            }
                            WebFontConfig['google'] = {families: ['Open+Sans:300,400,600,700,800,300italic,400italic,600italic,700italic,800italic', 'PT+Serif:400,700,400italic,700italic']};

                            (function() {
                                var wf = document.createElement( 'script' );
                                wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.3/webfont.js';
                                wf.type = 'text/javascript';
                                wf.async = 'true';
                                var s = document.getElementsByTagName( 'script' )[0];
                                s.parentNode.insertBefore( wf, s );
                            })();
    </script>
    <link rel='dns-prefetch' href='//maxcdn.bootstrapcdn.com' />
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel="alternate" type="application/rss+xml" title="DevMarketer &raquo; Feed"
        href="https://devmarketer.io/feed/" />
    <link rel="alternate" type="application/rss+xml" title="DevMarketer &raquo; Comments Feed"
        href="https://devmarketer.io/comments/feed/" />
    <link rel="alternate" type="application/rss+xml"
        title="DevMarketer &raquo; Ultimate Guide: Deploy Laravel 5.3 App on LEMP Stack (Ubuntu 16 and Nginx) Comments Feed"
        href="https://devmarketer.io/learn/deploy-laravel-5-app-lemp-stack-ubuntu-nginx/feed/" />
    <!-- This site uses the Google Analytics by MonsterInsights plugin v7.10.0 - Using Analytics tracking - https://www.monsterinsights.com/ -->
    <script type="text/javascript" data-cfasync="false">
        var mi_version         = '7.10.0';
	var mi_track_user      = true;
	var mi_no_track_reason = '';
	
	var disableStr = 'ga-disable-UA-81639323-1';

	/* Function to detect opted out users */
	function __gaTrackerIsOptedOut() {
		return document.cookie.indexOf(disableStr + '=true') > -1;
	}

	/* Disable tracking if the opt-out cookie exists. */
	if ( __gaTrackerIsOptedOut() ) {
		window[disableStr] = true;
	}

	/* Opt-out function */
	function __gaTrackerOptout() {
	  document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
	  window[disableStr] = true;
	}
	
	if ( mi_track_user ) {
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

		__gaTracker('create', 'UA-81639323-1', 'auto');
		__gaTracker('set', 'forceSSL', true);
		__gaTracker('require', 'displayfeatures');
		__gaTracker('send','pageview');
	} else {
		console.log( "" );
		(function() {
			/* https://developers.google.com/analytics/devguides/collection/analyticsjs/ */
			var noopfn = function() {
				return null;
			};
			var noopnullfn = function() {
				return null;
			};
			var Tracker = function() {
				return null;
			};
			var p = Tracker.prototype;
			p.get = noopfn;
			p.set = noopfn;
			p.send = noopfn;
			var __gaTracker = function() {
				var len = arguments.length;
				if ( len === 0 ) {
					return;
				}
				var f = arguments[len-1];
				if ( typeof f !== 'object' || f === null || typeof f.hitCallback !== 'function' ) {
					console.log( 'Not running function __gaTracker(' + arguments[0] + " ....) because you are not being tracked. " + mi_no_track_reason );
					return;
				}
				try {
					f.hitCallback();
				} catch (ex) {

				}
			};
			__gaTracker.create = function() {
				return new Tracker();
			};
			__gaTracker.getByName = noopnullfn;
			__gaTracker.getAll = function() {
				return [];
			};
			__gaTracker.remove = noopfn;
			window['__gaTracker'] = __gaTracker;
					})();
		}
    </script>
    <!-- / Google Analytics by MonsterInsights -->
    <script type="text/javascript">
        window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/devmarketer.io\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.9.18"}};
			!function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])?!1:!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([55358,56760,9792,65039],[55358,56760,8203,9792,65039])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
    </script>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' id='wp-block-library-css'
        href='https://devmarketer.io/wp-content/plugins/gutenberg/build/block-library/style.css?ver=1541282404'
        type='text/css' media='all' />
    <link rel='stylesheet' id='jac-shortcodes-styles-css'
        href='https://devmarketer.io/wp-content/plugins/jac-shortcodes/css/jac-shortcode-styles.css?ver=20151207'
        type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css'
        href='//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css?ver=4.5.0' type='text/css'
        media='all' />
    <link rel='stylesheet' id='md-bone-vendor-style-css'
        href='https://devmarketer.io/wp-content/themes/bone/css/vendor.css?ver=2.0.0' type='text/css' media='all' />
    <link rel='stylesheet' id='md-bone-style-css'
        href='https://devmarketer.io/wp-content/themes/bone/style.css?ver=2.0.0' type='text/css' media='all' />
    <link rel='stylesheet' id='prism-theme-css'
        href='https://devmarketer.io/wp-content/plugins/ank-prism-for-wp/out/prism-css.min.css?ver=1517873422'
        type='text/css' media='all' />
    <script type='text/javascript'>
        /* <![CDATA[ */
var monsterinsights_frontend = {"js_events_tracking":"true","download_extensions":"doc,pdf,ppt,zip,xls,docx,pptx,xlsx","inbound_paths":"[]","home_url":"https:\/\/devmarketer.io","hash_tracking":"false"};
/* ]]> */
    </script>
    <script type='text/javascript'
        src='https://devmarketer.io/wp-content/plugins/google-analytics-for-wordpress/assets/js/frontend.min.js?ver=7.10.0'>
    </script>
    <script type='text/javascript' src='https://devmarketer.io/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
    <script type='text/javascript' src='https://devmarketer.io/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'>
    </script>
    <link rel='https://api.w.org/' href='https://devmarketer.io/wp-json/' />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://devmarketer.io/xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml"
        href="https://devmarketer.io/wp-includes/wlwmanifest.xml" />
    <meta name="generator" content="WordPress 4.9.18" />
    <link rel='shortlink' href='https://devmarketer.io/?p=546' />
    <link rel="alternate" type="application/json+oembed"
        href="https://devmarketer.io/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fdevmarketer.io%2Flearn%2Fdeploy-laravel-5-app-lemp-stack-ubuntu-nginx%2F" />
    <link rel="alternate" type="text/xml+oembed"
        href="https://devmarketer.io/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fdevmarketer.io%2Flearn%2Fdeploy-laravel-5-app-lemp-stack-ubuntu-nginx%2F&#038;format=xml" />
    <style type="text/css">
        .recentcomments a {
            display: inline !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
    <style type="text/css" title="dynamic-css" class="options-output">
        .siteTitle--default {
            padding-top: 0;
            padding-right: 0;
            padding-bottom: 0;
            padding-left: 0;
        }

        .siteTitle--small {
            padding-top: 0;
            padding-right: 0;
            padding-bottom: 0;
            padding-left: 0;
        }

        .primaryBgColor,
        input[type="submit"],
        .postCategory,
        .progressContainer-bar,
        .reviewMeter-item-score,
        .reviewBox-summary-totalScore-wrap,
        .postTitle .featuredBadge,
        .btn.btn--solid,
        .postFormatLink .o-backgroundImg,
        .featuredBlock--slider article.noThumb,
        .post--review-meter-bar,
        .post--review-score,
        .post--tile.noThumb,
        .commentCountBox,
        .byCategoryListing-title i,
        .categoryTile .o-backgroundImg,
        .mdPostsListWidget .list-index,
        .widget_archive li:hover:after,
        .widget_calendar caption,
        .widget_calendar #today,
        .block-title span:after,
        .widget_mc4wp_form_widget input[type="submit"],
        .md-pagination .page-numbers.current,
        .offCanvasClose,
        .siteFooter-top-wrap,
        .woocommerce span.onsale,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce #respond input#submit.alt:hover,
        .woocommerce a.button.alt:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce input.button.alt:hover,
        .woocommerce #respond input#submit:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button:hover,
        .woocommerce input.button:hover,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt:disabled[disabled],
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt:disabled[disabled],
        .woocommerce a.button.alt:disabled[disabled]:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt:disabled[disabled],
        .woocommerce button.button.alt:disabled[disabled]:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt:disabled[disabled],
        .woocommerce input.button.alt:disabled[disabled]:hover,
        .headerCart .cart-contents .count,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
            background-color: #00a79d;
        }

        .primaryColor,
        .primaryColor:hover,
        .primaryColor:focus,
        .primaryColor:active,
        .authorName,
        .authorName a,
        .articleMeta-author a,
        .siteLogo-name,
        .articleTags-list>a:hover,
        .articleVia-list>a:hover,
        .articleSource-list>a:hover,
        .comment-author:hover,
        .bodyCopy a:hover,
        .post--card--bg.noThumb .postInfo .postMeta--author-author a,
        .loginFormWrapper .modal-close i,
        .navigation--offCanvas li>a:hover,
        .navigation--offCanvas li.current-menu-item>a,
        .postTitle .postFormatBadge,
        .widget_pages ul.children>li:before,
        .widget_categories ul.children>li:before,
        .widget_nav_menu .submenu-toggle,
        .widget_calendar td a,
        .tagcloud a:hover,
        .postTags-list>a:hover,
        .postVia-list>a:hover,
        .postSource-list>a:hover,
        .widget_recent_comments .comment-author-link,
        .widget_recent_comments .comment-author-link a,
        .tabs-nav li.active a,
        .widget_pages li>a:before,
        .postFormatBadge,
        .comment-author,
        .postMeta--author-author a,
        .postFormatQuote:before,
        .logged-in-as a:first-child,
        .menu--offCanvas li.current-menu-item>a,
        .siteFooter-copyright a,
        .woocommerce .star-rating,
        .woocommerce div.product p.price,
        .woocommerce div.product span.price {
            color: #00a79d;
        }

        .titleFont,
        .postTitle,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .widget_recent_comments .comment-author-link,
        .widget_recent_comments li>a,
        .widget_recent_entries a,
        .widget_rss a.rsswidget,
        .widget_rss .rss-date {
            font-family: "Open Sans", Arial, Helvetica, sans-serif;
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading .titleFont,
        .wf-loading .postTitle,
        .wf-loading h1,
        .wf-loading h2,
        .wf-loading h3,
        .wf-loading h4,
        .wf-loading h5,
        .wf-loading h6,
        .wf-loading .widget_recent_comments .comment-author-link,
        .wf-loading .widget_recent_comments li>a,
        .wf-loading .widget_recent_entries a,
        .wf-loading .widget_rss a.rsswidget,
        .wf-loading .widget_rss .rss-date {
            opacity: 0;
        }

        .ie.wf-loading .titleFont,
        .ie.wf-loading .postTitle,
        .ie.wf-loading h1,
        .ie.wf-loading h2,
        .ie.wf-loading h3,
        .ie.wf-loading h4,
        .ie.wf-loading h5,
        .ie.wf-loading h6,
        .ie.wf-loading .widget_recent_comments .comment-author-link,
        .ie.wf-loading .widget_recent_comments li>a,
        .ie.wf-loading .widget_recent_entries a,
        .ie.wf-loading .widget_rss a.rsswidget,
        .ie.wf-loading .widget_rss .rss-date {
            visibility: hidden;
        }

        body,
        .bodyCopy {
            font-family: "PT Serif", Georgia, serif;
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading body,
        .wf-loading .bodyCopy {
            opacity: 0;
        }

        .ie.wf-loading body,
        .ie.wf-loading .bodyCopy {
            visibility: hidden;
        }

        label,
        input[type=submit],
        .metaText,
        .metaFont,
        .metaBtn,
        .postMeta,
        .postCategory,
        .blockHeading,
        .comment-reply-title,
        .wp-caption,
        .gallery-caption,
        .widget-title,
        .btn,
        .navigation,
        .logged-in-as,
        .widget_calendar table,
        .tagcloud a,
        .widget_nav_menu .menu,
        .widget_categories li,
        .widget_meta li>a,
        .widget_pages li,
        .widget_archive a,
        .comment-reply-title small,
        .woocommerce div.product .woocommerce-tabs .panel h2,
        .woocommerce h2,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce .page-title,
        .woocommerce nav.woocommerce-pagination ul li a,
        .woocommerce nav.woocommerce-pagination ul li span,
        .woocommerce div.product form.cart .reset_variations {
            font-family: "Open Sans", Arial, Helvetica, sans-serif;
            opacity: 1;
            visibility: visible;
            -webkit-transition: opacity 0.24s ease-in-out;
            -moz-transition: opacity 0.24s ease-in-out;
            transition: opacity 0.24s ease-in-out;
        }

        .wf-loading label,
        .wf-loading input[type=submit],
        .wf-loading .metaText,
        .wf-loading .metaFont,
        .wf-loading .metaBtn,
        .wf-loading .postMeta,
        .wf-loading .postCategory,
        .wf-loading .blockHeading,
        .wf-loading .comment-reply-title,
        .wf-loading .wp-caption,
        .wf-loading .gallery-caption,
        .wf-loading .widget-title,
        .wf-loading .btn,
        .wf-loading .navigation,
        .wf-loading .logged-in-as,
        .wf-loading .widget_calendar table,
        .wf-loading .tagcloud a,
        .wf-loading .widget_nav_menu .menu,
        .wf-loading .widget_categories li,
        .wf-loading .widget_meta li>a,
        .wf-loading .widget_pages li,
        .wf-loading .widget_archive a,
        .wf-loading .comment-reply-title small,
        .wf-loading .woocommerce div.product .woocommerce-tabs .panel h2,
        .wf-loading .woocommerce h2,
        .wf-loading .woocommerce #respond input#submit,
        .wf-loading .woocommerce a.button,
        .wf-loading .woocommerce button.button,
        .wf-loading .woocommerce input.button,
        .wf-loading .woocommerce .page-title,
        .wf-loading .woocommerce nav.woocommerce-pagination ul li a,
        .wf-loading .woocommerce nav.woocommerce-pagination ul li span,
        .wf-loading .woocommerce div.product form.cart .reset_variations {
            opacity: 0;
        }

        .ie.wf-loading label,
        .ie.wf-loading input[type=submit],
        .ie.wf-loading .metaText,
        .ie.wf-loading .metaFont,
        .ie.wf-loading .metaBtn,
        .ie.wf-loading .postMeta,
        .ie.wf-loading .postCategory,
        .ie.wf-loading .blockHeading,
        .ie.wf-loading .comment-reply-title,
        .ie.wf-loading .wp-caption,
        .ie.wf-loading .gallery-caption,
        .ie.wf-loading .widget-title,
        .ie.wf-loading .btn,
        .ie.wf-loading .navigation,
        .ie.wf-loading .logged-in-as,
        .ie.wf-loading .widget_calendar table,
        .ie.wf-loading .tagcloud a,
        .ie.wf-loading .widget_nav_menu .menu,
        .ie.wf-loading .widget_categories li,
        .ie.wf-loading .widget_meta li>a,
        .ie.wf-loading .widget_pages li,
        .ie.wf-loading .widget_archive a,
        .ie.wf-loading .comment-reply-title small,
        .ie.wf-loading .woocommerce div.product .woocommerce-tabs .panel h2,
        .ie.wf-loading .woocommerce h2,
        .ie.wf-loading .woocommerce #respond input#submit,
        .ie.wf-loading .woocommerce a.button,
        .ie.wf-loading .woocommerce button.button,
        .ie.wf-loading .woocommerce input.button,
        .ie.wf-loading .woocommerce .page-title,
        .ie.wf-loading .woocommerce nav.woocommerce-pagination ul li a,
        .ie.wf-loading .woocommerce nav.woocommerce-pagination ul li span,
        .ie.wf-loading .woocommerce div.product form.cart .reset_variations {
            visibility: hidden;
        }

        .siteHeader-content {
            background-color: #ffffff;
        }

        .featuredBlockBackground {
            background-color: #f5f5f5;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center top;
            background-image: url('https://devmarketer.io/wp-content/uploads/2016/07/low-poly-texture.jpg');
        }
    </style>
    <style id="md-custom-style" type="text/css" media="all">
        .fotorama__thumb-border,
        .tagcloud a:hover,
        .postTags-list>a:hover,
        .postVia-list>a:hover,
        .postSource-list>a:hover,
        .tabs-nav li.active a:after,
        .navigation--standard>ul>li>a:before,
        .articleTags-list>a:hover,
        .articleVia-list>a:hover,
        .articleSource-list>a:hover,
        .bodyCopy a:hover,
        input[type="submit"],
        input[type="submit"]:hover {
            border-color: #00a79d;
        }

        .reviewMeter-item-score:after,
        .commentCountBox:before {
            border-top-color: #00a79d;
        }
    </style>
</head>

<body class="post-template-default single single-post postid-546 single-format-standard is-smoothScrollEnabled">
    <!-- siteWrap -->
    <div class="siteWrap">
        <main class="layoutBody clearfix noThumb">
            <article
                class="postSingle postSingle--fullwidth postSingle--headerWide hentry post-546 post type-post status-publish format-standard category-featured category-php-development category-web-development tag-employees tag-font tag-reading-list-2 tag-terminal tag-website tag-white-hat noThumb">
                <div class="container">
                    <div class="layoutContent">
                        <header class="postSingle-header postSingle-header--fullwidth postSingle-header--big">
                            <h1 itemprop="headline" class="postTitle entry-title">Ultimate Guide: Deploy Laravel 8 App
                                on LEMP Stack (Ubuntu 20 and Nginx)</h1>
                        </header>
                        <div class="contentWrap">
                            <div itemprop="articleBody"
                                class="postContent postContent--fullwidth bodyCopy entry-content">
                                <p>So you worked hard to build your Laravel 5.3 (or any version 5) application and now
                                    its time to deploy to the internet so you can share your hard work with everyone. In
                                    this tutorial we will learn to set up Laravel onto a virtual private server (VPS)
                                    using what is called a LEMP stack. LEMP is an acronym that stands for:</p>
                                <ul>
                                    <li><span style="text-decoration: underline;"><strong>L</strong></span>inux</li>
                                    <li><span style="text-decoration: underline;"><strong>E</strong></span>ngine-X
                                        (Nginx)</li>
                                    <li><span style="text-decoration: underline;"><strong>M</strong></span>ySQL</li>
                                    <li><span style="text-decoration: underline;"><strong>P</strong></span>HP</li>
                                </ul>
                                <p>The LEMP acronym represents the stack of technologies we will use to deliver our
                                    application. You may also be familiar with LAMP stack which is basically the same
                                    thing, but substitutes the Apache server for the Nginx server (pronounced Engine-X
                                    which gives LEMP the &#8220;E&#8221;).
                                </p>
                                <h3>Why LEMP and not LAMP?</h3>
                                <p>Well honestly it is up to you. The reason I chose to use LEMP with Laravel is that it
                                    seems to be the preferred stack among the Laravel community. Keep in mind however,
                                    that Laravel runs just perfectly fine on an Apache server, if you feel more
                                    comfortable with that. So for this tutorial we will use Nginx over Apache, but I may
                                    follow up with a LAMP stack tutorial if there is adequate interest from my fellow
                                    DevMarketers out there. Let me know in comments.
                                </p>
                                <p>One other thing I should mention is that when running smaller server instances like
                                    we are (with 512mb RAM or maybe 1Gb) it has been shown that Nginx performs better
                                    with more limited resources. Of course Apache is the most popular server on the
                                    internet by far, so I have no hate towards either one.
                                </p>
                                <h3>Where Should I Host?</h3>
                                <p><strong>You can host it anywhere that you wish.</strong> Keep in mind that this
                                    tutorial will cover setting up your server through SSH into your VPS instance. This
                                    means that it really doesn&#8217;t matter who you host through, once you have your
                                    IP address and you log into the server via SSH, the tutorial will work the same
                                    regardless of your host. So feel free to choose whoever you prefer for hosting your
                                    server, you can still follow this tutorial exactly the same.
                                </p>
                                <p>Some hosts that I recommend would be Vultr, DigitalOcean, and Linode. I have used all
                                    three in production and they work great. For this tutorial I will be using Vultr and
                                    if you would like to sign up through DevMarketer you will get $20 to get started,
                                    absolutely free.
                                </p>
                                <h2>Step 1: Set Up Your VPS</h2>
                                <p>
                                    This is the only step that will vary depending on which host you choose. I will be
                                    using Vultr, but the interface is almost 100% identical for Digital Ocean, should
                                    you decide to use them. Linode has a more basic interface, but will ask almost
                                    identical questions.
                                </p>
                                <h3>A. New Server (or Droplet)</h3>
                                <p>To get started we need to boot up our wizard for creating a new server. You are
                                    looking for the button for &#8220;New Server&#8221;. If you are on DigitalOcean,
                                    they call servers &#8220;Droplets&#8221;, so you select &#8220;New Droplet&#8221;.
                                </p>
                                <h3>B. Configure Server Location</h3>
                                <p>Now it is time to choose the physical location that your new server will be located.
                                    Each service has their own datacenter locations, but in general it is best to choose
                                    a location closest to where most of your users will be. So even if you are located
                                    in India, but most of your users are from the UK, then you should choose a London
                                    server. This makes your server fast for your users.
                                </p>
                                <p>Select a location that you prefer to host it at that location. On some services there
                                    will be multiple dataservers at a single location. You basically just choose a
                                    number at random, it won&#8217;t make much difference, unless you have some sort of
                                    insider information at your disposal.
                                </p>
                                <h3>C. Select Linux Distro</h3>
                                <p>The next step requires you to select which version of Linux you would like to use
                                    (this will configure the &#8220;L&#8221; in our LEMP stack. For this tutorial we
                                    will be using Ubuntu 16.04 x64 as our distro. Of course any of these will work if
                                    you have experience with them, but I will be demonstrating Ubuntu 16 in this
                                    tutorial.
                                </p>
                                <h3>D. Server Size</h3>
                                <p>This is the setting that will change the most depending on your application and what
                                    service you are using. Most Laravel applications are suggested to have a minimum of
                                    1Gb Ram which is usually the $10 a month plan for most services. However small
                                    Laravel apps work just fine on 512Mb or 768Mb servers too. Obviously you also want
                                    to take into account your traffic which will have the largest factor on which server
                                    size you select.
                                </p>
                                <p>As you may notice, you get a slightly better deal by going with Vultr, as you get a
                                    little bit extra RAM for your $5/mo plan.
                                </p>
                                <h3>E. Additional Settings</h3>
                                <p>These additional settings aren&#8217;t super important for now. Just choose what you
                                    think you will need. These settings vary a little between hosts but most ask if you
                                    want to use IPv6 (recommended), auto backups and more. Vultr has a cool feature to
                                    protect against DDOS attacks if you are in certain datacenters. I suspect this will
                                    expand in the future to all of their datacenters.
                                </p>
                                <p>In Vultr you may also set up a Startup Script. You can leave this blank for now. We
                                    do not need it.
                                </p>
                                <h3>D. SSH Keys</h3>
                                <p>It is <strong>HIGHLY RECOMMENDED</strong> that you set up SSH keys here. You will
                                    need to have SSH keys set up for your account and once you do, then you can simple
                                    check the SSH keys on your account to allow them root access to your application.
                                    For DigitalOcean when you select an SSH key then they actually do not create a
                                    username and password for you (you can always add it later through SSH). On Vultr
                                    they still email you username and password after you boot up the server, but its
                                    still a good idea to set up the SSH key as it is far more secure and more
                                    convenient.
                                </p>
                                <p>If you opt out of setting up SSH keys then the tutorial will still work the same,
                                    except that you will need to type in the username and password
                                    <strong>ALOT</strong>! So if you decide to skip SSH keys just know that you will be
                                    typing the password a lot and that you are actually less secure. It really is a
                                    win-win setting up SSH keys.
                                </p>
                                <h3>E. Server Hostname and/or Label</h3>
                                <p>This setting is a little different between hosts, but it is basically asking you what
                                    you want to call the server. On DigitalOcean it will not ask for the hostname, only
                                    the label. Just use a friendly name to describe your application so you know what
                                    server this does when looking at all your servers on the dashboard screen. The same
                                    goes with Vultr as you want to know what this server does when looking at the
                                    dashboard screen, but Vultr also asks for a Server Hostname. I usually just set this
                                    to localhost for now. You can change this later.
                                </p>
                                <h3>F. Deploy</h3>
                                <p>Click the final button to deploy and create your server. It will take about 1 minute
                                    to set up the server and then you will be able to log in and get started.</p>
                                <h2>Step 2: Log-In via SSH</h2>
                                <p>
                                    Before we get too carried away, make sure you have a way to SSH into your new
                                    server.
                                </p>
                                <h3>Linux and Mac You&#8217;re Covered</h3>
                                <p>If you are using Linux (on your local machine) or MacOS then you will have SSH
                                    capabilities by default. You don&#8217;t need to do anything to set it up, you will
                                    simply use your Terminal and use the <code>ssh</code> command which we will cover in
                                    a second.
                                </p>
                                <h3>Windows Install SSH Client</h3>
                                <p>Of course for some reason Windows doesn&#8217;t have this built in (as usual with
                                    most web development stuff) so you need to install an SSH client. Most Windows users
                                    use puTTY as an SSH client.You can
                                    download puTTY from their site.
                                </p>
                                <p>You will notice that it feels like you are downloading a virus. Their website has a
                                    very Web1.0 feel. Everyone give a round of applause welcoming our Windows users to
                                    the 21st century.
                                </p>
                                <h3>Logging Into Our Server</h3>
                                <p>Now that you have an SSH client, it is time to log into our server so we can set it
                                    up. In the terminal type:
                                </p>
                                <pre><code>ssh [email&#160;protected] </code></pre>
                                <p>Simply replace <code>100.100.100.100</code> with the IP address for your server. You
                                    will have this IP address in your dashboard on your host, or in an email sent to you
                                    from your host after the server finished setting up. You might want to write this
                                    down somewhere nearby for the time being since we will need it several times going
                                    forward.
                                </p>
                                <p>The first time you boot into your server and you are using SSH Keys, you will
                                    probably get a message asking you if you want to trust or add this IP address to
                                    your list of known hosts. Just agree to it to continue and you will not get this
                                    message again.
                                </p>
                                <p>Now that you are into your server you will get a welcome message from Ubuntu.</p>
                                <p><img class=" is-fullwidthImage aligncenter wp-image-545 size-full"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/jacurtis_—_root_localhost____—_ssh_root_107_191_44_91_—_127×24.png"
                                        alt="Welcome message from Ubuntu 16.04" width="769" height="275" />
                                </p>
                                <p>This might seem crazy but you have full access to this computer now by typing
                                    messages into this terminal. This is the same as if you had the computer in front of
                                    you with a monitor, except that your only method to &#8220;see&#8221; into the
                                    computer is with a terminal command window. We can now install programs, set
                                    preferences, and manage files just like you would on any new computer, but via the
                                    SSH terminal window.
                                </p>
                                <h2>Step 3: Update Package Installer</h2>
                                <p>We will be using the <strong>Apt-Get </strong>package installer to install new
                                    programs on our server. Think of this like the Apple App Store or Google Play Store,
                                    except not as cool looking, and it is for Linux programs.
                                </p>
                                <p>Before we start installing things, let&#8217;s make sure that our Apt-Get Installer
                                    is up to date. To do this just tell it to update with this command:
                                </p>
                                <pre>sudo apt-get update</pre>
                                <p>You will see a bunch of text, and eventually you will get your command prompt again.
                                    I encourage you to read some of the output to get used to how apt-get works. The
                                    chances of this failing are pretty small, so everyone should be able to move on
                                    easily from here.
                                </p>
                                <p><em>Note: as a side note, you will see us using the term <strong>sudo</strong> in
                                        front of many of the commands in this tutorial. <strong>Sudo</strong> stands for
                                        &#8220;<strong>s</strong>uper-<strong>u</strong>ser <strong>do</strong>&#8221;
                                        and tells our computer to do whatever we are asking as the super user. The super
                                        user is basically the admin. By default we are using the <strong>root</strong>
                                        user which has super user privileges. In more advanced tutorials you might make
                                        another account for yourself and then give yourself super user privileges. For
                                        simplicity we will be using the <strong>root</strong> user account in this
                                        tutorial.
                                    </em>
                                </p>
                                <h2>Step 4: Install Nginx</h2>
                                <p>Now that we are up to date with our installer, let&#8217;s use it to install our
                                    server Nginx.
                                </p>
                                <pre>sudo apt-get install nginx</pre>
                                <p>It is surprising how easy this is. If you are using Ubuntu 16.04, then Nginx will
                                    even start running itself after being installed.
                                </p>
                                <p>In fact you should be able to now visit your IP-Address and you will see that Nginx
                                    is working. You could even share this URL with your friends and they would be able
                                    to see it too (of course I don&#8217;t know why you would want to).
                                </p>
                                <figure id="attachment_549" style="width: 1440px" class="wp-caption alignnone">
                                    <img
                                        class="size-full wp-image-549"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/Welcome_to_nginx_.png"
                                        alt="Nginx Welcome Page" width="1440" height="343" 
                                    />
                                    <figcaption class="wp-caption-text">If you see this page, then you know that your
                                        server is working and Nginx successfully installed.
                                    </figcaption>
                                </figure>
                                <p>Some configuration is still needed to get Nginx to show our Laravel app, but we will
                                    come back to that. We need to set up a few other things first such as Mysql and PHP.
                                </p>
                                <h2>Step 5: Install MySQL</h2>
                                <p>Ok, a server isn&#8217;t much use without a database. In fact our Laravel application
                                    is kind of a waste unless we have a database to store our information (otherwise why
                                    not make a single page app or plain old HTML?).
                                </p>
                                <p>Of course you could always install another database, but we will be installing MySQL
                                    here. To get started, we need to use Apt-Get to go install the base Mysql Install.
                                </p>
                                <pre>sudo apt-get install mysql-server</pre>
                                <p>This will start installing MySQL. Let the install run until a bright pink/purple
                                    screen pops up. This might just be the worst color selection for any terminal
                                    application ever, but there isn&#8217;t much we can do about it but to embrace it.
                                    You will want to type in a password to use for the <strong>root</strong> MySQL user.
                                    Choose something secure here and then click the <code>enter</code> key.
                                </p>
                                <figure id="attachment_550" style="width: 770px" class="wp-caption alignnone">
                                    <img
                                        class="size-full wp-image-550"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/jacurtis_—_root_localhost____—_ssh_root_107_191_44_91_—_127×24-1.png"
                                        alt="Create a MySQL Password" width="770" height="364" 
                                    />
                                    <figcaption class="wp-caption-text">After selecting a password for MySQL it will ask
                                        you to confirm.
                                    </figcaption>
                                </figure>
                                <p>After you make your first password it will ask you to confirm. Obviously make sure
                                    they match. Also, this is a password you need to remember. So make sure you store
                                    the password somewhere safe or it is something you can remember. You will be using
                                    this password a lot going forward.
                                </p>
                                <p>Once your command line finished and displays the
                                    <code><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0f7d60607b4f63606c6e6367607c7b">[email&#160;protected]</a>:~#</code>
                                    line again, then you know you are complete with MySQL.
                                </p>
                                <h3>Secure your Install</h3>
                                <p>You know that friend that just has that reputation for being the person you
                                    can&#8217;t tell a secret to no matter what? Well MySQL has a reputation for being
                                    unsecure. It is not because it is unsecure itself, but because most people that set
                                    it up leave many default settings in place and the default settings are not secure
                                    at all. For example, on my local computer my MySQL doesn&#8217;t even have a
                                    password at all and the only user is <strong>root</strong>. This is ok because it is
                                    only on my local computer and because it doesn&#8217;t store anything important, but
                                    on your server this is a bad idea.</p>
                                <p>MySQL luckily has a nice helper script which gets rid of a lot of these bad habits
                                    that MySQL has. For example it makes sure you don&#8217;t have an empty password for
                                    your root user, it gets rid of the test database, and removes remote root user
                                    access. These setting changes will make your MySQL more secure. To get all these
                                    security fixes to take effect, just type this into the terminal:</p>
                                <pre>sudo mysql_secure_installation</pre>
                                <p>Depending on your version it might ask you to install the VALIDATE PASSWORD plugin. I
                                    personally don&#8217;t think this is necessary since I will have control over making
                                    new users and I will make sure the passwords are secure enough, so I will skip over
                                    this setting. (Type &#8216;N&#8217;).</p>
                                <pre class="code-pre "><code>VALIDATE PASSWORD PLUGIN can be used to test passwords
and improve security. It checks the strength of password
and allows the users to set only those passwords which are
secure enough. Would you like to setup VALIDATE PASSWORD plugin?

Press y|Y for Yes, any other key for No:</code></pre>
                                <p>Next it will ask you if you want to change the existing password for
                                    <strong>root</strong> user. If you just set a secure password in the last step then
                                    you can also skip this question by pressing any key (other than &#8216;Y&#8217;). If
                                    you left the password blank or set up a silly password (like &#8216;password&#8217;
                                    or &#8216;1234&#8217;) then go ahead and change your password now.</p>
                                <p>Next it will ask you to remove an anonymous user. Type <code>Y</code> to remove the
                                    anonymous users, this is a major security risk.</p>
                                <p>Now it will ask if you want to <em>Disallow root login remotely?</em> and you should
                                    also select <code>Y</code> for this.</p>
                                <p>Another prompt asks to <em>Remove test database and access to it?</em> This is a good
                                    idea to do, so type <code>Y</code> again for this.</p>
                                <p>It may also ask to <em>reload privilege tables now? </em>This is always a good idea,
                                    so type <code>Y</code> again.</p>
                                <p>The terminal will tell you <strong>All Done! </strong>With this announcement we now
                                    have a LEM stack, which really isn&#8217;t a think. But I thought you would like to
                                    know your progress as we just completed the <strong>M</strong> in LE<strong><span
                                            style="text-decoration: underline;">M</span></strong>P with our MySQL
                                    instance. Now let&#8217;s finish it up and get the <strong>P</strong>.</p>
                                <h2>Step 6: Install PHP</h2>
                                <p>Ok I kind of tricked you, because your Ubuntu instance probably already has base PHP
                                    set up. But you need to set up PHP for processing. This comes in the form of a
                                    plugin called <code>php-fpm</code> which is a boring as hell name which sounds much
                                    cooler in its full version &#8220;FastCGI Process Manager&#8221;.</p>
                                <p>We need to install both <code>php-fpm</code> and while we are at it, we will grab
                                    <code>php-mysql</code> which as you might guess, allows us to use PHP to talk to
                                    MySQL. Lastly we will install <code>php-mbstring</code> which is a requirement for
                                    Laravel.</p>
                                <pre>sudo apt-get install php-fpm php-mysql php-mbstring</pre>
                                <p>At the time of this writing, this will install the cool new version of PHP, version
                                    7! With PHP now installed, <strong>we have our full LEMP stack installed</strong>.
                                </p>
                                <h2>Step 7: Configure PHP</h2>
                                <p>With the stack installed, it is now time to configure everything to get it working.
                                    There isn&#8217;t much to configure with PHP, but there is one small security fix we
                                    need to make.</p>
                                <p>In your terminal, open up your <code>php.ini</code> file in whatever text editor you
                                    wish (VIM, or eMacs) but for simplicity, we will use Nano in this tutorial.</p>
                                <pre>sudo nano /etc/php/7.0/fpm/php.ini</pre>
                                <p>The line we need to edit is <code>cgi.fix_pathinfo=0</code> so you can either search
                                    for it like a needle in a haystack, or you can search for it using
                                    <code>Ctrl+W</code> , I personally recommend searching for it.</p>
                                <p>Press <code>Ctrl+W</code> and now type in <code>cgi.fix_pathinfo=</code> and click
                                    <code>enter</code>. This will take you to the right line right away. You will see a
                                    semicolon the left of this line. Delete the semi colon and then change the
                                    <code>1</code> into a <code>0</code> and save the file. The file should look like
                                    this upon saving:</p>
                                <figure id="attachment_551" style="width: 778px" class="wp-caption alignnone"><img
                                        class="size-full wp-image-551"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/jacurtis_—_root_localhost____—_ssh_root_107_191_44_91_—_127×24_and_How_To_Install_Linux__Nginx__MySQL__PHP__LEMP_stack__in_Ubuntu_16_04___DigitalOcean.png"
                                        alt="Change one line in your php.ini" width="778" height="364" />
                                    <figcaption class="wp-caption-text">Change cgi.fix_pathinfo=1 to a 0 and uncomment
                                        the line.</figcaption>
                                </figure>
                                <p>To save something in Nano, just press <code>Ctrl+X</code> and type <code>Y</code> and
                                    then press <code>Enter</code>.</p>
                                <p>Before the changes can take effect we need to restart <code>php-fpm</code> by typing
                                    in this command:<code></code></p>
                                <pre>sudo systemctl restart php7.0-fpm</pre>
                                <p>Now our change has taken effect.</p>
                                <h2>Step 7: Configure Nginx</h2>
                                <p>Here is where things will start to get a little tricky. Get your thinking caps on and
                                    lets configure our server engine. All the configuration we need to make is in the
                                    following config file. Go ahead and open it up in Nano using the following command
                                    (use another editor if you prefer).</p>
                                <pre>sudo nano /etc/nginx/sites-available/default</pre>
                                <p>You will see a lot of lines with <code>#</code> in front of them, these are comments.
                                    For simplicity, we will remove comments in this tutorial to make it easier to see
                                    what changed.</p>
                                <pre class="p1"><span class="s1">server {
</span><span class="s1"><span class="Apple-converted-space">    </span>listen 80 default_server;
</span><span class="s1"><span class="Apple-converted-space">    </span>listen [::]:80 default_server;
    
    root /var/www/html;
    index index.html index.htm index.nginx-debian.html;

    server_name _;

    location / {
        try_files $uri $uri/ =404;
    }
}
</span></pre>
                                <p>The first change we need to make to this file is to allow it to recognize index.php
                                    as a valid file to deliver.</p>
                                <p>In the line with all of the index names, we will add <code>index.php</code> to the
                                    list of allowed file types to deliver by default. What this line tells Nginx is to
                                    first look for an <code>index</code> file, then look for an <code>index.php</code>
                                    file, then an <code>index.html</code> file and so forth. It will start at the
                                    beginning and work down until it finds a matching file. Then the matching file is
                                    what is sent to the user. We want it to deliver an <code>index.php</code> file
                                    before an <code>index.html</code> file, so the order is important here. Add the red
                                    text shown below.</p>
                                <pre class="p1"><span class="s1">server {
</span><span class="s1"><span class="Apple-converted-space">    </span>listen 80 default_server;
</span><span class="s1"><span class="Apple-converted-space">    </span>listen [::]:80 default_server;
    
    root /var/www/html;
    index <span style="color: #ff0000;">index.php</span> index.html index.htm index.nginx-debian.html;

    server_name _;

    location / {
        try_files $uri $uri/ =404;
    }
}</span></pre>
                                <p>Next we need to add our public domain or IP address to the <code>server_name</code>
                                    line. This tells Nginx the domain to respond to. I am going to use an IP address for
                                    this tutorial since I am not setting up a domain. But if you have a domain name that
                                    you want this server to use then you would put the domain name here instead.</p>
                                <pre class="p1"><span class="s1">server {
</span><span class="s1"><span class="Apple-converted-space">    </span>listen 80 default_server;
</span><span class="s1"><span class="Apple-converted-space">    </span>listen [::]:80 default_server;
    
    root /var/www/html;
    index index.php index.html index.htm index.nginx-debian.html;

    server_name <span style="color: #ff0000;">107.191.44.91</span>;

    location / {
        try_files $uri $uri/ =404;
    }
}</span></pre>
                                <p>Now we need to do a few other housecleaning items. You will want to just trust me on
                                    these as they get more complex, but the concepts of what they accomplish should make
                                    sense to you. First things first we want to tell Nginx to use your
                                    <code>php-fpm</code> that we installed earlier. This will be represented by the
                                    first <code>location</code> block that we add (it will actually be the second on in
                                    the document though, make sure to leave the first <code>location</code> block alone
                                    (for now, we will come back to configure it for Laravel later).</p>
                                <p>The second <code>location</code> block we are adding (the third in the file) will be
                                    telling Nginx to ignore <code>.htaccess</code> files. This is because
                                    <code>.htaccess</code> files are for Apache and we are using Nginx. Sometimes
                                    Laravel files will have <code>.htaccess</code> files in them by default so
                                    let&#8217;s just make sure that if one gets onto our server to make sure it
                                    doesn&#8217;t interfere with anything and our users do not have access to it.</p>
                                <p>These changes are marked in red below If you scroll down in your file you will notice
                                    that these two location blocks are already written for you, just uncomment the lines
                                    if you like or write it as shown below. If you decide to uncomment the lines, make
                                    sure you leave the notes commented out and also there is a line that reads
                                    <code>fastcgi_pass 127.0.0.1:9000</code> that should stay commented. Basically just
                                    make sure that your uncommented lines match what is below.<span class="s1"> </span>
                                </p>
                                <pre class="code-pre "><code>server {
    listen 80 default_server;
    listen [::]:80 default_server;

    root /var/www/html;
    index <span class="highlight">index.php</span> index.html index.htm index.nginx-debian.html;

    server_name 107.191.44.91;

    location / {
        try_files $uri $uri/ =404;
    }

    <span style="color: #ff0000;"><span class="highlight">location ~ \.php$ {</span>
        <span class="highlight">include snippets/fastcgi-php.conf;</span>
        <span class="highlight">fastcgi_pass unix:/run/php/php7.0-fpm.sock;</span>
    <span class="highlight">}</span>

    <span class="highlight">location ~ /\.ht {</span>
        <span class="highlight">deny all;</span>
    <span class="highlight">}</span></span>
}</code></pre>
                                <p>So that is all we need to do for now. We will come back to this file again in a
                                    moment, but let&#8217;s save and close it for now just to make sure everything is
                                    good to go.</p>
                                <p>To save it remember to press <span
                                        style="font-family: Inconsolata, monospace;"><code>Ctrl + X</code> and then type
                                        <code>Y</code> and then press <code>enter</code>.</span></p>
                                <p>Now that we have saved the file, make sure it is error free by typing:</p>
                                <pre>sudo nginx -t</pre>
                                <p>If everything was correct then you should get this notice when submitting the
                                    command:</p>
                                <pre class="p1"><span class="s1">nginx: the configuration file /etc/nginx/nginx.conf syntax is ok</span>
<span class="s1">nginx: configuration file /etc/nginx/nginx.conf test is successful</span></pre>
                                <p>This means you have no errors. Good work, now to let it take effect you can restart
                                    Nginx:</p>
                                <pre>sudo systemctl reload nginx</pre>
                                <p>With this set up, you are now ready to deploy any PHP application. The server is all
                                    set up to accept and deliver it. So in the next few steps we will set it up
                                    specifically to work for Laravel 5.</p>
                                <h2>Step 8: Create A Folder for Laravel</h2>
                                <p>Now that our server is ready to serve files, lets get Laravel files set up so that
                                    our server can do what it was born to do and serve them. By default Nginx will look
                                    in our <code>/var/www/</code> folder as the root of where to serve files. So we will
                                    add another folder in here called <code>laravel</code> (or whatever you want to call
                                    it) and place our Laravel app there.</p>
                                <pre class="code-pre "><code>sudo mkdir -p /var/www/laravel</code></pre>
                                <p>Now we have a folder to store Laravel in. Let&#8217;s update Nginx so that it knows
                                    about this folder. Of course we don&#8217;t just tell Nginx about the folder, we
                                    need to tell it where to find the default page to run whenever there is a web
                                    request. This means we need to understand something about Laravel first.</p>
                                <p>In Laravel, there is a file called <code>index.php</code> in our <code>public</code>
                                    directory. This file is a php file that is actually most of the magic behind
                                    Laravel. Regardless of our routes, we always want to load this file. This file then
                                    grabs information about the request and sends it to our routes file (in
                                    <code>routes/web.php</code> in Laravel 5.3) which then parses the url that was
                                    passed into it to determine which controller to send it over to. When the routes
                                    file determines which controller and action to implement it does so, executes your
                                    controller action, which most likely returns a view that is what ultimately is
                                    returned to the user.</p>
                                <p>The reason that this workflow is important to understand is that regardless of which
                                    route you go to, the page that is always loaded is the <code>index.php</code> page.
                                    All the routes and views that you see are actually the result of loading this same
                                    page on every request. I share this information with you to explain that we just
                                    need to tell Nginx to always load the <code>index.php</code> page no matter what,
                                    and after that Laravel will do the rest.</p>
                                <p>In order to update Nginx, we are going to edit the same file we edited before. I will
                                    use Nano again, using this command:</p>
                                <pre class="code-pre "><code>sudo nano /etc/nginx/sites-available/default</code></pre>
                                <p>This time our focus will be on the <code>root</code> line which is the location that
                                    Nginx starts looking for a file to send back to the user. Right now it will default
                                    to <code>/var/www/html</code> which is actually just fine location for our app if
                                    you want to use it. But we will change it to the <code>laravel/</code> folder that
                                    we just created.</p>
                                <pre class="code-pre "><code>server {
    listen 80 default_server;
    listen [::]:80 default_server ipv6only=on;

    root <span class="highlight" style="color: #ff0000;">/var/www/laravel/public</span>;
    index <span class="highlight">index.php</span> index.html index.htm;

    server_name <span style="color: #999999;">100.100.100.100</span>;

    location / {
            try_files $uri $uri/ =404;
    }

    # more location blocks continue below
    # (no changes needed beyond this point)
</code></pre>
                                <p><strong>Just edit the one red line</strong> on root, even though the rest of the file
                                    is not displayed above, leave it how it was in the previous steps, only edited the
                                    red text.</p>
                                <p>You will now see that we point to the <code>laravel/public/</code> directory. This is
                                    because the <code>index.php</code> file that we want to use is inside the
                                    <code>public/</code> folder. You can see below that once it gets in that folder it
                                    will start looking for <code>index</code> and then <code>index.php</code> where it
                                    will find our file and then in turn execute Laravel.</p>
                                <p>Finally you might remember how I said that the <code>index.php</code> file collects
                                    the query data in order to pass it into Laravel. Well we need to do that now,
                                    attaching our query string onto the end of the <code>index.php</code>. We will do
                                    this after the <code>$uri</code> and <code>$uri/</code> so that if there is
                                    something that needs to overwrite Laravel, they can execute before it gets to
                                    Laravel. An example of this is like if you have <code>example.com/phpmyadmin</code>
                                    you want the <code>phpmyadmin</code> uri to execute before Laravel. But most stuff
                                    will just get caught by Laravel. We also remove the 404 error because we will let
                                    Laravel decide if something needs to respond with a 404 error.</p>
                                <p>Change only the red text and leave everything as it was (remember that the
                                    server_name on this example will not match your file, yours will either be the
                                    domain name or IP address you were given):</p>
                                <pre class="code-pre "><code>server {
        listen 80 default_server;
        listen [::]:80 default_server ipv6only=on;

        root /var/www/laravel/public;
        index index.php index.html index.htm;

        server_name <span class="highlight" style="color: #999999;">100.100.100.100</span>;

        location / {
                try_files $uri $uri/ <span class="highlight" style="color: #ff0000;">/index.php?$query_string</span>;
        }
        
        # more location blocks continue below
        # (no changes needed beyond this point)
</code></pre>
                                <p>Now make sure to save the file (<code>Ctrl + X</code> and then <code>Y</code> and
                                    then press the enter key). Once you are back at your ssh session (exited Nano) you
                                    can restart Nginx so the changes we made take effect.</p>
                                <pre class="code-pre "><code>sudo service nginx restart</code></pre>
                                <p>Try visiting your url now in the browser and if everything worked then <strong>you
                                        should now get a 404 page instead of the Nginx success page </strong>(this is
                                    actually a GOOD thing). This is because now Nginx is pointing at the Laravel folder
                                    (specifically the public folder inside the Laravel folder) instead of the html
                                    folder which contains that success page. Of course we haven&#8217;t installed
                                    Laravel yet, so that public folder doesn&#8217;t exist, hence the 404 error.</p>
                                <h2>Step 9: Create Swap File (Optional)</h2>
                                <p>Before we install composer or Laravel, we need to think about memory. Installing
                                    these applications require a larger download (compared to the other little stuff we
                                    have been downloading) and might potentially eat up all of our RAM if we are on a
                                    smaller server with less than 1Gb of memory. So if your server has more than 1Gb of
                                    memory then you can probably skip this step. If not, then it&#8217;s a good idea to
                                    create a swap file to accomodate the extra download sizes and leave some memory in
                                    RAM for our server to run during the download.</p>
                                <p>Building a swap file allows the operating system to move data off the RAM memory and
                                    onto the SSD when it doesn&#8217;t have enough space. This is mostly only important
                                    while installing larger applications.</p>
                                <p>We will create a 1Gb swap file on the SSD:</p>
                                <pre class="code-pre "><code>sudo fallocate -l 1G /swapfile</code></pre>
                                <p>Now we tell Ubuntu to format it as swap space:</p>
                                <pre class="code-pre "><code>sudo mkswap /swapfile</code></pre>
                                <p>And finally to start using it we type:</p>
                                <pre class="code-pre "><code>sudo swapon /swapfile</code></pre>
                                <p>Now we are good to install larger stuff.</p>
                                <h2>Step 10: Install Composer</h2>
                                <p>You have installed composer before (otherwise you wouldn&#8217;t have made it to this
                                    point in your life where you are reading a tutorial about how to deploy a Laravel
                                    app), and this is no different than before. Follow the instructions just like on the
                                    <a href="https://getcomposer.org/">GetComposer.org</a> website.</p>
                                <pre>cd ~
curl -sS https://getcomposer.org/installer | php</pre>
                                <p>Now we have <code>composer.phar</code> in our home folder, and it&#8217;s time to
                                    move it into our bin so we can use composer commands easier by just typing
                                    <code>composer</code>.</p>
                                <pre>sudo mv composer.phar /usr/local/bin/composer</pre>
                                <p>You can try typing `composer right now and you should get all the composer help files
                                    you are used to getting when using it on your local computer. Hopefully you are
                                    starting to feel at home.</p>
                                <h2>Step 11: Install Git</h2>
                                <p>Since the year is 2016 and not 2006 you really should be using git to deploy your
                                    application. So you could always use SFTP to get your Laravel 5.3 app onto your
                                    server, but that is not only less secure, but it also WAY SLOWER. While it might
                                    work fine the first time, it becomes a pain in the ass for future updates. Using
                                    git, pushing to our server is effortless and has virtually no downtime.</p>
                                <p>We will install Git onto our server now in a folder called <code>/var/repo/</code>
                                    which is near our Nginx folder of <code>/var/www/laravel/</code>. Let&#8217;s make
                                    the folder now.</p>
                                <pre>cd /var
mkdir repo &amp;&amp; cd repo</pre>
                                <p>This will move us into our <code>/var/</code> directory and then make a new directory
                                    called <code>repo/</code> and then move us into that folder. You should now be
                                    inside <code>/var/repo/</code> when you execute the next commands.</p>
                                <pre>mkdir site.git &amp;&amp; cd site.git
git init --bare</pre>
                                <p>The <code>--bare</code> flag might be a new one for you, and that is because it is
                                    generally only used on servers. A <code>bare</code> repo is a special kind of repo
                                    whose sole purpose is to receive pushes from developers. You can learn more about <a
                                        href="https://git-scm.com/book/ch4-2.html">these types of repositories from the
                                        official git site</a>.</p>
                                <p>We now have a git repository in <code>/var/repo/site.git</code> congratulations!</p>
                                <h2>Step 12: Setting Up Git Hooks</h2>
                                <p>Git repositories have a cool feature called hooks that we are going to use to move
                                    our files after a git push. Think of git hooks like webhooks or maybe wordpress
                                    hooks. Basically you can create scripts that execute when certain hooks are
                                    triggered. There are three hooks available through Git: <em>pre-receive</em>,
                                    <em>post-receive</em>, and <em>update</em>.</p>
                                <p>We will focus on the <em>post-receive</em> hook which triggers after the repo has
                                    fully downloaded your files and completed receiving a push.</p>
                                <p>To set up hooks we need to move into the hooks directory inside of our
                                    <code>site.git</code> folder. In <code>/var/repo/site.git#</code> we can type
                                    <code>ls</code> to see all the files and folders inside. You will see the
                                    <code>hooks/</code> directory which we need to <code>cd</code> into.</p>
                                <p>Once you are inside the <code>hooks/</code> directory we are going to create the
                                    <em>post-receive</em> script. We will be using a new command called <em>touch</em>
                                    which makes an empty file.</p>
                                <pre>sudo nano post-receive</pre>
                                <p>Now you will open up a blank file in Nano (terminal text editor). Type the next two
                                    lines into the file and save and exit the file.</p>
                                <pre>#!/bin/sh
git --work-tree=/var/www/laravel --git-dir=/var/repo/site.git checkout -f</pre>
                                <p>Now save and exit (the same way we keep doing it <code>Ctrl + X</code> then
                                    <code>Y</code> to confirm the save and <code>enter</code> to save it as
                                    <code>/var/repo/site.git/hooks/post-receive</code>. This file is where all of the
                                    magic happens.</p>
                                <p>The <code>--work-tree=</code> tells git where to copy received files to after it has
                                    completed. We set it to point to the folder for our Laravel application that we made
                                    earlier. The <code>--git-dir=</code> tells git where the bare git directory is that
                                    has received the files. It is that simple. Make sure that the whole command is on
                                    one line (including the <code>checkout -f</code>).</p>
                                <p>After you save the <code>/var/repo/site.git/hooks/post-receive</code> file, you need
                                    to make one last command before we leave this folder and push our files up. The
                                    <code>post-receive</code> file needs execution permissions in order to copy these
                                    files over. So we can do that really quick with one line of code. Make sure you are
                                    still in <code>/var/repo/site.git/hooks/</code> folder when you type this command:
                                </p>
                                <pre>sudo chmod +x post-receive</pre>
                                <p>That is it! Now when we push to this repository on our server, the files will be
                                    placed in our <code>/var/www/laravel/</code> directory and Nginx can begin to serve
                                    them to our users.</p>
                                <p>We are now done on our server for now, we need to exit the ssh session to access our
                                    local machine for the next step. Type the following command to end your
                                    <code>ssh</code> session.</p>
                                <pre>exit</pre>
                                <p>Your command prompt should now change to the name of your computer instead of
                                    <code><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c5b7aaaab185a9aaa6a4a9adaab6b1">[email&#160;protected]</a>#</code>.
                                    This indicates you are no longer on your server and you are making changes now to
                                    your local computer.</p>
                                <h2>Step 12: Set up our Local Computer to Push to Production</h2>
                                <p>Now that our server is set up to receive the files, let&#8217;s set up our local
                                    computer so that it can push the files to our server. We will be using git, so make
                                    sure that your local computer&#8217;s laravel directory is under git version control
                                    before you continue.</p>
                                <p>Just like when we push our files up to github, we set up a <code>git remote</code>
                                    called <code>origin</code> that represents github. So when we want to push to github
                                    we make a command like this <code>git push origin branchname</code>. This tells git
                                    to push the branch (branchname in this example) to our origin remote.</p>
                                <p>Now in the same fashion that we set up github as a push location, we will also set up
                                    our new server as a push location. I like to call this <code>remote</code> by the
                                    name <code>production</code> which represents our <em>live production website.</em>
                                    The goal is that after we set it up, we can tell it to push to our server from our
                                    local computer by just typing the command <code>git push production master</code>
                                    and this will push the master branch to our production server. You can continue to
                                    push to github using <code>git push origin master</code> but then when you are ready
                                    to make changes go live you will run the push to <code>production</code>.</p>
                                <p><em>Note: You can create as many &#8220;remotes&#8221; as you want in git. It is
                                        common to have a secondary server called &#8220;staging&#8221; which is where
                                        push your project to for quality testing before pushing to a live site. The
                                        staging site is like a beta for you to test internally in a production-like
                                        enviroment before the whole world sees it in real production. In this case you
                                        could create another server (just following the directions in this tutorial
                                        again) and create another &#8220;remote&#8221; called &#8220;staging&#8221;. Now
                                        you can use a command like <code>git push staging master</code> to push to
                                        staging for testing. Then when you feel that the version is safe for the public,
                                        you can run <code>git push production master</code> to push it to the production
                                        server. You can also set up other remote servers for git backups (like gitlab)
                                        or testing servers, or alpha tests and stuff.</em></p>
                                <p>To set up a new remote you use the <code>git remote add</code> command. Before you do
                                    this make sure you are in the correct location. First of all you should no longer be
                                    on your server. If you still see
                                    <code><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="384a57574c7854575b595450574b4c">[email&#160;protected]</a>#</code>
                                    in your prompt then you are on your server still. Type <code>exit</code> and click
                                    enter to leave the server. You should see the name of your computer in the command
                                    prompt now. Use <code>cd</code> commands to get into your laravel project folder
                                    that you want to push to the server. In my case my project is under
                                    <code>/Sites/blog</code> so i type this to get into my folder via the terminal:</p>
                                <pre>cd Sites/blog</pre>
                                <p>Also make sure you have git setup for this project. I am assuming you have already
                                    made at least one commit (but probably many) and you are currently on your
                                    <code>master</code> branch which contains your latest production-ready code.</p>
                                <p>Make sure that you substitute the red text with your domain name or IP address that
                                    you use to ssh into your server.</p>
                                <pre>git remote add production ssh://<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="97e5f8f8e3d7">[email&#160;protected]</a><span style="color: #ff0000;">example.com</span>/var/repo/site.git</pre>
                                <p>Make sure to substitute the red text with your domain or IP address. The command
                                    should mimic the ssh command you use to log into your server. So if you type
                                    <code>ssh <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="40322f2f34007170706e7170706e7170706e71">[email&#160;protected]</a></code>
                                    to get into your server than <code>100.100.100.1</code> is what it should show on
                                    the command above.</p>
                                <p>With this command we now created a remote called <em>production</em> that sends our
                                    files to the new <code>bare</code> git repo we made on our server.</p>
                                <p>Now once again, assuming your project code is production ready and is on your master
                                    branch then you can type this command to push it up to your server:</p>
                                <pre>git push production master</pre>
                                <p>The output will look just like when you push to github, but this time you are pushing
                                    to your own server! Let&#8217;s log back into our server now to make sure it worked.
                                </p>
                                <h2>Step 13: Verify our Git Hook Works</h2>
                                <p>Now let&#8217;s make sure our code is in the right place. It should be in our
                                    <code>/var/www/laravel/</code> folder on our server. It is easy to check, jut log
                                    back into your server and look at the directory.</p>
                                <pre>ssh <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="73011c1c0733">[email&#160;protected]</a><span style="color: #ff0000;">example.com</span></pre>
                                <p>Remember that <code>example.com</code> needs to be changed to your domain or ip
                                    address. Now <code>cd</code> into your laravel folder.</p>
                                <pre>cd /var/www/laravel
ls</pre>
                                <p>You should now see what appears to be a Laravel project. You can poke around but it
                                    should mimic your files from your local computer. Honestly anything in here is a
                                    good sign because it was empty the last time we logged off the server. If you have
                                    your Laravel project in here then you have done everything right.</p>
                                <h2>Step 14: Run Composer</h2>
                                <p>Hey remember when we installed composer a while ago? Well let&#8217;s use it. Now
                                    that we have Laravel on our server and all the files we need, lets run composer to
                                    get it working. Make sure you are in <code>/var/www/laravel/</code> when you run
                                    composer commands because you want to be inside your laravel project.</p>
                                <pre>composer install --no-dev</pre>
                                <p>The <code>--no-dev</code> command flag is very important. Without it, composer will
                                    try to install a bunch of stuff that you<strong> do not need on production</strong>.
                                    It is also very likely that the install will fail as well, since some of the dev
                                    dependencies won&#8217;t work on our server. By adding <code>--no-dev</code> we are
                                    only installing the main require elements and not other random things.</p>
                                <h2>Step 15: Laravel Permissions</h2>
                                <p>In order to run, Nginx needs certain permissions over the Laravel directory we made.
                                    We need to first change ownership of the laravel directory to our web group.</p>
                                <pre class="code-pre "><code>sudo chown -R :www-data /var/www/laravel</code></pre>
                                <p>Now the web group owns the files instead of the root user. Next we need to give the
                                    web group write privileges over our storage directory so it can write to this
                                    folder. This is where you store log files, cache, and even file uploads.</p>
                                <pre class="code-pre "><code>sudo chmod -R 775 /var/www/laravel/storage</code></pre>
                                <p>Now go to your web browser and type in your domain or IP address to attempt to view
                                    the site. What do you see?</p>
                                <figure id="attachment_560" style="width: 1439px" class="wp-caption aligncenter"><img
                                        class=" is-fullwidthImage wp-image-560 size-full"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/107_191_44_91.png"
                                        alt="Laravel 5.3 Error message" width="1439" height="272" />
                                    <figcaption class="wp-caption-text">This is actually a good thing to see.
                                    </figcaption>
                                </figure>
                                <p>If everything went &#8220;right&#8221; then you should see an error, Haha. This time
                                    though you will see a Laravel error, however which actually means that now Laravel
                                    is working. You know the all-to-familiar &#8220;Whoops something went wrong!&#8221;
                                    message and should recognize it with Laravel. If you tried this before then you got
                                    a simple 500 server error displayed by your browser, not by Laravel. The fact we see
                                    this error is actually a good thing because it means that Laravel is giving us the
                                    error and not Nginx.</p>
                                <p>Now I skipped a step intentionally. Before we go back and fix it, I wanted to show
                                    you how to troubleshoot on your server. If you thought troubleshooting was hard on
                                    your local machine, just wait till the world of live servers. Of course the idea is
                                    that you test your app so well before pushing to production that this never happens
                                    (trust me that is a pipe dream, every developer will experience errors on production
                                    at some point, just try to keep them to a minimum).</p>
                                <p>You might wonder why you don&#8217;t get the stack trace or why you don&#8217;t get a
                                    message explaining what the error is, like you are used to when you ran into this
                                    screen on your local computer. This is because our Laravel environment is currently
                                    set to <em>production</em> so Laravel recognizes that and intentionally does not
                                    output detailed error messages when something goes wrong. This is for your security.
                                    Would you want all of your visitors to see a full stack trace of your application?
                                    No, this is like giving your stalker full access to your diary, its a terrible idea.
                                    So on production you will only see these types of messages when something goes
                                    wrong. To see what happened, we need to look at our log file. Luckily now that
                                    Laravel has access to our write to our <code>storage/</code> folder, it now has the
                                    ability to create log files (which it couldn&#8217;t do before).</p>
                                <p>Let&#8217;s go take a look at our log file to see what went wrong. To find the log
                                    file, navigate to <code>/var/www/laravel/storage/logs</code> and if you type
                                    <code>ls</code> in this folder you will find a lone <code>laravel.log</code> file.
                                    Go ahead and open this file up in your terminal and let&#8217;s see what is inside.
                                </p>
                                <pre>nano laravel.log</pre>
                                <p>You should now see the errors that you are used to seeing on the error page. This is
                                    a safe place to store error messages because the only person that can read them are
                                    people that have full access to the server. If a hacker gets full access to your
                                    server then you have much bigger problems than the fact that they can read your log
                                    files.</p>
                                <p>Here is what my log file says. Your file should look similar:</p>
                                <figure id="attachment_561" style="width: 1006px" class="wp-caption aligncenter"><img
                                        class="size-full wp-image-561"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/error-message-laravel-5_3.png"
                                        alt="Laravel 5.3 Error message in Log File" width="1006" height="376" />
                                    <figcaption class="wp-caption-text">Some information flows off the screen.
                                    </figcaption>
                                </figure>
                                <p>The important part is the first line which gives you the error (and the timestamp of
                                    when it happened). To help us identify the error, I added bold green text over the
                                    important parts.</p>
                                <pre class="p1"><span class="s1">[2016-08-29 02:10:21] production.ERROR: ErrorException: file_put_contents(/var/www/laravel<span style="color: #339966;"><strong>/bootstrap/cache/</strong></span>services.php): <span style="color: #339966;"><strong>failed to open stream: Permission denied</strong></span> in /var/www/laravel/vendor/laravel/framework/src/Illuminate/Filesystem/Filesystem.php:81</span>

<span class="s1">Stack trace:

// Continues below with full stack trace...</span></pre>
                                <p>Basically this error says that it is unable to write to the
                                    <code>/boostrap/cache/</code> folder. If we look at the <a
                                        href="https://laravel.com/docs/5.3/installation">Laravel Installation
                                        Documentation</a> we can see that we were supposed to make the
                                    <code>boostrap/cache/</code> folder writable in addition to the
                                    <code>/storage/</code> folder. So let&#8217;s go back and fix that.</p>
                                <pre
                                    class="p1"><span class="s1">sudo chmod -R 775 /var/www/laravel/bootstrap/cache</span></pre>
                                <p>Ok, now the <code>cache</code> folder is writable. There are a few things though that
                                    we need to do. But we are getting really close to our app being ready to deploy.</p>
                                <h2>Step 16: Database Setup</h2>
                                <p>So we installed MySQL a while back, but we haven&#8217;t set up an actual database
                                    inside of it yet to store our application data. So now is the time to go set that
                                    up, so that we can configure it and run our migrations.</p>
                                <p>Lets get into MySQL by typing the following command:</p>
                                <pre>mysql -u root -p'<span style="color: #ff0000;">yourpassword</span>'</pre>
                                <p>Make sure to change the red text with your actual password (but keep the single
                                    quotation marks). Also note that there is no space between the <code>-p</code> and
                                    the first quotation mark.</p>
                                <p>Now you will see a command prompt change to:</p>
                                <pre>mysql&gt;</pre>
                                <p>This indicates that you are in the MySQL CLI now instead of the ssh. We aren&#8217;t
                                    going to learn all of the MySQL CLI commands here today, just the essential ones.
                                </p>
                                <pre>SHOW DATABASES;</pre>
                                <p>This will show you all of the databases you have on this system. Now we need to make
                                    a new database for our Laravel app to use. You can call it whatever you want. Just
                                    make sure to remember the name and keep it all lowercase.</p>
                                <pre>CREATE DATABASE <span style="color: #ff0000;">blog</span>;</pre>
                                <p>The red text is where you substitute the name of your new database. I called it
                                    <em>blog</em> in this case.</p>
                                <p>Now if you wanted, you could run <code>SHOW DATABASES;</code> again and you will find
                                    the list of databases and your new database should be in the list.</p>
                                <p>That is all we needed. We have set up our database now, we can configure Laravel to
                                    start using it and then run migrations onto it.</p>
                                <p>To leave the MySQL command prompt you simply type:</p>
                                <pre>exit</pre>
                                <p>MySQL is super friendly and will say &#8216;Bye&#8217;.</p>
                                <h2>Step 17: Configuring Laravel</h2>
                                <p>Now all we have left is to configure our Laravel app. This is the same way you would
                                    configure your Laravel app on your computer. We will use the <code>config</code>
                                    files and also set up a <code>.env</code> file. Remember that when we push to
                                    production that any file in our <code>.gitignore</code> will not be sent to our
                                    server. So any of those files need to be set up again. If done correctly, this
                                    isn&#8217;t a big deal, your <code>node_modules</code> should not be there, or your
                                    <code>vendor</code> files, which is ok because you don&#8217;t need them on
                                    production (you should use Elixir to compile the ones you need into your
                                    <code>public/</code> or <code>resources/assets/</code> folders prior to pushing to
                                    production).</p>
                                <p>Also remember that by default your <code>storage</code> directory is in your
                                    <code>.gitignore</code> file which means that anything stored in there (like user
                                    avatars) will not be transferred to the server. This is by design, but explaining
                                    this design decision is more complicated than we can get into right now.</p>
                                <p>It is just a good idea to look at your <code>.gitignore</code> and understand that
                                    everything in your .gitignore file will NOT be on the server. If you see something
                                    important on there than you either need to recreate it on your server or you need to
                                    edit your <code>.gitignore</code> file so that it includes it in your repository.
                                </p>
                                <h4>Understanding the .env File</h4>
                                <p>Really the only important file in your <code>.gitignore</code> file that our
                                    application really needs is the <code>.env</code> file. Now once again this is by
                                    design, so do not hastily remove it from the <code>.gitignore</code> file. Keep it
                                    in there, because it is very dangerous to put your <code>.env</code> file into your
                                    repository. The <code>.env</code> will contain private information, passwords, SMTP
                                    credentials, API keys, and more <strong>that all need to be kept very
                                        secret</strong>. So you should make a <code>.env</code> file for your server
                                    that represents your production environment and this will be different from the one
                                    on your local machine which contains information for your local enviroment.</p>
                                <p>For example, you might use mailtrap.io as your mail server on local, so that is the
                                    settings you put in your <code>.env</code> file under SMTP settings. However on
                                    production we need an actual SMTP server to send real emails from so the
                                    server&#8217;s <code>.env</code> file will contain your SMTP credentials for
                                    SendGrid, Amazon SES, or whatever you choose to use for mail delivery.</p>
                                <p>Another example is database information, which will be different between your local
                                    and production enviroments. Some devs even use different database drivers, opting
                                    for SQLite on local and PostgreSQL in production.</p>
                                <p>Once you have a <code>.env</code> file set up for your server and one for your local
                                    then you can push your code between your local computer and your server and the
                                    different settings will instantly take effect. Because git doesn&#8217;t touch your
                                    <code>.env</code> file, then it will not change when the other code is pushed, but
                                    Laravel will use the information in the <code>.env</code> to run everything.</p>
                                <p>Ok, I think we now know why we use a <code>.env</code> file, so now let&#8217;s
                                    create one for our server.</p>
                                <h4>Creating our .env file</h4>
                                <p>One file is kept in our git repo and that is the <code>.env.example</code>. This is
                                    an example <code>.env</code> file that we can use to get started. So we will start
                                    with this example file to create our server <code>.env</code>. Lets copy the
                                    <code>.env.example</code> and rename it <code>.env</code>. We want to copy instead
                                    of move because that way the <code>.env.example</code> file doesn&#8217;t get pulled
                                    from the repo and we can use it again later as a template if we mess up.</p>
                                <p>To copy and rename the file we will use the <code>cp</code> linux command. Make sure
                                    before you do this that you are inside your laravel folder (in
                                    <code>/var/www/laravel/</code>) because that is where the <code>.env.example</code>
                                    is located.</p>
                                <p>To make sure that you are in the right place, run the <code>ls</code> command but run
                                    it with the <code>-A</code> flag so that you can see the hidden files (the
                                    <code>.</code> before the filename indicates that it is hidden).</p>
                                <pre>ls -A</pre>
                                <p>This should show all of your folders and files, including the hidden files. You
                                    should see your normal Laravel structure ( <code>app/</code> , <code>public/</code>,
                                    <code>storage/</code> and so forth) and also normal files like
                                    <code>composer.json</code>, <code>gulpfile.js</code>, and finally your
                                    <code>.env.example</code>. Now you know you are in the right spot.</p>
                                <p>Now that you are in the right spot, lets copy the file.</p>
                                <pre>cp .env.example .env</pre>
                                <p>If you run <code>ls -A</code> again then you should see your <code>.env</code> file
                                    next to your <code>.env.example</code> (they should both be there).</p>
                                <p>Now we can edit our <code>.env</code> by opening it with a text editor of your choice
                                    (once again we will use nano for simplicity).</p>
                                <pre>nano .env</pre>
                                <p>Inside this file you will be able to overwrite many of the config settings. Remember
                                    that anything in the <code>.env</code> file will override whatever is in the
                                    <code>config</code> files.</p>
                                <p><img class="aligncenter size-full wp-image-562"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/nano__env.png"
                                        alt="Edit the .env file" width="775" height="483" /></p>
                                <p>Now that we have created this <code>.env</code> file, it is going to override the
                                    settings in our config file. So for example, our <code>config/app.php</code> file
                                    has our environment set to &#8216;<em>production</em>&#8216; but our new
                                    <code>.env</code> file has the <code>APP_ENV</code> set to <em>local</em> instead.
                                    So now this will switch our application to <em>local</em> which is a security
                                    concern. So we either need to remove the line or change it to what we want.</p>
                                <p><code>APP_DEBUG</code> is what sets those error messages that we talked about
                                    earlier. We need to make sure that is set to <code>false</code>.</p>
                                <p><code>APP_KEY</code> needs to also be set, but we will set that in a moment with an
                                    artisan command.</p>
                                <p>Next comes your database settings. You will need to configure your <span
                                        style="font-family: Inconsolata, monospace;"><code>DB_HOST</code> to be
                                        <code>localhost</code>, set the <code>DB_DATABASE</code> to be the name of the
                                        database we just created in the last step, and then set your username and
                                        password for the database in the <code>DB_USERNAME</code> and
                                        <code>DB_PASSWORD</code> fields.</span></p>
                                <p>You might want to adjust your cache, queue, and session drivers if you know what you
                                    are doing. But the defaults are good for most apps.</p>
                                <p>Lastly you will want to change the <code>MAIL</code> settings as well. Just configure
                                    it based on the settings for your email service provider. The settings are pretty
                                    self-explanatory and outside of the scope of this tutorial.</p>
                                <p>Now Save the file using the <code>Ctrl + X</code> command we usually do.</p>
                                <pre class="p1"><span class="s1">APP_ENV=production</span>
<span class="s1">APP_DEBUG=false</span>
<span class="s1">APP_KEY=SomeRandomString</span>

<span class="s1">DB_HOST=localhost</span>
<span class="s1">DB_DATABASE=<span style="color: #ff0000;">blog</span></span>
<span class="s1">DB_USERNAME=root</span>
<span class="s1">DB_PASSWORD=<span style="color: #ff0000;">XXXXXXXXX</span></span>

<span class="s1">CACHE_DRIVER=file</span>
<span class="s1">SESSION_DRIVER=file</span>
<span class="s1">QUEUE_DRIVER=sync</span>

<span class="s1">REDIS_HOST=localhost</span>
<span class="s1">REDIS_PASSWORD=null</span>
<span class="s1">REDIS_PORT=6379</span>

<span class="s1">MAIL_DRIVER=smtp</span>
<span class="s1">MAIL_HOST=<span style="color: #ff0000;">sendgrid.com</span></span>
<span class="s1">MAIL_PORT=<span style="color: #ff0000;">2525</span></span>
<span class="s1">MAIL_USERNAME=<span style="color: #ff0000;">XXXXXXXXXXX</span></span>
<span class="s1">MAIL_PASSWORD=<span style="color: #ff0000;">XXXXXXXXXXX</span></span>
<span class="s1">MAIL_ENCRYPTION=null</span></pre>
                                <p>Take extra care to make sure the red parts get changed. If you are not using Redis
                                    database then you can delete those lines (but keeping them in won&#8217;t hurt
                                    anything either). Take extra care to double check that the <code>APP_ENV</code> is
                                    set to <code>production</code> and that <code>APP_DEBUG</code> is set to
                                    <code>false</code>.</p>
                                <p>I always like to take a look at my local <code>.env</code> file as well just to make
                                    sure that I didn&#8217;t add any other <code>.env</code> settings while building my
                                    app. An example is in many of my apps I create a <code>GOOGLE_MAPS_API</code>
                                    setting to pull my Google Maps API key. If I forget to add that to my production
                                    <code>.env</code> file then my maps won&#8217;t work and I will have javascript
                                    errors.</p>
                                <p>We should now have most of our app set up. Just a few more configurations to make.
                                </p>
                                <h4>Encryption Key</h4>
                                <p>There is one line we left default in our <code>.env</code> file, the
                                    <code>APP_KEY</code>. Laravel needs this key to be set up in order to encrypt our
                                    sessions, cookies, and passwords. This needs to be a random key that is unique to
                                    our application to make everything more secure. We can generate this key with an
                                    artisan command. Remember those? Yeah, we can use those directly on our server, just
                                    like we did on our local computer.</p>
                                <p>Let&#8217;s run the <code>artisan</code> command to generate a secure encryption key.
                                </p>
                                <pre>php artisan key<span class="token punctuation">:</span>generate</pre>
                                <p>After clicking <code>enter</code> you should see a green line that says:</p>
                                <pre
                                    class="p1"><span class="s1" style="color: #99cc00;">Application key [8LTYOFGu3aBTUSiGea24KWYYrHGRXmxK] set successfully.</span></pre>
                                <p>Of course the long number inside the square brackets will be different for you,
                                    because it is supposed to be random.</p>
                                <p>If you are curious, this <code>artisan</code> command will actually write to your
                                    <code>.env</code> file for you. So you really don&#8217;t need to do anything. But
                                    for the adventerous among you, go back to your <code>.env</code> file and look
                                    inside.</p>
                                <pre>nano .env</pre>
                                <p>You should see the <code>APP_KEY</code> filled out now with your random key.</p>
                                <figure id="attachment_563" style="width: 779px" class="wp-caption aligncenter"><img
                                        class="size-full wp-image-563"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/env_file.png"
                                        alt="Env File with Encryption Key" width="779" height="208" />
                                    <figcaption class="wp-caption-text">Your APP_KEY will now be filled out
                                        automatically with your random key.</figcaption>
                                </figure>
                                <h4>A Few More Config Settings To Change</h4>
                                <p>Our <code>.env</code> file is complete, but there are just a few more settings we
                                    want to change before we are live. These settings are all in our
                                    <code>config/</code> files.</p>
                                <p>In <code>config/app.php</code> there are a few things to edit. Set the
                                    <code>'url'</code> to your actual domain name. Also make sure that your
                                    <code>'timezone'</code> is set correctly too. This needs to be an officially
                                    supported PHP time zone string. If you are not sure what your timezone string is,
                                    you can find the <a href="https://php.net/manual/en/timezones.php">official timezone
                                        strings on the PHP Manual</a>.</p>
                                <pre>&lt;?php

return [
    'env' =&gt; env('APP_ENV', 'production'),
    
    'debug' =&gt; env('APP_DEBUG', false),

    'url' =&gt; '<span style="color: #ff0000;">http://example.com</span>',

    'timezone' =&gt; '<span style="color: #ff0000;">America/Denver</span>',

    'locale' =&gt; '<span style="color: #ff0000;">en</span>',

    'fallback_locale' =&gt; '<span style="color: #ff0000;">en</span>',

    [CONTINUES BELOW]
]</pre>
                                <p>Change the red sections (note that comments were removed for readability). Save the
                                    file and you are done with your configuration.</p>
                                <h4>Cache Configuration Settings</h4>
                                <p>You might have noticed that there are lots of <strong>config</strong> files in our
                                    application. They inherite and cross reference eachother, all of which makes the
                                    configuration easier to read, but slower for PHP to compile on the fly.</p>
                                <p>Because of this, it is a good idea to cache all of the configuration settings into
                                    one cached config file. We can do this with another <code>artisan</code> command.
                                </p>
                                <p>In your terminal (in the <code>/var/www/laravel/</code> folder):</p>
                                <pre>php artisan config<span class="token punctuation">:</span>cache</pre>
                                <p>This will output:</p>
                                <pre class="p1"><span class="s1" style="color: #99cc00;">Configuration cache cleared!</span>
<span class="s1" style="color: #99cc00;">Configuration cached successfully!</span></pre>
                                <p>Now all of our configuration settings are compiled together into one quick file. Of
                                    course don&#8217;t forget now that they are cached. So if you make another change to
                                    your <code>.env</code> file or to a file in your <code>config/</code> folder, that
                                    you need to also recompile the config cache before it will take effect.</p>
                                <h2>Step 18: Migrate our Database</h2>
                                <p>Now that everything else is set up you can actually run your app. The only problem
                                    you might still have is that if your app relies on a database, then you need to
                                    migrate your database. We do this in much the same way as on our local computer. At
                                    this point our configuration files should have everything we need to set up and
                                    communicate with our database, so migrating now should be simple.</p>
                                <pre>php artisan migrate</pre>
                                <p>This will warn you that your app is in production and make sure that you want to
                                    actually run your migrations. The default setting is &#8220;no&#8221; also so its
                                    very difficult to accidentally migrate your live database. This can be good because
                                    sometimes you might forget you are logged into your server on SSH and just grab the
                                    nearest terminal window to run what you think are local migrations, but really they
                                    are production migrations. This script makes sure we know what we are doing.</p>
                                <p>Type <code>Y</code> to continue and migrate your database.</p>
                                <figure id="attachment_565" style="width: 574px" class="wp-caption aligncenter"><img
                                        class="size-full wp-image-565"
                                        src="https://devmarketer.io/wp-content/uploads/2016/08/artisan_migrate.png"
                                        alt="php artisan migrate production" width="574" height="310" />
                                    <figcaption class="wp-caption-text">After you select Y to migrate, you will see all
                                        of your migration catch up.</figcaption>
                                </figure>
                                <p>That&#8217;s it! Your database is now set up and ready to go.</p>
                                <h2>Step 19: Miscellaneous Things</h2>
                                <p>That is it! We have everything set up we need in order to start using our application
                                    on production. Remember that you have a database, but the database is empty. You
                                    might need to create a default admin user or something. You can run a database seed
                                    now if you have one set up. You can run it using the artisan command:</p>
                                <pre>php artisan db:seed</pre>
                                <p>Or if you do not have a seed setup then you can run:</p>
                                <pre>php artisan tinker</pre>
                                <p>This opens up a console where you can add Laravel commands and execute them
                                    immediately. To make a new default user for example you could use:</p>
                                <pre>$user = new App\User;
$user-&gt;name = '<span style="color: #ff0000;">Alex Curtis</span>';
$user-&gt;email = '<span style="color: #ff0000;"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="97f6fbf2efd7f2eff6fae7fbf2b9f4f8fa">[email&#160;protected]</a></span>';
$user-&gt;password = Hash::make('<span style="color: #ff0000;">password</span>');
$user-&gt;save();

exit</pre>
                                <p>This will create a user in our database named <code>Alex Curtis</code> with an email
                                    of
                                    <code><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="751419100d35100d14180519105b161a18">[email&#160;protected]</a></code>
                                    and a password of <code>password</code> (it will save the hashed version of course,
                                    but <code>password</code> would be the password we type in).</p>
                                <p>You might also need to start a queue worker and other various tasks like that. But if
                                    you navigate over the browser you should now have access to your full application in
                                    its entirety.</p>
                                <h2>Step 20: Share with Your Friends</h2>
                                <p>You have a world wide url now to share your server with your friends. Tweet it out to
                                    <a href="https://twitter.com/_jacurtis">@_jacurtis</a> on twitter so that I can see
                                    it as well. Also if you found this ultimate guide helpful, be sure to share it
                                    wherever great Laravel content is consumed.</p>
                            </div>
                        </div>
                    </div><!-- end layoutContent -->
                </div><!-- end container -->

            </article>
        </main>
    </div>
    <!-- siteWrap -->

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-578eb5c130c742eb"
        async="async"></script>

    <script type='text/javascript'>
        /* <![CDATA[ */
var thirsty_global_vars = {"home_url":"\/\/devmarketer.io","ajax_url":"https:\/\/devmarketer.io\/wp-admin\/admin-ajax.php","link_fixer_enabled":"yes","link_prefix":"recommends","link_prefixes":["recommends"],"post_id":"546","enable_record_stats":"yes","enable_js_redirect":"yes","disable_thirstylink_class":""};
/* ]]> */
    </script>
    <script type='text/javascript'
        src='https://devmarketer.io/wp-content/plugins/thirstyaffiliates/js/app/ta.js?ver=3.4.0'></script>
    <script type='text/javascript'>
        /* <![CDATA[ */
var mdBoneVar = {"ajaxloadpost":{"ajaxurl":"https:\/\/devmarketer.io\/wp-admin\/admin-ajax.php","failText":"Error loading posts","loadingText":"Loading posts","noMoreText":"No more posts","query_vars":"{\"page\":\"\",\"name\":\"deploy-laravel-5-app-lemp-stack-ubuntu-nginx\"}","startPage":1,"maxPages":0},"stickySidebar":{"toggle":"1","offsetTop":104},"stickyHeader":{"toggle":"1","hasAdminBar":false},"smoothScroll":"1","postLike":{"nonce":"b2f6ab92a6","likeText":"Like","likeCountTextSingular":"like","likeCountText":"likes","unlikeText":"Unlike"},"faFallBack":{"toggle":"1","faURL":"https:\/\/devmarketer.io\/wp-content\/themes\/bone\/lib\/vendor\/font-awesome\/css\/font-awesome.min.css"},"currentRelURI":"\/learn\/deploy-laravel-5-app-lemp-stack-ubuntu-nginx\/","parallaxToggle":"1","highResolution":"1","sliderOpts":{"autoplay":true,"timeout":5000}};
/* ]]> */
    </script>
    <script type='text/javascript' src='https://devmarketer.io/wp-content/themes/bone/js/md-scripts.js?ver=2.0.0'>
    </script>
    <script type='text/javascript' src='https://devmarketer.io/wp-includes/js/comment-reply.min.js?ver=4.9.18'></script>
    <script type='text/javascript'
        src='https://devmarketer.io/wp-content/plugins/ank-prism-for-wp/out/prism-js.min.js?ver=1517873422'></script>
    <script type='text/javascript' src='https://devmarketer.io/wp-includes/js/wp-embed.min.js?ver=4.9.18'></script>
    <script async="async" type='text/javascript'
        src='https://devmarketer.io/wp-content/plugins/akismet/_inc/form.js?ver=4.0.8'></script>
</body>

</html>