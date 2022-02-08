<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */
?>
<div class="projects index content">
    <?= $this->Html->link(__('New Project'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Projects') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('manager') ?></th>
                    <th><?= $this->Paginator->sort('descrition') ?></th>
                    <th><?= $this->Paginator->sort('employees') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= h($project->projectManager->first_name . ' ' . $project->projectManager->last_name) ?></td>
                    <td><?= h($project->descrition) ?></td>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('employees') ?></th>
                                    <th class="actions"><?= __('delete') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($project->projectEmployees as $projectEmployee): ?>
                                <tr>
                                    <td><?= ($projectEmployee->first_name . ' ' . $projectEmployee->last_name) ?>   </td>
                                    <td><?= $this->Form->postLink(
                                        __('<i class="far fa-times-circle"></i>'),
                                        [
                                            'action' => 'projectRequest',
                                            $projectEmployee->projects,
                                        ],
                                        ['escape' => false]
                                        ) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $project->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
