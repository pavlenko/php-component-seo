<?php

namespace PETest\Component\SEO;

use PE\Component\SEO\Exception\InvalidArgumentException;
use PE\Component\SEO\Links;
use PE\Component\SEO\Metas;
use PE\Component\SEO\Page;
use PE\Component\SEO\Template;

class PageTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        static::assertSame('foo', (new Page('foo'))->getTitle());
    }

    public function testSetTitleThrowsExceptionIfInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Page())->setTitle(false);
    }

    public function testTitle()
    {
        $temp = $this->createMock(Template::class);
        $page = new Page();

        static::assertSame('foo', $page->setTitle('foo')->getTitle());
        static::assertSame($temp, $page->setTitle($temp)->getTitle());
    }

    public function testSetDescriptionThrowsExceptionIfInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Page())->setDescription(false);
    }

    public function testDescription()
    {
        $temp = $this->createMock(Template::class);
        $page = new Page();

        static::assertSame('foo', $page->setDescription('foo')->getDescription());
        static::assertSame($temp, $page->setDescription($temp)->getDescription());
    }

    public function testSetKeywordsExceptionIfInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        (new Page())->setKeywords(false);
    }

    public function testKeywords()
    {
        $temp = $this->createMock(Template::class);
        $page = new Page();

        static::assertSame('foo', $page->setKeywords('foo')->getKeywords());
        static::assertSame($temp, $page->setKeywords($temp)->getKeywords());
    }

    public function testMetas()
    {
        $page = new Page();

        static::assertSame([], $page->getMetas());
        static::assertInstanceOf(Metas::class, $metas = $page->meta('foo'));
        static::assertSame(['foo' => $metas], $page->getMetas());
    }

    public function testLinks()
    {
        $page = new Page();

        static::assertSame([], $page->getLinks());
        static::assertInstanceOf(Links::class, $links = $page->links('foo'));
        static::assertSame(['foo' => $links], $page->getLinks());
    }

    public function testExtrasAPI()
    {
        $page = new Page();

        static::assertSame([], $page->getExtras());
        static::assertSame('bar', $page->getExtra('foo', 'bar'));
        static::assertNull($page->getExtra('foo'));

        $page->setExtra('foo', 'baz');

        static::assertSame(['foo' => 'baz'], $page->getExtras());
        static::assertSame('baz', $page->getExtra('foo', 'bar'));
        static::assertSame('baz', $page->getExtra('foo'));

        $page->removeExtra('foo');

        static::assertSame([], $page->getExtras());
        static::assertSame('bar', $page->getExtra('foo', 'bar'));
        static::assertNull($page->getExtra('foo'));
    }

    public function testCharset()
    {
        $page = new Page();

        static::assertSame('UTF-8', $page->getCharset());
        static::assertSame('UTF-9', $page->setCharset('UTF-9')->getCharset());
        static::assertSame('UTF-8', $page->setCharset(null)->getCharset());
    }

    public function testCanonical()
    {
        $page = new Page();

        static::assertNull($page->getCanonical());
        static::assertSame('canonical', $page->setCanonical('canonical')->getCanonical());
        static::assertNull($page->setCanonical(null)->getCanonical());
    }
}
