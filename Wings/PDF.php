<?php

namespace Wings;

require $_SERVER['DOCUMENT_ROOT'] . '/Modules/fpdf/fpdf.php';

class PDF extends \FPDF
{
	private		$prevFirstElement;
	protected	$isNewPageStart = 0;
	
	final public function drawRow($data, $columnWidth, $cellHeight, $cellAlign, $cellBorder)
	{
		list($rowHeight, $cell) = $this->getCellsHeight($data, $columnWidth, $cellHeight);
		
		$count = 0;
		
		foreach ($data as $key => $value)
		{
			if (!\is_array($value)) $count++;
		}
		
		$count--;
		
		$j = 0;
		
		$prevElement = null;
		
		foreach ($data as $key => $value)
		{
			if (!\is_array($value))
			{
				$border = $cellBorder[$j];
				
				$x = $this->GetX();
				$y = $this->GetY();
				
				if ($j !== 0 && $this->isNewPageStart === 1)
				{
					if (!is_null($prevElement) && $prevElement['isNewPageStart'] === 0)
					{
						$prevElement['border'] = str_replace('T', '', $prevElement['border']) . 'T';
						$this->SetXY($x - $prevElement['width'], $y);
						$this->Cell($prevElement['width'], $prevElement['height'], self::utf8To1251(''), $prevElement['border'], 0, 'C');
					}
					
					$border = str_replace('T', '', $border);
					$border .= 'T';
				}
				
				if ($j !== 0 && $y > (287 - ($cell[$key] * 2)))
				{
					if (!is_null($prevElement) && $j === 1)
					{
						$this->SetXY($x - $prevElement['width'], $y);
						$this->Cell($prevElement['width'], $prevElement['height'], self::utf8To1251(''), 'B', 0, 'C');
					}
					
					$border = str_replace('B', '', $border);
					$border .= 'B';
				}
				
				$prevElement =
				[
					'height'			=> ($cell[$key] > $cellHeight) ? $cellHeight : $rowHeight,
					'width'				=> $columnWidth[$j],
					'border'			=> $border,
					'isNewPageStart'	=> $this->isNewPageStart
				];
				
				if ($j === 0) $this->prevFirstElement = $prevElement;
				
				if ($j === $count) $border .= 'R';
					
				if ($cell[$key] > $cellHeight)
				{
					$this->MultiCell($columnWidth[$j], $rowHeight / ($cell[$key] / $cellHeight), self::utf8To1251($value), $border, $cellAlign[$key]);
		
					if ($j !== $count) $this->SetXY(($x + $columnWidth[$j]), $y);
					else $this->SetXY(($x + $columnWidth[$j]), $y + $rowHeight - $cellHeight);
				}
				else
				{
					$this->Cell($columnWidth[$j], $rowHeight, self::utf8To1251($value), $border, 0, $cellAlign[$key]);
				}
				
				$j++;
			}
		}
		
		$this->isNewPageStart = 0;
		
		$this->Ln();
	}
	
	final public function getCellHeight($width, $height, $text, $border)
	{
		$this->SetAutoPageBreak(false);
		
		$this->SetFillColor(255, 255, 255);
		
		$xBeforeCell = $this->GetX();
		$yBeforeCell = $this->GetY();
		
		$this->MultiCell($width, $height, self::utf8To1251($text), $border);
		
		$xCurrent = $xBeforeCell + $width;
		$yCurrent = $this->GetY();
		
		$this->Rect($xBeforeCell - 2, $yBeforeCell - 2, ($xCurrent - $xBeforeCell) + 4, ($yCurrent - $yBeforeCell) + 4, 'F');
		
		$this->SetXY($xBeforeCell, $yBeforeCell);
		
		$rowHeight = $yCurrent - $yBeforeCell;
		
		$this->SetAutoPageBreak(true, 10);
		
		return $rowHeight;
	}
	
	final public function getCellsHeight($data, $columnWidth, $cellHeight)
	{
		$rowHeight = $cellHeight;
		$j = 0;
		
		$x = $this->GetX();
		$y = $this->GetY();
		$cell = [];
		
		foreach ($data as $key => $value)
		{
			if (!\is_array($value))
			{
				$this->SetXY($x + 10, $y + 10);
					
				$cell[$key] = $this->getCellHeight($columnWidth[$j], $cellHeight, $value, 'LB');
					
				if ($cell[$key] > $rowHeight) $rowHeight = $cell[$key];
					
				$j++;
			}
		}
		
		$this->SetXY($x, $y);
		
		return [$rowHeight, $cell];
	}
	
	public function Header()
	{
		$this->isNewPageStart = 1;
	}
	
	final public static function utf8To1251($text)
	{
		return iconv('utf-8', 'cp1251', $text);
	}
}