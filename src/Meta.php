<?php

namespace PE\Component\SEO;

class Meta
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $content;

    /**
     * Meta constructor.
     *
     * @param string $key
     * @param string $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Get meta key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get meta value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get meta content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set meta content
     *
     * @param string $content
     *
     * @return $this;
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}