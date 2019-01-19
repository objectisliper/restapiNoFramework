<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 16:21
 */

namespace App\Controllers;

use Http\Request;
use Http\Response;
use App\Template\TwigRenderer;



class BaseController
{
    protected $request;
    protected $response;
    protected $renderer;

    public function __construct(
        Request $request,
        Response $response,
        TwigRenderer $renderer
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    protected function renderTemplate($template, $data=[]){
        $html = isset($data) ? $this->renderer->render($template, $data) : $this->renderer->render($template);
        return $this->response->setContent($html);
    }

    protected function render404(){
        $this->response->setStatusCode(404);
        return $this->response->setContent('404 - Page not found');
    }

    protected function redirect($url){
        header('Location: ' . $url, true, 301);

        exit();
    }

}