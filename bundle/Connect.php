<?php
namespace bundle;

class Connect {

    private $host;

    private $user;

    private $password;

    private $db;

    public $sqlConnect = FALSE;

    public $sqlConnectToDb = FALSE;

    public function __construct($sqlConfig)
    {
        $this->host = $sqlConfig['host'];
        $this->user = $sqlConfig['user'];
        $this->password = $sqlConfig['password'];
        $this->db = $sqlConfig['db'];

        $this->sqlConnectToDb();
    }

    public function sqlConnectToDb()
    {
        $host = $this->host;
        $user = $this->user;
        $password = $this->password;
        $db = $this->db;

        $sqlConnect = mysqli_connect($host, $user, $password);
        $this->sqlConnect = $sqlConnect;

        if($sqlConnect){
            $dbSelect = mysqli_select_db($sqlConnect, $db);
            if($dbSelect) {
                $this->sqlConnectToDb = mysqli_connect($host, $user, $password, $db);
            }
        }
    }
}