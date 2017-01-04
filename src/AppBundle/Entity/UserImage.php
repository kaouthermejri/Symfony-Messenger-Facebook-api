<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/28/2016
 * Time: 1:12 PM
 */

namespace AppBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class UserImage
{
    /**
     * @var UploadedFile
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     */
        public $image;

    /**
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param UploadedFile $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}