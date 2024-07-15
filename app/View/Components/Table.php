<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public $columns;
    public $id;
    public $ajaxUrl;
    
    public function __construct($columns = [], $id, $ajaxUrl)
    {
        $this->columns = $columns;
        $this->id = $id;
        $this->ajaxUrl = $ajaxUrl;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
