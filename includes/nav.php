<?php
    XenForo_Session::startPublicSession();
    $visitor = XenForo_Visitor::getInstance();
    $user_id = $visitor->getUserId();
?>
<?php
    $dependencies = new XenForo_Dependencies_Public();
    $dependencies->preLoadData();

    XenForo_Session::startPublicSession();

    $dependencies->preRenderView();
    $params = $dependencies->getEffectiveContainerParams(array(),new Zend_Controller_Request_Http());
    $template =$dependencies->createTemplateObject('navigation', $params);

    XenForo_Template_Public::setStyleId(1);
    XenForo_Template_Public::setLanguageId(1);

    echo $template->render();
?>
<div class="clear"></div>