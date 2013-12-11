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

require_once dirname(__FILE__).'/helper.php';
require_once JPATH_SITE.'/components/com_k2/helpers/route.php';
require_once JPATH_SITE.'/components/com_k2/helpers/utilities.php';
require_once JPATH_ADMINISTRATOR.'/components/com_k2/models/items.php';

switch ($params->get('usage'))
{
	case 'archive' :
		$months = ModK2ToolsHelper::getArchive($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'archive');
		break;

	case 'authors' :
		$authors = ModK2ToolsHelper::getAuthors($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'authors');
		break;

	case 'calendar' :
		$calendar = ModK2ToolsHelper::getCalendar($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'calendar');
		break;

	case 'breadcrumbs' :
		$breadcrumbs = ModK2ToolsHelper::getBreadcrumbs($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'breadcrumbs');
		break;

	case 'categories' :
		$categories = ModK2ToolsHelper::getCategories($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'categories');
		break;

	case 'categoriesList' :
		$categories = ModK2ToolsHelper::getCategories($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'categories_select');
		break;

	case 'search' :
		$search = ModK2ToolsHelper::getSearch($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'search');
		break;

	case 'tags' :
		$tags = ModK2ToolsHelper::getTagCloud($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'tags');
		break;

	case 'custom' :
		$customcode = ModK2ToolsHelper::renderCustomCode($params);
		require JModuleHelper::getLayoutPath('mod_k2_tools', 'customcode');
		break;
}
