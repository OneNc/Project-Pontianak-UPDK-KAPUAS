<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportReport implements FromView
{
    protected $information;
    protected $data;
    protected $view;
    public function __construct($information, $data, $view)
    {
        $this->data = $data;
        $this->information = $information;
        $this->view = $view;
    }

    public function view(): View
    {
        return view($this->view, [
            'info' => $this->information,
            'data' => $this->data
        ]);
    }
}
