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
    if(array_key_exists('submit_scripts', $_POST))
    {
        /*Update function from WP */
        update_option('header-scripts-text', $_POST['header-scripts']);
        update_option('footer-scripts-text', $_POST['footer-scripts']);

        ?>
        <div>
            <strong>
                Updated
            </strong> 
        </div>
        <?php 
    }

    $header_scripts = get_option('header-scripts-text', 'none');
    $footer_scripts = get_option('footer-scripts-text', 'none');

    ?>
    <div class="wrap">
        <h2>Update Scripts on the header and footer</h2>
        <form action="" method="post">
            <label for="header-scripts">header Scripts</label>
            <textarea name="header-scripts" class="large-text" id="">
                <?php 
                    print($header_scripts);
                ?>
            </textarea>
            <label for="footer-scripts">Footer Scripts</label>
            <textarea name="footer-scripts" class="large-text" id="">
                <?php 
                    print($footer_scripts);
                ?>
            </textarea>
            <input type="submit" name="submit_scripts" class="button button-primary"value="submit">
        </form>
    </div>
    <?php
}

add_action("admin_menu", 'adminMenuOption');

function displayHeaderScripts()
{
    $header_scripts = get_option('header-scripts-text', 'none');

    print $header_scripts;
}

add_action('wp_head', 'displayHeaderScripts');


function displayFooterScripts()
{
    $footer_scripts = get_option('footer-scripts-text', 'none');

    print $footer_scripts;
}

add_action('wp_footer', 'displayFooterScripts');

/* 
    GETTING E-MAIL
*/

function wpForm()
{
    $content = '<form method="post" action="http://localhost/plugin_wp/index.php/thank-you/">';
        $content .= '<input type="text" name="full_name" placeholder="Your full name"><br>';
        $content .= '<input type="text" name="email" placeholder="Your E-mail"><br>';
        $content .= '<input type="text" name="phone" placeholder="Your Phone Number"><br>';
        $content .= '<textarea name="comments" placeholder = "comments"></textarea><br>';
        $content .= '<input type="submit" name="submitForm" value="SUBMIT YOUR INFORMATION"><br>';
    $content .= '</form>';

    return $content;
}

add_shortcode('ViniciusForm','wpForm'); 

function setHtmlContentType()
{
    return 'text/html';
}

function wpFormCapture()
{
    if(array_key_exists('submitForm', $_POST))
    {
        $to = "agavi2014@hotmail.com";
        $subject = "Exemple In my plugin development";
        $body = 'Name: '.$_POST['full_name'].'<br>';
        $body .= 'Email: '.$_POST['email'].'<br>';
        $body .= 'Phone Number: '.$_POST['phone'].'<br>';
        $body .= 'Comments: '.$_POST['comments'].'<br>';

        add_filter('wp_mail_content_type', 'setHtmlContentType');

        wp_mail($to, $subject, $body);

        remove_filter('wp_mail_content_type', 'setHtmlContentType');
    }
}

add_action('wp_head', 'wpFormCapture');