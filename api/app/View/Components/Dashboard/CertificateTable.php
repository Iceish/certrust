<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CertificateTable extends Component
{
    public $certificates;

    /**
     * Create a new component instance.
     */
    public function __construct($certificates)
    {
        $this->certificates = $certificates;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.certificate-table');
    }
}
