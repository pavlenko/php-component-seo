<?php

namespace PETest\Component\SEO;

use PE\Component\SEO\Links;

class LinksTest extends \PHPUnit_Framework_TestCase
{
    public function testLinksAPI()
    {
        $links = new Links('links');

        static::assertSame([], $links->all());
        static::assertNull($links->get('foo'));

        $links->add('href1');
        $links->add('href2', 'type2');
        $links->add('href3', 'type3', 'title3');

        static::assertNotNull($links->get('href1'));
        static::assertNotNull($links->get('href2'));
        static::assertNotNull($links->get('href3'));

        static::assertNull($links->get('href1')->getType());
        static::assertSame('type2', $links->get('href2')->getType());
        static::assertSame('type3', $links->get('href3')->getType());

        static::assertNull($links->get('href1')->getTitle());
        static::assertNull($links->get('href2')->getTitle());
        static::assertSame('title3', $links->get('href3')->getTitle());

        $links->remove('href1');
        static::assertNull($links->get('href1'));

        $links->clear();
        static::assertSame([], $links->all());
    }
}
