<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    // tambahkan 2 properti ini dan masukan di constructor
    public $type;
    public $message;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
