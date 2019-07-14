<?php

namespace App\Http\View\Composers;

use App\User;
use Illuminate\View\View;

class SidebarComposer{

    public function __construct()
    {
        $this->users = User::all();
    }

    public function compose(View $view)
    {
        $view->with('users', $this->users);
    }

}

 ?>
