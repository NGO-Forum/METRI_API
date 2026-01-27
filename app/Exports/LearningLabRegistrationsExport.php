<?php

namespace App\Exports;

use App\Models\LearningLabRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LearningLabRegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $labId;

    public function __construct($labId)
    {
        $this->labId = $labId;
    }

    public function collection()
    {
        return LearningLabRegistration::where(
            'learning_lab_id',
            $this->labId
        )->get();
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Organization',
            'Role',
            'Email',
            'Phone',
            'Province',
            'NGOF Member',
            'NGO Name',
            'Payment %',
            'Special Needs',
        ];
    }

    public function map($r): array
    {
        return [
            $r->full_name,
            $r->organization,
            $r->role_position,
            $r->email,
            $r->phone,
            $r->province,
            $r->is_ngof_member ? 'Yes' : 'No',
            $r->ngo_name,
            $r->payment_percentage,
            $r->special_needs,
        ];
    }
}
