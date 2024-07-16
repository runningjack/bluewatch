<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ajax.
 *
 * @author Gbadeyanka Abass
 */
class Ajax extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Role');
        $this->load->model('Menu');
        // $this->load->model('cms');
        $this->load->model('generalmodel');
        $this->load->model('utitlitymodel');
        $this->load->model('transactionmodel');
        $this->load->model('subunitmodel');
        $this->load->model('settingsmodel');
        $this->load->model('reportmodel');
    }

    public function additems()
    {
        extract($_POST);  //var_dump($subunit);

        $unit_id = (int) ($unit_id);
        $quantity = $quantity;
        $tran_id = ($tran_id);
        $amount = $price;
        $weight = $weight;
        $total_weight = $weight * $quantity;

        $bal_qeury = $this->subunitmodel->getsingleunitbalance($unit_id);
        $amount_left = $bal_qeury['stock_balance'] - $total_weight;
        if ($amount_left > 0) {
            $details = array('unit_id' => $unit_id, 'trans_no' => $tran_id, 'quantity' => $quantity,
               'weight' => $weight, 'total_weight' => $total_weight, 'total_trans_amount' => $amount, );
            $id = $this->transactionmodel->insert_temp_transaction($details);
        }

        $this->display_temp_tran_dtetails($tran_id, $amount_left);
    }

    public function deletitems()
    {
        extract($_POST);  //var_dump($subunit);
        $id = (int) ($id);
        $tran_id = (int) ($tran_id);
        $this->transactionmodel->delete_temp($id);
        $this->display_temp_tran_dtetails($tran_id);
    }

    public function display_temp_tran_dtetails($tran_id, $amount_left)
    {
        $temp_result = $this->transactionmodel->fetch_temp_tran($tran_id);
        // var_dump($temp_result);exit;

        $counter = 1; ?> 
      <table class="table table-bordered" id="datatable2" >
	      <tr><td colspan="7"
                      <?php if ($amount_left < 0) {
            echo 'style="background-color: #FFF; color:red;"';
        } ?> 
                      
                      >Amount left after payment is <?php echo $amount_left; ?></td></tr>							
          <thead  style="background-color: #60c060; color:#fff;">
                                                                      
										<tr>
											<th><b>S/N</b></th>
                                                                                        <!-- <th><b>Transaction Number</b></th>-->
							                                 <th><b>Product Name</b></th>
                                                                                        <th><b>Weight</b></th>
                                                                                        <th><b>Quantity</b></th>
                                                                                        <th><b>Total Weight</b></th>
                                                                                         <th><b>Amount</b></th>
                                                                                        
                                                                                         <th><b></b></th>
                                                                                        
										</tr>
									</thead>
									<tbody>      
            <?php
if (empty($temp_result)) {
            echo 'No Transaction as been added';
        } else {
            foreach ($temp_result as $data) { //var_dump($data);exit;?>
  <tr class="gradeA">
<td><?php 
echo $counter; ?></td>
<!--<td class="center"><?php echo $data->trans_no; ?></td>-->
<td class="center"><?php echo $data->unit_name; ?></td>
<td class="center"><?php echo $data->weight; ?></td>
<td class="center"><?php echo $data->quantity; ?></td>
<td class="center"><?php echo $data->total_weight; ?></td>
<td class="center"><?php echo  number_format($data->total_trans_amount, 2); ?></td>

<td>   

<a href="#" class="delete" id="<?php echo $data->trans_id; ?>" onclick="deletetran(<?php echo $data->trans_id; ?>);">Remove</a>
</td>											
												
<?php ++$counter;
            }
        } ?>
 <?php
    }

    public function load_subunit()
    {
        //var_dump($_POST["valu"]);

        $subunit = $this->subunitmodel->getallsubunitByUnit($_POST['valu']);
        if ($subunit) {
            echo '<option value="">--Select Sub-Unit -- </option>';
            foreach ($subunit as $d) {
                echo '<option value="'.$d->subunit_id.'">'.$d->subunit_name.' (=N='.number_format($d->cost, 2).') </option>';
            }
        } else {
            echo '<option value="">No Subunit found </option>';
        }
    }

    public function projecttask()
    {
       

        if ($_POST['valu']) {
            $state = $this->utitlitymodel->getTaskByProject($_POST['valu']); 
            //var_dump($state);exit;
            $data = '<option label="--Select Project Task --"></option>';
            foreach ($state as $s) {
                $data .='<option value="'.$s->id.'">'.$s->task_name.'</option>';
            }
            echo $data;
        } else {
            echo '<option value="0">No Task found </option>';
        }
    }

    public function projectteammember($project_id)
    {
        $project = $this->settingsmodel->getTeamDetails($project_id); //var_dump($state);exit;
        if ($project) {
            
            $team_members = $this->settingsmodel->getProjectMembers($project['team_member']); //var_dump($state);exit;

            

            //echo "jhdhdhdfh";
            header('Content-Type: application/json');
            echo json_encode(  $team_members);
        } 
    }

    public function projecttasks($project_id)
    {
        $tasks = $this->settingsmodel->getprojecttask($project_id); //var_dump($state);exit;
        if ($tasks) {
            //echo "jhdhdhdfh";
            header('Content-Type: application/json');
            echo json_encode(  $tasks);
        } 
    }


    public function expensecat()
    {
        $emp_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);
        if ($_POST['stat'] == 'adm') {
               $department =  10;
           } else {
              $department = $emp_details['department'];
           }
        
        // var_dump($_SESSION['login_detal']);exit;
        if ($_POST['valu']) {
            $exp = $this->utitlitymodel->getExpenseCat($_POST['valu'],$department); 
            echo '<option value="">--Select Expense Line -- </option>';
            foreach ($exp as $s) {
                echo '<option value="'.$s->expense_line_id.'">'.$s->expense_line_name.'</option>';
            }
        } else {
            echo '<option value="0">No Expense found </option>';
        }
    }

    public function load_state()
    {
        if ($_POST['valu'] == 156) {
            $state = $this->utitlitymodel->getall('state'); //var_dump($state);exit;
            echo '<option value="">--Select State -- </option>';
            foreach ($state as $s) {
                echo '<option value="'.$s->state_id.'">'.$s->state_name.'</option>';
            }
        } else {
            echo '<option value="0">Outside Nigeria </option>';
        }
    }

    public function upload_image()
    {
        $rawData = $_POST['imgBase64'];
        $filteredData = explode(',', $rawData);

        $unencoded = base64_decode($filteredData[1]);
        $randomName = rand(0, 99999);
        //Create the image
        $image_random_name = $randomName.'.png';
        $image_name = 'uploads/'.$image_random_name;
        $fp = fopen($image_name, 'w');
        echo $image_random_name;
        fwrite($fp, $unencoded);
        fclose($fp);
    }

    public function getExpLineRemainder()
    {
        $emp_details = $this->settingsmodel->getEmployeeDetails($_SESSION['login_detal']->id);

        if ($_POST) {
           $year = $_SESSION['finacial_year']->year;

           $exp_line = $_POST["exp_line"];
           if ($_POST['stat'] == 'adm') {
               $dept_id =  10;
           } else {
               $dept_id =  $emp_details['department'];
           }
           
           
           $budget = 0;
           $actual = 0;
        
           $dept_budget = $this->settingsmodel->getDepartmentBudget($dept_id, $year, $exp_line);
           $dept_amount = $this->reportmodel->getDepartmentBudget($dbFilter = 'YEAR', $dept_id, $year, $exp_line); 
           if ($dept_budget) {
               $budget = $dept_budget[0]->budgeted_amount;
           }

           if ($dept_amount) {
               $actual = $dept_amount[0]->amount;
           }
           $balance = sprintf("%.2f", (floatval($budget) - floatval($actual)));

           echo json_encode(array('status'=>true,'bal'=>$balance));
        }
    }

    public function addorderitems()
    {
        if ($_POST) {
            extract($_POST);
            $details = array('order_id' => $id, 'weight_id' => $weight, 'quantity_id' => $quantity);
            $order_id = $this->utitlitymodel->insert('order_quantity', $details);
            //if($order_id)//echo 'Stock Updated';
        }
        $data['order_qty'] = $this->utitlitymodel->fetch_all_order_id_pk('order_quantity', 'order_id', $id);

        if ($order_id) {
            $this->load->view('neworder_ajax', $data);
        } else {
            'We could not update you data';
        }
    }
}?>