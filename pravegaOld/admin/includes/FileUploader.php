<?php

class FileUploader {

    var $file_name;
    var $errors;

    function FunctionFileUploader($inputfield, $newname, $path, $restriction = '') {
        if ((
        ($_FILES[$inputfield]["type"] == "application/pdf")
        || ($_FILES[$inputfield]["type"] == "application/msword")
        || ($_FILES[$inputfield]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
        || ($_FILES[$inputfield]["type"] == "application/rtf")
        || ($_FILES[$inputfield]["type"] == "image/jpeg")
        || ($_FILES[$inputfield]["type"] == "image/png")
        || ($_FILES[$inputfield]["type"] == "image/giff")
        || ($_FILES[$inputfield]["type"] == "image/jpg"))
        && ($_FILES[$inputfield]["size"] < 1048576)) {
			if(!empty($restriction) && !in_array($_FILES[$inputfield]["type"], $restriction)){	
				$this->errors = "Upload the specified file types only";			
                return FALSE;
			}
            if ($_FILES[$inputfield]["error"] > 0) {
                return FALSE;
                echo "Return Code: " . $_FILES[$inputfield]["error"] . "<br />";
            } else {

                if (file_exists("upload/" . $_FILES[$inputfield]['name'])) {
                    return FALSE;
                } else {
                    $filename = $_FILES[$inputfield]["name"];
                    //   echo $filename;
                    // echo $_FILES[$inputfield]["name"];
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    $newfilename = $newname . "." . $extension;

                    if (move_uploaded_file($_FILES[$inputfield]["tmp_name"], $path . $newfilename)) {
                        //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                        $this->file_name = $newfilename;

                        return true;
                    } else {

                        return FALSE;
                    }
                }
            }
        } else {
            return FALSE;
        }
    }

}

?>
