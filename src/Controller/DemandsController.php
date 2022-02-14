<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;
use App\Model\Entity\Salary;
use App\Model\Entity\DeptEmp;
/**
 * Demands Controller
 *
 * @property \App\Model\Table\DemandsTable $Demands
 * @method \App\Model\Entity\Demand[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DemandsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Demands->findByStatus(
            'not treated'
        )->order(
            ['type' => 'ASC']
        );
        $demands = $this->paginate($query);
        $this->set(compact('demands'));
    }

    /**
     * View method
     *
     * @param string|null $id Demand id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $demand = $this->Demands->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('demand'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $demand = $this->Demands->newEmptyEntity();
        if ($this->request->is('post')) {
            $demand = $this->Demands->patchEntity($demand, $this->request->getData());
            if ($this->Demands->save($demand)) {
                $this->Flash->success(__('The demand has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The demand could not be saved. Please, try again.'));
        }
        $this->set(compact('demand'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Demand id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $demand = $this->Demands->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $demand = $this->Demands->patchEntity($demand, $this->request->getData());
            if ($this->Demands->save($demand)) {
                $this->Flash->success(__('The demand has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The demand could not be saved. Please, try again.'));
        }
        $this->set(compact('demand'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Demand id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $demand = $this->Demands->get($id);
        if ($this->Demands->delete($demand)) {
            $this->Flash->success(__('The demand has been deleted.'));
        } else {
            $this->Flash->error(__('The demand could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     *  treatRequest method
     *
     * @param string|null $id Demand id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function treatRequest($id, bool $accepted = false)
    {
        $demand = $this->Demands->get($id, [
            'contain' => ['Employees', 'Salaries', 'DeptEmp'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->Demands->save($demand)) {
                $this->Flash->success(__('The demand has been saved.'));

                if ($demand->type == 'salary raise') {
                    //recuperer le dernier salaire
                    $lastSalary = array_pop($demand->salaries);
                    $lastSalary->to_date = new FrozenDate();

                    //mettre à jour le nouveau salaire
                    $salariesTable = $this->getTableLocator()->get('Salaries');

                    if ($salariesTable->save($lastSalary)) {
                        $this->Flash->success(__('The last salary has been updated.'));

                        $newSalary = new Salary();
                        $newSalary->emp_no = $demand->emp_no;
                        $newSalary->salary = $demand->about;
                        $newSalary->from_date = new FrozenDate();
                        $newSalary->to_date = '9999-01-01';

                        if ($salariesTable->save($newSalary)) {
                            $this->Flash->success(__('The new salary has been saved.'));
                            $demand->status = 'granted';

                            return $this->redirect(
                                ['action' => 'index']
                            );
                        }
                        $this->Flash->error(__('The demand could not be saved. Please, try again.'));
                    }
                    $this->Flash->error(__('The demand could not be saved. Please, try again.'));
                } elseif ($demand->type == 'reaffectation') {
                    //recuperer le dernier dept
                    $lastDept = array_pop($demand->dept_emp);
                    $lastDept->to_date = new FrozenDate();

                    //mettre à jour le nouveau salaire
                    $deptEmpTable = $this->getTableLocator()->get('DeptEmp');

                    if ($deptEmpTable->save($lastDept)) {
                        $this->Flash->success(__('The last dept has been updated.'));

                        $newDept = new DeptEmp();
                        $newDept->emp_no = $demand->emp_no;
                        $newDept->dept_no = $demand->about;
                        $newDept->from_date = new FrozenDate();
                        $newDept->to_date = '9999-01-01';

                        if ($deptEmpTable->save($newDept)) {
                            $this->Flash->success(__('The new dept has been saved.'));
                            $demand->status = 'granted';

                            return $this->redirect(['action' => 'index']);
                        }
                        $this->Flash->error(__('The demand could not be saved. Please, try again.'));
                    }
                }
            } else {
                $demand->status = 'refused';

                return $this->redirect(['action' => 'index']);
            }

        }
        $this->Flash->error(__('The demand could not be saved. Please, try again.'));

        $this->set(compact('demand'));
    }
}
