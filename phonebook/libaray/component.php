<?php

    function text_field($label,$name,$placeholder="Enter name",$blure="",$value="",$id=""){
        $html="<div class='form-group row'>";
            $html.="<label class='col-sm-3 col-form-label'>";
            $html.=$label;
            $html.="</label>";
            $html.="<div class='col-sm-9'>";
            $html.="<input type='text' id='$id' class='form-control' required onblur='$blure' name='$name' placeholder='$placeholder' value='$value'>";
            $html.="</div>";
            $html.="</div>";
            return $html;
    }
    function image_file($label,$name,$img_value=""){
        $html="<div class='form-group row'>";
            $html.="<label class='col-sm-3 col-form-label'>";
            $html.=$label;
            $html.="</label>";
            $html.="<div class='col-sm-9'>";
            $html.="<input type='file' class='form-control' name='$name' value='$img_value'>";
            $html.="</div>";
            $html.="</div>";
            return $html;
    }
    function password_field($label,$name,$placeholder,$password=""){
        $html="<div class='form-group row'>";
            $html.="<label class='col-sm-3 col-form-label'>";
            $html.=$label;
            $html.="</label>";
            $html.="<div class='col-sm-9'>";
            $html.="<input type='password' class='form-control' name='$name' value='$password' placeholder='$placeholder'>";
            $html.="</div>";
            $html.="</div>";
            return $html;
    }
    function select_box($label,$name,$data=array(),$city_value=""){
        $html="<div class='form-group row'>";
            $html.="<label class='col-sm-3 col-form-label'>";
            $html.=$label;
            $html.="</label>";
            $html.="<div class='col-sm-9'>";
            $html.="<select name='$name' class='form-control'>";
                foreach($data as $key=>$city_value){
                    $html.="<option value='$city_value'>$city_value</option>";
                }
            $html.="</select>";
            $html.="</div>";
            $html.="</div>";
            return $html;
    }

    function header_title($title,$breadcumbs=array()){
        $html="<div class='container-fluid'>";
        $html.="<div class='row mb-2'>";
        $html.="<div class='col-sm-6'>";
        $html.="<h1 class='m-0 text-dark'>";
        $html.=$title;
        $html.="</h1>";
        $html.="</div>";
        $html.="<div class='col-sm-6'>";
        $html.="<ol class='breadcrumb float-sm-right'>";
            foreach($breadcumbs as $breadcumb){
               
                $html.="<li class='breadcrumb-item active'>$breadcumb</li>";
            }
            $html.="</ol>";
            $html.="</div>";
            $html.="</div>";
            $html.="</div>";
            return $html;
    }
?>