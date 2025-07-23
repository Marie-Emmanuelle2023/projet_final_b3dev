<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDeSeance extends Model
{
    /** @use HasFactory<\Database\Factories\ReportDeSeanceFactory> */
    use HasFactory;

    protected $fillable = [
        'seance_reportee_id',
        'seance_report_id',
        'date'
    ];

    public function seanceReportee()
    {
        return $this->belongsTo(Seance::class, 'seance_reportee_id');
    }

    public function seanceReport()
    {
        return $this->belongsTo(Seance::class, 'seance_report_id');
    }
}
