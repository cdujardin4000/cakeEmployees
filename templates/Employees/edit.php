<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <h1 class="heading"><?= __('Edit Employee') ?></h1>
    <aside class="column">
        <div class="side-nav">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employee->emp_no],
                ['confirm' => __(
                    'Are you sure you want to delete # {0}?',
                    $employee->emp_no
                ), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Employees'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column">
        <div class="employees form content">
            <?= $this->Form->create($employee, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Employee') ?></legend>
                <?php
                    echo $this->Form->control('birth_date');
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('hire_date');
                    echo $this->Form->control(
                        'picture',
                        [
                            'type' => 'file',
                            'label' => 'emp_picture',
                        ]
                    );
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
