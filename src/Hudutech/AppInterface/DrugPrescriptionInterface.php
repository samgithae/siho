<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/8/17
 * Time: 3:40 PM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\DrugPrescription;

interface DrugPrescriptionInterface
{
    public function create(DrugPrescription $drugPrescription);

    public function update(DrugPrescription $drugPrescription, $id);

    public static function delete($id);

    public static function destroy();

    public static function getPrescriptions($patientId);

    public static function markDrugIssued($id);

    public static function markDrugUnavailable($id);
}