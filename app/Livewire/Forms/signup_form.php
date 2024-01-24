<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Form;

class signup_form extends Form
{
    //rules to validate data of the signup process
    #[Title('Signup')]

    #[Rule('required|min:5|max:50')]
    public $name;

    #[Rule('required')]
    public $email;

    #[Rule('required|min:5')]
    public $password;

    

}
