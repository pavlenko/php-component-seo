<?php

namespace PE\Component\SEO;

class Metas
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var Meta[]
     */
    private $values = [];

    /**
     * Metas constructor.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get all meta values
     *
     * @return Meta[]
     */
    public function all()
    {
        return $this->values;
    }

    /**
     * Set meta
     *
     * @param string      $name
     * @param string|null $content
     *
     * @return $this
     */
    public function add($name, $content = null)
    {
        $this->values[$name] = new Meta($this->type, $name);

        $this->values[$name]->setContent($content);

        return $this;
    }

    /**
     * Get meta
     *
     * @param string $name
     *
     * @return Meta|null
     */
    public function get($name)
    {
        return array_key_exists($name, $this->values) ? $this->values[$name] : null;
    }

    /**
     * Remove meta
     *
     * @param string $name
     *
     * @return $this
     */
    public function remove($name)
    {
        unset($this->values[$name]);
        return $this;
    }

    /**
     * Clear meta
     *
     * @return $this
     */
    public function clear()
    {
        $this->values = [];
        return $this;
    }
}