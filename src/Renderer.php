<?php

namespace PE\Component\SEO;

class Renderer
{
    /**
     * @var Page
     */
    private $page;

    /**
     * @var string
     */
    private $encoding;

    /**
     * Renderer constructor.
     *
     * @param Page   $page
     * @param string $encoding
     */
    public function __construct(Page $page, $encoding = 'UTF-8')
    {
        $this->page     = $page;
        $this->encoding = $encoding;
    }

    /**
     * Render <title> html
     *
     * @return string
     */
    public function renderTitle()
    {
        return sprintf('<title>%s</title>', strip_tags((string) $this->page->getTitle()));
    }

    /**
     * Render <meta> html
     *
     * @return string
     */
    public function renderMetas()
    {
        $html = '';

        foreach ($this->page->getMetas() as $metas) {
            foreach ($metas->all() as $meta) {
                if (!empty($content = (string) $meta->getContent())) {
                    $html .= sprintf("<meta %s=\"%s\" content=\"%s\" />\n",
                        $meta->getKey(),
                        $this->normalize($meta->getValue()),
                        $this->normalize($content)
                    );
                } else {
                    $html .= sprintf("<meta %s=\"%s\" />\n",
                        $meta->getKey(),
                        $this->normalize($meta->getValue())
                    );
                }
            }
        }

        return trim($html);
    }

    /**
     * Render <link> html
     *
     * @return string
     */
    public function renderLinks()
    {
        $html = '';

        foreach ($this->page->getLinks() as $links) {
            foreach ($links->all() as $link) {
                $attributes = [
                    "rel=\"{$link->getRel()}\"",
                    "href=\"{$link->getHref()}\"",
                ];

                if (!empty($type = $link->getType())) {
                    $attributes[] = "type=\"{$type}\"";
                }

                if (!empty($title = $link->getTitle())) {
                    $attributes[] = "title=\"{$title}\"";
                }

                $html .= sprintf('<link %s>', implode(' ', $attributes));
            }
        }

        return trim($html);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function normalize($string)
    {
        return htmlentities(strip_tags($string), ENT_COMPAT, $this->encoding);
    }
}