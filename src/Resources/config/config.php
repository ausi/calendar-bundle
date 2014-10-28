<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Calendar
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 1,
[
	'calendar' =>
	[
		'tables'      => ['tl_calendar', 'tl_calendar_events', 'tl_calendar_feed', 'tl_content'],
		'icon'        => 'vendor/contao/module-calendar/src/Resources/assets/icon.gif',
		'table'       => ['TableWizard', 'importTable'],
		'list'        => ['ListWizard', 'importList']
	]
]);


/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD'], 2,
[
	'events' =>
	[
		'calendar'    => 'ModuleCalendar',
		'eventreader' => 'ModuleEventReader',
		'eventlist'   => 'ModuleEventlist',
		'eventmenu'   => 'ModuleEventMenu'
	]
]);


/**
 * Cron jobs
 */
$GLOBALS['TL_CRON']['daily'][] = ['Calendar', 'generateFeeds'];


/**
 * Register hook to add news items to the indexer
 */
$GLOBALS['TL_HOOKS']['removeOldFeeds'][] = ['Calendar', 'purgeOldFeeds'];
$GLOBALS['TL_HOOKS']['getSearchablePages'][] = ['Calendar', 'getSearchablePages'];
$GLOBALS['TL_HOOKS']['generateXmlFiles'][] = ['Calendar', 'generateFeeds'];


/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'calendars';
$GLOBALS['TL_PERMISSIONS'][] = 'calendarp';
$GLOBALS['TL_PERMISSIONS'][] = 'calendarfeeds';
$GLOBALS['TL_PERMISSIONS'][] = 'calendarfeedp';
