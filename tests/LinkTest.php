<?php

namespace PETest\Component\SEO;

use PE\Component\SEO\Link;

class LinkTest extends \PHPUnit_Framework_TestCase
{
    public function testLinkAPI()
    {
        $link = new Link('rel', 'href');

        static::assertSame('rel', $link->getRel());
        static::assertSame('href', $link->getHref());
        static::assertNull($link->getType());
        static::assertNull($link->getTitle());
        static::assertSame('type', $link->setType('type')->getType());
        static::assertSame('title', $link->setTitle('title')->getTitle());
    }
}
