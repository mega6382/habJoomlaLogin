<?php
class HabJoomlaLogin
{
	/**
	 * Wrapper for HAB Joomla Login API
	 * @param Array $data Username and Password for Joomla site['user','pass']
	 * @param String $url Url to the "hab-joomla-login.php"
	 * @param Boolean $return True for array and false for an object of stdClass
	 * @return Array
	 */
	public static function doLogin($data, $url, $return = true)
	{
		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) {
			die("AN ERROR OCCURED");
		}
		
		$json = json_decode($result, $return);
		return $json;
	}
 
}