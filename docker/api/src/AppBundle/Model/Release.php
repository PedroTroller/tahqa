<?php

namespace AppBundle\Model;

interface Release
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return Commit
     */
    public function getCommit();

    /**
     * @return People
     */
    public function getAuthor();
}
