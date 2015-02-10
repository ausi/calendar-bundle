<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;


/**
 * Reads and writes calendars
 *
 * @property integer $id
 * @property integer $tstamp
 * @property string  $title
 * @property integer $jumpTo
 * @property boolean $protected
 * @property string  $groups
 * @property boolean $allowComments
 * @property string  $notify
 * @property string  $sortOrder
 * @property integer $perPage
 * @property boolean $moderate
 * @property boolean $bbcode
 * @property boolean $requireLogin
 * @property boolean $disableCaptcha
 *
 * @method static $this findById()
 * @method static $this findOneByTstamp()
 * @method static $this findOneByTitle()
 * @method static $this findOneByJumpTo()
 * @method static $this findOneByProtected()
 * @method static $this findOneByGroups()
 * @method static $this findOneByAllowComments()
 * @method static $this findOneByNotify()
 * @method static $this findOneBySortOrder()
 * @method static $this findOneByPerPage()
 * @method static $this findOneByModerate()
 * @method static $this findOneByBbcode()
 * @method static $this findOneByRequireLogin()
 * @method static $this findOneByDisableCaptcha()
 * @method static \Model\Collection findByTstamp()
 * @method static \Model\Collection findByTitle()
 * @method static \Model\Collection findByJumpTo()
 * @method static \Model\Collection findByProtected()
 * @method static \Model\Collection findByGroups()
 * @method static \Model\Collection findByAllowComments()
 * @method static \Model\Collection findByNotify()
 * @method static \Model\Collection findBySortOrder()
 * @method static \Model\Collection findByPerPage()
 * @method static \Model\Collection findByModerate()
 * @method static \Model\Collection findByBbcode()
 * @method static \Model\Collection findByRequireLogin()
 * @method static \Model\Collection findByDisableCaptcha()
 * @method static integer countById()
 * @method static integer countByTstamp()
 * @method static integer countByTitle()
 * @method static integer countByJumpTo()
 * @method static integer countByProtected()
 * @method static integer countByGroups()
 * @method static integer countByAllowComments()
 * @method static integer countByNotify()
 * @method static integer countBySortOrder()
 * @method static integer countByPerPage()
 * @method static integer countByModerate()
 * @method static integer countByBbcode()
 * @method static integer countByRequireLogin()
 * @method static integer countByDisableCaptcha()
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class CalendarModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_calendar';

}
