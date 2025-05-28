<?php

namespace App\Exports;

use App\Models\Position;
use App\Models\Candidate;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CandidatesExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    

    protected $sortBy;

    public function __construct($sortBy)
    {
        $this->sortBy = $sortBy;

    }

    public function collection()
    {
        $query = Candidate::query();


        if ($this->sortBy === 'President') {
            $query->where('position_id', 1);
        } elseif ($this->sortBy === 'Vice President') {
            $query->where('position_id', 2);
        } elseif ($this->sortBy === 'Secretary') {
            $query->where('position_id', 3);
        } elseif ($this->sortBy === 'Assistant Secretary') {
            $query->where('position_id', 4);
        } elseif ($this->sortBy === 'Treasurer') {
            $query->where('position_id', 5);
        }

        return $query->select('position_id', 'first_name', 'last_name', 'other_name', 'gender', 'email', 'phone_number', 'created_by', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['Position', 'First Name', 'Last Name', 'Other Name', 'Gender', 'Email', 'Phone Number', 'Created By', 'Date Registered'];
    
    }

    public function title(): string
    {
        return 'Sorted Candidates';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', 'Candidate Export - ' . $this->sortBy);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            },
        ];
    }




    
}
