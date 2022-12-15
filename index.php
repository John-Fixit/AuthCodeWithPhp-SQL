<?php
    $name = "John";
    $num = 10;

    // echo $name;
    echo ($name);
    echo "<h1>My name is $name</h1>";
    echo ("$name is $num years old");
    echo ("<br>");
    print $num;
    print ($num);
    echo ("<br>");

    $students = ['John', 'Raphael', 'Ayomide'];
    $students = array('John', 'Raphael', 'Ayomide');

    // echo count($students);
    print_r($students);
    for ($i=0; $i < (count($students)); $i++) { 
       echo $students[$i]; echo ("<br>");
    }
    echo gettype($students);

    $obj = ["name"=> "John", "school"=> "SQI"];
    echo $obj['name'];
    echo '<br>';
   //  echo gettype($obj);
   print_r($obj);
    echo implode(' ', $obj);
    
    // print_r == print in readable format
    // an array thatt has key value pair === associate array

    //strlen = gives the legnth of string
    //strrev = gives the reverse of string
    //strpos =  gives the position of a string in a word or variable