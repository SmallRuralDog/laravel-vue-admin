<?php


namespace SmallRuralDog\Admin\Components;


class Upload extends Component
{
    protected $componentName = "Upload";

    protected $action = "";
    protected $multiple = false;
    protected $data = [];
    protected $showFileList = true;
    protected $drag = false;
    protected $accept;
    protected $listType = 'text';
    protected $disabled = false;
    protected $limit = 1;

    public function __construct($value = null)
    {
        $this->action = route('admin.handle-upload');
        $this->componentValue($value);
    }

    static public function make($value = null)
    {
        return new Upload($value);
    }

    /**
     * @param string $action
     * @return $this
     */
    public function action($action)
    {
        $this->action = $action;
        return $this;
    }


    /**
     * @param bool $multiple
     * @return $this
     */
    public function multiple($multiple)
    {
        $this->multiple = $multiple;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param bool $showFileList
     * @return $this
     */
    public function showFileList($showFileList)
    {
        $this->showFileList = $showFileList;
        return $this;
    }

    /**
     * @param bool $drag
     * @return $this
     */
    public function drag($drag)
    {
        $this->drag = $drag;
        return $this;
    }

    /**
     * @param mixed $accept
     * @return $this
     */
    public function accept($accept)
    {
        $this->accept = $accept;
        return $this;
    }

    /**
     * @param string $listType
     * @return $this
     */
    public function listType($listType)
    {
        $this->listType = $listType;
        return $this;
    }

    public function text()
    {
        $this->listType = "text";
        return $this;
    }

    public function picture()
    {
        $this->listType = "picture";
        return $this;
    }

    public function pictureCard()
    {
        $this->listType = "picture-card";
        return $this;
    }

    /**
     * @param bool $disabled
     * @return $this
     */
    public function disabled($disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }


}
