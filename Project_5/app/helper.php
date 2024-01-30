<?php

if(!function_exists("pre")){


    function pre($a){

        echo "<pre>";
        dd($a);
        echo "</pre>";
    }
}


if(!function_exists("File_uploaded")){

    function File_upload($request,$input,$destin){


        $file=$request->file("$input");
        $file_name= rand(0,999)."-".$file->getClientOriginalName();
        $destination = $destin;

        $file->move($destination,$file_name);

        return ($destination."/".$file_name);

    }

}




?>