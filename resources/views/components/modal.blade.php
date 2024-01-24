@props(['name'])
<div 
x-data="{show : false , name:'{{$name}}'}" {{-- $name getting name of the modal to open the correct model --}}
x-show="show" 
x-on:open-modal.window = " show = ($event.detail.name === name)" {{-- if name matches make show = true otherwise false --}}
x-on:close-modal.window = "show = false"
x-on:keydown.escape.window = "show = false" 
x-transition
class="h-screen w-screen flex absolute inset-0">
    <div class="m-auto bg-white z-10  min-w-64 rounded px-3 py-2">
        <div class="flex justify-between mb-4">
            <h1>Delete Todo</h1>
        <button x-on:click="$dispatch('close-modal')" >x</button>
        </div>
        <br>{{$body}}<br>
        <br>{{$todoId}}<br>
        <button x-on:click="$dispatch('close-modal')" wire:click="deleteConfirm()" class="mt-3 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Delete</button>
        <button  x-on:click="$dispatch('close-modal')"
                class="mt-3 px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Cancel</button>
    </div>
    <div x-on:click="show = false" class="bg-gray-200 h-screen w-screen fixed t-0 opacity-50"></div>  {{-- if clicked outside modal(BG) close modal --}}
</div>