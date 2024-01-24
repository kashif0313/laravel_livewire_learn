<?php

namespace App\Livewire;

use App\Models\todo as ModelsTodo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;



class Todo extends Component
{

    
    #[Title('Todo Task')]    //overwriting title of website page to allow differnt names according to pages
    #[Validate('required|min:3|max:50')] //providing rules to the below $name variable
    public $name="";
    #[Validate('required|min:3')] //providing rules to the below $name variable
    public $details="";

    public function create() //creating a new todo after validating data
    {
         $this->validateOnly('name');
         $this->validateOnly('details');
        ModelsTodo::create([
            'name'=> $this->name,
            'details'=> $this->details
        ]);
        $this->reset(['name','details']);
        session()->flash('success','Todo Saved :)');
    }

    public ModelsTodo $selectedTodo; //opening model to view the confirmation message to delete todo
    public $todoDeleteID = "";
    public function deleteTodo(ModelsTodo $todo)
    {
        $this->selectedTodo = $todo;
        $this->todoDeleteID = $todo->id;
        $this->dispatch('open-modal' ,name:'delete'); //calling alpinejs function to open the modal 
    }
   
    public function deleteConfirm()
    {
        //ddd($this->todoDeleteID);
        $this->delete($this->todoDeleteID);
    }
    public function delete($todoID)   //deleting the todo
    {
        //ddd($todoID);
       ModelsTodo::find($todoID)->delete();
    }
    
    public $editingID="";   //variable to save the id of the specific todo that is being edited
    #[Validate('required|min:3|max:50')]
    public $editedName="";  //variable to populate input fieldwith old name that is being edited

    public function edit($todoID)
    {   
        $this->editingID = $todoID;
        $this->editedName = ModelsTodo::find($todoID)->name;
    }
    

    public function update()   //updating the todo with new name 
    {
        $this->validateOnly('editedName');
        ModelsTodo::find($this->editingID)->update([
            'name'=> $this->editedName
        ]);
        $this->reset(['editingID']); 
    }

    public function toggle($checkID) //updating the checked state of checkbox true or false in db  default is false
    {
        $todo = ModelsTodo::find($checkID);
        
        if($todo->compleated == false)
        {
             $this->dispatch(
            'toggleEvent',
            type:'success',
            title:'Todo Completed',
            text:'Todo is marked as compleated',
            position:'center',
            );
        }
        else
        {
            $this->dispatch(
           'toggleEvent',
           type:'warning',
           title:'Todo UnChecked',
           text:'Todo is marked as not compleated',
           position:'center',
           );
       }
       $todo->compleated = !$todo->compleated;
      
        //ddd($todo);
        $todo->save();
        
    }

    public function cancel() //cancel the editing process of todo 
    {
        $this->reset(['editingID']); 
        
    }

    public $filter;

    #[Url(as : 's' ,history:true )] //sends search variable to url with data 
                                    //as replaces name with new name in url 
                                    //history is used to save url query in brouser histroy so page didnt have to reload when user click back or forward 
    public $search; //getting the input of the search field
    // public function render()
    // {
    //     return view('livewire.todo',['todos'=> ModelsTodo::latest()->when($this->filter !== '' ,function($query){
    //         $query->where('compleated','like',true);
    //     })->when($this->filter !== '' ,function($query){
    //         $query->where('compleated','like',true);
    //     })->where('name','like',"%{$this->search}%")->paginate(5)]);
    // }

    public function render()
    {
        return view('livewire.todo',['todos'=> ModelsTodo::latest()->when($this->filter == 'complete' ,function($query){
            $query->where('compleated','like',true);
        })->when($this->filter == 'notComplete' ,function($query){
            $query->where('compleated','like',false);
        })->where('name','like',"%{$this->search}%")->paginate(5)]);
    }

    public function notCompTasks()
    {
        $this->filter = 'notComplete';
    }
    public function allTasks()
    {
        $this->filter = '';
    }
    public function compTasks()
    {
        $this->filter = 'complete';
    }
  
}
