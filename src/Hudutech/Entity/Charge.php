<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/16/17
 * Time: 11:02 AM
 */

namespace Hudutech\Entity;


class Charge
{
    private $id;
    private $chargeName;
    private $cost;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getChargeName()
    {
        return $this->chargeName;
    }

    /**
     * @param mixed $chargeName
     */
    public function setChargeName($chargeName)
    {
        $this->chargeName = $chargeName;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }
}