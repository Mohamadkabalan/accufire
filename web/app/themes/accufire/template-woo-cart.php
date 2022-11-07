<?php
/*
Template Name: Cart
*/

    $context = Timber::get_context();
    $context['post'] = new TimberPost();
    $template = ['page-cart.twig'];
    Timber::render($template, $context);
