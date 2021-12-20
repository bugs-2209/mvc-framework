<?php

namespace Framework\Libs;

use Framework\Libs\DB;

class Model extends DB
{
    protected $connect;

    const SLOW_LOG = 0.5;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    public function save($table, $data)
    {   
        //Lưu danh sách field
        $fieldList = '';
        //Lưu giá trị tương ứng với field
        $valueList = '';

        foreach ($data as $key => $value) {
            $fieldList .= ",$key";
            //mysqli_real_escape_string: Chống SQL Injection - Loại bỏ các ký tự đặc biệt khi được truyền lên
            $valueList .= ",'".$this->connect->real_escape_string($value)."'";
        }

        $sql = "INSERT INTO ".$table."(".trim($fieldList, ',').") VALUES (".trim($valueList, ',').")";
        
        $this->_query($sql);
    }
    
    public function update($table, $data, $where)
    {
        $val = '';
        
        foreach ($data as $key => $value){
            $val .= "$key = '".$this->connect->real_escape_string($value)."',";
        }

        // Sau vòng lặp biến $val sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'UPDATE '.$table. ' SET '.trim($val, ',').' WHERE '.$where;
        
        $this->_query($sql);
    }

    public function delete($table, $id)
    {    
        // Delete
        $sql = "DELETE FROM $table WHERE $id";

        $this->_query($sql);
    }
    
    public function getAll($table)
    {
        $sql = "SELECT * FROM $table";

        $result = $this->_query($sql);

        if (!$result){
            die ('Query Error !!!');
        }
        
        $data = [];
        
        // $row = mysqli_fetch_assoc($result);
        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }

    function getById($table, $id)
    {
        $sql = "SELECT * FROM $table where id  = $id";

        $result = $this->_query($sql);
 
        if (!$result){
            die ('Query Error !!!');
        }
 
        $row = mysqli_fetch_assoc($result);

        if ($row){
            return $row;
        }
        
        return false;
    }

    private function _query($sql)
    {   
        $started = microtime(true) * 1000;
        //run query
        $result = mysqli_query($this->connect, $sql);
        
        $excuteTime = microtime(true) * 1000 - $started;
        
        if ($excuteTime > self::SLOW_LOG) {
            $this->writeLog($sql, $excuteTime);
        }

        return $result;
    }

    public function writeLog($sql, $time)
    {
        $log = [
            'logMessage' => 'Slow Log',
            'logDatatime' => date('Y-m-d H:i:s'),
            'data' => ['sql' => $sql, 'time' => $time],
        ];
        
        $this->log(json_encode($log));        
    }

    public function log($txt)
    {
        $fileLog = $txt;
        file_put_contents(''.date("Ymd").'.txt', $fileLog);

        $folderOld = "".dirname(__DIR__)."\\public\\".date("Ymd").".txt";
        $folderNew = "".dirname(__DIR__)."\\logs\\mysql\\".date("Ymd").".txt";

        rename($folderOld, $folderNew);
    }
}
