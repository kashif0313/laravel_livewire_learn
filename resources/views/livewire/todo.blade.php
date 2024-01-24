<div class="px-4 py-5 flex flex-col"  >
    <div wire:offline class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Warning alert!</span> No internet Connection .
        </div>
      </div>
    @if ($selectedTodo)
        <x-modal name="delete">
             {{-- sending data to model in body variable --}}
        <x-slot:body>
            <span>{{$selectedTodo->name}}</span>
        </x-slot:body>
        {{-- sending data to model in todoID variable --}}
        <x-slot:todoId>
            <span>{{$selectedTodo->id}}</span>
        </x-slot:todoId>
    </x-modal>
    @endif
    
    <div class="flex   justify-center  ">
        <div class="flex flex-col min-w-80">
        
       {{-- live will send request as soon as a key is pressed to search and debounce is used to make delay in request  --}}
            <h1>Create new ToDo</h1>
   
         <form action="">
        <input type="name" class="px-3 py-2 my-2 rounded bg-gray-200 block w-full" placeholder="name" wire:model='name'>
            @error('name')
            <span class="text-red-500 sm-text">{{$message}}</span>
            @enderror
            <textarea type="text" class="px-3 py-2 my-2 rounded bg-gray-200 w-full block" rows="4" placeholder="Details" wire:model='details'>
            </textarea>
            @error('details')
            <span class="text-red-500 sm-text">{{$message}}</span>
            @enderror
        <button class="px-5 py-2 my-2 rounded bg-blue-600 text-white block" wire:click.prevent='create' >Submit</button>
   </form>
   <input wire:model.live.debounce.500ms='search' type="search" class="px-3 py-2 my-2 rounded bg-gray-200 block" name="search" placeholder="search">
   @if (session('success'))
        <span class="bg-green-500 text-white px-3 py-2 my-2">{{session('success')}}</span>        
    @endif
    <div class="flex justify-between ">
        <button class="px-5 py-2 my-2 rounded bg-blue-600 text-white " wire:click.prevent='allTasks' >All</button>
    <button class="px-5 py-2 my-2 rounded bg-blue-600 text-white " wire:click.prevent='compTasks' >Compleated</button>
    <button class="px-5 py-2 my-2 rounded bg-blue-600 text-white " wire:click.prevent='notCompTasks' >Not compleated</button>
    </div>
    @if (count($todos) == "0")
        <span>No result found</span>
    @else
    @foreach ($todos as $todo)
    @include('livewire.includes.todo_card')
          
      @endforeach
        
    @endif
 
        </div>
   
   </div>
  
    {{$todos->links()}}
</div>
  

  