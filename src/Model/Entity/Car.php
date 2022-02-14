<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Car Entity
 *
 * @property int $id
 * @property string $registration_number
 * @property string $model
 *
 * @property \App\Model\Entity\CarEmp[] $car_emp
 */
class Car extends Entity
{
    use \Cake\ORM\Locator\LocatorAwareTrait;

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
        'registration_number' => true,
        'model' => true,
        'carUser' => true,
    ];

    public function _getCarUser()
    {
        $user_no = $this->getTableLocator()->get('CarEmp')->find()
            ->where(['car_id' => $this->id])
            ->first();
        $car_user = $this->getTableLocator()->get('Employees')->find()
            ->where(['emp_no' => $user_no->emp_no])
            ->first();

        return $car_user;
    }
}
