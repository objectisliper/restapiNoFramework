<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 18:37
 */

namespace App\Template;

use Twig_Environment;

class TwigRenderer implements Renderer
{
    private $renderer;

    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    public function render($template, $data = []) : string
    {
        return $this->renderer->render("$template.html", $data);
    }
}