<?php


namespace SmallRuralDog\Admin\Layout;


use SmallRuralDog\Admin\Components\Component;

class Column extends Component
{

    protected $componentName = "Column";

    protected $width = 24;

    protected $span;
    protected $offset;
    protected $push;
    protected $pull;
    protected $xs;
    protected $md;
    protected $lg;
    protected $xl;
    protected $tag;

    protected $contents = [];

    public function __construct($content, $width = 24)
    {
        if ($content instanceof \Closure) {
            call_user_func($content, $this);
        } else {
            $this->append($content);
        }
        $this->width = $width;

    }

    public function append($content)
    {
        $this->contents[] = $content;
        return $this;
    }

    public function row($content)
    {
        if ($content instanceof \Closure) {
            $row = new Row();
            call_user_func($content, $row);
        } else {
            $row = new Row($content);
        }
        $this->append($row);
    }

    /**
     * @param mixed $span
     * @return $this
     */
    public function span($span)
    {
        $this->span = $span;
        return $this;
    }

    /**
     * @param mixed $offset
     * @return $this
     */
    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param mixed $push
     * @return $this
     */
    public function push($push)
    {
        $this->push = $push;
        return $this;
    }

    /**
     * @param mixed $pull
     * @return $this
     */
    public function pull($pull)
    {
        $this->pull = $pull;
        return $this;
    }

    /**
     * @param mixed $xs
     * @return $this
     */
    public function xs($xs)
    {
        $this->xs = $xs;
        return $this;
    }

    /**
     * @param mixed $md
     * @return $this
     */
    public function md($md)
    {
        $this->md = $md;
        return $this;
    }

    /**
     * @param mixed $lg
     * @return $this
     */
    public function lg($lg)
    {
        $this->lg = $lg;
        return $this;
    }

    /**
     * @param mixed $xl
     * @return $this
     */
    public function xl($xl)
    {
        $this->xl = $xl;
        return $this;
    }

    /**
     * @param mixed $tag
     * @return $this
     */
    public function tag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @param array $contents
     * @return $this
     */
    public function contents(array $contents)
    {
        $this->contents = $contents;
        return $this;
    }



}
