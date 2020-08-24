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
    $header_scripts = get_option('header-scripts', 'none');
    $footer_scripts = get_option('footer-scripts', 'none');
    ?>
    <div class="wrap">
        <h2>Update Scripts on the header and footer</h2>

        <label for="header-scripts">header Scripts</label>
        <textarea name="header-scripts" class="large-text" id="" cols="30" rows="10">
            <?php 
                print($header_scripts);
            ?>
        </textarea>
        <label for="footer-scripts">Footer Scripts</label>
        <textarea name="footer-scripts" class="large-text" id="" cols="30" rows="10">
            <?php 
                print($footer_scripts);
            ?>
        </textarea>
    </div>
    <?php
}

add_action("admin_menu", 'adminMenuOption');
