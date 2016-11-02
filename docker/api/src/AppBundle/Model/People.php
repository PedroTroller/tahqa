<?php

namespace AppBundle\Model;

interface People
{
    /**
     * @return string
     */
    public function getLogin();

    /**
     * @return string
     */
    public function getAvatar();
}
