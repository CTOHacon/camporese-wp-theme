<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Camporese
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $header_script = get_field('field_header_script', 'option');
    if ($header_script) {
        echo $header_script;
    }
    ?>
    <?php wp_head(); ?>
</head>

<body>
    <?php
    $body_script = get_field('field_body_script', 'option');
    if ($body_script) {
        echo $body_script;
    }

    component_header();

    ?>
    <main id="main">