<?php


define('JPATH_BASE', __DIR__);
	
define('_JEXEC', 1);

require_once ('includes/defines.php');
require_once ('includes/framework.php');
require_once ('Libraries/joomla/user/authentication.php');

$mainframe =& JFactory::getApplication('site');

$credentials = [];

$db    = JFactory::getDbo();

$credentials['username'] = JRequest::getVar('user', '', 'post', 'username');
$credentials['password'] = JRequest::getVar('pass', '', 'post', 'passwd');

$response = new JAuthenticationResponse;
$query = $db->getQuery(true)
	->select('id, password')
	->from('#__users')
	->where('username=' . $db->quote($credentials['username']));

$db->setQuery($query);
$result = $db->loadObject();

if ($result)
{
	$match = JUserHelper::verifyPassword($credentials['password'], $result->password, $result->id);

	if ($match === true)
	{
		$user               = JUser::getInstance($result->id);
		$response->email    = $user->email;
		$response->fullname = $user->name;

		if (JFactory::getApplication()->isAdmin())
		{
			$response->language = $user->getParam('admin_language');
		}
		else
		{
			$response->language = $user->getParam('language');
		}

		$response->status        = JAuthentication::STATUS_SUCCESS;
		$response->error_message = '';
	}
	else
	{
		$response->status        = JAuthentication::STATUS_FAILURE;
		$response->error_message = JText::_('JGLOBAL_AUTH_INVALID_PASS');
	}
}

echo json_encode($response);
