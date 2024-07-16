<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
class Budget extends MX_Controller
{
    public $crud;
    public $module;

    public function __construct()
    {
        //$this->load->model('guestsmodel');
        $this->load->model('generalmodel');
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        // $this->load->model('cms');
        $this->load->model('generalmodel');
        /*  $this->load->model('unitmodel');
          $this->load->model('subunitmodel');
          $this->load->model('reportmodel');*/
        $this->load->model('settingsmodel');

        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();
        ////$this->crud->set_theme('datatables');
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

    public function format_num($value, $row)
    {
        return number_format($value, 0);
    }

    public function _full_text($value, $row)
    {
        //    var_dump($value);exit;
        return $value = wordwrap($row->text_to_show, 1000, '', true);
    }

    public function index()
    {
        $this->load->view('header');
        $this->crud = new grocery_CRUD();
        $clients = $this->settingsmodel->getClients();
        $employee_select = $this->settingsmodel->getEmployee();
        $department_select = $this->settingsmodel->getDepartment();
        $year_select = $this->settingsmodel->getYear();
        $cat_select = $this->settingsmodel->expenseCategory();
        $role_select = $this->settingsmodel->getRoles();
        // var_dump($department_select);exit;

        $this->crud->columns('expense_line_code', 'expense_category_id', 'expense_line_name', 'department_map', 'budgeted_amount', 'year', 'show_bal_to');
        $this->crud->required_fields('expense_category_id', 'expense_line_name', 'department_map', 'year', 'show_bal_to');
        $this->crud->display_as('expense_line_code', 'Code')
                   ->display_as('expense_category_id', 'Expense Category')
                   ->display_as('expense_line_name', 'Expense Name')
                   ->display_as('department_map', 'Accessible to')
                   ->display_as('budgeted_amount', 'Budgeted Amount')
                   ->display_as('year', 'Year')
                   ->display_as('show_bal_to', 'Bal Visible To');

        $this->crud->callback_column('budgeted_amount', array($this, 'format_num'));
        $this->crud->unset_edit_fields('expense_line_id');

        $this->crud->field_type('budgeted_amount', 'integer', 0);
        $this->crud->field_type('year', 'dropdown', $year_select);
        $this->crud->field_type('show_bal_to', 'multiselect', $role_select);
        $this->crud->field_type('expense_category_id', 'dropdown', $cat_select);
        $this->crud->field_type('department_map', 'multiselect', $department_select);
        //$this->crud->callback_column('department_map', array($this, '_full_text'));

        //  $this->crud->field_type('client', 'dropdown', $clients);
        $this->crud->unset_delete();
        // $this->crud->unset_edit();
        $this->crud->unset_clone();
        $this->crud->set_subject('Expense Line');
        $this->crud->set_table('expense_line');
        $output = $this->crud->render();
        $output->extra = '<h3>Expense Line Items</h3>';

        //$this->_example_output($output);
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function managebudget()

    {
        $data['budgetExpense'] = $this->settingsmodel->getBudgetExpense();
        $this->load->view('header');
       $this->load->view('managebudget', $data);
        $this->load->view('footer');
    }

    public function createbudget()

    {
        if ($_POST) {
           // var_dump($_POST);exit();
            extract($_POST);
            if (!empty($year)) {
               $budget = array();
            foreach ($_POST as $key => $value)
            {
                if ($key == 'year') {
                   continue;
                }
                $ids = explode('-', $key);
                $exp_id = intval($ids[0]);
                $dpt_id = intval($ids[1]);
                $dpt_budget = array();
                $dpt_budget = array('expense_line_id' => $exp_id,
                                    'department_id' => $dpt_id,
                                    'budgeted_amount' => (floatval($value) > 0.00) ? floatval($value) : 0.00,
                                    'year' => $year);
                $budget[] = $dpt_budget;
            }
          //  var_dump($budget);exit();
            $resp = $this->settingsmodel->saveBudgetExpense($budget);
            if ($resp) {
                 $this->session->set_flashdata('success', 'Budget Created Successfully');
              redirect('admin/budget/managebudget/');
            }
            $this->session->set_flashdata('error', 'Internal Server Error, Please review and try again');
        }else{
            $this->session->set_flashdata('error', 'Please select budget year');
        }

            }
            
        //var_dump($budget);exit;
        //$next_year = (date('Y')+1);
        $data['budgetExpense'] = $this->settingsmodel->getBudgetExpense();
        $this->load->view('header');
       $this->load->view('createbudget', $data);
        $this->load->view('footer');
    }

    public function editDepartmentBudget($id){
        if($_POST){
            extract($_POST);
            $amount = floatval($budgeted_amount) ;
            $this->settingsmodel->updateDepartmentBudget($amount,$id); 
            redirect('admin/budget/managebudget');  
        }
        $data['deptbudget'] = $this->settingsmodel->getSingleDepartmentBudget($id);
        $data['id'] = $id;
        $this->load->view('header');
        $this->load->view('editdepartmentbudget', $data);
        $this->load->view('footer');

    }

    public function deleteBudgetByYear($year){
        if(intval(date("Y")) < intval($year)){
            $this->settingsmodel->deleteBudgetByYear($year);
            redirect('admin/budget/managebudget');  
        }
    }

    public function category()
    {
        $this->load->view('header');
        $this->crud = new grocery_CRUD();
        $clients = $this->settingsmodel->getClients();
        $employee_select = $this->settingsmodel->getEmployee();
        $department_select = $this->settingsmodel->getDepartment();
        $year_select = $this->settingsmodel->getYear();
        $cat_select = $this->settingsmodel->expenseCategory();
        $role_select = $this->settingsmodel->getRoles();
        // var_dump($department_select);exit;

        $this->crud->columns('expense_category_name');
        $this->crud->required_fields('expense_category_name');
        $this->crud->display_as('expense_category_name', 'Category Name');

        //  $this->crud->field_type('client', 'dropdown', $clients);
        $this->crud->unset_delete();
        // $this->crud->unset_edit();
        $this->crud->unset_clone();
        $this->crud->set_subject('Expense Category');
        $this->crud->set_table('expense_category');
        $output = $this->crud->render();
        $output->extra = '<h3>Expense Category</h3>';

        //$this->_example_output($output);
        $this->load->view('home', $output);
        $this->load->view('footer');
    }

    public function uploadExcel(){
    $data = array();
    $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');

    if($this->form_validation->run($this) == false){
      $this->session->set_flashdata('error', validation_errors());
      redirect('admin/budget/createbudget');
    }else {
         if(!empty($_FILES['fileURL']['name'])){
            // get file extension.
            $extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);
            if($extension == 'csv'){
                $fetchData = array();
                $file = $_FILES['fileURL']['tmp_name'];
                $handle = fopen($file, "r");
                $c = 0;
                while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                {
                    $code = trim(preg_replace("/[^a-zA-Z0-9\w-]/", "", (string)$filesop[0]));
                    $amount = $filesop[1];
                   // $amount = trim(preg_replace("/[^0-9]/", "", (string)$sourceamount[0]));
                    
                    $shortcode = explode('-', $code);
                    $dept = $this->settingsmodel->getDepartmentCode((string)$shortcode[1]);
                    $expenseLine = $this->settingsmodel->getExpenseLineCode((string)$shortcode[0]);
                    
                    if (!empty($dept) && !empty($expenseLine)) {
                        $fetchData[] = array('expense_line_id' => $expenseLine->expense_line_id, 'department_id' => $dept->id, 'budgeted_amount' => $amount, 'year' => $_POST['year']);
                    }
                    $c = $c + 1;
                }
                
                $data['dataInfo'] = $fetchData;
                if (!empty($fetchData)) {
                    $this->settingsmodel->setBatchImport($fetchData);
                    $this->settingsmodel->importData();
                }
                unlink($_POST);
                $this->session->set_flashdata('success', 'Import successful');
                redirect('admin/budget/managebudget');

            }else{
                $this->session->set_flashdata('error', 'Please upload correct file type');
                redirect('admin/budget/createbudget');
            }
        }else{
            $this->session->set_flashdata('error', 'File does not exist, Please try again');
            redirect('admin/budget/createbudget');
        }
    }
/*
    if($this->form_validation->run($this) == false){
      //$this->session->set_flashdata('message_error', 'Please upload a file');
      $this->session->set_flashdata('message_error', validation_errors());
      redirect('budget/createbudget');
    }else {
      // code...if file uploaded
      if(!empty($_FILES['fileURL']['name'])){
        // get file extension.
        $extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);

        if($extension == 'csv'){
          $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }elseif ($extension == 'xlsx') {
          $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }else {
          $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }
        //file path
        $spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        // array Count
                var_dump($allDataInSheet);exit;
                $arrayCount = count($allDataInSheet);
        $flag = 0;
        $createArray = array('code', 'amount');
        $makeArray = array('code' => 'code', 'amount' => 'amount');
        $SheetDataKey = array();
        foreach ($allDataInSheet as $dataInSheet) {
            foreach ($dataInSheet as $key => $value) {
                if (in_array(trim($value), $createArray)) {
                    $value = preg_replace('/\s+/', '', $value);
                    $SheetDataKey[trim($value)] = $key;
                }
            }
        }


        $dataDiff = array_diff_key($makeArray, $SheetDataKey);
        if (empty($dataDiff)) {
            $flag = 1;
        }
        // match excel sheet column
        if ($flag == 1) {
          for ($i = 2; $i <= $arrayCount; $i++) {
              $code = $SheetDataKey['code'];
              $amount = $SheetDataKey['amount'];

              $code = filter_var(trim($allDataInSheet[$i][$code]), FILTER_SANITIZE_STRING);
              $amount = filter_var(trim($allDataInSheet[$i][$amount]), FILTER_SANITIZE_STRING);

              $shortcode = explode('-', $code);
              $dept = $this->settingsmodel->getDepartmentCode((string)$shortcode[1]);
              $expenseLine = $this->settingsmodel->getExpenseLineCode((string)$shortcode[0]);

              if (!empty($dept) && !empty($expenseLine)) {
                  $fetchData[] = array('expense_line_id' => $expenseLine->expense_line_id, 'department_id' => $dept->id, 'budgeted_amount' => $amount, 'year' => $_POST['year'],'dname'=>$dept->title,'ename'=>$expenseLine->expense_line_name);
              }
              
          }

          var_dump($fetchData);exit;

          $data['dataInfo'] = $fetchData;
          if (!empty($fetchData)) {
             $this->settingsmodel->setBatchImport($fetchData);
          $this->settingsmodel->importData();
          }
          
          $this->session->set_flashdata('success_message', 'Import successful');
          redirect('budget/managebudget');
        } else {
            $this->session->set_flashdata('message_error', 'Please import correct file, did not match excel sheet column');
            redirect('budget/createbudget');
        }
      }
    } */
  }

  //Check File validation
  public function checkFileValidation($string){
    $file_mimes = array('text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );

      if(isset($_FILES['fileURL']['name'])) {
            $arr_file = explode('.', $_FILES['fileURL']['name']);
            $extension = end($arr_file);
        if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
            return true;
        }else{
            $this->form_validation->set_message('checkFileValidation', 'File format not supported.');
            return false;
        }
    }else{
        $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
        return false;
    }
  }
}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
