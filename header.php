<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'pl-body' ); ?>>
<div class="pl-body__header">

</div>
<?php

global $wp_customizer;

/*dump(get_theme_mods());
dump(get_theme_mod('header_rows_setting'));
dump(get_theme_mod('footer_rows_setting', 'lala'));*/

$headerRows = \Prior\Customizer\Customizer::getSetting('header_rows_setting');
$headerBg = \Prior\Customizer\Customizer::getSetting('header_bg_setting');
$footerRows = \Prior\Customizer\Customizer::getSetting('header_footer_setting');
dump($headerRows);
dump($headerBg);
dump($footerRows);