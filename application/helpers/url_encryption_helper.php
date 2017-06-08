<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('encode_url')){
    function encode_url($string, $key="", $url_safe=TRUE){
        
        if($key==null || $key=="")
        {
            $key="tyz_mydefaulturlencryption";
        }
        $CI =& get_instance();
        $ret = $CI->encrypt->encode($string, $key);

        if ($url_safe)
        {
            $ret = strtr(
                    $ret,
                    array(
                        '+' => '.',
                        '=' => '-',
                        '/' => '~'
                    )
                );
        }

        return $ret;
    }

}

if ( ! function_exists('decode_url')){

    function decode_url($string, $key=""){
         if($key==null || $key=="")
        {
            $key="tyz_mydefaulturlencryption";
        }
            $CI =& get_instance();
        $string = strtr(
                $string,
                array(
                    '.' => '+',
                    '-' => '=',
                    '~' => '/'
                )
            );

        $ret = $CI->encrypt->decode($string, $key);
        return $ret;
    }

}

//  ENCRIPATR EL ID 
if ( ! function_exists('encode_id')){
    function encode_id($string, $key="", $url_safe=TRUE){
        
        if($key==null || $key=="")
        {
            $key="#%*34dalk";
        }
        $CI =& get_instance();
        $ret = $CI->encrypt->encode($string, $key);

        if ($url_safe)
        {
            $ret = strtr(
                    $ret,
                    array(
                        '+' => '.',
                        '=' => '-',
                        '/' => '~'
                    )
                );
        }

        return $ret;
    }

}

if ( ! function_exists('decode_id')){

    function decode_id($string, $key=""){
         if($key==null || $key=="")
        {
            $key="#%*34dalk";
        }
            $CI =& get_instance();
        $string = strtr(
                $string,
                array(
                    '.' => '+',
                    '-' => '=',
                    '~' => '/'
                )
            );

        $ret = $CI->encrypt->decode($string, $key);
        return $ret;
    }

}

define("SALT", "pirabook");
if ( ! function_exists('encryptStringArray')){

function encryptStringArray ($stringArray) {
 $s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(SALT), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5(SALT)))), '+/=', '-_,');
 return $s;
}

}

if ( ! function_exists('decryptStringArray')){

function decryptStringArray ($stringArray) {
 $s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(SALT), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5(SALT))), "\0"));
 return $s;
} 
} 
// /////////////////////////////////
 ?>