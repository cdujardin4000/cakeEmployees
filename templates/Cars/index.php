<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Car[]|\Cake\Collection\CollectionInterface $cars
 */

?>
<div class="cars index content">
    <?= $this->Html->link(__('New Car'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Cars') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('registration_number') ?></th>
                <th><?= $this->Paginator->sort('model') ?></th>
                <th><?= $this->Paginator->sort('user') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($cars as $car) : ?>
                <tr>
                    <td><?= $this->Number->format($car->id) ?></td>
                    <td><?= h($car->registration_number) ?></td>
                    <td><?= h($car->model) ?></td>
                    <td><?= h($car->carUser->first_name . ' ' . $car->carUser->last_name) ?></td>
                    <td class="actions">
                        <?php $this->Form->create(
                            null,
                            [
                                'type' => 'post',
                                'url' => [
                                    'controller' => 'Cars',
                                    'action' => 'switchCars',
                                ],
                            ]
                        ) ?>
                        <fieldset>
                            <?= $this->Form->control(
                                'Cars.id',
                                [
                                    'name' => 'idCar',
                                    'type' => 'checkbox',
                                    'multiple' => true,
                                    'value' => $car->id,

                                ]
                            ); ?>
                        </fieldset>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <?= $this->Form->button(
                'Switch Cars',
                [
                    'type' => 'submit',
                    'class' => 'button float-right',
                    'url' => [
                        'controller' => 'Cars',
                        'action' => 'switchCars',
                    ],

                ]
            ); ?>
            <?= $this->Form->end(); ?>
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
