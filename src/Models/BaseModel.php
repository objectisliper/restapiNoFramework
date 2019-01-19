<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 19:43
 */

namespace App\Models;

class BaseModel
{
    private $mysqli;

    private $dbConfig = [
        "host" => "localhost:3306",
        "user" => "root",
        "pass" => "dev",
        "db" => "newFramework"
    ];

    public function __construct() {
        $this->mysqli = new \mysqli;
        $this->mysqli->connect($this->dbConfig["host"], $this->dbConfig["user"], $this->dbConfig["pass"], $this->dbConfig['db']);
        $this->mysqli->query("SET NAMES cp1251");
    }

    protected function setTableDB($table) {
        $this->dbConfig["table"] = $table;
    }

    protected function create($values) {
        $table = $this->dbConfig["table"];
        $query = "INSERT INTO $table (";
        foreach ($values as $key => $value) {
            $query.="$key, ";
        }

        $query = substr($query, 0, -2);
        $query.=") VALUES (";
        $types='';
        foreach ($values as $key => $value) {
            $query.="?, ";
            $types.=substr(gettype($value),0,1);
            $preparedData[$key] = &$values[$key];
        }
        $query = substr($query, 0, -2);
        $query.=")";
        $preparedQuery = $this->mysqli->prepare($query);
        array_unshift($preparedData,$types);
        call_user_func_array(array($preparedQuery, 'bind_param'), $preparedData);
        $preparedQuery->execute();
        return !isset($mysqli->error);
    }

    public function getAll() {
        $table = $this->dbConfig["table"];
        $query = "SELECT * FROM $table;";
        $result = $this->mysqli->query($query);
        $data = array();
        while($row = $result->fetch_row()){
            $data[] = $row;
        }
        return $data;
    }

    protected function getByKeys($keys) {
        $table = $this->dbConfig["table"];
        $query = "SELECT * ";
        $query.=" FROM $table WHERE ";
        $types="";
        $preparedData = array();
        foreach ($keys as $key => $value){
            $query.="$key = ?, AND";
            $types.=substr(gettype($value),0,1);
            $preparedData[$key] = &$keys[$key];
        }
        $query = substr($query, 0, -5);
        $preparedQuery = $this->mysqli->prepare($query);
        array_unshift($preparedData,$types);
        call_user_func_array(array($preparedQuery, 'bind_param'), $preparedData);
        $preparedQuery->execute();
        $meta = $preparedQuery->result_metadata();
        while ($field = $meta->fetch_field())
        {
            $params[] = &$row[$field->name];
        }

        call_user_func_array(array($preparedQuery, 'bind_result'), $params);

        while ($preparedQuery->fetch()) {
            foreach($row as $key => $val)
            {
                $c[$key] = $val;
            }
            $result[] = $c;
        }
        return isset($result) ? $result : Null;
    }

    protected function update($values, $filterValues) {
        $table = $this->dbConfig["table"];
        $query = "UPDATE $table SET ";
        $types = "";
        foreach ($values as $key => $value){
            $query.="$key = ?, ";
            $types.=substr(gettype($value),0,1);
            $preparedData[$key] = &$values[$key];
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ";
        foreach ($filterValues as $key => $value){
            $query.="$key = ?, AND ";
            $types.=substr(gettype($value),0,1);
            $preparedData[$key.'2'] = &$filterValues[$key];
        }
        $query = substr($query, 0, -6);
        $preparedQuery = $this->mysqli->prepare($query);
        array_unshift($preparedData,$types);
        call_user_func_array(array($preparedQuery, 'bind_param'), $preparedData);
        $preparedQuery->execute();
        return !isset($mysqli->error);
    }

}