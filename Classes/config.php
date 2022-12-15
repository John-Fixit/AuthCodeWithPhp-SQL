<?php

    class Config {
        protected $host = "localhost";
        protected $username ="root";
        protected $password ="";
        protected $dbName = "test_db";
        public $connectToDb;
        public $response;
        public function __construct(){
            $this->connectToDb = new mysqli($this->host, $this->username, $this->password, $this->dbName);
            if($this->connectToDb->connect_error){
                die("Error occured"." ".$this->connectToDb->connect_error);
            }
        }

        public function create($query, $binder){
            $stmt = $this->connectToDb->prepare($query);
            $stmt->bind_param(...$binder);
            $check = $stmt->execute();
            if($check){
                $this->response['message'] = "Registeration Successfully";
                $this->response['status'] = true;
            }
            else{
                $this->response['message'] = " Failed to Register";
                $this->response['status'] = false;
            }

            return $this->response;
        }

        public function read($query, $binder){
            $stmt = $this->connectToDb->prepare($query);
            if($binder){
                $stmt->bind_param(...$binder);
            }
           $check = $stmt->execute();
            
           if($check){
                $this->response['status'] = true;
                $this->response['user'] = mysqli_fetch_all(mysqli_stmt_get_result($stmt));
           }
           return $this->response;
        }

        public function update($query, $binder){
            $stmt = $this->connectToDb->prepare($query);
            if($binder){
                $stmt->bind_param(...$binder);
            }
            $check = $stmt->execute();
            if($check){
                $this->response['status'] = true;
                $this->response['message'] = "Details updated successfully";
            }
            else{
                $this->response['status'] = false;
                $this->response['message'] = "Internal server error, Details not updated, please try again!";
            }
            return $this->response;
        }

        public function delete($query, $binder){
            $stmt = $this->connectToDb->prepare($query);
            $stmt->bind_param(...$binder);
            $check = $stmt->execute();
            if($check){
                $this->response['message'] = "user deleted successfully";
                $this->response['status'] = true;
            }
            else{
                $this->response['status'] = false;
            }
            return $this->response;
        }

    }

