<?php

/**
 * PHP模板引擎
 *
 * @author  Zou Yiliang
 * @since   1.0
 */
class View
{
    public $path;
    protected $extension = '.php';
    protected $data = array();
    protected $tpl;

    public function render($tpl, array $data = array())
    {
        $this->tpl = $tpl;
        $this->data = $data;
        return $this->renderFile();
    }

    protected function renderFile()
    {
        extract($this->data);
        ob_start();
        include static::getFile();
        return ob_get_clean();
    }

    protected function getFile()
    {
        //根目录是否存在
        $path = realpath($this->path);
        if ($path === false) {
            throw new \Exception('path does not exist:' . $this->path);
        }

        //文件是否存在
        $file = $path . DIRECTORY_SEPARATOR . $this->tpl . $this->extension;
        $realFile = realpath($file);
        if ($realFile === false) {
            throw new \Exception('file does not exist:' . $file);
        }

        //限制在指定目录范围内
        if (strpos($realFile, $path) === false) {
            throw new \Exception('deny access the file:' . $realFile);
        }

        return $realFile;
    }
}