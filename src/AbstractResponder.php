<?php
namespace Websoftwares\Adr;
/**
 * Responder
 */
abstract class AbstractResponder
{
    /**
     * $file
     * @var string
     */
    public $file = null;

    /**
     * $variables
     * @var array
     */

    public $variables = null;
    /**
     * $path
     * @var string
     */
    public $path = null;

    /**
     * Getter for variables
     *
     * @return mixed
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Setter for variables
     *
     * @param  mixed $variables Value to set
     * @return self
     */
    public function setVariables($key, $value)
    {
        $this->variables[$key] = $value;

        return $this;
    }

    /**
     * Getter for path
     *
     * @return mixed
     */
    public function getPath()
    {
        if (! $this->path) {
            $this->path =  dirname(__FILE__) . '/views/';
        }

        if (! file_exists($this->path . $this->file . '.php')) {
            throw new \OutOfRangeException("the file " . $this->path . $this->file . '.php' ." could not be retrieved");
        }

        return $this->path;
    }

    /**
     * Setter for path
     *
     * @param  mixed $path Value to set
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Sets the $file.
     *
     * @param string $file the file
     *
     * @return self
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * render a view file
     *
     * @return void
     */
    public function render()
    {
        extract($this->variables);

        ob_start();
        include $this->getPath(). $this->file .'.php';
        $renderedView = ob_get_clean();

        return $renderedView;
    }
}
