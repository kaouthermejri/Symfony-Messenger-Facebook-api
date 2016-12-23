<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/20/2016
 * Time: 3:33 PM
 */

namespace AppBundle\Entity;


class UserUpdateVar
{
    public $name_surname;
    public $email;
    public $phone_number;

    /**
     * @return mixed
     */
    public function getNameSurname()
    {
        return $this->name_surname;
    }

    /**
     * @param mixed $name_surname
     */
    public function setNameSurname($name_surname)
    {
        $this->name_surname = $name_surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }
}