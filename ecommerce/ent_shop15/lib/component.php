    
    <?php

    function breadcumb($breadcumbs=array()){


        $html="<div class='row'>";
            $html.="<ol class='breadcrumb'>";
            $html.="<li><a href='home.php'>";
            $html.="<em class='fa fa-home'></em>";
            $html.="</a></li>";
            foreach($breadcumbs as $breadcumb){
                $html.="<li class='active'>$breadcumb</li>";
            }
			$html.="</ol>";
            $html.="</div>";
            
        
        return $html;
    }
    function head_title($title){
        $html="<div class='row'>";
        $html.="<div class='col-lg-12'>";
        $html.="<h1 class='page-header'>$title</h1>";
        $html.="</div>";
        $html.="</div>";
        return $html;
    }
    function pagination($page=1,$totalPages){
        $next=($page+1)<$totalPages?($page+1):$totalPages;
        $pre=($page-1)>0?($page-1):1;
         
          $links = "<ul class='pagination pagination-sm'>";
          $links .= "<li class='page-item'><a href='?p=1' class='page-link'>First</a></li>";
          $links .= "<li class='page-item'><a href='?p=$pre' class='page-link'>Previous</a></li>";
          
          for ($i = $page-5;$i<=$page+5;$i++) {
            
           if($i>0 && $i<=$totalPages){
            $links .= ($i != $page ) ? "<li class='page-item'><a href='?p=$i' class='page-link'> $i</a> </li>" : "<li><a  class='page-link active'> $page</a> </li>";
           }		 
            
          }
      
          $links.= "<li class='page-item'><a href='?p=$next' class='page-link'>Next</a></li>";
          $links.= "<li class='page-item'><a href='?p=$totalPages' class='page-link'>Last</a></li>";	
          $links.="<li class='page-item'><form  method='get'>";
          $links.= "<input type='text' size='1' name='p' />";
          $links.="<input type='submit' value='go' />";
          $links.= "</form></li>";
          $links.= "</ul>";
          return $links;
        }

        function select_box_query($name,$query_rs,$select_id=0){
            $html="<class='form-group row'>";
            $html.="<clss='col'>";
            $html.="<select name='$name' id='$name' class='form-contorl'>";
            while(list($id,$name)=$query_rs->fetch_row()){
                if($id==$select_id){
                    $html.="<option value='$id' selected>$name</option>";

                }else{
                    $html.="<option value='$id'>$name</option>";
                }
            }
            $html.="</select>";
            $html.="</div>";
            $html.="</div>";
            return $html;
        }
        function text_field_nolabel($name,$placeholder="Enter value",$value=""){
            $html="<class='form-group row'>";
            $html.="<clss='col'>";
            $html.="<input type='text' name='$name' id='$name' value='$value' placeholder='$placeholder'/>";
            $html.="</div>";
            $html.="</div>";
            return $html;
        }
      

    ?>
    