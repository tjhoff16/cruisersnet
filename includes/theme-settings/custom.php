<?php 

//add_action( 'gform_after_submission', 'marinas_post_update', 10, 2 );
function marinas_post_update( $entry, $form ) {

    //getting post
    $post = get_post( $entry['post_id'] );
	//echo "<pre>";print_r($entry);
	$marinas_email = get_post_meta($entry['post_id'], 'marinas_email',true );
	$marina_address = get_post_meta($entry['post_id'], 'marina_address',true );
	$marinas_title = get_the_title( $entry['post_id'] );
	$send_mail = $entry['81.1'];
	$send_mail_fuel_update = $entry['18.1'];
	 
	 if($send_mail == "Yes" || $send_mail_fuel_update == "Yes" ){
		
			$to = 'paygudeg@gmail.com';             
			$subject = 'Send me more Salty Southeast Cruisers’ Net information cards to provide cruisers'; 
			$from    = $marinas_email;   
			$imgSrc   = get_template_directory_uri(); 
			$imgDesc  = 'Marinas  logo'; 
			$imgTitle = 'Site Logo'; 


			$subjectPara1 = 'Send me more Salty Southeast Cruisers’ Net information cards to provide cruisers.'; 
			$Marinas_link = "Marinas Web Link: ".get_permalink($entry['post_id']); 

			$message = '<!DOCTYPE HTML>'. 
			'<head>'. 
			'<meta http-equiv="content-type" content="text/html">'. 
			'<title>Email reminder to update fuel Info</title>'. 
			'</head>'. 
			'<body>'. 
			'<div id="header" style="width: 80%;height: 60px;margin: 0 auto;padding: 10px;color: #fff;text-align: center;background-color: #002366;font-family: Open Sans,Arial,sans-serif;">'. 
			   '<img height="50" width="220" style="border-width:0" src="'.$imgSrc.'/images/cnet-logo-2014.png" alt="'.$imgDesc.'" title="'.$imgTitle.'">'. 
			'</div>'. 

			'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
			   '<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
				   '<p>'.$subjectPara1.'</p>'. 
				   '<p>Marinas Name:'.$marinas_title.'</p>'.  
				   '<p>Marinas Email Address:'.$marinas_email.'</p>'.
			   '</div>'.   
			'</div>'. 

			'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;color: #fff;text-align: center;padding: 10px;font-family: Verdena;background-color: #002366;">'. 
			   '@'.date('Y').' Salty Southeast Cruisers  Net - All Rights Reserved'. 
			'</div>'. 
			'</body>';


			$headers  = "From: " . $from . "\r\n"; 
			$headers .= "Reply-To: ". $from . "\r\n"; 
			$headers .= "CC: test@example.com\r\n"; 
			$headers .= "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 

					if(wp_mail($to, $subject, $message, $headers)) 
					{ 
						echo 'Email sent successfully!'; 
					} 
					else 
					{ 
						echo 'Problem sending HTML email!'; 
					} 
	}
	if( $entry['form_id'] == 7 || $entry['form_id'] == 6 ){ 
	update_post_meta($entry['post_id'], 'marina_reporting_date',date("Y-m-d") );	
	}
	 $marina_reporting_date = get_post_meta($entry['post_id'], 'marina_reporting_date',true );	
  
}

/**
 * Declaring the form fields
 */
function show_marina_user_profile_fields( $user ) {
   $sub_user_account = get_user_meta( $user->ID, 'marina_sub_user', true ); ?>
   <table class="form-table">
	<tbody>
    <tr class="form-field">
       <th scope="row"><label for="my-field"><?php _e('Sub User Account Of') ?> </label></th>
       <td>
		<select name="marina_sub_user" id="marina_sub_user">
		<option value="0">Select</option>
		<?php $blogusers = get_users();		
		foreach ( $blogusers as $user ) {
		?>
		<option value="<?php echo $user->ID; ?>" <?php echo selected($sub_user_account, $user->ID, false); ?>><?php echo  $user->display_name; ?></option>	
		<?php } ?>
		</select>
		</td>
	</tr>
	</tbody>
	</table >
<?php
}
add_action( 'show_user_profile', 'show_marina_user_profile_fields' ); 
add_action( 'edit_user_profile', 'show_marina_user_profile_fields' );
add_action( 'user_new_form', 'show_marina_user_profile_fields' ); 

/**
 * Saving my form fields
 */
function marina_user_profile_fields( $user_id ) {
    update_user_meta( $user_id, 'marina_sub_user', $_POST['marina_sub_user'] );
}
add_action( 'personal_options_update', 'marina_user_profile_fields' ); //for profile page update
add_action( 'edit_user_profile_update', 'marina_user_profile_fields' ); //for profile page update
add_action( 'user_register', 'marina_user_profile_fields' ); //for user-new.php page new user addition


function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url('marina');
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

add_filter( 'show_password_fields', 'wpse_notification_html' );

function wpse_notification_html( $show )
{
    if( current_user_can( 'manage_options' ) ):
?>
    <tr>
        <th scope="row">
            <label for="wpse_send_notification"><?php _e('Send a notification?') ?></label>
        </th>
    <td>
            <label for="wpse_send_notification">
                <input type="checkbox" name="wpse_send_notification" id="wpse_send_notification" value="1" />
                <?php _e( 'Send an email to user and notify that the password has changed.' ); ?>
            </label>
        </td>
    </tr>
<?php
    endif;
    return $show;
}
add_action( 'edit_user_profile_update', 'wpse_user_update' );
add_action( 'personal_options_update',  'wpse_user_update' );

function wpse_user_update( $user_id )
{
    if( current_user_can( 'manage_options' ) )
        add_action( 'profile_update', 'wpse_controller', 10, 2 );
}

function wpse_controller( $user_id, $old_user_data )
{
    // Input:
    $pass1  = filter_input( INPUT_POST, 'pass1' );
    $pass2  = filter_input( INPUT_POST, 'pass2' );
    $send   = filter_input( INPUT_POST, 'wpse_send_notification', FILTER_SANITIZE_NUMBER_INT );

    // Run this action only once:
    remove_action( current_action(), __FUNCTION__ );

    // Send the notification:
    if( 1 == $send )
    {
       if( ! empty( $pass1 )
           && $pass1 === $pass2
           && sanitize_text_field( $pass1 ) === $pass1
       ):
            if( wpse_user_password_notification( $user_id, wp_unslash( sanitize_text_field( $pass1 ) ) ) )
                add_filter( 'wp_redirect', 'wpse_redirect_notification_success' );
            else
                add_filter( 'wp_redirect', 'wpse_redirect_notification_error' );
       else:
                add_filter( 'wp_redirect', 'wpse_redirect_pass_validation_error' );
       endif;
    }
}
function wpse_redirect_notification_success( $location )
{
    return add_query_arg( 'wpse_notification', 'mail_success', $location );
}

function wpse_redirect_notification_error( $location )
{
    return add_query_arg( 'wpse_notification', 'mail_error', $location );
}

function wpse_redirect_pass_validation_error( $location )
{
    return add_query_arg( 'wpse_notification', 'pass_validation_error', $location );
}

function wpse_user_password_notification( $user_id, $plaintext_pass = '' )
{
    if ( empty( $plaintext_pass ) )
       return false;

    $user = get_userdata( $user_id );
    $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
    $message  = sprintf( __( 'Username: %s' ),     $user->user_login ) . "\r\n";
    $message .= sprintf( __( 'New Password: %s' ), $plaintext_pass   ) . "\r\n";
    $message .= wp_login_url() . "\r\n";
    return wp_mail( $user->user_email, sprintf(__('[%s] Your username and new password'), $blogname), $message );
}
add_action( 'admin_notices', 'wpse_admin_notices' );

function wpse_admin_notices()
{
    $status = filter_input( INPUT_GET, 'wpse_notification', FILTER_SANITIZE_STRING );

    switch ( $status )
    {
        case 'mail_success':
            ?><div id="message" class="updated"><p><strong>Notification Sent!</strong>: Notification email successfully sent to the user</p></div><?php
            break;  
        case 'mail_error':
            ?><div class="error"><p><strong>ERROR</strong>: Notification email not sent to the user</p></div><?php
            break;
        case 'pass_validation_error':
            ?><div class="error"><p><strong>ERROR</strong>: Notification email not sent to the user, because of symbol chars in the password </p></div><?php
            break;
    } // end switch
}