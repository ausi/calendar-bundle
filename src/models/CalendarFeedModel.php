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

namespace Contao;

use Contao\Model\Collection;


/**
 * Reads and writes calendar feeds
 *
 * @package   Models
 * @author    Leo Feyer <https://github.com/leofeyer>
 * @copyright Leo Feyer 2005-2014
 */
class CalendarFeedModel extends Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_calendar_feed';


	/**
	 * Find all feeds which include a certain calendar
	 *
	 * @param int   $intId      The calendar ID
	 * @param array $arrOptions An optional options array
	 *
	 * @return Model|null The model or null if the calendar is not part of a feed
	 */
	public static function findByCalendar($intId, array $arrOptions=[])
	{
		$t = static::$strTable;
		return static::findOneBy(["$t.calendars LIKE '%\"" . intval($intId) . "\"%'"], null, $arrOptions);
	}


	/**
	 * Find calendar feeds by their IDs
	 *
	 * @param array $arrIds     An array of calendar feed IDs
	 * @param array $arrOptions An optional options array
	 *
	 * @return Collection|null A collection of models or null if there are no feeds
	 */
	public static function findByIds($arrIds, array $arrOptions=[])
	{
		if (!is_array($arrIds) || empty($arrIds))
		{
			return null;
		}

		$t = static::$strTable;
		return static::findBy(["$t.id IN(" . implode(',', array_map('intval', $arrIds)) . ")"], null, $arrOptions);
	}
}
