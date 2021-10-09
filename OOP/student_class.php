<?php
	class Student{
		private $id;
		private $name;
		private $course;
		private $phone;
		
		function __construct($id,$name,$course,$phone){
			$this->id=$id;
			$this->name=$name;
			$this->course=$course;
			$this->phone=$phone;
		}
		public function save(){
			$file = file("student.txt");
			$csv=trim($this->id).",".trim($this->name).",".trim($this->course).",".trim($this->phone).PHP_EOL;
			file_put_contents("student.txt",$csv,FILE_APPEND);
		}
		public function upload($file){
			$valid_type = ["image/jpg","image/jpeg","image/png","image/gif"];
			$valid_size =100;
			$success=false;
			if(in_array($file["type"],$valid_type)){           

            if(($file["size"]/1000)<=$valid_size){
              move_uploaded_file($file["tmp_name"],$this->id.".jpg");
              $success=true;
            }else{
              echo "Size must within 100kb";
            }

        }else{
            echo "Invalid file type";
        }
			return $success;
		}
		public static function display(){
			$students=file("student.txt");
			foreach($students as $student){
				list($id,$name,$course,$phone)=explode(",",$student);
				echo "<div>";
				echo "<img src='$id.jpg' width='50' />" .$id." | ",$name." | ".$course." | ".$phone;
				echo "</div>";
			}
			//echo $this->id." |".$this->name." |".$this->course." |".$this->phone;
			
			
			
		}
		
		
	}
	
	if(isset($_POST["formSUbmit"])){
		//print_r($_POST);
		$id=$_POST["txtId"];
		$name=$_POST["txtName"];
		$course=$_POST["txtCourse"];
		$phone=$_POST["txtPhone"];
		//$photo=$_FILES["file"]["photo"];
		$ob1 = new Student($id,$name,$course,$phone);
		$success=$ob1->upload($_FILES["file"]);
		$ob1->save();
		
	}

?>

<form action="#" method="post" ecntype="multipart/form-data">
	<div>Id<br>
		<input type="text" name="txtId" value="<?php echo isset($_POST["txtId"])?$_POST["txtId"]:""; ?>" required/>
	</div>
	<div>Name<br>
		<input type="text" name="txtName" value="<?php echo isset($_POST["txtName"])?$_POST["txtName"]:""; ?>" required/>
	</div>
	<div>Course<br>
		<input type="text" name="txtCourse" value="<?php echo isset($_POST["txtCourse"])?$_POST["txtCourse"]:""; ?>" required/>
	</div>
	<div>Phone<br>
		<input type="text" name="txtPhone" value="<?php echo isset($_POST["txtPhone"])?$_POST["txtPhone"]:""; ?>" required />
	</div>
	<div>Photo<br>
		<input type="file" name="file" />
	</div>
	<div>
		<input type="submit" name="formSUbmit" />
	</div>
</form>

<?php
	Student::display();
?>