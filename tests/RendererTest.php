<?php

namespace PETest\Component\SEO;

use PE\Component\SEO\Page;
use PE\Component\SEO\Renderer;
use PE\Component\SEO\Template;

class RendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Page
     */
    private $page;

    /**
     * @var Renderer
     */
    private $renderer;

    protected function setUp()
    {
        $this->page     = new Page();
        $this->renderer = new Renderer($this->page);
    }

    public function testRenderTitleString()
    {
        $this->page->setTitle('Page title');
        static::assertSame('<title>Page title</title>', $this->renderer->renderTitle());
    }

    public function testRenderTitleTemplate()
    {
        $this->page->setTitle(new Template('Page title for %foo%', ['foo' => 'bar']));
        static::assertSame('<title>Page title for bar</title>', $this->renderer->renderTitle());
    }

    public function testRenderMetaDescriptionString()
    {
        $this->page->setDescription('Page description');
        static::assertSame('<meta name="description" content="Page description" />', $this->renderer->renderMetas());
    }

    public function testRenderMetaDescriptionTemplate()
    {
        $this->page->setDescription(new Template('Page description for %foo%', ['foo' => 'bar']));

        static::assertSame(
            '<meta name="description" content="Page description for bar" />',
            $this->renderer->renderMetas()
        );
    }

    public function testRenderCharset()
    {
        $this->page->setCharset('UTF-16');
        static::assertSame('<meta charset="UTF-16" />', $this->renderer->renderMetas());
    }

    public function testRenderCanonical()
    {
        $this->page->setCanonical('http://canonical.com');
        static::assertSame('<link rel="canonical" href="http://canonical.com">', $this->renderer->renderLinks());
    }

    public function testRenderLink()
    {
        $this->page->links('alternate')->add('http://example.com', 'Type', 'Title');

        static::assertSame(
            '<link rel="alternate" href="http://example.com" type="Type" title="Title">',
            $this->renderer->renderLinks()
        );
    }
}
