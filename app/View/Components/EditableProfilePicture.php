<?php
namespace App\View\Components;

use Illuminate\View\Component;

class EditableProfilePicture extends Component
{
    public $imageUrl;
    public $label;

    public function __construct($imageUrl,$label)
    {
        $this->label = $label;
        $this->imageUrl = $imageUrl;
    }

    public function render()
    {
        return view('components.editable-profile-picture');
    }
}
