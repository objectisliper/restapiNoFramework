<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 15:23
 */

namespace App\Controllers;

use App\Models\TaskModel;

class Homepage extends BaseController
{

    public function show()
    {
        $data['tasks'] = (new TaskModel)->getAll();
        $data['auth'] = isset($_SESSION['auth']);
        $this->renderTemplate('Homepage', $data);
    }
}