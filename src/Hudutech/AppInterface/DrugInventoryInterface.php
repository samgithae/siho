<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/15/17
 * Time: 11:53 PM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\DrugInventory;

interface DrugInventoryInterface
{
   public function create(DrugInventory $drugInventory);
   public function update(DrugInventory $drugInventory, $id);
   public static function delete($id);
   public static function getId($id);
   public static function getObject($id);
   public static function all();
   public static function getPrice($id, $qty);

}