<?php
    class Student{
        private $id;
        private $name;
        private $course;
        private $reg;
        
        function __construct($id,$name,$course,$reg){
            $this->id=$id;
            $this->name=$name;
            $this->course=$course;
            $this->reg=$reg;
        }
        public function save(){
            $file=file("student1.txt");
            $csv=trim($this->id)." | ".trim($this->name)." | ".trim($this->course)." | ".trim($this->reg).PHP_EOL;
            file_put_contents("student1.txt",$csv,FILE_APPEND);
        }
        public static function display(){
            $students=file("student1.txt");
            foreach($students as $student){
                echo "<div>";
                    echo $student;
                echo "<div>";
            }
            
        }
    }
    $ob1=new Student(01,"Azizul Islam","PWAD",1234);
    $ob1->save();
    Student::display();

?>