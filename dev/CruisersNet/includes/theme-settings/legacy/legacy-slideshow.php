<?php
if ( !class_exists('slideshowOptions') ) {  
  
    class slideshowOptions {  
        /** 
        * @var  string  $prefix  The prefix for storing custom fields in the postmeta table 
        */  
        var $prefix = 'ngg_gal_';  
        /** 
        * @var  array  $customFields  Defines the custom fields available 
        */  
        var $customFields = array(    
            array(
            	"name"			=> "ShowSlide",
            	"title"			=> "Slide Show On = 1 | Off = 0 or empty",
            	"description"	=> "",
            	"type"			=> "text",
            	"scope"			=>  array( "post", "page" ),
            	"capability"	=> "publish_pages"
            )
        );  
        /** 
        * PHP 4 Compatible Constructor 
        */  
        function slideshowOptions() { $this->__construct(); }  
        /** 
        * PHP 5 Constructor 
        */  
        function __construct() {  
            add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );  
            add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );  
            // Comment this line out if you want to keep default custom fields meta box  
            // add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );  
        }  
        /** 
        * Remove the default Custom Fields meta box 
        */  
        function removeDefaultCustomFields( $type, $context, $post ) {  
            foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {  
                //remove_meta_box( 'postcustom', 'post', $context );  
                //remove_meta_box( 'pagecustomdiv', 'page', $context );  
            }  
        }  
        /** 
        * Create the new Custom Fields meta box 
        */  
        function createCustomFields() {  
            if ( function_exists( 'add_meta_box' ) ) {  
                add_meta_box( 'slideshow-fields', 'Slideshow Options', array( &$this, 'displaySlideshowFields' ), 'page', 'normal', 'high' );  
                add_meta_box( 'slideshow-fields', 'Slideshow Options', array( &$this, 'displaySlideshowFields' ), 'post', 'normal', 'high' );
            }  
        }  
        /** 
        * Display the new Custom Fields meta box 
        */  
        function displaySlideshowFields() {  
            global $post;  
            ?>  
            <div class="form-wrap">  
                <?php  
                wp_nonce_field( 'slideshow-fields', 'slideshow-fields_wpnonce', false, true );  
                foreach ( $this->customFields as $customField ) {  
                    // Check scope  
                    $scope = $customField[ 'scope' ];  
                    $output = false;  
                    foreach ( $scope as $scopeItem ) {  
                        switch ( $scopeItem ) {  
                            case "post": {  
                                // Output on any post screen  
                                if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="post" )  
                                    $output = true;  
                                break;  
                            }  
                            case "page": {  
                                // Output on any page screen  
                                if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="page-new.php" || $post->post_type=="page" )  
                                    $output = true;  
                                break;  
                            }  
                        }  
                        if ( $output ) break;  
                    }  
                    // Check capability
                    if ( !current_user_can( $customField['capability'], $post->ID ) )  
                        $output = false;  
                    // Output if allowed  
                    if ( $output ) { ?>  
                        <div>  
                            <?php  
                            switch ( $customField[ 'type' ] ) {  
                                case "text": {  
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';  
                                    echo '<input style="background:#d8d8d8;" type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
                                    echo '<br /><br />';  
                                    break;  
                                }  
                                default: {  
                                    // Plain text field  - not using this at the moment.
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';  
                                    echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';  
                                    break;  
                                }  
                            }
                            ?>
                            <?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
                        </div>  
                    <?php  
                    }  
                } ?>
                <!-- Going ahead and putting this in a table to accommodate for more features down the road. -->
                
            </div>  
            <?php  
        }  
        /** 
        * Save the new Custom Fields values 
        */  
        function saveCustomFields( $post_id, $post ) {  
            if ( !wp_verify_nonce( $_POST[ 'slideshow-fields_wpnonce' ], 'slideshow-fields' ) )  
                return;  
            if ( !current_user_can( 'edit_post', $post_id ) )  
                return;  
            if ( $post->post_type != 'page' && $post->post_type != 'post' )  
                return;  
            foreach ( $this->customFields as $customField ) {  
                if ( current_user_can( $customField['capability'], $post_id ) ) {  
                    if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {  
                        update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $_POST[ $this->prefix . $customField['name'] ] );  
                    } else {  
                        delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );  
                    }  
                }  
            }  
        }  
  
    } // End Class  
  
} // End if class exists statement  
  
// Instantiate the class  
if ( class_exists('slideshowOptions') ) {  
    $slideshowOptions_var = new slideshowOptions();  
}  