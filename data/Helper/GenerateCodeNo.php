<?php
namespace Data\Helper;

class GenerateCodeNo
{
    public static function getTeacherPrefix(){
        return 'T';
    }

    public static function getStudentPrefix(){
        return 'S';
    }

    public static function getInvoicePrefix(){
        return 'P';
    }

    public static function  formatCode($p_prefix,$p_digit,$code){
        try {
            if (!$code) {
                $code = 1;
            } else {
                $code = str_replace_first($p_prefix, '', $code);
                $code = $code + 1;
            }

            $codeLength = strlen($code);

            return str_pad($p_prefix, $p_digit - $codeLength, '0', STR_PAD_RIGHT) . $code;
        }
        catch(\Exception $e){
            throw new \Exception($e);
        }
    }

    public static  function teacherCode($code){

        return self::formatCode(self::getTeacherPrefix(),7,$code);
    }

    public static  function studentcode($code){

        return self::formatCode(self::getStudentPrefix(),7,$code);
    }

    public static  function invoice($code){

        return self::formatCode(self::getInvoicePrefix(),7,$code);
    }
}