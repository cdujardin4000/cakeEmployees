<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Demands Model
 *
 * @method \App\Model\Entity\Demand newEmptyEntity()
 * @method \App\Model\Entity\Demand newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Demand[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Demand get($primaryKey, $options = [])
 * @method \App\Model\Entity\Demand findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Demand patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Demand[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Demand|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demand saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demand[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demand[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demand[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Demand[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DemandsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('demands');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo(
            'Employees',
            [
                'foreignKey' => 'emp_no',
                'targetForeignKey' => 'dept_no',
            ]
        );

        $this->hasMany(
            'Salaries',
            [
                'bindingKey' => 'emp_no',
                'foreignKey' => 'emp_no',
            ]
        );
        $this->hasMany(
            'DeptEmp',
            [
                'bindingKey' => 'emp_no',
                'foreignKey' => 'emp_no',
            ]
        );
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('emp_no')
            ->allowEmptyString('emp_no');

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('about')
            ->maxLength('about', 20)
            ->requirePresence('about', 'create')
            ->notEmptyString('about');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}
