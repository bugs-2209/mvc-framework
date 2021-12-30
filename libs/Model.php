<?php

namespace Framework;

use Framework\DB;

class Model extends DB
{
    protected $connect;

    protected $table = '';

    protected $fillable = '';

    public $dataList = [];

    const SLOW_LOG = 0.5;

    public function __construct()
    {   
        $this->connect = $this->connect();
        $this->table = $this->getNameTable();
    }

    public function getNameTable()
    {
        $result = '';

        if ($this->table == '') {
          $result = str_replace('_model', '', get_class($this));
        } else{
          $result = $this->table;
        }
    
        return $result;
    }

    public function save($data)
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

        $sql = "INSERT INTO ".$this->table."(".trim($fieldList, ',').") VALUES (".trim($valueList, ',').")";
        
        $this->_query($sql);
    }
    
    public function update($data, $where)
    {
        $val = '';
        
        foreach ($data as $key => $value){
            $val .= "$key = '".$this->connect->real_escape_string($value)."',";
        }

        // Sau vòng lặp biến $val sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'UPDATE '.$this->table. ' SET '.trim($val, ',').' WHERE id = '.$where;

        $this->_query($sql);
    }

    public function destroy($id)
    {    
        // Delete
        $sql = "DELETE FROM $this->table WHERE id = $id";

        $this->_query($sql);
    }
    
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        
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

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id  = $id";

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
        //run query
        $result = mysqli_query($this->connect, $sql);
        
        return $result;
    }
}
