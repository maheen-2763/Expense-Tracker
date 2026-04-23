<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public $action;
    public $placeholder;

    public function __construct(
        $action,
        $placeholder = 'Search...'
    ) {
        $this->action = $action;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.search');
    }
}