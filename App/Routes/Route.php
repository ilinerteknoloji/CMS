<?php 

$cms->router->setNamespace('App');

require BASEDIR.'/App/Routes/api.php';
require BASEDIR.'/App/Routes/web.php';
require BASEDIR.'/App/Routes/admin.php';

$cms->router->get('user/detail/(\d+)', 'User@showProfile');

$cms->router->run();

?>