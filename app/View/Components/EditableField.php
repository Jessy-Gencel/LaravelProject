<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditableField extends Component
{
    public $label;
    public $value;
    public $name;
    public $type;
    public $validationType;
    public $editable;

    public function __construct($label, $value, $name, $type, $validationType = 'NONE', $editable = true)
    {
        $this->label = $label;
        $this->value = $value;
        $this->name = $name;
        $this->type = $type;
        $this->validationType = $validationType;
        $this->editable = $editable;
    }

    public function render()
    {
        return view('components.editable-field');
    }
}
