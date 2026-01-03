<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Reports extends Component
{

    public $todayRevenue;
    public $paidCount;
    public $pendingCount;
    /**
     * Create a new component instance.
     */
    public function __construct($todayRevenue, $paidCount, $pendingCount)
    {
          $this->todayRevenue = $todayRevenue;
        $this->paidCount = $paidCount;
        $this->pendingCount = $pendingCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reports');
    }
}
