<?php

class Database
{
  protected $conn;
  protected $host;
  protected $username;
  protected $password;
  protected $dbname;

  public function __construct()
  {
      $this->host = "localhost";
      $this->username = "root";
      $this->password = "";
      $this->dbname = "dbumbra";
  }
  public function Connect()
  {
    $this->conn = null;
    try
    {
      $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
      $this->conn->exec("set names utf8");
    }catch(\PDOException $exception)
    {
      die(json_encode(["ErrorCode"=>1, "ErrorMessage" => "Database Connection Error", "ErrorRef" => "DB0000"]));
    }
    return $this->conn;
  }


}