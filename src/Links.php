<?php

namespace PE\Component\SEO;

class Links
{
    /**
     * @var string
     */
    private $rel;

    /**
     * @var Link[]
     */
    private $links = [];

    /**
     * Links constructor.
     *
     * @param string $rel
     */
    public function __construct($rel)
    {
        $this->rel = $rel;
    }

    /**
     * Get all links
     *
     * @return Link[]
     */
    public function all()
    {
        return $this->links;
    }

    /**
     * Add new link
     *
     * @param string      $href
     * @param string|null $type
     * @param string|null $title
     *
     * @return $this
     */
    public function add($href, $type = null, $title = null)
    {
        $this->links[$href] = new Link($this->rel, $href);

        $this->links[$href]->setType($type);
        $this->links[$href]->setTitle($title);

        return $this;
    }

    /**
     * Get link by href
     *
     * @param string $href
     *
     * @return Link|null
     */
    public function get($href)
    {
        return isset($this->links[$href]) ? $this->links[$href] : null;
    }

    /**
     * Remove meta
     *
     * @param string $href
     *
     * @return $this
     */
    public function remove($href)
    {
        unset($this->links[$href]);
        return $this;
    }

    /**
     * Clear links
     *
     * @return $this
     */
    public function clear()
    {
        $this->links = [];
        return $this;
    }
}