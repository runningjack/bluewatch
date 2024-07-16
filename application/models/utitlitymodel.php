<?php

class utitlitymodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //$this->db_cms = $this->load->database('new_hospital', TRUE);
    }

    public function getemployeetimelogcount($employid)
    {
        $this->db->where('employee_id', $employid);
        $query = $this->db->get('activities');

        return $query->num_rows();
    }

    public function getemprojectmemebertimelogcount($employid)
    {
        $this->db->where('employee_id', $employid);
        $query = $this->db->get('activities');

        return $query->num_rows();
    }

    public function getprojectsprojmanagercount($employid)
    {
        $this->db->where('project_manager', $employid);
        $query = $this->db->get('projects');

        return $query->num_rows();
    }

    public function getprojectscdocount()
    {
        $query = $this->db->get('projects');

        return $query->num_rows();
    }

    public function gettimelogteamlead($employid)
    {
        // $this->db->limit($limit, $start);
        $this->db->select('activities.employee_id as employee_id');
        $this->db->select('activities.*');
        $this->db->select('projects.*');
        //$this->db->select('tasks.*');
        $this->db->join('employees', 'employees.id = activities.employee_id', 'left');
        $this->db->join('projects', 'projects.id = activities.project_id', 'left');
        //$this->db->join('tasks', 'tasks.task_id = activities.project_task', 'left');
        $this->db->join('project_team', 'project_team.team_project_id = activities.project_id', 'left');

        // $where = "FIND_IN_SET('".$employid."', project_team.team_leadn)";
        //  $this->db->where($where);


        $this->db->where('project_team.team_lead', $employid);
        $query = $this->db->get('activities');
        //var_dump($query->result());exit;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getteamleadproject($employid)
    {
        $this->db->select('projects.*');
        $this->db->select('clients.name as client_name');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $this->db->join('project_team', 'project_team.team_project_id = projects.id', 'left');
        $this->db->where('project_team.team_lead', $employid);
        $query = $this->db->get('projects');
        return $query->result();
    }

    public function getProjectManagerproject($employid)
    {
        $this->db->select('projects.*');
        $this->db->select('clients.name as client_name');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $this->db->join('project_team', 'project_team.team_project_id = projects.id', 'left');
        $this->db->where('projects.project_manager', $employid);
        $query = $this->db->get('projects');
        return $query->result();
    }


    public function projectmanagerviewproject($employid)
    {
        $this->db->select('projects.*');
        $this->db->select('clients.name as client_name');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $this->db->where('projects.project_manager', $employid);
        $query = $this->db->get('projects');
        return $query->result();
    }

    public function cdoviewproject()
    {
        $this->db->select('projects.*');
        $this->db->select('clients.name as client_name');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $query = $this->db->get('projects');
        return $query->result();
    }


    public function getProjectTeamBWithRole($employid, $id)
    {
        $this->db->select('*');
        $this->db->select('Employees.id as employee_id');
        $this->db->select('project_roles.name as role_name');
        $this->db->where('project_team_role.project_id', $id);
        $this->db->where('project_manager', $employid);
        $this->db->join('Employees', 'Employees.id = project_team_role.assigned_to', 'left');
        $this->db->join('project_roles', 'project_roles.project_role_id = project_team_role.project_role_id', 'left');
        $this->db->join('projects', 'projects.id = project_team_role.project_id', 'left');

        $query = $this->db->get('project_team_role');

        return $query->result();
    }

    public function getProjectTeam($employid, $id)
    {
        $this->db->select('*');
        $this->db->where('team_project_id', $id);
        $this->db->where('team_project_manager', $employid);
        $query = $this->db->get('project_team');

        return $query->result();
    }

    public function getProjectTeamLead($employid, $id)
    {
        $this->db->select('*');
        $this->db->where('team_project_id', $id);
        $this->db->where('team_lead', $employid);
        $query = $this->db->get('project_team');
        return $query->result();
    }

    public function getcdoProjectTeam($id)
    {
        $this->db->select('*');
        $this->db->where('team_project_id', $id);
        $query = $this->db->get('project_team');
        //var_dump($query->result());exit;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getProjectTeamMemberName($id)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('first_name');
        $this->db->select('middle_name');
        $this->db->select('last_name');
        $this->db->select('id');
        $this->db->where('id', $id);

        $query = $this->db->get('employees');
        return $query->row_array();
    }

    public function getProjectTeamMemberRate($project_id, $user_id)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('`SUM(activities.hours)` As hours');
        $this->db->select('employee_rate');
        $this->db->select('rate_cost');
        $this->db->where('project_id', $project_id);
        $this->db->where('employee_id', $user_id);

        $query = $this->db->get('employee_hourly_cost_rate');
        return $query->row_array();
    }

    public function getProjectTeamMemberRateCost($user_id)
    {
        // var_dump($res_ext);exit;
        $this->db = $this->load->database('default', true);
        $this->db->select('employee_rate');
        $this->db->where('employee_id', $user_id);

        $query = $this->db->get('employee_rate');
        return $query->row_array();
    }

    public function getemprojectmemebertimelog($employid, $id)
    {
        $projectTeam = $this->getProjectTeam($employid, $id);
        $projectTeam = $this->getProjectTeamBWithRole($employid, $id);
        //  var_dump($projectTeam);exit;

        $team = array();
        if ($projectTeam) {
            foreach ($projectTeam as $value) {

                $list = array();
                $list['project_code'] = $value->project_code;
                // $member_name = $this->getProjectTeamMemberName($data);
                $list['member_name'] = $value->first_name . " " . $value->last_name;
                $list['member_id'] = $value->employee_id;
                $list['role_name'] = $value->role_name;
                $list['name'] = $value->name;

                $team[] = $list;
            }
        }

        return $team;
    }

    public function getteamleadprojectmembers($employid, $id)
    {
        $projectTeam = $this->getProjectTeamLead($employid, $id);
        $team = array();
        if ($projectTeam) {
            foreach ($projectTeam as $value) {
                $team_member = explode(',', $value->team_member);
                foreach ($team_member as $data) {
                    $list = array();
                    $list['team_name'] = $value->team_name;
                    $list['team_lead'] = $value->team_lead;
                    $member_name = $this->getProjectTeamMemberName($data);
                    $list['member_name'] = $member_name['first_name'] . " " . $member_name['last_name'];
                    $list['member_id'] = $member_name['id'];

                    $team[] = $list;
                }
            }
        }

        return $team;
    }

    public function getfinanceprojectmemebertimelog($id)
    {
        $projectTeam = $this->getcdoProjectTeam($id);
        $team = array();
        foreach ($projectTeam as $value) {
            $team_member = explode(',', $value->team_member);
            foreach ($team_member as $data) {
                $list = array();
                $list['team_name'] = $value->team_name;
                $list['team_lead'] = $value->team_lead;
                $member_name = $this->getProjectTeamMemberName($data);
                $member_rate_cost = $this->getProjectTeamMemberRateCost($data);
                $member_rate = $this->getProjectTeamMemberRate($id, $data);
                $employee_rate = ($member_rate_cost) ? $member_rate_cost['employee_rate'] : 0;
                $list['member_name'] = $member_name['first_name'] . " " . $member_name['last_name'];
                $list['member_id'] = $member_name['id'];
                if ($member_rate) {
                    $list['hours'] = $member_rate['hours'];
                    $list['employee_rate'] = $employee_rate;
                    $list['rate_cost'] = $member_rate['rate_cost'];
                } else {
                    $list['hours'] = 0;
                    $list['employee_rate'] = $employee_rate;
                    $list['rate_cost'] = 0;
                }


                $team[] = $list;
            }
        }

        return $team;
    }

    public function getcdoprojectmemebertimelog($id)
    {
        $projectTeam = $this->getcdoProjectTeam($id);
        $team = array();
        foreach ($projectTeam as $value) {
            $team_member = explode(',', $value->team_member);
            foreach ($team_member as $data) {
                $list = array();
                $list['team_name'] = $value->team_name;
                $list['team_lead'] = $value->team_lead;
                $member_name = $this->getProjectTeamMemberName($data);
                $list['member_name'] = $member_name['first_name'] . " " . $member_name['last_name'];
                $list['member_id'] = $member_name['id'];

                $team[] = $list;
            }
        }

        return $team;
    }

    public function getprojectsprojmanager($employid)
    {
        $this->db->select('projects.*');
        $this->db->select('clients.name as client_name,projects.id as project_id');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $this->db->where('project_manager', $employid);
        $query = $this->db->get('projects');

        return $query->result();
    }


    public function getprojectscdo($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('projects.*');
        $this->db->select('clients.name as client_name');
        $this->db->join('clients', 'clients.id = projects.client', 'left');
        $query = $this->db->get('projects');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }



    public function gettimelogprojmanager($limit, $start, $employid)
    {
        $this->db->limit($limit, $start);
        $this->db->join('employees', 'employees.id = activities.employee_id', 'left');
        $this->db->join('projects', 'projects.id = activities.project_id', 'left');
        $this->db->join('project_tasks', 'project_tasks.task_id = activities.project_task', 'left');
        $this->db->join('project_team', 'project_team.team_project_id = activities.project_task', 'left');

        // $where = "FIND_IN_SET('".$employid."', project_team.team_leadn)";
        //  $this->db->where($where);


        $this->db->where('projects.project_manager', $employid);
        $query = $this->db->get('activities');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }



    public function getsingleemployeetimelog($activitiesId)
    {

        $this->db->join('employees', 'employees.id = activities.employee_id', 'left');
        $this->db->join('projects', 'projects.id = activities.project_id', 'left');
        $this->db->join('project_tasks', 'project_tasks.task_id = activities.project_task', 'left');
        $this->db->where('activities.activity_id', $activitiesId);
        $query = $this->db->get('activities');

        return $query->row_array();
    }

    public function getemployeetimelogGroupBydateByProjectManager($employid, $project_list)
    {
 // var_dump($project_list);exit;


        if ($_POST) {
            $project_id = $_POST['project_id'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $date_from = date("Y-m-d", strtotime($start_date)) . ' 00:00:00';
            $date_to = date("Y-m-d", strtotime($end_date)) . ' 23:59:59';
        }
        $this->db->select('DATE(log_date) as date, COUNT(*) as total');
        $this->db->from('activities');
        $this->db->join('projects', 'projects.id = activities.project_id', 'left'); 
        $this->db->where('projects.project_manager', $employid); 
        if ($project_id) $this->db->where('activities.project_id', $project_id);
        if ($start_date) $this->db->where("activities.log_date BETWEEN '$date_from' AND '$date_to'");
        $this->db->group_by('DATE(log_date)');
        $this->db->limit(30);
        $query = $this->db->get();
        $all_date = $query->result_array();


        $final_level_array = array();
        foreach ($all_date as $current_date) {

            if ($current_date['total'] > 0) {
                $main_array = array();
                $main_array['current_date'] = $current_date['date'];
                // $main_array['project_list'] = array();

                foreach ($project_list as  $key=>$pl) {
                    $project_log['project_log']["project_details"] = $pl;
                    $this->db->select('activities.employee_id as empl_id');
                    $this->db->select('activities.*');
                    $this->db->select('projects.*');
                    $this->db->select('employees.*');
                    $this->db->select('project_role_task.*');

                    $this->db->join('employees', 'employees.id = activities.employee_id', 'left');
                    $this->db->join('projects', 'projects.id = activities.project_id', 'left');
                    $this->db->join('project_role_task', 'project_role_task.task_id = activities.project_task', 'left');
                    //log_date
                    $this->db->where('activities.project_id', $key);
                    $this->db->where('activities.log_date', $current_date['date']);
                    $this->db->where('projects.project_manager', $employid); 
                    if ($project_id) $this->db->where('activities.project_id', $project_id);
                    if ($start_date) $this->db->where("activities.log_date BETWEEN '$date_from' AND '$date_to'");
                    $this->db->order_by('activities.activity_id', 'desc');
                    $query = $this->db->get('activities');
                    //   if ($query->num_rows() > 0) {
                    $project_log['project_log']["project_list"] = $query->result();
                    $project_log['project_log']["project_list_count"]  = $query->num_rows();
                    $main_array[] = $project_log;
                    //     }               
                }
                $main_array['project_list'] = $main_array;

                $final_level_array[] = $main_array;
            }
        }


        return $final_level_array;
    }


    public function getemployeetimelogGroupBydate($employid, $project_list)
    {



        if ($_POST) {
            $project_id = $_POST['project_id'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $date_from = date("Y-m-d", strtotime($start_date)) . ' 00:00:00';
            $date_to = date("Y-m-d", strtotime($end_date)) . ' 23:59:59';
        }
        $this->db->select('DATE(log_date) as date, COUNT(*) as total');
        $this->db->from('activities');
        $this->db->where('activities.employee_id', $employid);
        if ($project_id) $this->db->where('activities.project_id', $project_id);
        if ($start_date) $this->db->where("activities.log_date BETWEEN '$date_from' AND '$date_to'");
        $this->db->group_by('DATE(log_date)');
        $this->db->order_by("log_date", "desc");
        $this->db->limit(60);
        $query = $this->db->get();
        $all_date = $query->result_array();


        $final_level_array = array();
        foreach ($all_date as $current_date) {

            if ($current_date['total'] > 0) {
                $main_array = array();
                $main_array['current_date'] = $current_date['date'];
                // $main_array['project_list'] = array();

                foreach ($project_list as $pl) {
                    $project_log['project_log']["project_details"] = $pl->name;
                    $this->db->select('activities.employee_id as empl_id');
                    $this->db->select('activities.*');
                    $this->db->select('projects.*');
                    $this->db->select('employees.*');
                    $this->db->select('project_role_task.*');

                    $this->db->join('employees', 'employees.id = activities.employee_id', 'left');
                    $this->db->join('projects', 'projects.id = activities.project_id', 'left');
                    $this->db->join('project_role_task', 'project_role_task.task_id = activities.project_task', 'left');
                    //log_date
                    $this->db->where('activities.project_id', $pl->proj_id);
                    $this->db->where('activities.log_date', $current_date['date']);
                    $this->db->where('activities.employee_id', $employid);
                    if ($project_id) $this->db->where('activities.project_id', $project_id);
                    if ($start_date) $this->db->where("activities.log_date BETWEEN '$date_from' AND '$date_to'");
                    $this->db->order_by('activities.activity_id', 'desc');
                    $query = $this->db->get('activities');
                    //   if ($query->num_rows() > 0) {
                    $project_log['project_log']["project_list"] = $query->result();
                    $project_log['project_log']["project_list_count"]  = $query->num_rows();
                    $main_array[] = $project_log;
                    //     }               
                }
                $main_array['project_list'] = $main_array;

                $final_level_array[] = $main_array;
            }
        }


        return $final_level_array;
    }



    public function getemployeetimelog($employid)
    {
        // die("......");
        //$this->db->limit($limit, $start);
        $this->db->join('employees', 'employees.id = activities.employee_id', 'left');
        $this->db->join('projects', 'projects.id = activities.project_id', 'left');
        // $this->db->join('project_tasks', 'project_tasks.task_id = activities.project_task', 'left');
        $this->db->join('project_role_task', 'project_role_task.task_id = activities.project_task', 'left');

        $this->db->where('activities.employee_id', $employid);
        $this->db->order_by('activities.activity_id', 'desc');
        $query = $this->db->get('activities');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getallforpagination($table_name, $limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get($table_name);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function fetch_all_order_id_pk($table_name, $pk, $id)
    {
        $this->db->where('order_quantity.order_id', $id);
        $query = $this->db->get('order_quantity');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }


    public function getExpenseCat($cat_id, $dept)
    {
        //var_dump($dept);exit;
        $where = "FIND_IN_SET('" . $dept . "', expense_line.department_map)";
        $this->db->where($where);
        $this->db->where('expense_category_id', $cat_id);
        $query = $this->db->get('expense_line');



        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }


    public function getTaskByProject($project_id)
    {
        $this->db->select('project_tasks.id, project_role_task.task_name');
        $this->db->join('project_role_task', 'project_role_task.task_id = project_tasks.task_id', 'left');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_tasks');



        return $query->result();
    }

    public function getall($table_name)
    {
        $query = $this->db->get($table_name);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function insert($table_name, $data)
    {
        $this->db->insert($table_name, $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }

    public function getSingle($table_name, $pk, $id)
    {
        $this->db->select('*');
        $this->db->where($pk, $id);
        $query = $this->db->get($table_name);

        return $query->row_array();
    }

    public function update($table_name, $pk, $id, $data)
    {      //var_dump($id);exit;
        $this->db->where($pk, $id);
        $this->db->update($table_name, $data);
    }

    public function delete($table_name, $pk, $id)
    {
        $this->db->where($pk, $id);
        $this->db->delete($table_name);
    }

    public function profile_photo($image)
    {
        $myfilename = base_url('uploads/' . $image); //echo $myfilename;
        //   $dmyfilename = $myfilename;
        if (!($image == '')) {
            $dmyfilename = "$myfilename";
        } else {
            $dmyfilename = base_url('uploads/default.jpg');
        }

        return $dmyfilename;
    }
}
