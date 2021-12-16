<?php
declare(strict_types = 1);

namespace App\Controller;
use App\Controller\AppController;

class DepartmentsController extends AppController
{
    public function index()
    {
        $departments = $this->paginate($this->Departments);

        $this->set(compact('departments'));
    }
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('department'));
    }
}
