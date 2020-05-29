<?php


namespace SmallRuralDog\Admin\Components\Form;


use SmallRuralDog\Admin\Components\Component;

class WangEditor extends Component
{

    protected $componentName = 'WangEditor';

    protected $menus = [
        'head',  // 标题
        'bold',  // 粗体
        'fontSize',  // 字号
        'fontName',  // 字体
        'italic',  // 斜体
        'underline',  // 下划线
        'strikeThrough',  // 删除线
        'foreColor',  // 文字颜色
        'backColor',  // 背景颜色
        'link',  // 插入链接
        'list',  // 列表
        'justify',  // 对齐方式
        'quote',  // 引用
        'emoticon',  // 表情
        'image',  // 插入图片
        'table',  // 表格
        'video',  // 插入视频
        'code',  // 插入代码
        'undo',  // 撤销
        'redo'  // 重复
    ];

    protected $zIndex = 0;

    protected $uploadImgShowBase64 = false;

    protected $uploadImgServer;

    protected $uploadFileName;

    protected $uploadImgHeaders;

    static public function make($value = null)
    {
        return new Wangeditor($value);
    }

    /**
     * 自定义菜单
     * @param array $menus
     * @return $this
     */
    public function menus(array $menus)
    {
        $this->menus = $menus;
        return $this;
    }

    /**
     * 编辑区域的 z-index
     * @param int $zIndex
     * @return $this
     */
    public function zIndex(int $zIndex)
    {
        $this->zIndex = $zIndex;
        return $this;
    }

    /**
     * 使用 base64 保存图片
     * @param bool $uploadImgShowBase64
     * @return $this
     */
    public function uploadImgShowBase64(bool $uploadImgShowBase64 = true)
    {
        $this->uploadImgShowBase64 = $uploadImgShowBase64;
        return $this;
    }

    /**
     * 配置服务器端地址
     * @param string $uploadImgServer
     * @return $this
     */
    public function uploadImgServer(string $uploadImgServer)
    {
        $this->uploadImgServer = $uploadImgServer;
        return $this;
    }

    /**
     * 自定义 fileName
     * @param mixed $uploadFileName
     * @return WangEditor
     */
    public function uploadFileName(string $uploadFileName)
    {
        $this->uploadFileName = $uploadFileName;
        return $this;
    }

    /**
     * 自定义 header
     * @param mixed $uploadImgHeaders
     * @return WangEditor
     */
    public function uploadImgHeaders(array $uploadImgHeaders)
    {
        $this->uploadImgHeaders = $uploadImgHeaders;
        return $this;
    }


}
