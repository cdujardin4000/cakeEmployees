<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(
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
            <h3><?= h($employee->emp_no . ' : ' . $employee->first_name . ' ' . $employee->last_name)?></h3>
            <div class="card" style="width: 30rem; text-align: center; display:flex; align-items:center">
                <?php
                $picture = $employee->emp_picture;
                if ($picture == null) {
                    $this->Form->create($employee, ['type' => 'file']) ?>
                <fieldset>
                    <legend><?= __('Add your picture') ?></legend>
                    <?php echo $this->Form->control('picture', ['type' => 'file']); ?>
                </fieldset>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
            </div>
            <div class="card" style="width: 18rem; text-align: center">
                <?php } else {
                    h($this->Html->image(
                        'employee/' . $employee->emp_picture,
                        [
                            'alt' => h($employee->emp_no),
                            'width' => 150,
                            'height' => 150,
                            'class' => 'card-img-top',
                        ]
                    ));
                } ?>
                <div class="card-body">
                    <h5 class="card-title"><?= h($employee->first_name . ' ' . $employee->last_name) ?> </h5>
                </div>
            </div>
            <h3><?= __('Personal informations') ?></h3>
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
                    <th><?= __('Salaire actuel') ?></th>
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
                    <th><?= __('Age') ?></th>
                    <td><?= h($employee->age) ?></td>
                </tr>

            </table>
            <h3><?= __('Salaries') ?></h3>
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
