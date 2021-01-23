<?php
/**
*Session Class
**/
class Session{
//lưu phiên giao dịch
 public static function init(){
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }
//set key thành giá trị
 public static function set($key, $val){
    $_SESSION[$key] = $val;
 }

//get giá trị
 public static function get($key){
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }
//kiểm tra phiên giao dịch để logout
 public static function checkSession(){
    self::init();
    if (self::get("adminlogin")== false) {
     self::destroy();
     header("Location:login.php");
    }
 }
//kiểm tra phiên giao dịch để login
 public static function checkLogin(){
    self::init();
    if (self::get("adminlogin")== true) {
     header("Location:index.php");
    }
 }

 public static function destroy(){
  session_destroy();
  header("Location:login.php");
 }
}
?>
