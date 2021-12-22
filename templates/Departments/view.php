<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <h1 class="heading"><?= h(__('Department  : ') . $department->dept_name)?></h1>
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(
                __('Edit Department'),
                [
                    'action' => 'edit',
                    $department->dept_no,
                ],
                ['class' => 'side-nav-item']
            ) ?>
            <?= $this->Form->postLink(
                __('Delete Department'),
                [
                    'action' => 'delete',
                    $department->dept_no,
                ],
                [
                    'confirm' => __(
                        'Are you sure you want to delete # {0}?',
                        $department->dept_no
                    ),
                    'class' => 'side-nav-item',
                ]
            ) ?>
            <?= $this->Html->link(
                __('List Departments'),
                ['action' => 'index'],
                ['class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(
                __('New Department'),
                ['action' => 'add'],
                ['class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column-center">
        <div class="departments view content">
            <div class="show-dep">
                <?php $picture = $department->dept_picture;
                if ($picture == null) { ?>
                    <div class="card-upload">
                        <?php $this->Form->create($department, ['type' => 'file']) ?>
                        <fieldset>
                            <legend><?= __('Add the picture of the department') ?></legend>
                            <?php echo $this->Form->control('picture', ['type' => 'file']); ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit')) ?>
                        <?= $this->Form->end() ?>
                    </div>
                <?php } else { ?>
                    <?php
                    //echo $picture;
                    echo $this->Html->image(
                        'department/' . $picture . '.jpg',
                        [
                            'alt' => h($department->dept_no),
                            'width' => 400,
                            'height' => 400,
                            'class' => 'card-show-department',
                        ]
                    );
                }
                ?>
            </div>
            <h2 class="heading"><?= __('Department informations') ?></h2>
            <table>
                <tr>
                    <th><?= __('Dept No') ?></th>
                    <td><?= h($department->dept_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dept Name') ?></th>
                    <td><?= h($department->dept_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dept manager') ?></th>
                    <td><?= h('nommanager') ?></td>
                </tr>
                <tr>
                    <th><?= __('Dept informations') ?></th>
                    <td><?= h('infodept') ?></td>
                </tr>
                <tr>
                    <th><?= __('the ROI of the department') ?></th>
                    <td><?= h('linktoroi') ?></td>
                </tr>
                <tr>
                    <th><?= __('Description of roles') ?></th>
                    <td><?= h('descriptionjob') ?></td>
                </tr>
                <tr>
                <tr>
                    <th><?= __('Amount Employees') ?></th>
                    <td><?= h(('nbdept' ?? '0')) ?></td>
                </tr>
            </table>
            <h2 class="heading"><?= __('Department manager') ?></h2>
            <?php /* $picture = $employee->emp_picture;
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
            <div class="card-show">
                <?php
                //echo $picture;
                echo $this->Html->image(
                    'employees/' . $picture . '.jpg',
                    [
                        'alt' => h($employee->emp_no),
                        'width' => 200,
                        'height' => 200,
                        'class' => 'card-img-top',
                    ]
                );
                }
               */ ?>
            <h2 class="heading"><?= __('Department requests') ?></h2>
            <table>
                <?php
                echo $this->Html->tableHeaders(
                    [
                    __('Employee'),
                    __('type'),
                    __('about'),
                    ]
                );
                /*foreach ($department->demands as $demand) :
                    echo $this->Html->tableCells(
                        [
                            h('employeeno'),
                            h('typedemand'),
                            h('about'),
                        ]
                    );
                endforeach;*/
                ?>
            </table>
        </div>
    </div>
</div>
