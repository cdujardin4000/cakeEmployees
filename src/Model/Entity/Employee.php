<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\I18n\FrozenDate;
use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $emp_no
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $hire_date
 */
class Employee extends Entity
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
        'birth_date' => true,
        'first_name' => true,
        'last_name' => true,
        'gender' => true,
        'hire_date' => true,
        'password' => true,
        'email' => true,
        'emp_picture' => true,
        'pic_dir' => true,
    ];

    //FONCTIONS REMONTEES DU CONTROLLER AFIN DE L'ALLEGER (heavy model/light controller)

    /**
     * GetActualSalary method
     *
     * @return int|null $actualSalary
     */
    protected function _getActualSalary()
    {
        $actualSalary = null;

        $salaries = $this->salaries;

        $dateInfinie = new FrozenDate('9999-01-01');

        foreach ($salaries as $salary) {
            if ($salary->to_date->equals($dateInfinie)) {
                $actualSalary = $salary;
                break;
            }
        }

        return $actualSalary;
    }

    /**
     * GetActualTitle method
     *
     * @return int|null $actualTitle
     */
    protected function _getActualTitle()
    {
        $actualTitle = null;

        $titles = $this->titles;

        $dateInfinie = new FrozenDate('9999-01-01');

        foreach ($titles as $title) {
            if ($title->to_date->equals($dateInfinie)) {
                $actualTitle = $title;
                break;
            }
        }

        return $actualTitle;
    }

    /**
     * GetAge method
     *
     * @return int|null actualAge
     */
    protected function _getAge()
    {
        return $this->birth_date->diffInYears(new FrozenDate());
    }

    /**
     * SetPassword method
     * Hashing method for passwords when modified
     *
     * @return string $password the freshly hashed password by the new DefaultPasswordHasher
     */
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($password);
    }
}
