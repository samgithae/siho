<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/16/17
 * Time: 8:34 AM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\ProductInventory;

interface ProductInventoryInterface
{
    public function create(ProductInventory $productInventory);

    public function update(ProductInventory $productInventory, $id);

    public static function delete($id);

    public static function getId($id);

    public static function getObject($id);

    public static function all();

}