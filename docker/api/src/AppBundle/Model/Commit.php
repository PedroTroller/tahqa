<?php

namespace AppBundle\Model;

interface Commit
{
    /**
     * @return string
     */
    public function getSha();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return Commit
     */
    public function getParent();

    /**
     * @return People
     */
    public function getAuthor();
}
