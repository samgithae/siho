<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/22/17
 * Time: 2:17 PM
 */

namespace Hudutech\AppInterface;

use Hudutech\Entity\ClinicalTest;

interface ClinicalTestInterface
{
   public function create(ClinicalTest $clinicalTest);
   public function update(ClinicalTest $clinicalTest, $id);
   public static function delete($id);
   public static function destroy();
   public static function getId($id);
   public static function getObject($id);
   public static function all();


}