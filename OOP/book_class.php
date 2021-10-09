<?php
    class Book{
        private $title;
        private $isbn;
        private $author;
        private $publishar;

        function __construct($isbn,$title,$author,$publishar){
            
            $this->isbn=$isbn;
            $this->title=$title;
            $this->author=$author;
            $this->publishar=$publishar;
        }

        public function save(){
            $file=file("book.txt");
            $csv=trim($this->isbn)." | ".trim($this->title)." | ".trim($this->author)." | ".trim($this->publishar).PHP_EOL;
            file_put_contents("book.txt",$csv,FILE_APPEND);
        }
        public static function display(){
            $books=file("book.txt");
            foreach($books as $book){
                echo "<di>";
                    echo $book."<br>";
                echo "</div>";
            }
        }
    }//end class
    if(isset($_POST["submitButn"])){
        $isbn=$_POST["txtIsbn"];
        $title=$_POST["txtTitle"];
        $author=$_POST["txtAuthor"];
        $publishar=$_POST["txtPublishar"];
        $errors=[];

        if(!preg_match("/^[0-9]{2,}$/",$isbn)){
            $errors["isbn"]="Invalid isbn";
        }
        if(!preg_match("/^[a-zA-Z]{3,}$/",$title)){
            $errors["title"]="Invalid title";
        }
        if(count($errors)==0){
            $ob1=new Book($isbn,$title,$author,$publishar);
            
            $ob1->save();
        }else{
            print_r($errors);
        }

        
        
}

?>

<form action="#" method="post" enctype="multipart/form-data">
    <div>Isbn<br>
        <input type="text" name="txtIsbn" value="" required />
    </div>
    <div>Title<br>
        <input type="text" name="txtTitle" value="" required />
    </div>
    <div>Author<br>
        <input type="text" name="txtAuthor" value="" required />
    </div>
    <div>Publisha<br>
        <input type="text" name="txtPublishar" value="" required />
    </div>
    <div>
        <input type="submit" name="submitButn" value="Submit" />
    </div>
</form>


<?php Book::display(); ?>