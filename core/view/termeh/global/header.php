<?php
/**
 * The header template file
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpArch
 */

/*
* Codebox SEO
**/
define('CB_Title', wp_title(' ~ ',false,'right').get_bloginfo('name'));
define('CB_Canonical', get_permalink());

$CB_IMG_Full = (has_post_thumbnail()) ? get_the_post_thumbnail_url(null,'full') : CB_IMG.'/IMG_Full.jpeg';
$CB_IMG_Medium = (has_post_thumbnail()) ? get_the_post_thumbnail_url(null,'medium') : CB_IMG.'/IMG_Medium.jpeg';
$CB_IMG_Thumbnail = (has_post_thumbnail()) ? get_the_post_thumbnail_url(null,'thumbnail') : CB_IMG.'/IMG_Thumbnail.jpeg';

$CB_Publisher = array(
    'DC'  =>  '',
    'og'  =>  '',
    'twitter'  =>  ''
);

?>
    <!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Main Meta -->
    <base href='<?= site_url() ?>/'>
    <link rel="author" href="<?= site_url() ?>/humans.txt">
    <meta name="generator" content="wordpress">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--- Codebox Data -->
    <meta name="cb-url" content="<?= site_url() ?>">
    <meta name="cb-cdn" content="<?= CB_CDN ?>">
    <meta name="cb-css" content="<?= CB_CSS ?>">
    <meta name="cb-img" content="<?= CB_IMG ?>">
    <meta name="cb-js" content="<?= CB_JS ?>">
    <!--- Prefetch -->
    <link rel='dns-prefetch' href="<?= CB_CDN ?>">
    <!--- Verification -->
    <!-- <meta name="yandex-verification" content=" "> -->
    <!-- <meta name="p:domain_verify" content=" "> -->
    <!-- <meta name="samandehi" content=" "> -->
    <!-- Alternative -->
<?php if (CB_Canonical): ?><link rel="canonical" href="<?= CB_Canonical ?>"><?php endif; ?>
    <link rel="alternate" type="application/rss+xml" title="Posts RDF/RSS 1.0 Feed" href=" <?php bloginfo( 'rdf_url' ); ?>" />
    <link rel="alternate" type="application/rss+xml" title="Posts Atom Feed" href=" <?php bloginfo( 'atom_url' ); ?>" />
    <link rel="alternate" type="application/rss+xml" title="Posts RSS 0.92 Feed" href=" <?php bloginfo( 'rss_url' ); ?>" />
    <link rel="alternate" type="application/rss+xml" title="Posts RSS 2.0 Feed" href=" <?php bloginfo( 'rss2_url' ); ?>" />
    <link rel="alternate" type="application/rss+xml" title="Comments Atom Feed" href=" <?php bloginfo( 'comments_atom_url' ); ?>" />
    <link rel="alternate" type="application/rss+xml" title="Comments RSS 2.0 Feed" href=" <?php bloginfo( 'comments_rss2_url' ); ?>" />
    <!-- <link rel="alternate" href=" " hreflang="fa-ir"> -->
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= CB_IMG ?>/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= CB_IMG ?>/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= CB_IMG ?>/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= CB_IMG ?>/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= CB_IMG ?>/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= CB_IMG ?>/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= CB_IMG ?>/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= CB_IMG ?>/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= CB_IMG ?>/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= CB_IMG ?>/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= CB_IMG ?>/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= CB_IMG ?>/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= CB_IMG ?>/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= CB_IMG ?>/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= CB_IMG ?>/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- page info -->
    <title><?= CB_Title ?></title>
    <meta name="description" content="<?= CB_Description ?>">
    <meta name='robots' content='index, follow'>
    <!-- Meta Data -->
    <meta name="DC.Date.Created" content="<?= get_the_date('c'); ?>">
    <meta name="DC.Type" content="text">
    <meta name="DC.Title" content="<?= CB_Title ?>">
    <meta name="DC.Description" content="<?= CB_Description ?>">
    <meta name="DC.Language" content="fa_IR">
    <meta name="DC.Publisher" content="<?= $CB_Publisher['DC'] ?>">
    <!--- Open Graph -->
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
    <meta property="og:image" content="<?= $CB_IMG_Full ?>">
    <meta property="og:description" content="<?= CB_Description ?>">
    <meta property="og:url" content="<?= site_url() ?>">
    <meta property="og:title" content="<?= CB_Title ?>">
    <meta property="article:publisher" content="<?= $CB_Publisher['og'] ?>">
    <!--- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="<?= $CB_Publisher['twitter'] ?>">
    <meta name="twitter:creator" content="<?= $CB_Publisher['twitter'] ?>">
    <meta name="twitter:image" content="<?= $CB_IMG_Full ?>">
    <meta name="twitter:description" content="<?= CB_Description ?>">
    <meta name="twitter:title" content="<?= CB_Title ?>">
    <!-- Custom -->

    <!-- Wordpress -->
<?php wp_head(); ?>
</head><?php include_once TEMPLATEPATH.'/inc/head.php'; ?>