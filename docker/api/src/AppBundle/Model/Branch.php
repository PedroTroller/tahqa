<?php

namespace AppBundle\Model;

interface Branch
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return Commit
     */
    public function getCommit();
}
