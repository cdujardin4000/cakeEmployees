<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CarEmp Entity
 *
 * @property int $id
 * @property int|null $emp_no
 * @property int $car_id
 * @property \Cake\I18n\FrozenDate $receipt_date
 *
 * @property \App\Model\Entity\Car $car
 */
class CarEmp extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'emp_no' => true,
        'car_id' => true,
        'receipt_date' => true,
        'car' => true,
    ];
}