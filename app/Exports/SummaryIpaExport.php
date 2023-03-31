<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SummaryIpaExport implements FromView
{
    private $movings;
    private $date;

    public function __construct($movings, $date)
    {
        $this->movings = $movings;
        $this->date = $date;
    }

    public function view(): View
    {
        $ipas = $this->movings;
        $date = $this->date;

        return view('reports.summary_ipa.export', compact('ipas', 'date'));
    }
}
