<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\EmployeesTable;
use Cake\I18n\FrozenDate;
use Cake\View\CellTrait;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 * @method \App\Model\Entity\Employee|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
    use CellTrait;

    /**
     * BeforeFilter method
     *
     * that allow Unauthenticated connexion
     *
     * @param \Cake\Event\EventInterface $event the unauthenticated event
     * @return void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        //$this->Authentication->addUnauthenticatedActions(['login','index','view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $employees = $this->paginate($this->Employees);

        $total = $this->Employees->find()->count();

        $genderCell = $this->cell('Gender');

        $this->set(compact('employees', 'total', 'genderCell'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get(
            $id,
            ['contain' => ['Salaries']]
        );

        $this->set(compact('employee'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEmptyEntity();

        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());

            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }

        $this->set(compact('employee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get(
            $id,
            ['contain' => []]
        );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());

            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }

        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);

        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects to page home.
     */
    public function login()
    {
        $result = $this->Authentication->getResult();

        // Si l'utilisateur est connecté, le renvoyer ailleurs
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? 'pages/home';

            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Identifiant ou mot de passe invalide');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void Redirects to login page if successful
     */
    public function logout()
    {
        $this->Authentication->logout();

        return $this->redirect(['controller' => 'Employees', 'action' => 'login']);
    }
}
