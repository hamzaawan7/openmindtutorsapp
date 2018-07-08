var login_count = 0 ;
var appID = '';
//var channelUrl = '';
var HTTP_HOST = window.location.host;
var FB_PAGE = '';
if(HTTP_HOST=="localhost") {
	 appID = '235254706946670'; //my_app
	 FB_PAGE= "http://localhost/omt/ha_web_open-mind-tutors/code/beta/";
               
}else {
	 appID = '235254706946670';
	 FB_PAGE= "http://openmindtutors.co.uk/";
}
window.fbAsyncInit = function() {
	//alert('Facebook Library Loaded');
	// init the FB JS SDK
	FB.init({
	  appId      : appID, // App ID from the App Dashboard
	//  channelUrl : channelUrl, // Channel File for x-domain communication
	  status     : true, // check the login status upon init?
	  cookie     : true, // set sessions cookies to allow your server to access the session?
	  xfbml      : true  // parse XFBML tags on this page?
	});
	
	// Additional initialization code such as adding Event Listeners goes here
	// -- -- start Login Event -- --
	FB.Event.subscribe('auth.login', function(response) {
		FB.getLoginStatus(function(response) {
			//alert("Login Event Fired");
			if (response.status === 'connected') {
				if(login_count == 0) {
					//alert("Facebook Connection Found");
                	loginByFacebook();
					login_count = 1;
				}								
			}else {
				//alert("Facebook Connection Failed");
			}
		});
	});
	// -- -- end Login Event -- --
	
	// -- -- start Logout Event -- --
	FB.Event.subscribe('auth.logout', function(response) {
		//alert('Logout Event Fired');
		destroy_session();				
	});
	// -- -- end Logout Event -- --
};
// Load the SDK's source Asynchronously
// Note that the debug version is being actively developed and might 
// contain some type checks that are overly strict. 
// Please report such bugs using the bugs tool.
(function(d, debug){
 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement('script'); js.id = id; js.async = true;
 js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
 ref.parentNode.insertBefore(js, ref);
}(document, /*debug*/ false));  
 
function feed_dialog(title,description,image_url,src){ 
	FB.ui(
  	{
    	method: 'feed',
    	name: title,
		link: FB_PAGE,
		picture: image_url,
		caption: '',
		description: description,
		source:src
  	},
  	function(response) {
		if (response && response.post_id) {
		  //alert('Post was published.');
		} else {
		  //alert('Post was not published.');
		}
  	});
}
