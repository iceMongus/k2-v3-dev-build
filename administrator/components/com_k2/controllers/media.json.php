<?php
/**
 * @version		3.0.0
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die ;

require_once JPATH_ADMINISTRATOR.'/components/com_k2/controller.php';
require_once JPATH_ADMINISTRATOR.'/components/com_k2/classes/filesystem.php';
require_once JPATH_ADMINISTRATOR.'/components/com_k2/resources/items.php';
require_once JPATH_ADMINISTRATOR.'/components/com_k2/helpers/media.php';

jimport('joomla.filesystem.file');

/**
 * Media JSON controller.
 */

class K2ControllerMedia extends K2Controller
{

	public function upload()
	{
		// Check for token
		JSession::checkToken() or K2Response::throwError(JText::_('JINVALID_TOKEN'));

		// Get input
		$itemId = $this->input->get('itemId', '', 'cmd');
		$upload = $this->input->get('upload', '', 'cmd');
		$file = $this->input->files->get('file');

		// Permissions check
		if (is_numeric($itemId))
		{
			// Existing items check permission for specific item
			$authorised = K2Items::getInstance($itemId)->canEdit;
		}
		else
		{
			// New items. We can only check the generic create permission. We cannot check against specific category since we do not know the category of the item.
			$authorised = JFactory::getUser()->authorise('k2.item.create', 'com_k2');
		}
		if (!$authorised)
		{
			K2Response::throwError(JText::_('K2_YOU_ARE_NOT_AUTHORIZED_TO_PERFORM_THIS_OPERATION'), 403);
		}

		// If the current file is uploaded then we should remove it before we upload a new one
		if ($upload)
		{
			K2HelperMedia::remove($upload, $itemId);
		}

		$response = K2HelperMedia::add($file, $itemId);

		echo json_encode($response);

		// Return
		return $this;

	}

	/**
	 * Delete function.
	 * Deletes a resource.
	 * Usually there will be no need to override this function.
	 *
	 * @return void
	 */
	protected function delete()
	{
		// Check for token
		JSession::checkToken() or K2Response::throwError(JText::_('JINVALID_TOKEN'));

		// Get id from input
		$itemId = $this->input->get('itemId', '', 'cmd');
		$upload = $this->input->get('upload', '', 'cmd');

		// Permissions check
		if (is_numeric($itemId))
		{
			// Existing items check permission for specific item
			$authorised = K2Items::getInstance($itemId)->canEdit;
		}
		else
		{
			$authorised = true;
		}
		if (!$authorised)
		{
			K2Response::throwError(JText::_('K2_YOU_ARE_NOT_AUTHORIZED_TO_PERFORM_THIS_OPERATION'), 403);
		}

		K2HelperMedia::remove($upload, $itemId);

		// Response
		K2Response::setResponse(true);

	}

	public function connector()
	{
		$application = JFactory::getApplication();
		$params = JComponentHelper::getParams('com_media');
		$root = $params->get('file_path', 'media');
		$folder = $this->input->get('folder', $root, 'path');
		$type = $this->input->get('type', 'video', 'cmd');
		if (JString::trim($folder) == "")
		{
			$folder = $root;
		}
		else
		{
			// Ensure that we are always below the root directory
			if (strpos($folder, $root) !== 0)
			{
				$folder = $root;
			}
		}
		// Disable debug
		$this->input->set('debug', false);
		$url = JURI::root(true).'/'.$folder;
		$path = JPATH_SITE.'/'.JPath::clean($folder);
		JPath::check($path);
		include_once JPATH_COMPONENT_ADMINISTRATOR.'/js/widgets/elfinder/php/elFinderConnector.class.php';
		include_once JPATH_COMPONENT_ADMINISTRATOR.'/js/widgets/elfinder/php/elFinder.class.php';
		include_once JPATH_COMPONENT_ADMINISTRATOR.'/js/widgets/elfinder/php/elFinderVolumeDriver.class.php';
		include_once JPATH_COMPONENT_ADMINISTRATOR.'/js/widgets/elfinder/php/elFinderVolumeLocalFileSystem.class.php';
		function access($attr, $path, $data, $volume)
		{
			$application = JFactory::getApplication();

			$ext = strtolower(JFile::getExt(basename($path)));
			if ($ext == 'php')
			{
				return true;
			}

			// Hide files and folders starting with .
			if (strpos(basename($path), '.') === 0 && $attr == 'hidden')
			{
				return true;
			}
			// Read only access for front-end. Full access for administration section.
			switch($attr)
			{
				case 'read' :
					return true;
					break;
				case 'write' :
					return ($application->isSite()) ? false : true;
					break;
				case 'locked' :
					return ($application->isSite()) ? true : false;
					break;
				case 'hidden' :
					return false;
					break;
			}

		}

		if ($application->isAdmin())
		{
			$permissions = array(
				'read' => true,
				'write' => true
			);
		}
		else
		{
			$permissions = array(
				'read' => true,
				'write' => false
			);
		}
		$options = array('roots' => array( array(
					'driver' => 'LocalFileSystem',
					'path' => $path,
					'URL' => $url,
					'accessControl' => 'access',
					'defaults' => $permissions
				)));
		$connector = new elFinderConnector(new elFinder($options));
		$connector->run();
		return $this;
	}

}
