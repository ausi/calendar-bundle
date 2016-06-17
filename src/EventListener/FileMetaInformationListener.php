<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CalendarBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Database;
use Contao\Database\Result;

/**
 * Provides file meta information for the request.
 *
 * @author Andreas Schempp <https://github.com/aschempp>
 */
class FileMetaInformationListener
{
    /**
     * @var ContaoFrameworkInterface
     */
    private $framework;

    /**
     * Constructor.
     *
     * @param ContaoFrameworkInterface $framework
     */
    public function __construct(ContaoFrameworkInterface $framework)
    {
        $this->framework = $framework;
    }

    /**
     * Returns the page record related to the given table and ID.
     *
     * @param string $table
     * @param int    $id
     *
     * @return Result|false
     */
    public function onAddFileMetaInformationToRequest($table, $id)
    {
        if ('tl_calendar' === $table) {
            return $this->getResult(
                'SELECT * FROM tl_page WHERE id=(SELECT jumpTo FROM tl_calendar WHERE id=?)',
                $id
            );
        }

        if ('tl_calendar_events' === $table) {
            return $this->getResult(
                'SELECT * FROM tl_page WHERE id=(
                    SELECT jumpTo FROM tl_calendar WHERE id=(SELECT pid FROM tl_calendar_events WHERE id=?)
                )',
                $id
            );
        }

        return false;
    }

    /**
     * Fetches the result from the database.
     *
     * @param string $query
     * @param int    $id
     *
     * @return Result
     */
    private function getResult($query, $id)
    {
        $this->framework->initialize();

        /** @var Database $database */
        $database = $this->framework->createInstance('Contao\Database');

        return $database->prepare($query)->execute($id);
    }
}
