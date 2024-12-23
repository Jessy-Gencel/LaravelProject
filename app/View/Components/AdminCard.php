<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminCard extends Component
{
    public $icon;
    public $iconColor;
    public $title;
    public $description;
    public $route;
    public $buttonText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $iconColor, $title, $description, $route, $buttonText)
    {
        $this->icon = $icon;
        $this->iconColor = $iconColor;
        $this->title = $title;
        $this->description = $description;
        $this->route = $route;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin-card');
    }
}

