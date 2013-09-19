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

/**
 * K2 Response class.
 * This class sets the JSON response object structure for the Backbone.js application.
 */

class K2Response
{
	/**
	 * The object which holds the actual data of the response.
	 *
	 * @var object $response
	 */
	public static $response = null;

	/**
	 * The menu links.
	 *
	 * @var array $menu
	 */
	public static $menu = array();

	/**
	 * Rows for list rendering.
	 *
	 * @var array $rows
	 */
	public static $rows = array();

	/**
	 * Pagination data for list rendering.
	 *
	 * @var object $pagination
	 */
	public static $pagination = null;

	/**
	 * Filters for list rendering.
	 *
	 * @var array $filters
	 */
	public static $filters = array();

	/**
	 * Toolbar buttons for list rendering.
	 *
	 * @var array $toolbar
	 */
	public static $toolbar = array();

	/**
	 * Batch operation actions for list rendering.
	 *
	 * @var array $batch
	 */
	public static $batch = array();

	/**
	 * Row for form rendering.
	 *
	 * @var object $row
	 */
	public static $row = null;

	/**
	 * Array containing the fields that need to be rendered in form view.
	 *
	 * @var array $form
	 */
	public static $form = array();

	/**
	 * Array containing the the messages enqueued by the application.
	 *
	 * @var array $messages
	 */
	public static $messages = array();

	/**
	 * Setter function for the response variable.
	 *
	 * @param object $response
	 *
	 * @return void
	 */
	public static function setResponse($response)
	{
		self::$response = $response;
	}

	/**
	 * Getter function for the response variable.
	 *
	 * @return object $response
	 */
	public static function getResponse()
	{
		return self::$response;
	}

	/**
	 * Setter function for the menu variable.
	 *
	 * @param array $menu
	 *
	 * @return void
	 */
	public static function setMenu($menu)
	{
		self::$menu = $menu;
	}

	/**
	 * Getter function for the menu variable.
	 *
	 * @return array $menu
	 */
	public static function getMenu()
	{
		return self::$menu;
	}

	/**
	 * Setter function for the rows variable.
	 *
	 * @param array $rows
	 *
	 * @return void
	 */
	public static function setRows($rows)
	{
		self::$rows = $rows;
	}

	/**
	 * Getter function for the rows variable.
	 *
	 * @return array $rows
	 */
	public static function getRows()
	{
		return self::$rows;
	}

	/**
	 * Setter function for the pagination variable.
	 *
	 * @param object $pagination
	 *
	 * @return void
	 */
	public static function setPagination($pagination)
	{
		self::$pagination = $pagination;
	}

	/**
	 * Getter function for the pagination variable.
	 *
	 * @return object $pagination
	 */
	public static function getPagination()
	{
		return self::$pagination;
	}

	/**
	 * Setter function for the filters variable.
	 *
	 * @param array $filters
	 *
	 * @return void
	 */
	public static function setFilters($filters)
	{
		self::$filters = $filters;
	}

	/**
	 * Getter function for the filters variable.
	 *
	 * @return array $filters
	 */
	public static function getFilters()
	{
		return self::$filters;
	}

	/**
	 * Setter function for the toolbar variable.
	 *
	 * @param array $toolbar
	 *
	 * @return void
	 */
	public static function setToolbar($toolbar)
	{
		self::$toolbar = $toolbar;
	}

	/**
	 * Getter function for the toolbar variable.
	 *
	 * @return array $toolbar
	 */
	public static function getToolbar()
	{
		return self::$toolbar;
	}

	/**
	 * Setter function for the batch variable.
	 *
	 * @param array $batch
	 *
	 * @return void
	 */
	public static function setBatch($batch)
	{
		self::$batch = $batch;
	}

	/**
	 * Getter function for the batch variable.
	 *
	 * @return array $batch
	 */
	public static function getBatch()
	{
		return self::$batch;
	}

	/**
	 * Setter function for the row variable.
	 *
	 * @param object $row
	 *
	 * @return void
	 */
	public static function setRow($row)
	{
		self::$row = $row;
	}

	/**
	 * Getter function for the row variable.
	 *
	 * @return object $row
	 */
	public static function getRow()
	{
		return self::$row;
	}

	/**
	 * Setter function for the form variable.
	 *
	 * @param array $form
	 *
	 * @return void
	 */
	public static function setForm($form)
	{
		self::$form = $form;
	}

	/**
	 * Getter function for the form variable.
	 *
	 * @return array $form
	 */
	public static function getForm()
	{
		return self::$form;
	}

	/**
	 * Adds a filter to the filters array that will be rendered on the page.
	 *
	 * @param string $id		The id of the filter. This identifier allows the client to get the specific filter from the Backbone filters collection.
	 * @param string $label		The label of the filter.
	 * @param string $input		The HTML that the filter outputs.
	 * @param string $position	The position of the filter. Use this to set a position so the client can render filters together in positions.
	 *
	 * @return void
	 */
	public static function addFilter($id, $label, $input, $position = null)
	{
		$filter = new stdClass;
		$filter->id = $id;
		$filter->label = $label ? $label : '';
		$filter->input = $input ? $input : '';
		$filter->position = $position;
		self::$filters[$id] = $filter;
	}

	/**
	 * Removes a filter from the filters array that will be rendered on the page.
	 *
	 * @param string $id		The id of the filter to remove.
	 *
	 * @return void
	 */
	public static function removeFilter($id)
	{
		if (isset($self::$filters[$id]))
		{
			unset($self::$filters[$id]);
		}
	}

	/**
	 * Adds a menu link to the menu array that will be rendered on the page.
	 *
	 * @param string $id			The id of the menu link. This identifier allows the client to get the specific link from the Backbone menu collection.
	 * @param string $name			The name of the menu link.
	 * @param array $attributes		The attributes of the menu link.
	 *
	 * @return void
	 */
	public static function addMenuLink($id, $name, $attributes = array())
	{
		$link = new stdClass;
		$link->id = $id;
		$link->name = JText::_($name);
		$link->attributes = $attributes;
		self::$menu[$id] = $link;
	}

	/**
	 * Removes a menu link from the menu array that will be rendered on the page.
	 *
	 * @param string $id			The id of the menu link to remove.
	 *
	 * @return void
	 */
	public static function removeMenuLink($id)
	{
		if (isset($self::$menu[$id]))
		{
			unset($self::$menu[$id]);
		}
	}

	/**
	 * Adds a toolbar button to the toolbar array that will be rendered on the page.
	 *
	 * @param string $id	The id of the button. This identifier allows the client to get the specific button from the Backbone toolbar collection.
	 * @param string $html	The HTML output of the button.
	 *
	 * @return void
	 */
	public static function addToolbarButton($id, $html)
	{
		$button = new stdClass;
		$button->id = $id;
		$button->input = $html;
		self::$toolbar[$id] = $button;
	}

	/**
	 * Removes a toolbar button from the toolbar array.
	 *
	 * @param string $id	The id of the button to be removed.
	 *
	 * @return void
	 */
	public static function removeToolbarButton($id)
	{
		if (isset($self::$toolbar[$id]))
		{
			unset($self::$toolbar[$id]);
		}
	}

	/**
	 * Adds an action to the batch operations array.
	 *
	 * @param string $id		The id of the action. This identifier allows the client to get the specific action from the Backbone batch collection.
	 * @param string $label		The label of the action.
	 * @param string $input		The HTML of the action.
	 *
	 * @return void
	 */
	public static function addBatchAction($id, $label, $input)
	{
		$action = new stdClass;
		$action->id = 'jwBatch'.JString::ucfirst($id);
		$action->label = $label;
		$action->input = $input;
		self::$batch[$id] = $action;
	}

	/**
	 * Removes an action from the batch operations array.
	 *
	 * @param string $id		The id of the action to be removed.
	 *
	 * @return void
	 */
	public static function removeBatchAction($id)
	{
		if (isset($self::$batch[$id]))
		{
			unset($self::$batch[$id]);
		}
	}

	/**
	 * Adds a field to the form array which contains the fields to be rendered by the client in a form view.
	 *
	 * @param string $id	The id of the field. This identifier allows the client to get the specific field from the Backbone form collection.
	 * @param string $html	The HTML of the field.
	 *
	 * @return void
	 */
	public static function addFormField($id, $html)
	{
		$field = new stdClass;
		$field->id = $id;
		$field->input = $html;
		self::$form[$id] = $field;
	}

	/**
	 * Removes a field from the form array.
	 *
	 * @param string $id	The id of the fieldto be removed.
	 *
	 * @return void
	 */
	public static function removeFormField($id)
	{
		if (isset($self::$form[$id]))
		{
			unset($self::$form[$id]);
		}
	}

	/**
	 * Builds the whole response object.
	 *
	 * @return  object $response.
	 */
	public static function render()
	{
		if (!is_object(self::$response))
		{
			self::$response = new stdClass;
		}
		self::$response->menu = self::getMenu();
		self::$response->rows = self::getRows();
		self::$response->pagination = self::getPagination();
		self::$response->filters = self::getFilters();
		self::$response->toolbar = self::getToolbar();
		self::$response->batch = self::getBatch();
		self::$response->row = self::getRow();
		self::$response->form = self::getForm();
		self::$response->messages = JFactory::getApplication()->getMessageQueue();
		return self::$response;
	}

	/**
	 * This function is used to process all PHP errors and convert them to messages instead of outputing directly to the screen.
	 * More information at http://php.net/manual/en/function.set-error-handler.php.
	 * This guarantees that we will always have a valid JSON response.
	 *
	 * @param integer $code				The code of the error.
	 * @param string $description		The description of the error.
	 * @param string $file				The filename that the error was raised in.
	 * @param integer $line				The line number the error was raised at.
	 *
	 * @return void
	 */
	public static function errorHandler($code, $description, $file, $line)
	{
		$application = JFactory::getApplication();

		if (!(error_reporting() & $code))
		{
			return;
		}

		switch ($code)
		{
			case E_ERROR :
				$message = 'Error['.$code.'] '.$description.'. Line '.$line.' in file '.$file;
				$type = 'error';
				break;

			case E_WARNING :
				$message = 'Warning['.$code.'] '.$description.'. Line '.$line.' in file '.$file;
				$type = 'warning';
				break;

			case E_NOTICE :
				$message = 'Notice['.$code.'] '.$description.'. Line '.$line.' in file '.$file;
				$type = 'notice';
				break;

			default :
				$message = 'Uknown error type['.$code.'] '.$description.'. Line '.$line.' in file '.$file;
				$type = 'error';
				break;
		}

		$application->enqueueMessage($message, 'error');

		return;
	}

}
