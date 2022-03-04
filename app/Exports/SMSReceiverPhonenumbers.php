<?php

namespace App\Exports;

use App\Models\SMS\ReceiversModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SMSReceiverPhonenumbers implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public ReceiversModel $receivers;
    public function __construct()
    {
        $this->receivers = $receivers ?? new ReceiversModel();
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->receivers->ExportToExcel();
    }

    public function headings(): array
	{
		return [
            'Name',
			'Phone Number',
            'Category'
		];
	}
    public function map($bulk): array
	{
		return [
            $bulk->name,
			$bulk->phone,
			$bulk->cate_name,
		];
	}

    public function registerEvents(): array
	{
		return [
			AfterSheet::class => function (AfterSheet $event) {
				$cellRange = 'A1:W1';
				$
				$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->setName('Arial')
					->applyFromArray(array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => 'FFFF0000'),
							'borders' => [
								'outline' => [
									'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
									'color' => ['argb' => 'FFFF0000'],
								],
				])));
			},
		];
	}
}
