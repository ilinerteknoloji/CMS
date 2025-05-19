<?php 

function assets($assetsName)
{
    return URL.'public/'.$assetsName;
}

function redirect($url)
{
    header('Location:'.URL.$url);
}

function _link($url = null)
{
    return URL.$url;
}

function sess($name)
{
    return \Core\Session::getSession($name);
}

?>