<?php    
    $startTime = microtime(true);

    require($fileDir . '/library/XenForo/Autoloader.php');
    XenForo_Autoloader::getInstance()->setupAutoloader($fileDir . '/library');

    XenForo_Application::initialize($fileDir . '/library', $fileDir);
    XenForo_Application::set('page_start_time', $startTime);

    XenForo_Session::startPublicSession();
?>