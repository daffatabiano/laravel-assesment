<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserInfo extends Component
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function render(): View|Closure|string
    {
        return view('components.user-info');
    }
}
