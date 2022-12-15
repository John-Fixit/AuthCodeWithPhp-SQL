<?php
    session_start();
    class First {
        //properties
        public $name = "John Fixit";
        private $email = "johnfixit293@gmail.com";
        protected $school = "SQI college of ICT";

        public function __construct($name){
            // $_SESSION['name'] = $name;
            echo "welcome to my page"." ".$name;
            echo "<br>";

        }


        public function getName($param) { 
          return  $this->name." ".$param." ".$this->email;
        }

        public function __destruct()
        {
            echo "Leave my page";
        }
    }
    
    class Second extends First {
        public function __construct(){
            echo "You aere not welcome";
        }
        public function getUser(){
            return $this->school;
        }
    }

    class Third extends Second {
        public function __construct(){
            echo "You are welcome nigga";

        }
        public function getProperties(){
            return $this->school;
        }
    }

    $first = new First("John");
    $second = new Second("Favour");
    $third = new Third("Ola");
    // $second->getUser(); 
    // echo $third->getProperties();
    echo "<br>";
    // echo $first->getName('John');

?>