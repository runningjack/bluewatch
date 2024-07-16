<?php
 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Index extends MX_Controller
{
    public $crud;
    public $module;

    public function __construct()
    {
       // die('hh');
        //$this->load->model('guestsmodel');
        $this->load->model('generalmodel');
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
       // die('jjjjjjj');
 
        // $this->load->model('cms');
        $this->load->model('generalmodel');
        $this->load->model('unitmodel');
        $this->load->model('subunitmodel');
        $this->load->model('reportmodel');
        $this->load->model('transactionmodel');
        $this->load->model('projectexpensemodel');
        $this->load->model('settingsmodel');

        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();
        $this->module = 'employees';
    }

    public function _example_output($output = null)
    {
        $this->load->view('example.php', (array) $output);
    }

    public function offices()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    public function index()
    {
        $this->db = $this->load->database('default', true);
        $this->load->library('pagination');
        $department = 0;
        $data['dept'] = false;
        $data['all_project'] = $this->projectexpensemodel->getprojectDash();
         //var_dump($data['all_project']);exit;

        if (!in_array(intval($_SESSION['login_detal']->group_id), array(1,7,2,5))) {
            $emplyee_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->employee_id);
            $data['dept'] = $emplyee_details['title']; //exit;
            $department = $emplyee_details['department'];
            $total_budget = $this->projectexpensemodel->getBudgetTotalDept($department);
            $total_spent = $this->projectexpensemodel->getSepentBudgetTotalDept($department);

           
        } else {
            $total_budget = $this->projectexpensemodel->getBudgetTotal();
            $total_spent = $this->projectexpensemodel->getSepentBudgetTotal();
        }
        $total_project = $this->projectexpensemodel->getTotalProject();
        $total_closedProject = $this->projectexpensemodel->getTotalClosedProject();
        $total_onHoldProject = $this->projectexpensemodel->getTotalOnHoldProject();
        $total_onActiveProject = $this->projectexpensemodel->getTotalActiveProject();

        $data['analytic_dept_budget'] = $this->projectexpensemodel->getTotalBudgetByDept(1)['total'];
        $data['app_dept_budget'] = $this->projectexpensemodel->getTotalBudgetByDept(2)['total'];
        $data['sales_dept_budget'] = $this->projectexpensemodel->getTotalBudgetByDept(3)['total'];
        $data['deliver_dept_budget'] = $this->projectexpensemodel->getTotalBudgetByDept(11)['total'];
        $data['inf_dept_budget'] = $this->projectexpensemodel->getTotalBudgetByDept(6)['total'];

        $data['spent_analytic_dep'] = $this->projectexpensemodel->getTotalSpentOnBudgetByDept(1)['total'];
        $data['spent_app_dept'] = $this->projectexpensemodel->getTotalSpentOnBudgetByDept(2)['total'];
        $data['spent_sales_dept'] = $this->projectexpensemodel->getTotalSpentOnBudgetByDept(3)['total'];
        $data['spent_deliver_dept'] = $this->projectexpensemodel->getTotalSpentOnBudgetByDept(11)['total'];
        $data['spent_inf_dept'] = $this->projectexpensemodel->getTotalSpentOnBudgetByDept(6)['total'];

        $data['admin_exp'] = $this->projectexpensemodel->getTotalSpentOnBudgetByCategory(1)['total'];
        $data['op_exp'] = $this->projectexpensemodel->getTotalSpentOnBudgetByCategory(2)['total'];
        $data['mark_exp'] = $this->projectexpensemodel->getTotalSpentOnBudgetByCategory(3)['total'];
        $data['staff_exp'] = $this->projectexpensemodel->getTotalSpentOnBudgetByCategory(4)['total'];
        $data['comp_exp'] = $this->projectexpensemodel->getTotalSpentOnBudgetByCategory(5)['total'];
        $data['other_exp'] = $this->projectexpensemodel->getTotalSpentOnBudgetByCategory(6)['total'];
        //var_dump( $data['staff_exp']);exit;

        $data['total_budget'] = $total_budget['total'] / 1000000;
        $data['total_spent'] = $total_spent['total'] / 1000000;
        $data['total_project'] = $total_project['total'];
        $data['total_closedProject'] = $total_closedProject['total'];
        $data['total_onHoldProject'] = $total_onHoldProject['total'];
        $data['total_onActiveProject'] = $total_onActiveProject['total'];

        

        $this->load->view('header');
        $this->load->view('mouse', $data);
        //$this->load->view('footer');*/
    }

    public function test()
    {
        $data['id'] = $id;
        $this->load->view('header');

        $this->crud->set_relation('officeCode', 'offices', 'city');
        $this->crud->display_as('officeCode', 'Office City');
        $this->crud->display_as('lastName', 'Last Name');
        $this->crud->set_subject('Employee');

        $this->crud->required_fields('lastName');

        $this->crud->set_field_upload('file_url', 'assets/uploads/files');

        $this->crud->set_table($this->module);
        $this->crud->where('employees.officeCode', '1');

        $output = $this->crud->render();

        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function home()
    {
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }
}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
