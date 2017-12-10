<?php

namespace PETest\Component\SEO;

use PE\Component\SEO\Metas;

class MetasTest extends \PHPUnit_Framework_TestCase
{
    public function testMetasAPI()
    {
        $metas = new Metas('metas');

        static::assertSame([], $metas->all());
        static::assertNull($metas->get('foo'));

        $metas->add('foo');
        $metas->add('bar', 'baz');

        static::assertNotNull($metas->get('foo'));
        static::assertNotNull($metas->get('bar'));

        static::assertSame('metas', $metas->get('foo')->getKey());
        static::assertSame('metas', $metas->get('bar')->getKey());

        static::assertNull($metas->get('foo')->getContent());
        static::assertSame('baz', $metas->get('bar')->getContent());

        $metas->remove('foo');
        static::assertNull($metas->get('foo'));

        $metas->clear();
        static::assertSame([], $metas->all());
    }
}
