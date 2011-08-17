<?php
/**
 * @version		$Id: profile.php 21766 2011-07-08 12:20:23Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
jimport('joomla.utilities.date');

/**
 * An example custom profile plugin.
 *
 * @package		Joomla.Plugin
 * @subpackage	User.profile
 * @version		1.6
 */
class plgContentSimpleGeoTag extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * @param	string	$context	The context for the data
	 * @param	int		$data		The user id
	 * @param	object
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	function onContentPrepareData($context, $data)
	{
		echo "<p>";
		echo "test";
		echo var_dump($context);
		echo "</p>";
		// Check we are manipulating a valid form.
		if (!in_array($context, array('com_content.article'))) {
			return true;
		}
		var_dump($data);
		if (is_object($data))
		{
			$userId = isset($data->id) ? $data->id : 0;

			if (!isset($data->profile) and $userId > 0) {

				// Load the profile data from the database.
				$db = JFactory::getDbo();
				$db->setQuery(
					'SELECT profile_key, profile_value FROM #__user_profiles' .
					' WHERE user_id = '.(int) $userId." AND profile_key LIKE 'profile.%'" .
					' ORDER BY ordering'
				);
				$results = $db->loadRowList();

				// Check for a database error.
				if ($db->getErrorNum())
				{
					$this->_subject->setError($db->getErrorMsg());
					return false;
				}

				// Merge the profile data.
				$data->profile = array();

				foreach ($results as $v)
				{
					$k = str_replace('profile.', '', $v[0]);
					$data->profile[$k] = $v[1];
				}
			}

			
			if (!JHtml::isRegistered('users.url')) {
				JHtml::register('users.url', array(__CLASS__, 'url'));
			}
			if (!JHtml::isRegistered('users.calendar')) {
				JHtml::register('users.calendar', array(__CLASS__, 'calendar'));
			}
			if (!JHtml::isRegistered('users.tos')) {
				JHtml::register('users.tos', array(__CLASS__, 'tos'));
			}
		}

		return true;
	}

	public static function url($value)
	{
		if (empty($value))
		{
			return JHtml::_('users.value', $value);
		}
		else
		{
			$value = htmlspecialchars($value);
			if(substr ($value, 0, 4) == "http") {
				return '<a href="'.$value.'">'.$value.'</a>';
			}
			else {
				return '<a href="http://'.$value.'">'.$value.'</a>';
			}
		}
	}

	public static function calendar($value)
	{
		if (empty($value)) {
			return JHtml::_('users.value', $value);
		} else {
			return JHtml::_('date', $value, null, null);
		}
	}

	public static function tos($value)
	{
		if ($value) {
			return JText::_('JYES');
		}
		else {
			return JText::_('JNO');
		}
	}

	/**
	 * @param	JForm	$form	The form to be altered.
	 * @param	array	$data	The associated data for the form.
	 *
	 * @return	boolean
	 * @since	1.6
	 */
	function onContentPrepareForm($form, $data)
	{
		if (!($form instanceof JForm))
		{
			$this->_subject->setError('JERROR_NOT_A_FORM');
			return false;
		}
		
			if (!JHtml::isRegistered('users.url')) {
				JHtml::register('users.url', array(__CLASS__, 'url'));
			}
			if (!JHtml::isRegistered('users.calendar')) {
				JHtml::register('users.calendar', array(__CLASS__, 'calendar'));
			}
			if (!JHtml::isRegistered('users.tos')) {
				JHtml::register('users.tos', array(__CLASS__, 'tos'));
			}
		

		// Check we are manipulating a valid form.
		$context = $form->getName();
		if (!in_array($context, array('com_content.article'))) {
			return true;
		}

		// Add the registration fields to the form.
		JForm::addFormPath(dirname(__FILE__).'/geotag');
		$form->loadFile('geotag', false);

		// Set whether location is requried
		$form->setFieldAttribute('latitude', 'required', $this->params->get('require_location') == 2, 'metadata');
		$form->setFieldAttribute('longitude', 'required', $this->params->get('require_location') == 2, 'metadata');
		/*
		echo "<p>";
		echo "test22";
		echo var_dump($form);
		echo "</p><p>";
		echo $form->getName();
		echo "</p>";
		*/


		return true;
	}

	/*
	 * This is not needed because the data are saved in normal content table as metadata...
	public function onContentAfterSave($context, &$article, $isNew)
	{
		$app = JFactory::getApplication();
		
		//throw new Exception("$context:".$context);
		
		// Check we are in the right context
		if (!in_array($context, array('com_content.article'))) {
			return true;
		}
		$doc =& JFactory::getDocument();
		$registry = new JRegistry();
        $registry->loadArray($article->metadata);
		$lat = $registry->getValue("latitude");
		
		throw new Exception($lat."article: ".print_r($registry, true));
		
		$articleid = $article->id;
		
		throw new Exception("Intro: ".$article->introtext." Lat: ");
	}
		*/
		/*
		if(isset(articleid) && $articleid != 0)
		{
			try
			{
				$db = JFactory::getDbo();
				
				$db->setQuery('INSERT INTO `#__simplegeotag` ( `content_id`, `text`, `lat`, `long`, `note`) VALUES( 2, \'Example 3\', 34.05265942137599, -118.2568359375, NULL);');

				if (!$db->query()) {
					throw new Exception($db->getErrorMsg());
				}
				
				
			}
			catch (JException $e)
			{
				$this->_subject->setError($e->getMessage());
				return false;
			}
			
		}
	*/
		
}
