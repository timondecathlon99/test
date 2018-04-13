<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 13.04.2018
 * Time: 10:30
 */
<?php
class Member{

    public $email;

    public function __construct($member_id, $pdo){
        $this->member_id = $member_id;
        $this->pdo = $pdo;
    }

    public function show(){
        $sql = $this->pdo->prepare("SELECT * FROM user WHERE id= :member_id");
        $sql->bindParam(":member_id", $this->member_id);
        $sql->execute();
        $member = $sql->fetch();
        return $member;
    }

    public function showField($field){
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE id= :member_id");
        $sql->bindParam(":member_id", $this->member_id);
        $sql->execute();
        $member = $sql->fetch();
        return $member[$field];
    }

    public function name(){
        return $this->showField('name');
    }

    public function email(){
        return $this->showField('email');
    }

    public function findByEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $sql->bindParam(":email", $email);
        $sql->execute();
        $member = $sql->fetch();
        return $member['id'];
    }

    public function create($name, $email){
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $sql->bindParam(":email", $email);
        $sql->execute();
        if($sql->rowCount() == 0){
            $sql = $this->pdo->prepare("INSERT INTO users(name,email)"."VALUES('$name','$email')");
            $sql->bindParam(":name", $name);
            $sql->bindParam(":email", $email);
            try {
                $sql->execute();
            }catch (PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
            }
        }
    }
}



?>