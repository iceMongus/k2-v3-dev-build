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

require_once JPATH_SITE.'/components/com_k2/views/view.php';

/**
 * K2 itemlist feed view class
 */

class K2ViewItemlist extends K2View
{
	public function display($tpl = null)
	{
		// Get application
		$application = JFactory::getApplication();

		// Get document
		$document = JFactory::getDocument();

		// Legacy
		$moduleId = $application->input->get('moduleID', 0, 'int');
		if ($moduleId)
		{
			$application->input->set('task', 'module');
			$application->input->set('id', $moduleId);
		}

		// Get input
		$task = $application->input->get('task', '', 'cmd');

		// Trigger the corresponding subview
		if (method_exists($this, $task))
		{
			call_user_func(array($this, $task));
		}
		else
		{
			return JError::raiseError(404, JText::_('K2_NOT_FOUND'));
		}

		// Load the comments counters in a single query for all items
		$params = JComponentHelper::getParams('com_k2');
		if ($params->get('comments'))
		{
			K2Items::countComments($this->items);
		}
		// Add items to feed
		foreach ($this->items as $item)
		{
			// Add item
			$document->addItem($this->getFeedItem($item));
		}
	}

	private function category()
	{
		$this->getCategoryItems();
	}

	private function user()
	{
		$this->getUserItems();
	}

	private function tag()
	{
		$this->getTagItems();
	}

	private function date()
	{
		$this->getDateItems();
	}

	private function search()
	{
		$this->getSearchItems();
	}

	private function module()
	{
		$this->getModuleItems();
	}

}
