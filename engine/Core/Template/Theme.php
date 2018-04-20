<?php

namespace Engine\Core\Template;

use function extract;
use const ROOT_DIR;
use function sprintf;

class Theme
{
    const RULES_NAME_FILE = [
        'header' => 'header-%s',
        'footer' => 'footer-%s',
        'sidebar' => 'sidebar-%s'
    ];

    /**
     * url content theme
     * @var string
     */
    public $url = '';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param null $name
     */
    public function header($name = null)
    {
        $name = (string) $name;
        $file = 'header';

        if($name !== '')
        {
            $file = sprintf(self::RULES_NAME_FILE['header'], $name);
        }

        $this->loadTemplateFile($file);
    }

    /**
     * @param string $name
     */
    public function footer($name = null)
    {
        $name = (string) $name;
        $file = 'footer';

        if($name !== '')
        {
            $file = sprintf(self::RULES_NAME_FILE['footer'], $name);
        }

        $this->loadTemplateFile($file);
    }

    /**
     * @param string $name
     */
    public function sidebar($name = null)
    {
        $name = (string) $name;
        $file = 'sidebar';

        if($name !== '')
        {
            $file = sprintf(self::RULES_NAME_FILE['sidebar'], $name);
        }

        $this->loadTemplateFile($file);
    }


    /**
     * @param string $name
     * @param array $data
     */
    public function block($name = '', $data = [])
    {
        $name = (string) $name;

        if($name !== '')
        {
            $this->loadTemplateFile($name, $data);
        }
    }

    /**
     * @param $nameFile
     * @param array $data
     * @throws \Exception
    */
    private function loadTemplateFile($nameFile, $data = [])
    {
        $templateFile = ROOT_DIR . '/content/themes/default/' . $nameFile .'.php';

        if(is_file($templateFile))
        {
            extract($data);
            require_once $templateFile;
        }
        else
        {
            throw new \Exception(sprintf('view file "%s" does not exist!',$templateFile));
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}