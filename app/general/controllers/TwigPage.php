<?php

namespace app\general\controllers;

use Twig\Loader\FilesystemLoader as TwigLoader;
use Twig\Environment as TwigEnvironment;

use app\general\libraries\DataStorage\VariablesArray;
use app\general\controllers\Page;


abstract class TwigPage extends Page
{
    /** @var TwigEnvironment */
    private $twig;
    
    /** @var VariablesArray */
    protected $pageData;


    /**
     * @param string $templatesFoler  Path to the folder which contains templates
     */
    public function __construct(string $templatesFoler)
    {
        $twigSettings = [
            'strict_variables' => true,
        ];

        $twigLoader = new TwigLoader($templatesFoler);

        $this->twig     = new TwigEnvironment($twigLoader, $twigSettings);
        $this->pageData = new VariablesArray();
    }


    /**
     * Method will render temlate with $this->pageData variables
     * 
     * @param string $filename  Path from environment folder to template filename
     *   Environment folder is path which you passed in the constructor.
     *   The file extension doesn't matter. It can be .twig .html .php .txt or whatever.
     */
    protected function renderTwigFile(string $filename) : void
    {
        echo $this->twig->render($filename, $this->pageData->getAll());
    }
}
