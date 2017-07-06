<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/22/17
 * Time: 12:04 AM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\ClinicalNote;

interface ClinicalNoteInterface
{
    public function create(ClinicalNote $clinicalNote);

    public function update(ClinicalNote $clinicalNote, $id);

    public static function delete($id);

    public static function destroy();

    public static function getAllClinicalNoteByPatientId($patientId);

    public static function getClinicalNoteByDate($patientId, $date);

    public static function getObject($patientId, $date);

    public static function getPatientFromClinicalNotes($patientId);
}