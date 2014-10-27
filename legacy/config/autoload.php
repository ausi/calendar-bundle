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

// Templates
TemplateLoader::addFiles(
[
	'cal_default'        => 'vendor/contao/module-calendar/legacy/templates/calendar',
	'cal_mini'           => 'vendor/contao/module-calendar/legacy/templates/calendar',
	'event_full'         => 'vendor/contao/module-calendar/legacy/templates/events',
	'event_list'         => 'vendor/contao/module-calendar/legacy/templates/events',
	'event_teaser'       => 'vendor/contao/module-calendar/legacy/templates/events',
	'event_upcoming'     => 'vendor/contao/module-calendar/legacy/templates/events',
	'mod_calendar'       => 'vendor/contao/module-calendar/legacy/templates/modules',
	'mod_event'          => 'vendor/contao/module-calendar/legacy/templates/modules',
	'mod_eventlist'      => 'vendor/contao/module-calendar/legacy/templates/modules',
	'mod_eventmenu'      => 'vendor/contao/module-calendar/legacy/templates/modules',
	'mod_eventmenu_year' => 'vendor/contao/module-calendar/legacy/templates/modules',
]);
