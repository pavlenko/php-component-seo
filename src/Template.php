<?php

namespace PE\Component\SEO;

class Template
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $vars;

    /**
     * @var string
     */
    private $rule;

    /**
     * Template constructor.
     *
     * @param string $template
     * @param array  $vars
     * @param string $rule
     */
    public function __construct($template, array $vars = [], $rule = '/\%(\S+)\%/')
    {
        $this->template = $template;
        $this->vars     = $vars;
        $this->rule     = $rule;
    }

    /**
     * Get vars
     *
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * Set vars
     *
     * @param array $vars
     *
     * @return $this
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
        return $this;
    }

    /**
     * Check var exists
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasVar($name)
    {
        return array_key_exists($name, $this->vars);
    }

    /**
     * Get var or default
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getVar($name, $default = null)
    {
        return array_key_exists($name, $this->vars) ? $this->vars[$name] : $default;
    }

    /**
     * Set var
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setVar($name, $value)
    {
        $this->vars[$name] = $value;
        return $this;
    }

    /**
     * Remove var
     *
     * @param string $name
     *
     * @return $this
     */
    public function removeVar($name)
    {
        unset($this->vars[$name]);
        return $this;
    }

    /**
     * Render template to string, empty keys will be removed
     *
     * @return string
     */
    public function __toString()
    {
        return (string) preg_replace_callback($this->rule, function(array $matches){
            return (string) isset($this->vars[$matches[1]]) ? $this->vars[$matches[1]] : '';
        }, $this->template);
    }
}