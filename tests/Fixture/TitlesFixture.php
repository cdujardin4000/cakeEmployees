<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TitlesFixture
 */
class TitlesFixture extends TestFixture
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
                'emp_no' => 1,
                'title' => '224397d0-8366-452c-945b-add745b4e0de',
                'from_date' => '2022-02-03',
                'to_date' => '2022-02-03',
            ],
        ];
        parent::init();
    }
}
