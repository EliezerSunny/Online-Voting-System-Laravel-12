<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VotesExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $sortBy;

    public function __construct($sortBy)
    {
        $this->sortBy = $sortBy;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->sortBy === 'Voted') {
            $query->where('vote', true);
        }

        return $query->select('first_name', 'last_name', 'other_name', 'gender', 'email', 'phone_number', 'vote', 'created_by', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['First Name', 'Last Name', 'Other Name', 'Gender', 'Email', 'Phone Number', 'Vote', 'Created By', 'Date Registered'];
    
    }

    public function title(): string
    {
        return 'Voted User';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', 'Results - ' . $this->sortBy);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            },
        ];
    }



    
}
