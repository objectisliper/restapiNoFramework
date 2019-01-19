<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 13.01.19
 * Time: 0:41
 */

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{
    public function index(){
        if($this->request->getMethod() === "POST"){
            $data = $this->request->getBodyParameters();
            if((new TaskModel())->save($data)){
                $this->redirect('/');
            }
            else{
                return $this->renderTemplate('CreateTask', ['error' => 'Something went wrong, try again later']);
            }
        }

        return $this->renderTemplate('CreateTask');
    }

    public function editTask($params){
        if($this->request->getMethod() === "POST"){
            $data = $this->request->getBodyParameters();
            if ((new TaskModel())->updateTaskById($data,$params['id'])){
                $this->redirect('/');
            }
            else{
                return $this->renderTemplate('EditTask', ['error' => 'Something went wrong, try again later']);
            }
        }
        elseif ($this->request->getMethod() === "PUT") {
            if ((new TaskModel())->updateTaskById(["complete" => 1],$params['id'])){
                return $this->renderTemplate(json_encode('success'));
            }
            else{
                return $this->renderTemplate('EditTask', ['error' => 'Something went wrong, try again later']);
            }
        }

        $data['task'] = (new TaskModel())->getTaskById($params['id']);
        return $this->renderTemplate('EditTask', $data);
    }

}