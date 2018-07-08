<?php
class urlmanager
{
	var $Default = array();
	var $Param = NULL;
	var $Page = NULL;
	var $Function = NULL;
	var $PreFix = "";
	var $admin = 'admin/';

	function http_referer()
	{
		if ( isset($_SERVER['HTTP_REFERER']) )
		{
			return $_SERVER['HTTP_REFERER'];
		}
		else
		{
			return base_url();
		}

	}
/*___________________________________________________________________________________________________*/



	function SetupURLObject( $u, $start_from=1 )
	{
	  $this->Page = $u->segment( URL_SEGMENT_1 );
	  $this->Function = $u->segment( URL_SEGMENT_2 );

	  $this->Param = $u->uri_to_assoc( $start_from , $this->Default );
	}


	function url_segments( $segment_no )
	{
		$parts = explode("/", $_SERVER['REQUEST_URI']);

		foreach ($parts as $key => $value)
		{
			if (is_null($value) || $value=="")
			{
				unset($parts[$key]);
			}
		}

		if ( isset($parts[$segment_no]) )
			return $parts[$segment_no];
		else
			return false;
	}

	// updated for urldecode()

	function GetParam( $key )
	{
		if( $this->Param == NULL )
			return -1;

		if( isset($this->Param[$key]) )
			return urldecode($this->Param[$key]);
		else
			return -1;
	}

	function build_relative_base()
	{
		$url_arr = explode('/', base_url());

		$url_arr = array_unique($url_arr);

		$url_uri_arr = explode('/', $_SERVER['REQUEST_URI']);

		$url_uri_arr = array_unique($url_uri_arr);

		$url_uri_arr = array_diff($url_uri_arr, $url_arr);

//		pr($url_uri_arr);

		if ( count($url_uri_arr) < 3 )
		{
			return '../';
		}
		else if ( count($url_uri_arr) < 4 )
		{
			return '../../';
		}
		else if ( count($url_uri_arr) < 5 )
		{
			return '../../../';
		}
		else if ( count($url_uri_arr) < 6 )
		{
			return '../../../../';
		}
		else if ( count($url_uri_arr) < 7 )
		{
			return '../../../../../';
		}

//		pr($_SERVER['FULL_URL']).'<hr>';
//		return str_replace(base_url(), '', $_SERVER['FULL_URL']);
	}
}
?>