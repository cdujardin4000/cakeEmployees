<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department[]|\Cake\Collection\CollectionInterface $departments
 */
?>
<div class="departments index content">
    <?= $this->Html->link(__('New Department'), ['action' => 'add',  $this->Paginator->counter('{{count}}') /*'Total' => 'total'*/],
        [
            'class' => 'button float-right',

            //'total' => $this->Number->format($total,['locale' => 'fr_BE'])
        ])
    ?>
    <h3><?= __('Departments') ?></h3>
    <div><?= __('Total') ?> : <?= $this->Number->format($total,['locale' => 'fr_BE']) ?> départements</div>
    <div><?= __('Total') ?> : <?= $this->Paginator->counter('{{count}}') ?> départements</div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('dept_no') ?></th>
                    <th><?= $this->Paginator->sort('dept_name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $department): ?>
                <tr>
                    <td><?= h($department->dept_no) ?></td>
                    <td><?= h($department->dept_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fas fa-eye"></i>'),
                            ['action' => 'view', $department->dept_no],
                            ['escape' => false])
                        ?>
                        <?= $this->Html->link(__('<i class="fas fa-edit"></i>'),
                            ['action' => 'edit', $department->dept_no],
                            ['escape' => false])
                        ?>
                        <?= $this->Form->postLink(__('<i class="fas fa-trash-alt"></i>'),
                            ['action' => 'delete', $department->dept_no],
                            [
                                'confirm' => __('Are you sure you want to delete # {0}?', $department->dept_no),
                                'escape' => false
                            ])
                        ?>
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
