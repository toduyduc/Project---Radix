<?php
if(!defined("_INCODE")) die("unauthorized access...");

function query($sql,$data=[],$statementStatus = false){
    global $conn;
    $query = false;
    try{
        $statement = $conn->prepare($sql);
        if(empty($data)){
            $query = $statement->execute();
        }else{
            $query = $statement->execute($data);
        }
        
    }catch(exception $exception){
        require_once "modules/errors/database.php";
        die(); // dừng hết chương trình
    }
    if($statementStatus){
        return $statement;
    }else{
        return $query;
    }
}

function insert($table,$dataInsert){
    $keyArr = array_keys($dataInsert);
    $fieldStr = implode(",",$keyArr);
    $valueStr = ":".implode(",:",$keyArr);
    $sql = 'INSERT INTO '.$table.' ('.$fieldStr.') VALUES('.$valueStr.')';
    $result = query($sql,$dataInsert);
    return $result;
}

function update($table,$dataUpdate,$condition){    // condition (english) : điều kiện
    
    $updStr = "";
    foreach($dataUpdate as $key=>$value){
        $updStr.= $key."=:".$key.", ";
    }
    $updStr = substr($updStr,0,-2);
    $sql = 'UPDATE '.$table.' SET '.$updStr.' WHERE '.$condition.'';
    $result = query($sql,$dataUpdate);
    return $result;
}

function delete($table,$condition=''){
    $data = '';
    if(!empty($condition)){
        $sql = 'DELETE FROM '.$table.' WHERE '.$condition.'';
    }else{
        $sql = 'DELETE FROM '.$table.'';
    }
   
    $result = query($sql);
    return $result;
}

// query data
function getData($sql){
    $statement = query($sql,[],true);
    if(is_object($statement)){
        $dataFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dataFetch;
    }else return false;
}


// lấy 1 bản ghi đầu tiên
function firstRow($sql){
    $statement = query($sql,[],true);
    if(is_object($statement)){
        $dataFetch = $statement->fetch(PDO::FETCH_ASSOC);
        return $dataFetch;
    }else return false;
}

// lấy dữ liệu theo table,field, condition
function get($table,$field = "*", $condition=""){
    $sql = 'SELECT '.$field.' FROM '.$table.'';
    if(!empty($condition)){
        $sql.=' WHERE '.$condition;
    }
    return getData($sql);
}

function first($table,$field = "*", $condition=""){
    $sql = 'SELECT '.$field.' FROM '.$table.'';
    if(!empty($condition)){
        $sql.=' WHERE '.$condition;
    }
    return firstRow($sql);
}

// function bổ sung
// lấy số dòng câu truy vấn
function getRows($sql){
    $statement = query($sql,[],true);
    if(!empty($statement)){
        return $statement -> rowCount();
    }
}

// lấy id vừa insert
function insertId(){
    global $conn;
    return $conn->lastInsertId();
}
