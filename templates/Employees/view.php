<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <h1 class="heading"><?= h($employee->emp_no . ' : ' . $employee->first_name . ' ' . $employee->last_name)?></h1>
    <aside class="column">
        <h2 class="heading"><?= __('Actions') ?></h2>
        <div class="side-nav">
            <?= $this->Form->postlink(
                __('Edit Employee'),
                [
                    'action' => 'edit',
                    $employee->emp_no,
                ],
                ['class' => 'side-nav-item']
            ) ?>
            <?= $this->Form->postLink(
                __('Delete Employee'),
                [
                    'action' => 'delete',
                    $employee->emp_no,
                ],
                [
                    'confirm' => __(
                        'Are you sure you want to delete # {0}?',
                        $employee->emp_no
                    ),
                    'class' => 'side-nav-item',
                ]
            ) ?>
            <?= $this->Html->link(
                __('List Employees'),
                ['action' => 'index'],
                ['class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(
                __('New Employee'),
                ['action' => 'add'],
                ['class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column">
        <div class="employees view content">
            <?php $picture = $employee->emp_picture;
            if ($picture == null) { ?>
                <div class="card-upload">
                    <?php $this->Form->create($employee, ['type' => 'file']) ?>
                    <fieldset>
                        <legend><?= __('Add your picture') ?></legend>
                        <?php echo $this->Form->control('picture', ['type' => 'file']); ?>
                    </fieldset>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
                </div>
            <?php } else { ?>
            <div class="card-show-pic">
                <?php echo $this->Html->image(
                    'employees/' . $picture . '.jpg',
                    [
                        'alt' => h($employee->emp_no),
                        'width' => 200,
                        'height' => 200,
                        'class' => 'card-img-top',
                    ]
                );
            }
            ?>
            </div>

            <h2 class="heading"><?= __('Personal informations') ?></h2>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($employee->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($employee->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= h($employee->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Emp No') ?></th>
                    <td><?= h($this->Number->format($employee->emp_no)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birth Date') ?></th>
                    <td><?= h($employee->birth_date->i18nFormat('yyyy-MM-dd')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hire Date') ?></th>
                    <td><?= h($employee->hire_date->i18nFormat('yyyy-MM-dd')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Actual Salary') ?></th>
                    <td>
                        <?= h($this->Number->currency(
                            $employee->actualSalary->salary,
                            'EUR',
                            [
                                'locale' => 'fr_BE',
                                'places' => 2,
                            ]
                        ))
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Actual title') ?></th>
                    <td><?= h($employee->actualTitle->title) ?></td>
                </tr>
                <?php if ($employee->cars[0]->model != null) { ?>
                <tr>
                    <th><?= __('Actual car') ?></th>
                    <td>
                        <?= h($employee->cars[0]->model) ?>
                        <div class="card-show-car">
                            <?php echo $this->Html->image(
                                'cars/' . $employee->cars[0]->id . '.jpg',
                                [
                                    'alt' => h($employee->cars[0]->model),
                                    'width' => 400,
                                    'height' => 300,
                                    'class' => 'card-img-top',
                                ]
                            );
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Age') ?></th>
                    <td><?= h($employee->age) ?></td>
                </tr>
            </table>
            <h2 class="heading"><?= __('Titles') ?></h2>
            <table>
                <?php
                echo $this->Html->tableHeaders(
                    [
                        __('Title'),
                        __('From'),
                        __('to'),
                    ]
                );
                foreach ($employee->titles as $title) :
                    echo $this->Html->tableCells(
                        [
                            h($title->title),
                            h($title->from_date->i18nFormat('yyyy-MM-dd')),
                            h($title->to_date->i18nFormat('yyyy-MM-dd')),
                        ]
                    );
                endforeach;
                ?>
            </table>
            <h2 class="heading"><?= __('Salaries') ?></h2>
            <table>
                <?php
                echo $this->Html->tableHeaders(
                    [
                        __('Salary'),
                        __('From'),
                        __('to'),
                    ]
                );
                foreach ($employee->salaries as $salary) :
                    echo $this->Html->tableCells(
                        [
                            h($this->Number->currency(
                                $salary->salary,
                                'EUR',
                                [
                                    'locale' => 'fr_BE',
                                    'places' => 2,
                                ]
                            )),
                            h($salary->from_date->i18nFormat('yyyy-MM-dd')),
                            h($salary->to_date->i18nFormat('yyyy-MM-dd')),
                        ]
                    );
                endforeach;
                ?>
            </table>
        </div>
    </div>
</div>
