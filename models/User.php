<?php

class User {
    private $pdo;
    private $table = 'users';

    private $id;
    private $is_active;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $created_at;
    private $time;
    private $ip;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    
    public function login_authentication($email, $password) {
        $stmt = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE email = ?');
        $stmt->execute([$email]);
        if (!$stmt->rowCount() == 1) {
            $data['email_msg'] = "You have entered an invalid e-mail";
            $data['email'] = $email;
            return $data;
        } else {
            $row = $stmt->fetch();
            if (!password_verify($password, $row['password'])) {
                $data['pwd_msg'] = "Your e-mail/password combo doesn't match";
                $data['email'] = $email;
                return $data;
            } else {
                session_regenerate_id();
                $this->is_active = $_SESSION['login'] = true;
                $this->id = $_SESSION['id'] = $row['id'];
                $this->email = $_SESSION['email'] = $row['email'];
                $this->password = $_SESSION['password'] = $row['password'];
                $this->first_name = $_SESSION['first_name'] = $row['first_name'];
                $this->last_name = $_SESSION['last_name'] = $row['last_name'];
                $this->created_at = $_SESSION['created_at'] = $row['created_at'];
                $this->time = $_SESSION['time'] = time();
                $this->ip = $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                header('Location: feed.php');
            }
        }

    }


    public function register_authentication($email, $password, $re_password, $first_name, $last_name) {
        $data['email'] = $email;
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;

        if ($password !== $re_password) {
            $data['pwd_msg'] = "Passwords do not match!";
            return $data;
        } elseif (strlen($password) < 6) {
            $data['pwd_msg'] = "At least 6 characters!";
            return $data;
        } elseif    (!preg_match('/[A-Z]/', $password) or 
                    !preg_match('/[a-z]/', $password) or
                    !preg_match('/[0-9]/', $password)){
                        $data['pwd_msg'] = "Lowercase and uppercase letter and a digit!";
                        return $data;
        } else {
            $stmt = $this->pdo->prepare('SELECT id FROM '.$this->table.' WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $data['email_msg'] = "This E-mail is already registered!";
                return $data;
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = 'INSERT INTO '.$this->table.' (first_name, last_name, email, password, created_at)
                        VALUES (?,?,?,?,?)';
                $stmt = $this->pdo->prepare($sql);
                if ($stmt->execute([$first_name, $last_name, $email, $hash, $timestamp = date('Y-m-d G:i:s')])) {
                    header ('Location: login.php?succ_reg='.$email);    
                }
            }
        }


    }




}

?>