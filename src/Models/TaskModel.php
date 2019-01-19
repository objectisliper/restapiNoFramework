<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 13.01.19
 * Time: 0:41
 */

namespace App\Models;


class TaskModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
        $this->setTableDB('tasks');
    }

    public function save($data){
        return $this->create($data);
    }

    public function getTaskById($id){
        return $this->getByKeys(['id' => $id])[0];
    }

    public function updateTaskById($values, $id)
    {
        return $this->update($values, ['id' => $id]);
    }

}