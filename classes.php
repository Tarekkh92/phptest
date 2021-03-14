<?php
class Database
{
    private $user ;
    private $host;
    private $pass ;
    private $db;

    public function __construct()
    {
        $this->user = "root";
        $this->host = "localhost";
        $this->pass = "";
        $this->db = "full_stack";
    }
    public function connect()
    {
        $mysqlhost = $this->host;
        $dbname = $this->db;
        $username = $this->user;
        $password = $this->pass;
        $pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.';charset=utf8', $username, $password);
        if($pdo){
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }else{
            die("Could not create PDO connection.");
        }
    }
}

class Post
{
    function __construct()
    {
        $db = new Database();
        $sql = $db->connect();
        $this->sql = $sql;
    }
    
    public function create($user_id, $title, $body)
    {
        $stmt = $this->sql->prepare("INSERT INTO posts (user_id, title, body) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
        $stmt->bindParam(2, $title, PDO::PARAM_STR);
        $stmt->bindParam(3, $body, PDO::PARAM_STR);
        if($stmt->execute()){
            return $this->sql->lastInsertId();
        }
    }
    
    public function searchById($post_id)
    {
        $stmt = $this->sql->prepare("SELECT * from posts where id = ?");
        $stmt->bindParam(1, $post_id, PDO::PARAM_STR);
        if($stmt->execute()){
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            return json_encode($post);
        }
    }
    
    public function searchByUserId($user_id)
    {
        $stmt = $this->sql->prepare("SELECT * from posts where user_id = ?");
        $stmt->bindParam(1, $user_id, PDO::PARAM_STR);
        if($stmt->execute()){
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($posts);
        }
    }
    
    public function searchByContent($string)
    {
        $stmt = $this->sql->prepare("SELECT * from posts where body LIKE ?");
        $string = "%$string%";
        $stmt->bindParam(1, $string, PDO::PARAM_STR);
        if($stmt->execute()){
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($posts);
        }
    }
}

class User
{
    function __construct()
    {
        $db = new Database();
        $sql = $db->connect();
        $this->sql = $sql;
    }
    
    public function create($name, $email)
    {
        $stmt = $this->sql->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        if($stmt->execute()){
            return $this->sql->lastInsertId();
        }
    }
}