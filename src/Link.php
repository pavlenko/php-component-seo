<?php

namespace PE\Component\SEO;

class Link
{
    /**
     * @var string
     */
    private $rel;

    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $title;

    /**
     * Link constructor.
     *
     * @param string $rel
     * @param string $href
     */
    public function __construct($rel, $href)
    {
        $this->rel  = $rel;
        $this->href = $href;
    }

    /**
     * Get link rel
     *
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * Get link href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Get link type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set link type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get link title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
}