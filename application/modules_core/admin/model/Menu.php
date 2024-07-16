<?php

/**
 * This Class Buid Menus Both the top and side menu and its dynamic.
 *
 * @author Gbadeyanka Abass
 */
class menu extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
        //$this->menu_object = new Menu();
    }

    public function getPerm($grp_id)
    {
        $this->db->select('perm_id');
        $this->db->where('role_id', $grp_id);
        $query = $this->db->get('role_perm');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getAccesibleMenu($res_ext)
    {
        // var_dump($res_ext);exit;
       // $this->db = $this->load->database('default', true); 
        $this->db->distinct('module.module_name');
        $this->db->select('module.module_name');
        $this->db->select('permissions.module_id');
        $this->db->join('permissions', 'permissions.module_id = module.module_id', 'left');
        $this->db->where('permissions.perm_id IN ('.$res_ext.')', null, false);

        $query = $this->db->get('module');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            // var_dump($data);
            return $data;
        }

        return false;
    }

    public function getPermDetail($res_ext, $id, $grp_id)
    {
        $this->db->select('*');
        $this->db->join('role_perm', 'role_perm.perm_id = permissions.perm_id', 'left');
        $this->db->where('role_perm.perm_id IN ('.$res_ext.')', null, false);
        $this->db->where('role_id', $grp_id);
        $this->db->where('module_id', $id);
        $this->db->where('visible', '1');
        $query = $this->db->get('permissions');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function fetchEnabledModule($grp_id)
    {
        // $db = new Database();
        $res_list = array();

        $module_menu = array();
        $list = array();
       $menu_object = new Menu();

        $res = $menu_object->getPerm($grp_id);
        //var_dump($res );exit;
        if ($res) {
            foreach ($res as $d) {
                $res_list[] = $d->perm_id;
            }
            $res_ext = join(',', array_values($res_list)); //var_dump($res_ext);exit;

            //fetch enabled menus

            $emodule = Menu::getAccesibleMenu($res_ext);
            // var_dump($emodule);

            foreach ($emodule as $s) {
                $list['module_name'] = $s->module_name;
                $id = $s->module_id;

                //echo $lsql;
                $res2 = Menu::getPermDetail($res_ext, $id, $grp_id);
                $menu = array();
                $m_name_des = array();
                if ($res2) {
                    foreach ($res2 as $k) {
                        //  var_dump($res2);
                        $menu['perm_name'] = $k->perm_name;
                        $menu['per_desc'] = $k->perm_desc;
                        $m_name_des[] = $menu;
                    }
                    $list['menu'] = $m_name_des;
                    $module_menu[] = $list;
                }
            }
        }

        return $module_menu;
    }

    public function menuIcon($id)
    {
        //  echo $id;
        $id = $id;
        switch ($id) {
           case 1:
           $icoon = '<i class="fa fa-smile-o"></i>';
              echo $icoon;
            break;
            case 2:
           $icoon = '<i class="fa fa-list-alt"></i>';
                echo $icoon;
            break;
           case 3:
           $icoon = '<i class="fa fa-table"></i>';
               echo $icoon;
            break;
           case 4:
           $icoon = '<i class="fa fa-map-marker nav-icon"></i>';
               echo $icoon;
            break;
           case 5:
           $icoon = '<i class="fa fa-envelope nav-icon"></i>';
               echo $icoon;
           break;
           case 6:
           $icoon = '<i class="fa fa-text-height"></i>';
               echo $icoon;
           break;
           case 7:
           $icoon = '<i class="fa fa-bar-chart-o"></i>';
               echo $icoon;
           break;
           case 8:
           $icoon = '<i class="fa fa-table"></i>';
               echo $icoon;
           break;
           case 9:
           $icoon = '<i class="fa fa-file"></i>';
               echo $icoon;
           break;
           case 10:
           $icoon = '<i class="fa fa-history"></i>';
               echo $icoon;
           break;
           case 11:
           $icoon = '<i class="fa fa-file"></i>';
               echo $icoon;
           break;
           default:
           $icoon = '';
               echo $icoon;
           break;

     // echo $icoon;
         }
    }
}
