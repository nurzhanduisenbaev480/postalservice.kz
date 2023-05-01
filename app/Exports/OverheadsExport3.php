<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\City;
use App\Models\Overhead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OverheadsExport3 implements FromCollection, WithColumnFormatting, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents,WithHeadings
{
    
    private $overheads1;
	private $overheads2;
    public function __construct($overheads = null)
    {
        $this->overheads2 = $overheads;
    }
    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
	public function columnFormats(): array
	{
		return [
			'A' => NumberFormat::FORMAT_NUMBER,
			//'F' => NumberFormat::FORMAT_NUMBER,
		];
	}
    
    public function columnWidths(): array
    {
        // TODO: Implement columnWidths() method.
        return [
            'A' => 20
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
		$this->overheads1 = $this->overheads2;
		//dd($this->overheads1);
        return $this->overheads2;
    }


    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                for($i=1;$i<=$this->overheads1->count()+1; $i++){
                    $event->sheet->getDelegate()->getStyle('A'.$i.':P'.$i)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                }
            },
        ];
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
			'Дата забора',
            'Код',
            'Отправитель',
            'Компания',
            'Город',
            'Адрес',
            'Телефон',
            'Получатель',
            'Компания',
            'Город',
            'Адрес',
            'Телефон',
            'Тип',
            'Срочность',
            'Оплата',
            'Способ оплаты',
            'Примечание',
			'Вес'
        ];
    }
}
