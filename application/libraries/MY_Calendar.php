<?php 

class MY_Calendar extends CI_Calendar {
    
    public function __construct($config = array())
        {
            parent::__construct($config);
        }


    public function generate($year = '', $month = '', $data = array())
	{
		$local_time = time();

		// Set and validate the supplied month/year
		if (empty($year))
		{
			$year = date('Y', $local_time);
		}
		elseif (strlen($year) === 1)
		{
			$year = '200'.$year;
		}
		elseif (strlen($year) === 2)
		{
			$year = '20'.$year;
		}

		if (empty($month))
		{
			$month = date('m', $local_time);
		}
		elseif (strlen($month) === 1)
		{
			$month = '0'.$month;
		}

		$adjusted_date = $this->adjust_date($month, $year);

		$month	= $adjusted_date['month'];
		$year	= $adjusted_date['year'];

		// Determine the total days in the month
		$total_days = $this->get_total_days($month, $year);

		// Set the starting day of the week
		$start_days	= array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
		$start_day	= isset($start_days[$this->start_day]) ? $start_days[$this->start_day] : 0;

		// Set the starting day number
		$local_date = mktime(12, 0, 0, $month, 1, $year);
		$date = getdate($local_date);
		$day  = $start_day + 1 - $date['wday'];

		while ($day > 1)
		{
			$day -= 7;
		}

		// Set the current month/year/day
		// We use this to determine the "today" date
		$cur_year	= date('Y', $local_time);
		$cur_month	= date('m', $local_time);
		$cur_day	= date('j', $local_time);

		$is_current_month = ($cur_year == $year && $cur_month == $month);

		// Generate the template data array
		$this->parse_template();

		// Begin building the calendar output
		$out = $this->replacements['table_open']."\n\n".$this->replacements['heading_row_start']."\n";

		// "previous" month link
		if ($this->show_next_prev === TRUE)
		{
			// Add a trailing slash to the URL if needed
			$this->next_prev_url = preg_replace('/(.+?)\/*$/', '\\1/', $this->next_prev_url);

			$adjusted_date = $this->adjust_date($month - 1, $year);
			$out .= str_replace('{previous_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->replacements['heading_previous_cell'])."\n";
		}

		// Heading containing the month/year
		$colspan = ($this->show_next_prev === TRUE) ? 5 : 7;

		$this->replacements['heading_title_cell'] = str_replace('{colspan}', $colspan,
								str_replace('{heading}', $this->get_month_name($month).'&nbsp;'.$year, $this->replacements['heading_title_cell']));

		$out .= $this->replacements['heading_title_cell']."\n";

		// "next" month link
		if ($this->show_next_prev === TRUE)
		{
			$adjusted_date = $this->adjust_date($month + 1, $year);
			$out .= str_replace('{next_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->replacements['heading_next_cell']);
		}

		$out .= "\n".$this->replacements['heading_row_end']."\n\n"
			// Write the cells containing the days of the week
			.$this->replacements['week_row_start']."\n";

		$day_names = $this->get_day_names();

		for ($i = 0; $i < 7; $i ++)
		{
			$out .= str_replace('{week_day}', $day_names[($start_day + $i) %7], $this->replacements['week_day_cell']);
		}

		$out .= "\n".$this->replacements['week_row_end']."\n";

		// Build the main body of the calendar
		$convertedwks = date('Y-m-j',strtotime('Monday -2 weeks',strtotime(date('Y-m-d'))));
		$convertedwks2 = date('Y-m-j',strtotime('Monday -1 weeks',strtotime(date('Y-m-d'))));
		$thisconvertedwks = date('Y-m-j',strtotime('Monday this week',strtotime(date('Y-m-d'))));
		//var_dump($convertedwks);exit;
		while ($day <= $total_days)
		{
			
			if ($day > 0 && $day <= $total_days)
			{
				$cvwks = $year."-".$month."-".$day;
				$week2 = '';
				if ($convertedwks == $cvwks || $convertedwks2 == $cvwks) {
					$week2 = 'week2';
				}

				$thisweek2 = '';
				if ($thisconvertedwks == $cvwks) {
					$thisweek2 = 'active-week';
				}

			$out .= "\n".str_replace(array('{weeks2}', '{thisweek}', '{week_first_date}'), array($week2, $thisweek2, $cvwks), $this->replacements['cal_row_start'])."\n";
		}
		elseif ($this->show_other_days === TRUE)
		{
			if ($day <= 0)
					{
						// Day of previous month
						$prev_month = $this->adjust_date($month - 1, $year);
						$prev_month_days = $this->get_total_days($prev_month['month'], $prev_month['year']);

						$cvwks = $year."-".$prev_month['month']."-".($prev_month_days + $day);
						$week2 = '';
						if ($convertedwks == $cvwks || $convertedwks2 == $cvwks) {
							$week2 = 'week2';
						}

						$thisweek2 = '';
						if ($thisconvertedwks == $cvwks) {
							$thisweek2 = 'active-week';
						}

						$out .= str_replace(array('{weeks2}', '{thisweek}', '{week_first_date}'), array($week2, $thisweek2, $cvwks), $this->replacements['cal_row_start']);
					}
					else
					{
						// Day of next month
						$cvwks = $year."-".$prev_month."-".($day - $total_days);
						$week2 = '';
						if ($convertedwks == $cvwks || $convertedwks2 == $cvwks) {
							$week2 = 'week2';
						}

						$thisweek2 = '';
						if ($thisconvertedwks == $cvwks) {
							$thisweek2 = 'active-week';
						}

						$out .= str_replace(array('{weeks2}', '{thisweek}', '{week_first_date}'), array($week2, $thisweek2, $cvwks), $this->replacements['cal_row_start']);
					}
		}
		else
		{
			$out .= "\n".str_replace(array('{weeks2}', '{thisweek}', '{week_first_date}'), array("", "", ""), $this->replacements['cal_row_start'])."\n";
		}
			for ($i = 0; $i < 7; $i++)
			{
				if ($day > 0 && $day <= $total_days)
				{
					$out .= ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_start_today'] : $this->replacements['cal_cell_start'];

					if (isset($data[$day]))
					{
						// Cells with content
						$temp = ($is_current_month === TRUE && $day == $cur_day) ?
								$this->replacements['cal_cell_content_today'] : $this->replacements['cal_cell_content'];
						$out .= str_replace(array('{content}', '{day}'), array($data[$day], $day), $temp);
					}
					else
					{
						// Cells with no content
						$temp = ($is_current_month === TRUE && $day == $cur_day) ?
								$this->replacements['cal_cell_no_content_today'] : $this->replacements['cal_cell_no_content'];
						$out .= str_replace('{day}', $day, $temp);
					}

					$out .= ($is_current_month === TRUE && $day == $cur_day) ? $this->replacements['cal_cell_end_today'] : $this->replacements['cal_cell_end'];
				}
				elseif ($this->show_other_days === TRUE)
				{
					$out .= $this->replacements['cal_cell_start_other'];

					if ($day <= 0)
					{
						// Day of previous month
						$prev_month = $this->adjust_date($month - 1, $year);
						$prev_month_days = $this->get_total_days($prev_month['month'], $prev_month['year']);
						$out .= str_replace('{day}', $prev_month_days + $day, $this->replacements['cal_cell_other']);
					}
					else
					{
						// Day of next month
						$out .= str_replace('{day}', $day - $total_days, $this->replacements['cal_cell_other']);
					}

					$out .= $this->replacements['cal_cell_end_other'];
				}
				else
				{
					// Blank cells
					$out .= $this->replacements['cal_cell_start'].$this->replacements['cal_cell_blank'].$this->replacements['cal_cell_end'];
				}

				$day++;
			}

			$out .= "\n".$this->replacements['cal_row_end']."\n";
		}

		return $out .= "\n".$this->replacements['table_close'];
	}

		public function default_template()
	{
		return array(
			'table_open'				=> '<table border="0" cellpadding="4" cellspacing="0">',
			'heading_row_start'			=> '<tr>',
			'heading_previous_cell'		=> '<th><a href="{previous_url}">&lt;&lt;</a></th>',
			'heading_title_cell'		=> '<th colspan="{colspan}">{heading}</th>',
			'heading_next_cell'			=> '<th><a href="{next_url}">&gt;&gt;</a></th>',
			'heading_row_end'			=> '</tr>',
			'week_row_start'			=> '<tr>',
			'week_day_cell'				=> '<td>{week_day}</td>',
			'week_row_end'				=> '</tr>',
			'cal_row_start'				=> '<tr class="{weeks2} {thisweek}" data-first-date="{week_first_date}" onclick="setWData(this)">',
			'cal_cell_start'			=> '<td>',
			'cal_cell_start_today'		=> '<td>',
			'cal_cell_start_other'		=> '<td style="color: #666;">',
			'cal_cell_content'			=> '<a href="{content}">{day}</a>',
			'cal_cell_content_today'	=> '<a href="{content}"><strong>{day}</strong></a>',
			'cal_cell_no_content'		=> '{day}',
			'cal_cell_no_content_today'	=> '<strong>{day}</strong>',
			'cal_cell_blank'			=> '&nbsp;',
			'cal_cell_other'			=> '{day}',
			'cal_cell_end'				=> '</td>',
			'cal_cell_end_today'		=> '</td>',
			'cal_cell_end_other'		=> '</td>',
			'cal_row_end'				=> '</tr>',
			'table_close'				=> '</table>'
		);
	}

}

?>