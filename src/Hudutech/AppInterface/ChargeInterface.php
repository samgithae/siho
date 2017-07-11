<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/16/17
 * Time: 11:05 AM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\Charge;

interface ChargeInterface
{
    public function create(Charge $charges);
    public function update(Charge $charges, $id);
    public static function delete($id);
    public static function getId($id);
    public static function getObject($id);
    public static function all();
}