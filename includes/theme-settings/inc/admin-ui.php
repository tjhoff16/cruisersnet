<?php
/** 
 * Add styles/classes to the "Styles" drop-down (Updated for WP 3.9+)
 */   
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );  
  
function tuts_mce_before_init( $settings ) {  
  
    $style_formats = array(  
        array(  
            'title' => 'Style - Claiborne\s Comments (Paragraph)',  
            'selector' => 'p',  
            'classes' => 'claiborne-comments'  
            ),
        array(
            'title' => 'Style - Claiborne\s Comments (Span)',  
            'selector' => 'span',  
            'classes' => 'claiborne-comments'  
            ),
        array(
            'title' => 'Style - Alert Text (Paragraph)',  
            'selector' => 'p',  
            'classes' => 'alert-comments'  
            ),
        array(
            'title' => 'Style - Alert Text (Span)',  
            'selector' => 'span',  
            'classes' => 'alert-comments'
            )
    );  
  
    $settings['style_formats'] = json_encode( $style_formats );
    
    // Manipulate "block_formats" (formerly "theme_advanced_blockformats")
    $settings['block_formats'] = 'Paragraph=p;Header 2=h2;Header 3=h3';
  
    return $settings;  
  
}

function my_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );