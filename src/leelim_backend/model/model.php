<?php
class DBconnection {
    protected $connection = [
        "host" => "localhost:3306", // Host and port
        "database" => "leelim_backend", // Database name
        "user" => "root", // User
        "password" => "root" // Password
    ];
    public function connect(){
        try {
            return new \PDO("mysql:host=".$this->connection["host"].";dbname=".$this->connection["database"].";charset=utf8mb4", $this->connection["user"], $this->connection["password"]);
        } catch (\PDOException $defaultPDOError) {
            print "Error connection $defaultPDOError";
            die();
        }
    }
}
class DBconnectionClient {
    protected $connection = [
        "host" => "localhost:3306", // Host and port
        "database" => "leelim", // Database name
        "user" => "root", // User
        "password" => "root" // Password
    ];
    public function connect(){
        try {
            return new \PDO("mysql:host=".$this->connection["host"].";dbname=".$this->connection["database"].";charset=utf8mb4", $this->connection["user"], $this->connection["password"]);
        } catch (\PDOException $defaultPDOError) {
            print "Error connection $defaultPDOError";
            die();
        }
    }
}
class MVCmodelDB extends DBconnection{
    // RUN QUERY 
    public function runQuerySQL($query, $param = [], $select = false){
        $prepare = $this->connect()->prepare($query);
        $data_return = $prepare->execute($param);

        if($select){
            $data_return = $prepare->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data_return;
    }
    public function testQuery($table){
        //SELECT TEST
        $query = "SELECT * FROM `$table`";
        return $this->runQuerySQL($query, [], true);
    }
}
class MVCmodelDBClient extends DBconnectionClient{
    // RUN QUERY 
    public function runQuerySQL($query, $param = [], $select = false){
        $prepare = $this->connect()->prepare($query);
        $data_return = $prepare->execute($param);

        if($select){
            $data_return = $prepare->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data_return;
    }
    public function testQuery($table){
        //SELECT TEST
        $query = "SELECT * FROM `$table`";
        return $this->runQuerySQL($query, [], true);
    }
}