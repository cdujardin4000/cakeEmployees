<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property string $dept_no
 * @property string $dept_name
 */
class Department extends Entity
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
        'dept_name' => true,
        'dept_picture' => true,
        'dept_info' => true,
        'emp_no' => true,
        'first_name' => true,
        'last_name' => true,
    ];

    public function _getNbEmployees()
    {
        $query = $this->getTableLocator()->get('DeptEmp')->find()
            ->where(['dept_no' => $this->dept_no])
            ->where(['to_date' => '9999-01-01']);

        return $query->count();
    }

    public function _getNewEmployees()
    {
        $query = $this->getTableLocator()->get('DeptEmp')->find()
            ->where(['dept_no' => $this->dept_no])
            ->where(['to_date' => '9999-01-01'])
            ->order(['from_date' => 'DESC'])
            ->limit(10)
        ->toArray();

        return $query;
    }

    public function _getActualManager()
    {
        $man_no = $this->getTableLocator()->get('DeptManager')->find()
            ->where(['dept_no' => $this->dept_no])
            ->where(['to_date' => '9999-01-01'])
            ->first();
        //dd($man_no->emp_no);
        $query = $this->getTableLocator()->get('Employees')->find()
            ->where(['emp_no' => $man_no->emp_no]);

        return $query->first();
    }
}
