<?php
/*
* Contains functions for sanitizing and filtering.
* - These functions are not complete, and only work on a basic level.
* - Validating your inputs for databases our for later output should be done more thoroughly than this class provides.
*/

class Helper {

    /*
    * Character Libraries are for use in VERY STRICT input validation
    */
    const CharacterAlphaLibrary = ['a', 'A', 'b', 'B', 'c', 'C', 'd', 'D', 'e', 'E', 'f', 'F', 'g', 'G', 'h', 'H', 'i', 'I', 'j', 'J', 'k', 'K', 'l', 'L', 'm', 'M', 'n', 'N', 'o', 'O', 'p', 'P', 'q', 'R', 's', 'S', 't', 'T', 'u', 'U', 'v', 'V', 'w', 'W', 'x', 'X', 'y', 'Y', 'z', 'Z'];
    const CharacterNumLibrary = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    const CharacterPuncLibrary = ["!", "@"];
    
    /*
    *  Simple email validation using FILTER_VALIDATE_EMAIL
    */
    public function emailIsValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        else{
            return true;
        }
    }
    /*
    * filtering for strings.
    */
    public function filterString($str)
    {
        $newStr = filter_var($str, FILTER_SANITIZE_STRING);
        $newStr = filter_var($newStr, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        return $newStr;
    }

};
?>