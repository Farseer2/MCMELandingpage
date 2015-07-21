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
    $template = $dependencies->createTemplateObject('navigation', $params);

    XenForo_Template_Public::setStyleId(1);
    XenForo_Template_Public::setLanguageId(1);

    echo $template->render();
?>
<div class="sidebar_container">  
<aside id="sidebar">
    <button id="nav-btn">
        <div></div>
        <div></div>
        <div></div>
    </button>
    <nav id="sidenav">
        <ul>
            <li><a class="link" href="/">Home</a>
            <li><a class="link" href="/forums">Forums</a>
            <li><a class="link" href="resources/">Resources</a>
            <li><a class="link" href="/members/">Members</a>
            <li><a class="link" href="/faq/">FAQ</a>
        </ul>
    </nav>
</aside>
</div>    
<div class="clear"></div>