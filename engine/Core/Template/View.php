<?php

namespace Engine\Core\Template;

use Exception;
use function is_file;
use function mb_strtolower;
use function ob_end_clean;
use function ob_implicit_flush;

use Engine\Core\Template\Theme;
use const ROOT_DIR;

class View
{
    /**
     * @var \Engine\Core\Template\Theme
     */
    protected $theme;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->theme = new Theme();
    }

    /**
     * @param $template
     * @param array $vars
     * @throws Exception
     */
    public function render($template, $vars = [])
    {

        $templatePatch = $this->getTemplatePath($template, ENV);

        if(!is_file($templatePatch))
        {
            throw  new \InvalidArgumentException(
                sprintf('Template "%s" not found in "%s"',$template, $templatePatch)
            );
        }
        $this->theme->setData($vars);
        extract($vars);

        ob_start();
        ob_implicit_flush(1);

        try{
            require_once $templatePatch;
        } catch (\Exception $e){
            ob_end_clean();
            throw $e;
        }

        echo ob_get_clean();
    }


    /**
     * @param $template
     * @param null $env
     * @return string
     */
    private function getTemplatePath($template, $env = null)
    {
        if($env == 'Cms')
        {
            return ROOT_DIR . '/content/themes/default/'. $template . '.php';
        }
        return ROOT_DIR . '/View/'. $template . '.php';
    }

}