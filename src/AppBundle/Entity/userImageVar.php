<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/21/2016
 * Time: 9:27 AM
 */

namespace AppBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class userImageVar
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }



}