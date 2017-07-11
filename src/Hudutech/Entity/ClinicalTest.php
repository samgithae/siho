<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/22/17
 * Time: 2:12 PM
 */

namespace Hudutech\Entity;


class ClinicalTest
{
    /**
     * @var string
     */
    private $testName;
    /**
     * @var float
     */
    private $cost;

    /**
     * @return string
     */
    public function getTestName()
    {
        return $this->testName;
    }

    /**
     * @param string $testName
     */
    public function setTestName($testName)
    {
        $this->testName = $testName;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }


}