<?php

namespace Wings;

final class Calendar
{
	final public static function getMonthByDate($date)
	{
		$dateNow = \DateTime::createFromFormat('Y-m-d', $date);
		
		$daysInMonth = $dateNow->format('t');
		
		$firstDay = \DateTime::createFromFormat('Y-m-d', $dateNow->format('Y-m') . '-01');
		$lastDay = \DateTime::createFromFormat('Y-m-d', $dateNow->format('Y-m') . '-' . $daysInMonth);
		
		$startDay = clone $firstDay;
		$startDay->sub(new \DateInterval('P' . ($startDay->format('N') - 1) . 'D'));
		$endDay = clone $lastDay;
		$endDay->add(new \DateInterval('P' . (8 - $endDay->format('N')) . 'D'));
		
		$period = new \DatePeriod($startDay, new \DateInterval('P1D'), $endDay);
		
		$calendar = [];
		
		foreach ($period as $key => $date)
		{
			$active = true;
			if ($date < $firstDay || $date > $lastDay) $active = false;
			
			$calendar[$date->format('Y-m-d')] = [
				'key'			=> $key,
				'active'		=> $active,
				'date'			=> $date->format('Y-m-d'),
				'year'			=> $date->format('Y'),
				'month'			=> $date->format('m'),
				'monthWithZero'	=> $date->format('n'),
				'day'			=> $date->format('j'),
				'dayWithZero'	=> $date->format('d'),
				'dayOfWeek'		=> $date->format('N')
			];
		}
		
		return $calendar;
	}
}