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
 * Table tl_calendar
 */
$GLOBALS['TL_DCA']['tl_calendar'] =
[

	// Config
	'config' =>
	[
		'dataContainer'               => 'Table',
		'ctable'                      => ['tl_calendar_events'],
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'onload_callback' =>
		[
			['tl_calendar', 'checkPermission'],
			['tl_calendar', 'generateFeed']
		],
		'onsubmit_callback' =>
		[
			['tl_calendar', 'scheduleUpdate']
		],
		'sql' =>
		[
			'keys' =>
			[
				'id' => 'primary'
			]
		]
	],

	// List
	'list' =>
	[
		'sorting' =>
		[
			'mode'                    => 1,
			'fields'                  => ['title'],
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		],
		'label' =>
		[
			'fields'                  => ['title'],
			'format'                  => '%s'
		],
		'global_operations' =>
		[
			'feeds' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_calendar']['feeds'],
				'href'                => 'table=tl_calendar_feed',
				'class'               => 'header_rss',
				'attributes'          => 'onclick="Backend.getScrollOffset()"',
				'button_callback'     => ['tl_calendar', 'manageFeeds']
			],
			'all' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			]
		],
		'operations' =>
		[
			'edit' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_calendar']['edit'],
				'href'                => 'table=tl_calendar_events',
				'icon'                => 'edit.gif'
			],
			'editheader' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_calendar']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => ['tl_calendar', 'editHeader']
			],
			'copy' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_calendar']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
				'button_callback'     => ['tl_calendar', 'copyCalendar']
			],
			'delete' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_calendar']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				'button_callback'     => ['tl_calendar', 'deleteCalendar']
			],
			'show' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_calendar']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			]
		]
	],

	// Palettes
	'palettes' =>
	[
		'__selector__'                => ['protected', 'allowComments'],
		'default'                     => '{title_legend},title,jumpTo;{protected_legend:hide},protected;{comments_legend:hide},allowComments'
	],

	// Subpalettes
	'subpalettes' =>
	[
		'protected'                   => 'groups',
		'allowComments'               => 'notify,sortOrder,perPage,moderate,bbcode,requireLogin,disableCaptcha'
	],

	// Fields
	'fields' =>
	[
		'id' =>
		[
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		],
		'tstamp' =>
		[
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		],
		'title' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => ['mandatory'=>true, 'maxlength'=>255],
			'sql'                     => "varchar(255) NOT NULL default ''"
		],
		'jumpTo' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['jumpTo'],
			'exclude'                 => true,
			'inputType'               => 'pageTree',
			'foreignKey'              => 'tl_page.title',
			'eval'                    => ['mandatory'=>true, 'fieldType'=>'radio'],
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => ['type'=>'hasOne', 'load'=>'eager']
		],
		'protected' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['protected'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['submitOnChange'=>true],
			'sql'                     => "char(1) NOT NULL default ''"
		],
		'groups' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['groups'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => ['mandatory'=>true, 'multiple'=>true],
			'sql'                     => "blob NULL",
			'relation'                => ['type'=>'hasMany', 'load'=>'lazy']
		],
		'allowComments' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['allowComments'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['submitOnChange'=>true],
			'sql'                     => "char(1) NOT NULL default ''"
		],
		'notify' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['notify'],
			'default'                 => 'notify_admin',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => ['notify_admin', 'notify_author', 'notify_both'],
			'reference'               => &$GLOBALS['TL_LANG']['tl_calendar'],
			'sql'                     => "varchar(32) NOT NULL default ''"
		],
		'sortOrder' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['sortOrder'],
			'default'                 => 'ascending',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => ['ascending', 'descending'],
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => ['tl_class'=>'w50'],
			'sql'                     => "varchar(32) NOT NULL default ''"
		],
		'perPage' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['perPage'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => ['rgxp'=>'digit', 'tl_class'=>'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
		],
		'moderate' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['moderate'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class'=>'w50'],
			'sql'                     => "char(1) NOT NULL default ''"
		],
		'bbcode' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['bbcode'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class'=>'w50'],
			'sql'                     => "char(1) NOT NULL default ''"
		],
		'requireLogin' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['requireLogin'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class'=>'w50'],
			'sql'                     => "char(1) NOT NULL default ''"
		],
		'disableCaptcha' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_calendar']['disableCaptcha'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class'=>'w50'],
			'sql'                     => "char(1) NOT NULL default ''"
		]
	]
];


/**
 * Class tl_calendar
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    Calendar
 */
class tl_calendar extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Check permissions to edit table tl_calendar
	 */
	public function checkPermission()
	{
		// HOOK: comments extension required
		if (!in_array('comments', ModuleLoader::getActive()))
		{
			unset($GLOBALS['TL_DCA']['tl_calendar']['fields']['allowComments']);
		}

		if ($this->User->isAdmin)
		{
			return;
		}

		// Set root IDs
		if (!is_array($this->User->calendars) || empty($this->User->calendars))
		{
			$root = [0];
		}
		else
		{
			$root = $this->User->calendars;
		}

		$GLOBALS['TL_DCA']['tl_calendar']['list']['sorting']['root'] = $root;

		// Check permissions to add calendars
		if (!$this->User->hasAccess('create', 'calendarp'))
		{
			$GLOBALS['TL_DCA']['tl_calendar']['config']['closed'] = true;
		}

		// Check current action
		switch (Input::get('act'))
		{
			case 'create':
			case 'select':
				// Allow
				break;

			case 'edit':
				// Dynamically add the record to the user profile
				if (!in_array(Input::get('id'), $root))
				{
					$arrNew = $this->Session->get('new_records');

					if (is_array($arrNew['tl_calendar']) && in_array(Input::get('id'), $arrNew['tl_calendar']))
					{
						// Add permissions on user level
						if ($this->User->inherit == 'custom' || !$this->User->groups[0])
						{
							$objUser = $this->Database->prepare("SELECT calendars, calendarp FROM tl_user WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->id);

							$arrCalendarp = deserialize($objUser->calendarp);

							if (is_array($arrCalendarp) && in_array('create', $arrCalendarp))
							{
								$arrCalendars = deserialize($objUser->calendars);
								$arrCalendars[] = Input::get('id');

								$this->Database->prepare("UPDATE tl_user SET calendars=? WHERE id=?")
											   ->execute(serialize($arrCalendars), $this->User->id);
							}
						}

						// Add permissions on group level
						elseif ($this->User->groups[0] > 0)
						{
							$objGroup = $this->Database->prepare("SELECT calendars, calendarp FROM tl_user_group WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->groups[0]);

							$arrCalendarp = deserialize($objGroup->calendarp);

							if (is_array($arrCalendarp) && in_array('create', $arrCalendarp))
							{
								$arrCalendars = deserialize($objGroup->calendars);
								$arrCalendars[] = Input::get('id');

								$this->Database->prepare("UPDATE tl_user_group SET calendars=? WHERE id=?")
											   ->execute(serialize($arrCalendars), $this->User->groups[0]);
							}
						}

						// Add new element to the user object
						$root[] = Input::get('id');
						$this->User->calendars = $root;
					}
				}
				// No break;

			case 'copy':
			case 'delete':
			case 'show':
				if (!in_array(Input::get('id'), $root) || (Input::get('act') == 'delete' && !$this->User->hasAccess('delete', 'calendarp')))
				{
					$this->log('Not enough permissions to '.Input::get('act').' calendar ID "'.Input::get('id').'"', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;

			case 'editAll':
			case 'deleteAll':
			case 'overrideAll':
				$session = $this->Session->getData();
				if (Input::get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'calendarp'))
				{
					$session['CURRENT']['IDS'] = [];
				}
				else
				{
					$session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
				}
				$this->Session->setData($session);
				break;

			default:
				if (strlen(Input::get('act')))
				{
					$this->log('Not enough permissions to '.Input::get('act').' calendars', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;
		}
	}


	/**
	 * Check for modified calendar feeds and update the XML files if necessary
	 */
	public function generateFeed()
	{
		$session = $this->Session->get('calendar_feed_updater');

		if (!is_array($session) || empty($session))
		{
			return;
		}

		$this->import('Calendar');

		foreach ($session as $id)
		{
			$this->Calendar->generateFeed($id);
		}

		$this->import('Automator');
		$this->Automator->generateSitemap();

		$this->Session->set('calendar_feed_updater', null);
	}


	/**
	 * Schedule a calendar feed update
	 *
	 * This method is triggered when a single calendar or multiple calendars
	 * are modified (edit/editAll).
	 * @param Contao\DataContainer
	 */
	public function scheduleUpdate(Contao\DataContainer $dc)
	{
		// Return if there is no ID
		if (!$dc->id)
		{
			return;
		}

		// Store the ID in the session
		$session = $this->Session->get('calendar_feed_updater');
		$session[] = $dc->id;
		$this->Session->set('calendar_feed_updater', array_unique($session));
	}


	/**
	 * Return the manage feeds button
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function manageFeeds($href, $label, $title, $class, $attributes)
	{
		return ($this->User->isAdmin || !empty($this->User->calendarfeeds) || $this->User->hasAccess('create', 'calendarfeedp')) ? '<a href="'.$this->addToUrl($href).'" class="'.$class.'" title="'.specialchars($title).'"'.$attributes.'>'.$label.'</a> ' : '';
	}


	/**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return $this->User->canEditFieldsOf('tl_calendar') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the copy calendar button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function copyCalendar($row, $href, $label, $title, $icon, $attributes)
	{
		return $this->User->hasAccess('create', 'calendarp') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the delete calendar button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function deleteCalendar($row, $href, $label, $title, $icon, $attributes)
	{
		return $this->User->hasAccess('delete', 'calendarp') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}
}
