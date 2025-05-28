<?php 

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $sortBy;

    public function __construct($sortBy)
    {
        $this->sortBy = $sortBy;
    }

    public function collection()
    {
        $query = User::query();

        if ($this->sortBy === 'Voted user') {
            $query->where('vote', true);
        } elseif ($this->sortBy === 'Unvote user') {
            $query->where('vote', false);
        }

        return $query->select('first_name', 'last_name', 'other_name', 'gender', 'email', 'phone_number', 'vote', 'created_by', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['First Name', 'Last Name', 'Other Name', 'Gender', 'Email', 'Phone Number', 'Vote', 'Created By', 'Date Registered'];
    
    }

    public function title(): string
    {
        return 'Sorted Users';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->setCellValue('A1', 'User Export - ' . $this->sortBy);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            },
        ];
    }




}

