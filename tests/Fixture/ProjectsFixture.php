<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsFixture
 */
class ProjectsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'emp_no' => 1,
                'descrition' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-02-06 20:03:32',
                'modified' => '2022-02-06',
            ],
        ];
        parent::init();
    }
}
