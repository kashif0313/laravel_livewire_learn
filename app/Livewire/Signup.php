<?php

namespace App\Livewire;

use App\Livewire\Forms\signup_form;
use App\Models\images;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class Signup extends Component
{
    use WithFileUploads;
    
    public signup_form $signupForm;
    //form file to validate the data according tothe defined rules

    #[Rule(['images.*'=>'nullable|sometimes|image|max:1024'])]
    public $images;
    
    public function  newUser()
    {
        $validated = $this->signupForm->validate();
        //dd($this->signupForm->image);
       
        
        $user = User::create($validated);
       $userID = $user->id;
       isset($userID);
       {
            foreach ($this->images as $image)
            {
                $images_url = $image->store('uploads','public');
                images::create([
                    'url'=>$images_url,
                    'user_id'=> $userID
                 ]);
            }
       }
        
        

        $this->signupForm->reset();
        $this->images = [];
        request()->session()->flash('success','User Created Successfully');
    }

    public function render()
    {
        $users = User::paginate(12);
        return view('livewire.signup',[
            'users'=> $users
        ]);
    }
}
