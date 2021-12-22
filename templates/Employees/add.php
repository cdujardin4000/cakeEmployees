<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <h1 class="heading"><?= __('Add Employee') ?></h1>
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('List Employees'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column">
        <div class="employees form content">
            <?= $this->Form->create($employee) ?>
            <fieldset>
                <legend><?= __('Add Employee') ?></legend>
                    <?php
                    echo $this->Form->control(
                        'email',
                        ['required' => true]
                    );
                    echo $this->Form->control(
                        'password',
                        ['required' => true]
                    );
                    echo $this->Form->control('birth_date');
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('hire_date');
                    echo $this->Form->control('picture', ['type' => 'file']);
                    ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
