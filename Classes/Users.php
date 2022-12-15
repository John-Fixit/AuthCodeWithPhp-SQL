<?php

    require_once('config.php');

    class Users extends Config{
        public function __construct(){
            parent::__construct();
        }

            public function createUser($name, $email, $password)
            {
                $query = "INSERT INTO `users_tb` (`name`, `email`, `password`) VALUE (?, ?, ?)";

                $binder = array('sss', $name, $email, $password);

                $result = $this->create($query, $binder);
                return $result;
            }

            public function getUser($userId)
            {
                $query = "SELECT * FROM users_tb WHERE user_id = ?" ;
                $binder = array('i',$userId);
                
                $result = $this->read($query, $binder);
                return $result;
            }

            public function updateUser($userId, $name, $email)
            {
                $query = "UPDATE `users_tb` SET `name`=?,`email`=? WHERE `user_id`=?";
                $binder = array('ssi', $name, $email, $userId);

                $result = $this->update($query, $binder);
                return $result;
            }
            public function deleteUser($userId)
            {
                $query = "DELETE FROM users_tb WHERE user_id = ?";

                $binder = ['i', $userId];

                $result = $this->delete($query, $binder);
                return $result;

            }
    }

