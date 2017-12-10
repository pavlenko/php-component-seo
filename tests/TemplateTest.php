<?php

namespace PETest\Component\SEO;

use PE\Component\SEO\Template;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        static::assertSame([], (new Template('foo'))->getVars());
        static::assertSame(['bar' => 'baz'], (new Template('foo', ['bar' => 'baz']))->getVars());
    }

    public function testVarsAPI()
    {
        $tpl = new Template('foo');

        static::assertFalse($tpl->hasVar('foo'));
        static::assertNull($tpl->getVar('foo'));
        static::assertSame('default', $tpl->getVar('foo', 'default'));

        $tpl->setVar('foo', 'bar');

        static::assertTrue($tpl->hasVar('foo'));
        static::assertSame('bar', $tpl->getVar('foo'));
        static::assertSame('bar', $tpl->getVar('foo', 'default'));

        $tpl->removeVar('foo');

        static::assertFalse($tpl->hasVar('foo'));

        static::assertSame(['bar' => 'baz'], $tpl->setVars(['bar' => 'baz'])->getVars());
    }

    public function testToString()
    {
        static::assertSame('bar', (string) new Template('%foo%', ['foo' => 'bar']));
        static::assertNotSame('bar', (string) new Template('{{foo}}', ['foo' => 'bar']));
        static::assertSame('bar', (string) new Template('{{foo}}', ['foo' => 'bar'], '/\{\{(\S+)\}\}/'));
    }
}
