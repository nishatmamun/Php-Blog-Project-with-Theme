<?php
class session
{
    public static function init()
    {
        session_start();
    }

    public static function set($key, $val)
    {
        $_SESSION["$key"] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION["$key"])) {
            return $_SESSION["$key"];
        } else {
            return false;
        }
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("Location: login.php");
        }
    }

    public static function checkLogin()
    {
        self::init();
        if (self::get("login") == true) {
            $log = base64_encode("You have already logged in!");
            header('location: index.php?msg=' . $log);
        }
    }

    public static function destroy()
    {
        session_destroy();
        header("Location: login.php");
    }
}