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
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'cal_default'        => 'system/modules/calendar/templates/calendar',
	'cal_mini'           => 'system/modules/calendar/templates/calendar',
	'event_full'         => 'system/modules/calendar/templates/events',
	'event_list'         => 'system/modules/calendar/templates/events',
	'event_teaser'       => 'system/modules/calendar/templates/events',
	'event_upcoming'     => 'system/modules/calendar/templates/events',
	'mod_calendar'       => 'system/modules/calendar/templates/modules',
	'mod_event'          => 'system/modules/calendar/templates/modules',
	'mod_eventlist'      => 'system/modules/calendar/templates/modules',
	'mod_eventmenu'      => 'system/modules/calendar/templates/modules',
	'mod_eventmenu_year' => 'system/modules/calendar/templates/modules',
));
