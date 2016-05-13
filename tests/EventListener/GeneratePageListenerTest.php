<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CalendarBundle\Test\EventListener;

use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\CalendarBundle\EventListener\GeneratePageListener;
use Contao\Model\Collection;
use Contao\PageModel;

/**
 * Tests the GeneratePageListener class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class GeneratePageListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $listener = new GeneratePageListener($this->mockContaoFramework());

        $this->assertInstanceOf('Contao\CalendarBundle\EventListener\GeneratePageListener', $listener);
    }

    /**
     * Tests that the listener returns a replacement string for a calendar feed.
     */
    public function testOnGeneratePage()
    {
        /** @var PageModel|\PHPUnit_Framework_MockObject_MockObject $pageModel */
        $pageModel = $this
            ->getMockBuilder('Contao\PageModel')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $layoutModel = $this
            ->getMockBuilder('Contao\LayoutModel')
            ->setMethods(['__get'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $layoutModel
            ->expects($this->any())
            ->method('__get')
            ->willReturnCallback(function ($key) {
                switch ($key) {
                    case 'calendarfeeds':
                        return 'a:1:{i:0;i:3;}';

                    default:
                        return null;
                }
            })
        ;

        $GLOBALS['TL_HEAD'] = [];

        $listener = new GeneratePageListener($this->mockContaoFramework());
        $listener->onGeneratePage($pageModel, $layoutModel);

        $this->assertEquals(
            [
                '<link type="application/rss+xml" rel="alternate" href="http://localhost/share/events.xml" title="Upcoming events">',
            ],
            $GLOBALS['TL_HEAD']
        );
    }

    /**
     * Tests that the listener returns if there are no feeds.
     */
    public function testReturnIfNoFeeds()
    {
        /** @var PageModel|\PHPUnit_Framework_MockObject_MockObject $pageModel */
        $pageModel = $this
            ->getMockBuilder('Contao\PageModel')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $layoutModel = $this
            ->getMockBuilder('Contao\LayoutModel')
            ->setMethods(['__get'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $layoutModel
            ->expects($this->any())
            ->method('__get')
            ->willReturnCallback(function ($key) {
                switch ($key) {
                    case 'calendarfeeds':
                        return '';

                    default:
                        return null;
                }
            })
        ;

        $GLOBALS['TL_HEAD'] = [];

        $listener = new GeneratePageListener($this->mockContaoFramework());
        $listener->onGeneratePage($pageModel, $layoutModel);

        $this->assertEmpty($GLOBALS['TL_HEAD']);
    }

    /**
     * Tests that the listener returns if there are no models.
     */
    public function testReturnIfNoModels()
    {
        /** @var PageModel|\PHPUnit_Framework_MockObject_MockObject $pageModel */
        $pageModel = $this
            ->getMockBuilder('Contao\PageModel')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $layoutModel = $this
            ->getMockBuilder('Contao\LayoutModel')
            ->setMethods(['__get'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $layoutModel
            ->expects($this->any())
            ->method('__get')
            ->willReturnCallback(function ($key) {
                switch ($key) {
                    case 'calendarfeeds':
                        return 'a:1:{i:0;i:3;}';

                    default:
                        return null;
                }
            })
        ;

        $GLOBALS['TL_HEAD'] = [];

        $listener = new GeneratePageListener($this->mockContaoFramework(true));
        $listener->onGeneratePage($pageModel, $layoutModel);

        $this->assertEmpty($GLOBALS['TL_HEAD']);
    }

    /**
     * Returns a ContaoFramework instance.
     *
     * @param bool $noModels
     *
     * @return ContaoFrameworkInterface
     */
    private function mockContaoFramework($noModels = false)
    {
        /** @var ContaoFramework|\PHPUnit_Framework_MockObject_MockObject $framework */
        $framework = $this
            ->getMockBuilder('Contao\CoreBundle\Framework\ContaoFramework')
            ->disableOriginalConstructor()
            ->setMethods(['isInitialized', 'getAdapter'])
            ->getMock()
        ;

        $framework
            ->expects($this->any())
            ->method('isInitialized')
            ->willReturn(true)
        ;

        $feedModel = $this
            ->getMockBuilder('Contao\CalendarFeedModel')
            ->setMethods(['__get'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $feedModel
            ->expects($this->any())
            ->method('__get')
            ->willReturnCallback(function ($key) {
                switch ($key) {
                    case 'feedBase':
                        return 'http://localhost/';

                    case 'alias':
                        return 'events';

                    case 'format':
                        return 'rss';

                    case 'title':
                        return 'Upcoming events';

                    default:
                        return null;
                }
            })
        ;

        $calendarFeedModelAdapter = $this
            ->getMockBuilder('Contao\CoreBundle\Framework\Adapter')
            ->setMethods(['findByIds'])
            ->setConstructorArgs(['Contao\CalendarFeedModel'])
            ->getMock()
        ;

        $calendarFeedModelAdapter
            ->expects($this->any())
            ->method('findByIds')
            ->willReturn($noModels ? null : new Collection([$feedModel], 'tl_calendar_feeds'))
        ;

        $framework
            ->expects($this->any())
            ->method('getAdapter')
            ->willReturnCallback(function ($key) use ($calendarFeedModelAdapter) {
                switch ($key) {
                    case 'Contao\CalendarFeedModel':
                        return $calendarFeedModelAdapter;

                    case 'Contao\Template':
                        return new Adapter('Contao\Template');

                    default:
                        return null;
                }
            })
        ;

        return $framework;
    }
}
