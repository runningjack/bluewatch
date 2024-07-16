<?php

class Generalmodel extends CI_Model
{
    public static $schoolname = 'Bluechip Tech';
    public static $schoolAdd = 'katsina State,';
    public static $schoolAddPMB = 'No 9B Onikoyi Lane.';
    public static $faculty = 'Bluechip';
    public static $rightreserve = 'Bluechip Tech Limited';
    public static $developer = 'Bluechiptech Ltd';

    public static $schoolshortname = 'Budget Application';

    public static $email = 'lekan4real07@yahoo.com';

    public function __construct()
    {
        parent::__construct();
        //$this->db_cms = $this->load->database('cms', TRUE);
    }

    public function Mailfunction($to, $subject, $body)
    {
        $url = 'http://46.101.81.193:3000/api/sendmail';
        $url = MAILAPI;
        $data['phone'] = '07030657010';
        $data['password'] = '07030657010';
        $data['mail_from'] = 'info@bodcng.com';
        $data['mail_to'] = $to;
        $data['mail_body'] = $body;
        $data['mail_subject'] = $subject;
        $this->callSendAPI('POST', $url, $data);
    }

    public function getFinyear()
    {
        $result = $this->db->get('finacial_year_setting');
        return $result->row();
    }

    public function setFinYear($data)
    {
        $resp = $this->db->update('finacial_year_setting', $data);
        return $resp;    
    }

    function check_duplicate_trans($key, $table)
    {

        $this->db->where('trans_id', $key);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0) ? TRUE : FALSE;

    }

    public function photo($image, $display = 0)
    {
        //  var_dump(base_url('passport/'.$image));exit;
        // if(getimagesize(base_url('passport/'.$image)))

        if (strpos($image, 'pdf') !== false) {
            $myfilename = base_url('exp_files/pdf.jpg');
            $dmyfilename = "<img  src='$myfilename' "
        .' />';
            echo $dmyfilename;
        } else {
            if (empty($image)) {
                $image = 'default.png';       //if image not found this will display
            }
            $myfilename = base_url('exp_files/'.$image);
            $dir = 'exp_files/'.$image;
            $defaultfilename = base_url('exp_files/default.png'); //var_dump(($myfilename));exit;
            if (file_exists($dir)) {
                $dmyfilename = "<img  style='width:70px;height:80px;' src='$myfilename' "
              .' />';
                if ($display == 1) {
                    $dmyfilename = "<img  src='$myfilename' "
              .' />';
                }
            } else {
                $dmyfilename = "<img style='width:120px;height:120px;' src='$defaultfilename' />";
                if ($display == 1) {
                    $dmyfilename = "<img  src='$defaultfilename' "
              .' />';
                }
            }

            echo $dmyfilename;
        }
    }


    public function callSendAPI($method, $url, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        $payload = json_encode($data);

        if ($data) {
            //  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'Content-Type : application/x-www-form-urlencoded',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            return false;
        }
        curl_close($curl);

        return $result;
    }

    public function chkschoolprofile($id)
    {
        $retVal = true;
        $this->db->select('*')->from('school_attended')->where('std_id', $id);

        $query = $this->db->get(); //var_dump($query->num_rows());exit;
        if ($query->num_rows() > 0) {
            $retVal = false;
        }

        return $retVal;
    }

    public function chk_ol($id)
    {
        $retVal = true;
        $this->db->select('*')->from('student_olevel')->where('student_id', $id);

        $query = $this->db->get(); //var_dump($query->num_rows());exit;
        if ($query->num_rows() > 0) {
            $retVal = false;
        }

        return $retVal;
    }

    public function allbloodgroup()
    {
        $query = $this->db->get('bloodgroup');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function allgenotype()
    {
        $query = $this->db->get('genotype');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function olevelsubject()
    {
        $query = $this->db->get('olevel_subject');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function olevelexam()
    {
        $query = $this->db->get('olevel_exam_type');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function olevelgrade()
    {
        $this->db->where('grade.gcid', 1);
        $query = $this->db->get('grade');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function school_attended($id)
    {
        // echo $id;
        $this->db->where('school_attended.std_id', $id);
        $query = $this->db->get('school_attended');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function alevelgrade()
    {
        $this->db->where('grade.gcid', 3);
        $query = $this->db->get('grade');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getallstate()
    {
        $query = $this->db->get('state');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function allprogrammetype()
    {
        $query = $this->db->get('programme_type');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function alldegreegen()
    {
        $query = $this->db->get('degree');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function allentrymode()
    {
        $query = $this->db->get('entrymode');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function alllga()
    {
        $query = $this->db->get('lga');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function alllgabystate($state_id)
    {
        $this->db->where('lga.state_id', $state_id);
        $query = $this->db->get('lga');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getallstatus()
    {
        $query = $this->db->get('student_status');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function getallprog()
    {
        $query = $this->db->get('programme');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function alldegree($prog_id)
    {
        $this->db->where('degree.programme_id', $prog_id);
        $query = $this->db->get('degree');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function insert_courses($data)
    {
        $this->db->insert('courses', $data);
        $id = $this->db->insert_id();

        return (isset($id)) ? $id : false;
    }

    public function getsinglecourses($id)
    {
        $this->db->select('*');
        $this->db->join('department', 'department.department_id = courses.department_id', 'left');
        $this->db->join('faculty', 'faculty.faculty_id = department.faculty_id', 'left');
        $this->db->where('courses.course_id', $id);
        $query = $this->db->get('courses');

        return $query->row_array();
    }

    public function update_courses($id, $data)
    {
        $this->db->where('course_id', $id);
        $this->db->update('courses', $data);
    }

    public function delete_courses($id)
    {
        $this->db->where('course_id', $id);
        $this->db->delete('courses');
    }

    public function allcoursesbylevelanddepartment($department_id, $level_id)
    {
        $this->db->where('courses.department_id', $department_id);
        $this->db->where('courses.level_id', $level_id);

        $this->db->join('department', 'department.department_id = courses.department_id', 'left');
        $this->db->join('level', 'level.level_id = courses.level_id', 'left');
        $query = $this->db->get('courses');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // var_dump($this->GuestStatus($row->guestid));exit;
                $data[] = $row;
            }

            return $data;
        }

        return false;
    }

    public function profile_photo($image)
    {
        $myfilename = base_url('passport/'.$image);
        $dir = 'passport/'.$image;
        $defaultfilename = base_url('passport/default.jpg'); //var_dump(($myfilename));exit;
        if (file_exists($dir)) {
            $dmyfilename = "<img  style='width:120px;height:120px;' src='$myfilename' "
        .' />';
        } else {
            $dmyfilename = "<img style='width:120px;height:120px;' src='$defaultfilename' />";
        }

        return $dmyfilename;
    }
}
