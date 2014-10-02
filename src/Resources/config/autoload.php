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
	'cal_default'        => 'vendor/contao/modules-calendar/src/Resources/templates/calendar',
	'cal_mini'           => 'vendor/contao/modules-calendar/src/Resources/templates/calendar',
	'event_full'         => 'vendor/contao/modules-calendar/src/Resources/templates/events',
	'event_list'         => 'vendor/contao/modules-calendar/src/Resources/templates/events',
	'event_teaser'       => 'vendor/contao/modules-calendar/src/Resources/templates/events',
	'event_upcoming'     => 'vendor/contao/modules-calendar/src/Resources/templates/events',
	'mod_calendar'       => 'vendor/contao/modules-calendar/src/Resources/templates/modules',
	'mod_event'          => 'vendor/contao/modules-calendar/src/Resources/templates/modules',
	'mod_eventlist'      => 'vendor/contao/modules-calendar/src/Resources/templates/modules',
	'mod_eventmenu'      => 'vendor/contao/modules-calendar/src/Resources/templates/modules',
	'mod_eventmenu_year' => 'vendor/contao/modules-calendar/src/Resources/templates/modules',
]);
