<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 17:40
 */

namespace App\Template;


interface Renderer
{
    public function render($template, $data = []) : string;

}