<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property int $emp_no
 * @property string $descrition
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenDate|null $modified
 */
class Project extends Entity
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
        'id' => true,
        'emp_no' => true,
        'descrition' => true,
        'created' => true,
        'modified' => true,
        'project_employees' => true,
    ];

    public function _getProjectManager()
    {
        $projectManager = $this->getTableLocator()->get('Employees')->find()
            ->where(['emp_no' => $this->emp_no]);

        return $projectManager->first();
    }

    public function _getProjectEmployees()
    {
        $projectEmployees = $this->getTableLocator()->get('Employees')->find('all')
            ->where(['projects' => $this->id])->toArray();

        return $projectEmployees;
    }
}
