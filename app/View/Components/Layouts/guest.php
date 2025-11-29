<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class guest extends Component
{

    public function render(): View|Closure|string
    {
        return view('layouts.guest');
    }
}
