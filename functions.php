<?php

/**
 * Cruisers' Net Setup
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */

// Enable this if SSL fails - DISABLE AFTERWORD TO MAINTAIN SECURITY!!!!!!!
// This was required to update AdRotate Plugin for some reason.
// add_filter('https_ssl_verify', '__return_false');

if (!function_exists('cnet_setup')) :
    function cnet_setup() {
        // add theme support
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );

    }
endif; // end cnet_setup
add_action( 'after_setup_theme', 'cnet_setup' );

// custom functions
include_once('includes/custom-functions.php');

// custom filters
include_once('includes/filters.php');

// load all required theme files
include_once('includes/loader.php');

function wpa_107371_meta_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    // only change the query on a custom taxonomy
    // can check for a specific taxonomy if desired
    if ( is_tax('cnet_regions_marinas') ) {
        //define our meta query
              $meta_query = array(
                    'key'=>'not_a_marina',
                    'value'=>'no',
                    'compare'=>'!=',
                );
         $query->set('meta_query',$meta_query);
        return;
    }

}
//add_action( 'pre_get_posts', 'wpa_107371_meta_query' );

function ssecn_register_query_vars( $vars ) {
        return $vars;
    }
add_filter( 'query_vars', 'ssecn_register_query_vars' );

function cnet_superadmin_cleanup() {
	$current_user = wp_get_current_user();
    /*
	if ($current_user->user_login != "admin") {
		remove_menu_page('plugins.php');
		remove_menu_page('themes.php');
		remove_menu_page('link-manager.php');
		remove_menu_page('options-general.php');
		remove_menu_page('tools.php');
		remove_menu_page('users.php');
		remove_menu_page('edit.php?post_type=acf');
		remove_menu_page('duplicator');
		remove_menu_page('wpcf7');
		remove_menu_page('quick_cache');
		remove_menu_page('WP-Optimize');
		remove_menu_page('gadash_settings');
	}
     */
}
add_action('admin_menu', 'cnet_superadmin_cleanup', 99);

$test_user = wp_get_current_user();

//if ($test_user->user_login == 'admin') {
require('includes/facebook/post.php');
//}

add_filter('redirect_canonical','pif_disable_redirect_canonical');
function pif_disable_redirect_canonical($redirect_url) {
    if (is_singular()) $redirect_url = false;
    return $redirect_url;
}

    function add_theme_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-widget' );
        wp_enqueue_script( 'jquery-ui-mouse' );
        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'jquery-ui-slider' );
        wp_enqueue_script( 'jquery-ui-tabs' );
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( 'jquery-ui-draggable' );
        wp_enqueue_script( 'jquery-ui-droppable' );
        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 'jquery-ui-resize' );
        wp_enqueue_script( 'jquery-ui-dialog' );
        wp_enqueue_script( 'jquery-ui-button' );
        //
        //  Styles
        //
        $templateDir = "/wp-content/themes/CruisersNet";
        wp_enqueue_style( 'wp-jquery-ui-dialog' );
        CUSTOM_my_enqueue( 'earthnc_v3',"/charts/css/earthnc_v3.css");
        CUSTOM_my_enqueue( 'weather',   "/charts/weather/css/weather.css");
        CUSTOM_my_enqueue( 'icoMoon',   $templateDir . '/css/icoMoon.css');
        CUSTOM_my_enqueue( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
        CUSTOM_my_enqueue( 'w3',        "https://www.w3schools.com/w3css/4/w3.css");
        CUSTOM_my_enqueue( 'styles',    $templateDir . '/css/styles.css');
        // *** NOTE: FONT-AWESOME is added via PLUGIN
        //
        //  Scripts
        //    Discussion on async / defer : https://www.growingwiththeweb.com/2014/02/async-vs-defer-attributes.html
        //
        $deferScripts = [
        'google_maps'         => 'https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC7d-LKrHTDVMoWoeDdDBCHOjElj3d1MuE&libraries=geometry,weather',
        'bootstrap'           => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        'questions'           =>  $templateDir . '/js/questions.js',
        'loader'              => 'https://www.gstatic.com/charts/loader.js',
        'OpenLayers'          => 'https://openlayers.org/api/OpenLayers.js',
        'OWM.OpenLayers'      => 'https://openweathermap.org/js/OWM.OpenLayers.1.3.4.js',
        'ssecnhydro'          => '/charts/js/ssecnhydro.js',
        'ssecnutils'          => '/charts/js/ssecnutils.js',
        'ssecnchartview'      => '/charts/js/ssecnchartview.js',
        'markerwithlabel'     => '/charts/js/markerwithlabel.js',
        'ssecnrouting'        => '/charts/js/ssecnrouting.js',
        'ssecnwaterways'      => '/charts/js/ssecnwaterways.js',
        'ssecncookie'         => '/charts/js/ssecncookie.js',
        'ssecntide'           => '/charts/js/ssecntide.js',
        'wmsMapType'          => '/charts/js/wmsMapType.js',
        'suncalc'             => '/charts/js/suncalc.js',
        'ssecnweatheroverlay' => '/charts/js/ssecnweatheroverlay.js',
        'zoomTMSLayer'        => '/charts/js/zoomTMSLayer.js',
        'skycons'             => '/charts/weather/js/skycons.js',
        'heatmap.min'         => '/charts/js/heatmap/build/heatmap.min.js',
        'gmaps-heatmap'       => '/charts/js/heatmap/plugins/gmaps-heatmap.js',
        'custom-async'        => $templateDir . '/js/custom.js',
        'google-webfont'      => 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js',
        'google-fonts'        => $templateDir . '/js/google-fonts.js',
        'jquery-easing'       => $templateDir . '/js/jquery.easing.js',
        'jquery-tools'        => $templateDir . '/js/jquery.tools.js',
        // Not needed - only needed in charlet.php file
        // 'earthnc'             => '/charts/js/earthncjs.js',
        'cv-widget'           => $templateDir . '/js/cv-widget.js?ver=1'];
        foreach ( $deferScripts as $scriptKey=>$scriptPath ) {
            $handle=$scriptKey . '-defer';
            CUSTOM_my_enqueue($handle, $scriptPath);
            //wp_register_script($handle, $scriptPath, '', 2, false);
            //wp_enqueue_script($handle);
        }
        $asyncScripts = [];
        foreach ( $asyncScripts as $scriptKey=>$scriptPath ) {
            $handle=$scriptKey . '-async';
            CUSTOM_my_enqueue($handle, $scriptPath);
            //wp_register_script($handle, $scriptPath, '', 2, false);
            //wp_enqueue_script($handle);
        }
        $standardScripts = [];
        foreach ( $standardScripts as $scriptKey=>$scriptPath ) {
            $handle=$scriptKey . '';
            CUSTOM_my_enqueue($handle, $scriptPath);
            //wp_register_script($handle, $scriptPath, '', 2, false);
            //wp_enqueue_script($handle);
        }
    }
add_action( 'wp_enqueue_scripts',   'add_theme_scripts' );
    
     // FROM: https://gist.github.com/tovic/d7b310dea3b33e4732c0
    function CUSTOM_my_enqueue($handle, $path) {
        $debug=TRUE;
        if ( $debug ) echo "<!-- \n";
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $urlReferenced = strpos($path, 'http://') === 0 ||  strpos($path, 'https://') === 0 ||
                         strpos($path, 'https://maps.googleapis.com') === 0;
        /*
        //  ***** BY PASSING *****
        if ( $extension==='css' ) {
            wp_enqueue_style( $handle,   $path );
            return;
        } else if ( $extension==='js' )  {
            wp_register_script($handle, $path, '', 2, false);
            wp_enqueue_script($handle);
            return;
        }
        */
        if ( $debug ) echo " Processing: $handle : $path  \n";
        $rootDir = $_SERVER['DOCUMENT_ROOT'];
        if ( $debug ) echo " Root Dir: $rootDir \n";

        if ( ! file_exists($rootDir.$path) && ! $urlReferenced ) {
            if ( $debug ) echo "  DOES NOT EXIST: $handle : $path at $rootDir$path \n";
            return;
        }
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if ( $extension!=='css' && $extension!=='js' ) {
            if ( $debug ) echo " Extension is bad: $extension \n";
            return;
        }
        $handle_enqueue = $handle . '-min';
        $path_enqueue = substr_replace($path, "min.$extension", strlen($path)-strlen($extension) );
        if ( $debug ) echo " handle_enqueue : path_enqueue are: $handle_enqueue : $path_enqueue\n";
        if ( $debug && ! $urlReferenced ) echo file_exists($rootDir . $path_enqueue) ? " path_enqueue EXISTS\n" : " path_enqueue DOES NOT EXIST\n";
        //  See if we should minify
        $makeMinify=false;
        $useMinified=true;
        if ( $urlReferenced ) {
            if ( $debug ) echo ' NO MINIFY - URL Referenced path' . "\n";
            $useMinified=false;
            $makeMinify=false;
        } else if ( isset($_GET['minify']) && $_GET['minify']==='false' ) {
            if ( $debug ) echo ' NO MINIFY - _GET[minify] is set to false  ' . "\n";
            $useMinified=false;
            $makeMinify=false;
        } else if ( ! file_exists($rootDir.$path_enqueue) ) {
            if ( $debug ) echo " Min file does not already exist \n";
            $makeMinify=true;
        } else {
            if ( filemtime($rootDir . $path_enqueue)<filemtime($rootDir . $path) )  {
                if ( $debug ) echo ' Std file modifiy time A: ' . filemtime($rootDir . $path) . "\n";
                if ( $debug ) echo ' Min file modifiy time A: ' . filemtime($rootDir . $path_enqueue) . "\n";
                if ( $debug ) echo " Min file exists but is OLDER than std file and needs to be deleted\n";
                if ( unlink($rootDir.$path_enqueue) ) {
                    if ( $debug ) echo " SUCCESSFULLY unlinked $rootDir$path_enqueue \n";
                    $makeMinify=true;
                } else {
                    if ( $debug ) echo " UNLINKED *FAILED* $rootDir$path_enqueue \n";
                }
            } else {
                if ( $debug ) echo ' Std file modifiy time B: ' . filemtime($rootDir . $path) . "\n";
                if ( $debug ) echo ' Min file modifiy time B: ' . filemtime($rootDir . $path_enqueue) . "\n";
                if ( $debug ) echo " Min file exists but is NEWER than std file \n";
            }
        }
        if ( ! $useMinified ) {
            if ( $debug ) echo " useMinified is FALSE \n";
            $handle_enqueue = $handle;
            $path_enqueue = $path;
        } else if ( ! $makeMinify ) {
            if ( $debug ) echo " makeMinify is FALSE \n";
            if ( ! file_exists($rootDir.$path_enqueue) ) {
                $handle_enqueue = $handle;
                $path_enqueue = $path;
            }
        } else {
            if ( $debug ) echo " doMinify is TRUE \n";
            if ( $debug ) echo " Minifying Std: $rootDir$path  \n";
            if ( $debug ) echo " To Min:        $rootDir$path_enqueue \n";
            //  Create new min versions since std version is newer than min version
            include_once(get_template_directory() . '/php-html-css-js-minifier.php');
            $data = file_get_contents($rootDir.$path);
            $stdSize = filesize($rootDir.$path);
            if ( $debug ) echo " Std Size: $stdSize\n";
            $minified = $extension==='css' ? minify_css($data) : minify_js($data);
            file_put_contents($rootDir.$path_enqueue, $minified);
            $minSize = filesize($rootDir.$path_enqueue);
            $sizeReduction = -100*($stdSize-$minSize)/$stdSize;
            if ( $debug ) echo " Min Size: $minSize Reduction in size: $sizeReduction %\n";
            if ( ! file_exists($rootDir.$path_enqueue) || ! filesize($rootDir.$path_enqueue)>0 ) {
                if ( $debug ) echo " Min file either does not exist or file size is zero\n";
                $handle_enqueue=$handle;
                $path_enqueue=$path;
            }
        }
        //  Enqueue
        if ( $debug ) echo " ENQUEUEING -  $handle_enqueue : $path_enqueue \n";
        if ( $extension==='css' ) {
            wp_enqueue_style( $handle_enqueue,   $path_enqueue );
        } else if ( $extension==='js' )  {
            wp_register_script($handle_enqueue, $path_enqueue, '', 2, false);
            wp_enqueue_script($handle_enqueue);
        }
        if ( $debug ) echo "-->\n";
    }

// From: https://stackoverflow.com/questions/18944027/how-do-i-defer-or-async-this-wordpress-javascript-snippet-to-load-lastly-for-fas
if( ! is_admin() ) {
    function add_asyncdefer_attribute($tag, $handle) {
        if      ( strpos($handle, 'async') !== false ) return str_replace( '<script ', '<script async ', $tag );
        else if ( strpos($handle, 'defer') !== false ) return str_replace( '<script ', '<script defer ', $tag );
        else                                           return $tag;
    }
    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}

function redirect_after_comment($location) { return $_SERVER["HTTP_REFERER"]; }
add_filter('comment_post_redirect', 'redirect_after_comment');

    class WP_HTML_Compression {
        protected $compress_css = true;
        protected $compress_js = true;
        protected $info_comment = true;
        protected $remove_comments = true;
        
        protected $html;
        public function __construct($html) {
            if (!empty($html)) {
                $this->parseHTML($html);
            }
        }
        public function __toString() {
            return $this->html;
        }
        protected function bottomComment($raw, $compressed) {
            $raw = strlen($raw);
            $compressed = strlen($compressed);
            $savings = ($raw-$compressed) / $raw * 100;
            $savings = round($savings, 2);
            return '<!-- HTML Minify | https://fastwp.de/2044/ | Größe reduziert um '.$savings.'% | Von '.$raw.' Bytes, auf '.$compressed.' Bytes -->';
        }
        protected function minifyHTML($html) {
            $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
            preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
            $overriding = false;
            $raw_tag = false;
            $html = '';
            foreach ($matches as $token) {
                $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
                $content = $token[0];
                if (is_null($tag)) {
                    if ( !empty($token['script']) ) {
                        $strip = $this->compress_js;
                    }
                    else if ( !empty($token['style']) ) {
                        $strip = $this->compress_css;
                    }
                    else if ($content == '<!--wp-html-compression no compression-->') {
                        $overriding = !$overriding;
                        continue;
                    }
                    else if ($this->remove_comments) {
                        if (!$overriding && $raw_tag != 'textarea') {
                            $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                        }
                    }
                }
                else {
                    if ($tag == 'pre' || $tag == 'textarea') {
                        $raw_tag = $tag;
                    }
                    else if ($tag == '/pre' || $tag == '/textarea') {
                        $raw_tag = false;
                    }
                    else {
                        if ($raw_tag || $overriding) {
                            $strip = false;
                        }
                        else {
                            $strip = true;
                            $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                            $content = str_replace(' />', '/>', $content);
                        }
                    }
                }
                if ($strip) {
                    $content = $this->removeWhiteSpace($content);
                }
                $html .= $content;
            }
            return $html;
        }
        public function parseHTML($html) {
            $this->html = $this->minifyHTML($html);
            if ($this->info_comment) {
                $this->html .= "\n" . $this->bottomComment($html, $this->html);
            }
        }
        protected function removeWhiteSpace($str) {
            $str = str_replace("\t", ' ', $str);
            $str = str_replace("\n",  '', $str);
            $str = str_replace("\r",  '', $str);
            while (stristr($str, '  ')) {
                $str = str_replace('  ', ' ', $str);
            }
            return $str;
        }
    }
        function wp_html_compression_finish($html) { return new WP_HTML_Compression($html); }
        function wp_html_compression_start()       { ob_start('wp_html_compression_finish'); }
        // NO HTML COMPRESSION add_action('get_header', 'wp_html_compression_start');
    ?>
