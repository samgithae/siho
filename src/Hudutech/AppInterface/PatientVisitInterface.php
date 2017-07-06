<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/8/17
 * Time: 11:48 AM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\PatientVisit;

interface PatientVisitInterface
{
    public function create(PatientVisit $patientVisit);
    public function update(PatientVisit $patientVisit, $id);
    public static function delete($patientId);
    public static function destroy();
    public static function getId($patientId);
    public static function all();
    public static function markAsLeft($patientId);

}