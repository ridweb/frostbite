<?php

namespace UnicornTheme\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

/**
 * Description of UnicornUserWidget
 *
 * @author Kathryn
 */
class UnicornUserWidget extends AbstractHelper
{
    public function __toString()
    {
        $gravatar = $this->getView()->plugin('gravatar');
        $userInfo = $this->getView()->plugin('zfcUserIdentity');
        $urlHelper = $this->getView()->plugin('url');
        return '<div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">

                <li class="btn btn-inverse" ><a title="Profile" href="#">' . $gravatar($userInfo()->getEmail(), array('img_size'=>16), array('class' => 'icon')) . ' <span class="text">My Profile</span></a></li>
                <li class="btn btn-inverse dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#">new message</a></li>
                        <li><a class="sInbox" title="" href="#">inbox</a></li>
                        <li><a class="sOutbox" title="" href="#">outbox</a></li>
                        <li><a class="sTrash" title="" href="#">trash</a></li>
                    </ul>
                </li>
                <li class="btn btn-inverse"><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
                <li class="btn btn-inverse"><a title="" href="' . $urlHelper('zfcuser/logout') . '"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>';
    }

    public function __invoke()
    {
        return $this;
    }
}
