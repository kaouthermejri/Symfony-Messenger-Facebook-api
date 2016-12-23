<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/21/2016
 * Time: 10:54 AM
 */

namespace AppBundle\Entity;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserPass
{
/**
 * @SecurityAssert\UserPassword(
 *      message="Neteisingai įvestas dabartinis slaptažodis"
 * )
 */
    public $oldPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Minimum 6 simboliai"
     * )
     */
    public $newPassword;


}