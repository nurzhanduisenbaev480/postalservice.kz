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

class Overheads2Export implements FromCollection, WithColumnFormatting, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents,WithHeadings
{
    private $from_company;
    private $from_date;
    private $to_date;
    private $overheads1;
    public function __construct($from_company = '', $from_date = '', $to_date = '')
    {
        $this->from_company = $from_company;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
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
            'F' => NumberFormat::FORMAT_NUMBER,
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
        if (strlen($this->from_company) == 0){
            $overheads = Overhead::select(
                'overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
                'to_name', 'to_company', 'to_city', 'to_address', 'to_phone',
                'type', 'speed', 'payment', 'payment_type', 'description')
                ->whereBetween('created_at', [$this->from_date, $this->to_date])
                ->orderBy('id', 'DESC')
                ->get();
            foreach ($overheads as $overhead){
                if(!is_null(City::find($overhead->from_city))){
					$overhead->from_city = City::find($overhead->from_city)->city_name;
				}else{
					$overhead->from_city = 'Не указан';
				}
				
				if(!is_null(City::find($overhead->to_city))){
					$overhead->to_city = City::find($overhead->to_city)->city_name;
				}else{
					$overhead->to_city = 'Не указан';
				}
				if(is_null($overhead->to_company) || strlen($overhead->to_company) < 1){
					$overhead->to_company = '';
				}
				if(is_null($overhead->from_company) || strlen($overhead->from_company) < 1){
					$overhead->from_company = '';
				}
            }
        }else{
            $overheads = Overhead::select(
                'overhead_code', 'from_name', 'from_company', 'from_city', 'from_address', 'from_phone',
                'to_name', 'to_company', 'to_city', 'to_address', 'to_phone',
                'type', 'speed', 'payment', 'payment_type', 'description'
            )
                ->where('from_name', "like", "%".$this->from_company."%")
                ->whereBetween('created_at', [$this->from_date, $this->to_date])
                ->orderBy('id', 'DESC')
                ->get();
            //dd($overheads);
            foreach ($overheads as $overhead){
                if(!is_null(City::find($overhead->from_city))){
					$overhead->from_city = City::find($overhead->from_city)->city_name;
				}else{
					$overhead->from_city = 'Не указан';
				}
				
				if(!is_null(City::find($overhead->to_city))){
					$overhead->to_city = City::find($overhead->to_city)->city_name;
				}else{
					$overhead->to_city = 'Не указан';
				}
				if(is_null($overhead->to_company) || strlen($overhead->to_company) < 1){
					$overhead->to_company = '';
				}
				if(is_null($overhead->from_company) || strlen($overhead->from_company) < 1){
					$overhead->from_company = '';
				}
            }
        }
        $this->overheads1 = $overheads;
		//dd($this->overheads1);
        return $overheads;
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
        ];
    }
}
