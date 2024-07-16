<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {
    
    function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('settingsmodel');
        
    }
    
    function sendTaskNotification() {
        $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime (date('Y-m-d')) ) ));
        
        if (!$this->isWeekend($yesterday)) {
            $employees = $this->settingsmodel->getTaskEmployee($yesterday);

            foreach ($employees as $value) {
                if ($this->settingsmodel->checkLogdate($value->assigned_to, $yesterday)) {
                    continue;
                }

                $recipiant_name = $value->first_name . ' ' . $value->last_name;;
                $subject = 'Bluewatch Actvitiy Log Reminder';
                $body = 'Your are yet to log your task activities for yesterday, Please do so before 11:59pm today';
                $this->sendTeamLeadTimeLogMail($subject, $recipiant_name, $body, $value->work_email);
            }
        }

    }

    public function isWeekend($date)
    {
        $dt1 = strtotime($date);
        $day = date("w", $dt1);
        if ($day == 0 || $day == 6) {
            return true;
        } else {
            return false;
        }
    }

    public function sendTeamLeadTimeLogMail($mail_title, $recipiant_name, $body, $to)
    {
        $body = '<html>
    <head>
        <title>Bluechip Technology</title>
    </head>
    <body>
<table style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px; color:#757575; width:600px; background-color:#fff; margin:0" bgcolor="#fff">
	<tbody>
		<tr>
            <td valign="top"></td>
            <td width="600" valign="top">
                <div style="max-width:600px;display:block;margin:0 auto;padding:20px">
                    <table style="background-color:#f5f2f5; margin:0" width="598px" cellspacing="0" cellpadding="0" bgcolor="#F5F2F5">
                        <tbody>
							<tr style="margin:0">
								<td style="text-align:right;padding-right:15px;padding-top:20px">
									<img src="http://bluechiptech.biz/wp-content/uploads/2019/03/bluechip-light-1.png"  >
								</td>
							</tr>
							<tr>
								<td valign="top" style="padding:20px">
									<table width="550px" cellspacing="0" cellpadding="0">
										<tbody>
											<tr >
												<td style="font-weight:bold;color:black; font-size:20px;line-height:18px;vertical-align:top;margin:0;padding:0 0 20px" valign="top">
                                                ' . $mail_title . '
												</td>
											</tr>
											<tr style="background-color:#fff;">
												<td style="color:#000; padding:20px" valign="top">
													<table>
														<tbody>
															<tr>
																<td>
																	Dear ' . $recipiant_name . ',
																</td>
															</tr>
															<tr>
																<td style="padding:10px 0; font-size:20px;">
                                                                ' . $body . ' 
																</td>
															</tr>

														</tbody>
													</table>
													 
													<br />
													If you need to know more, send an email to 
													<span style="color:#ab0b4b">appdevsupport@bluechtech.biz</span>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
                        </tbody>
					</table>
				</div>
			</td>
		</tr>
    </tbody>
</table>
	</body>
</html>';

        $this->load->helper('mymail');
        Mailfunction1($to, $mail_title, $body);
    }
}

?>