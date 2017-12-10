<?php

namespace PETest\Component\SEO;

use PE\Component\SEO\Meta;

class MetaTest extends \PHPUnit_Framework_TestCase
{
    public function testMetaAPI()
    {
        $meta = new Meta('key', 'value');

        static::assertSame('key', $meta->getKey());
        static::assertSame('value', $meta->getValue());
        static::assertNull($meta->getContent());
        static::assertSame('content', $meta->setContent('content')->getContent());
    }
}
