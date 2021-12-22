<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <h1 class="heading"><?= __('Actions') ?></h1>
    <aside class="column">
        <div class="side-nav">
            <?= $this->Form->postLink(
                __('Delete'),
                [
                    'action' => 'delete',
                    $department->dept_no],
                [
                    'confirm' => __(
                        'Are you sure you want to delete # {0}?',
                        $department->dept_no
                    ),
                    'class' => 'side-nav-item',
                ]
            ) ?>
            <?= $this->Html->link(__('List Departments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column">
        <div class="departments form content">
            <?= $this->Form->create($department, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Department') ?></legend>
                <?php
                    echo $this->Form->control('dept_name');
                    echo $this->Form->control('dept_picture', ['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
