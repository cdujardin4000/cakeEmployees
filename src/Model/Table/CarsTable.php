<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cars Model
 *
 * @property \App\Model\Table\CarEmpTable&\Cake\ORM\Association\HasMany $CarEmp
 *
 * @method \App\Model\Entity\Car newEmptyEntity()
 * @method \App\Model\Entity\Car newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Car[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Car get($primaryKey, $options = [])
 * @method \App\Model\Entity\Car findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Car patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Car[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Car|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Car saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CarsTable extends Table
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

        $this->setTable('cars');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('CarEmp', [
            'foreignKey' => 'car_id',
        ]);
        $this->hasMany('Employees', [
            'foreignKey' => 'emp_no',
        ]);
    }

    /**
     * FindUserId method
     *
     * @param \Cake\ORM\Query $query The query to find the user id of a car
     * @param array $options array of options
     * @return \Cake\ORM\Query $query
     */
    public function findUserId(Query $query, array $options)
    {
        $query->contain('CarEmp', function ($q) {
            return $q->where(['CarEmp.car_id' => 'id'])
                ->first();
        });

        return $query;
    }
    /**
     * FindCarUser method
     *
     * @param \Cake\ORM\Query $query The query to find user of each car
     * @param array $options array of options
     * @return \Cake\ORM\Query $query

    public function findCarUser(Query $query, array $options)
    {
        $query->contain('Employees', function ($q) {
            return $q->where(['DeptEmp.to_date' => '9999-01-01',])
                ->order(['hire_date' => 'DESC',])
                ->limit(10);
        });

        return $query;
    }*/
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
            ->scalar('registration_number')
            ->maxLength('registration_number', 9)
            ->requirePresence('registration_number', 'create')
            ->notEmptyString('registration_number');

        $validator
            ->scalar('model')
            ->maxLength('model', 30)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

        return $validator;
    }
}
