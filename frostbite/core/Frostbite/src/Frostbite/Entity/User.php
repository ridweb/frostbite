<?php
namespace Frostbite\Entity;

use ZfcUser\Entity\User as ZfcUserEntity;

class User extends ZfcUserEntity
{
    protected $role;
}
