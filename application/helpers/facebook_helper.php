<?php
/* ---- ---- ---- start TINY FACEBOOK FUNCTIONS ---- ---- ---- */
//FUNCTION 0.1
function fbh_get_user()
{
	$obj = & get_instance();			
	// Get User ID
	if(isset($_SESSION['fb_user_id'])){
		$_SESSION['fb_user_id'] = $obj->facebook_ext->getUser(); 		
		if($_SESSION['fb_user_id'] != 0) {
			//Graph API Call to get User's Details 				
			$_SESSION['fb_user_details'] = $obj->facebook_ext->api('/me'); 				
			//Graph API Call to get Acess Token
			$_SESSION['access_token'] = $obj->facebook_ext->getAccessToken(); 						
			return TRUE;
		}		
	}
}

//FUNCTION 0.2
function fbh_postCheckIn($fb_id, $fb_access_token)
{
	$obj = & get_instance();			
    $post=array(
        'access_token'=>  $fb_access_token,
        'message'=>'In for a battle & a possibly a free meal!',
        'place'=>'186013571442944',
        'coordinates' => json_encode(array(
               'latitude'  => '31.478443997997',
               'longitude' => '74.392839108239'
         ))
    );
    try
    {
	    $res = $obj->facebook_ext->api('/'.$fb_id.'/checkins', 'POST', $post);
    }
    catch(FacebookApiException $e)
    {
        $res = $e->getMessage();
    }
    return $res;
}
//FUNCTION 0.3
function fbh_initialize_fb_php($user_id = false) {
	try {
		if ( !$user_id ) $user_id = 'me?fields=id,name,email,picture';
		$obj = & get_instance();
		$user_data = $obj->facebook_ext->api('/'.$user_id);				
		
		if( !empty($user_data) ) {
			$_SESSION['fb_'.FB_APP_ID.'_user'] = $user_data;
		}		
		return $user_data;
	}	
	catch (FacebookApiException $exp) {	
		//pr($exp);		
		return false;
	}
}
//FUNCTION 0.4
function fbh_check_permission($permission_name = false) {
	try {
		if ( !$permission_name ) $permission_name = 'manage_pages';
		$obj = & get_instance();
		$permissions = $obj->facebook_ext->api("/me/permissions");				
		if( array_key_exists($permission_name, $permissions['data'][0]) ) {
			// Permission is granted!	
		} else {
			// We don't have the permission
			// Alert the user or ask for the permission!
			header( "Location: " . $obj->facebook_ext->getLoginUrl(array("scope" => $permission_name)) );
		}
	}	
	catch (FacebookApiException $exp) {	
		//pr($exp);		
		return false;
	}
}
//FUNCTION 0.5
function fbh_login_dialog() {
	try {
		$obj = & get_instance();
		// Allow Access And Extended Permissions 
		$loginUrl =  $obj->facebook_ext->getLoginUrl(array(	
														'redirect_uri'	=> FB_APP_PATH,
														'cancel_url'	=> FB_APP_CANCEL_URL,
														'scope'			=> FB_APP_REQUEST_PERMISSIONS													
													)
												);
		echo "<script type='text/javascript'>top.location.href = '".$loginUrl."';</script>";
		exit();	
	}	
	catch (FacebookApiException $exp) {	
		//pr($exp);		
		return false;
	}
}
/* ++++ ++++ ++++ end TINY FACEBOOK FUNCTIONS ++++ ++++ ++++ */
//FUNCTION 01
//Facebook Authentication and storing basic logged in user's variables in session
function facebook_auth()
{
	
	$obj = & get_instance();		
	//CASE: localhost
	if($_SERVER['HTTP_HOST']=="localhost") {
		$_SESSION['fb_user_id'] = TEMP_FB_USER_ID;
		$_SESSION['like_status'] = TEMP_PAGE_LIKE;
		$_SESSION['signed_reuqest'] = "";
		
		$_SESSION['fb_user_friends'] = array('data'=>array(
			0=>array('id'=>504369820,'name'=>'Roshan Ejaz'),
			1=>array('id'=>510077403, 'name'=>'Danish Elahi Khan'),
			2=>array('id'=>100002284293800,'name'=>'Naveed Aziz'),			
			)
		); 
		return false;
	}	
	
	// Get User ID
	$user = $obj->facebook_ext->getUser(); 
	//print_r($user); exit();
	
	// Allow Access And Extended Permissions 
	$loginUrl =  $obj->facebook_ext->getLoginUrl(array(
														'redirect_uri'	=> FB_APP_PATH,
														'cancel_url'	=> FB_APP_CANCEL_URL,
														'scope'			=> FB_APP_REQUEST_PERMISSIONS
													)
												);
	
	if(!$user) {
		echo "<script type='text/javascript'>top.location.href = '".$loginUrl."';</script>";
		exit;
	}
	else {
		try
		{
			//Get Facebook UserID	
			$_SESSION['fb_user_id']			= $obj->facebook_ext->getUser();
			//GraphAPI Call to get User's Details 				
			$_SESSION['fb_user_me']			= $obj->facebook_ext->api('/me'); 				
			//GraphAPI Call to get User's Friends
			$_SESSION['fb_user_friends']	= $obj->facebook_ext->api('/me/friends/');		
			
			$_SESSION['permissions'] = $obj->facebook_ext->api("/me/permissions");
			return $_SESSION;
		}
		catch (FacebookApiException $ex) {
			pr($ex);
			exit;
		}
	}
}

//FUNCTION 02
function signed_request()
{
	//CASE: localhost
	if($_SERVER['HTTP_HOST']=="localhost") {
		$_SESSION['fb_user_id']		= TEMP_FB_USER_ID;
		$_SESSION['page_admin']		= TEMP_PAGE_ADMIN;
		$_SESSION['like_status']	= TEMP_PAGE_LIKE;
		$_SESSION['page_id']        = TEMP_FB_PAGE_ID;
		$_SESSION['signed_reuqest'] = "";
		
		$_SESSION['fb_user_friends'] = array('data'=>array(
			0=>array('id'=>504369820,'name'=>'Roshan Ejaz'),
			1=>array('id'=>510077403, 'name'=>'Danish Elahi Khan'),
			2=>array('id'=>100002284293800,'name'=>'Naveed Aziz'),			
			)
		); 
		return false;
	}

	$obj = & get_instance();	
	$signed_request = $obj->facebook_ext->getSignedRequest();
	
	if(isset($_REQUEST['signed_request']))
		$_SESSION['signed_reuqest']	= $_REQUEST['signed_request'];
	
	$_SESSION['page_id']		= (isset($signed_request["page"]["id"])) ? $signed_request["page"]["id"] : '';
	$_SESSION['page_admin']		= (isset($signed_request["page"]["admin"])) ? $signed_request["page"]["admin"] : '';
	$_SESSION['like_status']	= (isset($signed_request["page"]["liked"])) ? $signed_request["page"]["liked"] : '';

	if ( ! isset($_SESSION['page_id']) || $_SESSION['page_id'] == '' )
	{
	}
	else
	{
		if ( $signed_request["page"]["id"] != '' && $_SESSION['page_id'] != $signed_request["page"]["id"] )
		{
			unset($_SESSION['page_id']);
			unset($_SESSION['fan_page_url']);
			unset($_SESSION['fan_page_name']);
			unset($_SESSION['fan_page_url_with_app_id']);
			unset($_SESSION['store_id']);
		}

	}

	if ( $signed_request["page"]["id"] != '' )
	{
		$_SESSION['page_id'] = (isset($signed_request["page"]["id"])) ? $signed_request["page"]["id"] : '';
	}

	return $signed_request;
}

//FUNCTION 03
//Specs: This function returns the Pages owned by a certain user
function get_owned_pages( $user_id = false ) {
	try {	
		if ( !$user_id ) $user_id = 'me';
		$obj = & get_instance();
		$pages = $obj->facebook_ext->api('/'.$user_id.'/accounts');
		if ( array_key_exists( 'data', $pages ) ) {		
			//$this->last_result = $pages['data'];		
			return $pages['data'];
		} else {
			return false;
		}
	}
	catch ( FacebookApiException $exp ) {	
		//pr( $exp );		
		return false;
	}
}

//FUNCTION 04
//Specs: This function is used to check if a user is an admin of a certain page
function is_user_admin( $page_id, $user_id = false ) {

	try {
	
		$pages = get_owned_pages( $user_id );
		
		if ( $pages ) {
		
			foreach ( $pages as $page ) {
				if ( $page['id'] == $page_id ) {
					return true;
				}
			}
		}
		
		return false;
	}
	
	catch ( FacebookApiException $exp ) {
	
		//$this->pre_print( $exp );
		
		return false;
	}
}

//FUNCTION 05
//Specs: This function return Page details, given a certain Page ID
function get_page( $id ) {

	try {
		$obj = & get_instance();
		$page_data = $obj->facebook_ext->api('/'.$id);
				
		return $page_data;
	}
	
	catch ( FacebookApiException $exp ) {
	
		//$this->pre_print( $exp );
		
		return false;
	}
}

//FUNCTION 06
//Specs: This function is used for re-direction using JS code
function is_fanpage_application()
{
	if ( ! isset($_SESSION['page_id']) )
	{
		ob_start()
		?>
			You cannot use this application without a fan page.<br /><br /><br />
			Please install it on facebook fan page.
		<?
		print ob_get_clean(); die();
	}
	
	try	{
		$page_data = $obj->facebook_ext->api('/'.$_SESSION['page_id']);

		$_SESSION['fan_page_url'] = ( isset($page_data->link) ) ? $page_data->link : '';
		$_SESSION['fan_page_name'] = ( isset($page_data->name) ) ? $page_data->name : '';
		$_SESSION['fan_page_url_with_app_id'] = $_SESSION['fan_page_url'].'?sk=app_'.FB_APP_ID;
	}
	catch (FacebookApiException $ex) {
		pr($ex);
		exit;
	}
}

//FUNCTION 07
//Specs: This function returns the Tab Applications installed on Pages
function fbh_is_tab_installed($page_id, $application_id) {
	try {	
		
		$obj = & get_instance();
		$tabs = $obj->facebook_ext->api('/'.$page_id.'/tabs/'.$application_id);
		if ( array_key_exists( 'data', $tabs ) ) {	
			if( !empty($tabs['data']) ) {
				foreach($tabs['data'] as $tab) {
					if($tab['id'] == $page_id."/tabs/app_".$application_id) {
						return true;
					}
				}
				return false;
			}else {
				return false;	
			}
		} else {
			return false;
		}
	}
	catch ( FacebookApiException $exp ) {	
		//pr( $exp );		
		return false;
	}
}

//FUNCTION 08
//Specs: This function is used for re-direction using JS code
function js_redirect( $url, $extra = '' ) {
	if($extra=='top') {
		ob_start(); ?>
        <script>
			top.location.href = '<?php echo $url; ?>';
		</script>
		<?php
		print ob_get_clean();
	} else if( $extra=='href' ) {
		print $url;
	} else {
		ob_start(); ?>
        <script>
			document.location = '<?php echo $url; ?>';
		</script>
<?php	print ob_get_clean();
	}
}
?>
