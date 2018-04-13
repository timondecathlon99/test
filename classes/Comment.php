<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 13.04.2018
 * Time: 10:31
 */
<?
class Comment{
    private $id;
    private $pdo;

    public function __construct($id, $pdo){
        $this->id = $id;
        $this->pdo = $pdo;
    }

    public function show(){
        $sql = $this->pdo->prepare("SELECT * FROM comments WHERE id= :id");
        $sql->bindParam(":id", $this->id);
        $sql->execute();
        $item_info = $sql->fetch();
        return $item_info;
    }

    public function showField($field){
        $sql = $this->pdo->prepare("SELECT * FROM comments WHERE id= :id");
        $sql->bindParam(":id", $this->id);
        $sql->execute();
        $item_info = $sql->fetch();
        return $item_info[$field];
    }

    public function comment_id(){
        return $this->showField('id');
    }

    public function title(){
        return $this->showField('title');
    }

    public function description(){
        return $this->showField('description');
    }

    public function author(){
        return $this->showField('author_id');
    }


    public function publ_time(){
        return date_format_rus($this->showField('publ_time'));
    }

    public function create($author_id, $description){
        $timestamp = time();
        $sql = $this->pdo->prepare("INSERT INTO comments(author_id,description,publ_time)"."VALUES(:author_id, :description,'$timestamp')");
        $sql->bindParam(":author_id", $author_id);
        $sql->bindParam(":description", $description);
        try {
            $sql->execute();
            //return true
        }catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
            //return false;
        }
    }
}


?>