<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 03:20 PM
 */
class USER
{

public function is_logged_in()
    {
        if(isset($_SESSION['userSession']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}

?>