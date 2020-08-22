<?php
/**
 * Short-Code
 *
 * Plugin Name: Short-code
 * Plugin URI:  https://github.com/DEVinicius
 * Description: Create a Link on Astra Theme and redirect to other page
 * Version:     1.0
 * Author:      Vinícius Pereira de Oliveira
 * Author URI:  https://github.com/WordPress/classic-editor/
 * License:     GPLv2 or later
 * Text Domain: Show Json
 */

function addShortCode()
{
     $text = "<div>";
     $text .= "<a href='#'> Botao </a>";
     $text .= "<div>";

     return $text;
}

add_shortcode('button','addShortCode');

function adminMenuOption()
{   
    //name, title
    add_menu_page('header & footer scripts', 'site Scripts', 'manage_options', 'adminMenuOptions', 'scriptsPage','',200);
}

function scriptsPage()
{
    
}

add_action("admin_menu", 'adminMenuOption');
