<div class="table-responsive">
    <table>
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('dept_no') ?></th>
            <th><?= $this->Paginator->sort('dept_name') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($departments as $department): ?>
            <tr>
                <td><?= h($department->dept_no) ?></td>
                <td><?= h($department->dept_name) ?></td>
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
