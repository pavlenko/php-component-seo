<?php

namespace PE\Component\SEO;

use PE\Component\SEO\Exception\ExceptionInterface;
use PE\Component\SEO\Exception\InvalidArgumentException;

class Page
{
    /**
     * @var Metas[]
     */
    private $metas = [];

    /**
     * @var Links[]
     */
    private $links = [];// 2, 3, 4 ©Rammstein

    /**
     * @var string|Template
     */
    private $title;

    /**
     * @var array
     */
    private $extras = [];

    /**
     * Page constructor.
     *
     * @param string $title
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Get metas group by type
     *
     * @param string $type
     *
     * @return Metas
     */
    public function meta($type)
    {
        if (!array_key_exists($type, $this->metas)) {
            $this->metas[$type] = new Metas($type);
        }

        return $this->metas[$type];
    }

    /**
     * Get all metas
     *
     * @return Metas[]
     */
    public function getMetas()
    {
        return $this->metas;
    }

    /**
     * Get links group by type
     *
     * @param string $rel
     *
     * @return Links
     */
    public function links($rel)
    {
        if (!array_key_exists($rel, $this->links)) {
            $this->links[$rel] = new Links($rel);
        }

        return $this->links[$rel];
    }

    /**
     * Get all links
     *
     * @return Links[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Get title
     *
     * @return string|Template
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string|Template $title
     *
     * @return $this
     *
     * @throws ExceptionInterface
     */
    public function setTitle($title)
    {
        $this->validateTemplate($title);

        $this->title = $title;
        return $this;
    }

    /**
     * Get all page extras
     *
     * @return array
     */
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Get page extra by name, fallback to default if not set
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getExtra($name, $default = null)
    {
        return isset($this->extras[$name]) ? $this->extras[$name] : $default;
    }

    /**
     * Set page extra by name
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setExtra($name, $value)
    {
        $this->extras[$name] = $value;
        return $this;
    }

    /**
     * Remove page extra by name
     *
     * @param string $name
     *
     * @return $this
     */
    public function removeExtra($name)
    {
        unset($this->extras[$name]);
        return $this;
    }

    /**
     * Get charset helper
     *
     * @return string
     */
    public function getCharset()
    {
        return count($metas = $this->meta('charset')->all()) ? current($metas)->getValue() : 'UTF-8';
    }

    /**
     * Set charset helper
     *
     * @param string $charset
     *
     * @return $this
     */
    public function setCharset($charset)
    {
        if (null === $charset) {
            $this->meta('charset')->clear();
        } else {
            $this->meta('charset')->add($charset);
        }

        return $this;
    }

    /**
     * Get description helper
     *
     * @return null|string|Template
     */
    public function getDescription()
    {
        return ($meta = $this->meta('name')->get('description')) ? $meta->getContent() : null;
    }

    /**
     * Set description helper
     *
     * @param null|string|Template $description
     *
     * @return $this
     *
     * @throws ExceptionInterface
     */
    public function setDescription($description)
    {
        $this->validateTemplate($description);

        $this->meta('name')->add('description', $description);
        return $this;
    }

    /**
     * Get keywords helper
     *
     * @return null|string|Template
     */
    public function getKeywords()
    {
        return ($meta = $this->meta('name')->get('keywords')) ? $meta->getContent() : null;
    }

    /**
     * Set description helper
     *
     * @param null|string|Template $keywords
     *
     * @return $this
     *
     * @throws ExceptionInterface
     */
    public function setKeywords($keywords)
    {
        $this->validateTemplate($keywords);

        $this->meta('name')->add('keywords', $keywords);
        return $this;
    }

    /**
     * Get canonical url
     *
     * @return string
     */
    public function getCanonical()
    {
        return count($links = $this->links('canonical')->all()) ? current($links)->getHref() : null;
    }

    /**
     * Set canonical url
     *
     * @param string $href
     *
     * @return $this
     */
    public function setCanonical($href)
    {
        if (null === $href) {
            $this->links('canonical')->clear();
        } else {
            $this->links('canonical')->add($href);
        }

        return $this;
    }

    /**
     * Validate title, description, keywords allowed type of value
     *
     * @param $value
     *
     * @throws ExceptionInterface
     */
    private function validateTemplate($value)
    {
        if ($value !== null && !is_string($value) && !($value instanceof Template)) {
            throw new InvalidArgumentException('Value must be a string or instance of ' . Template::class);
        }
    }
}