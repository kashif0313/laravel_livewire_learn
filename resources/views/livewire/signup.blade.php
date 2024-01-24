<div class="px-4 py-5">
    @if (session('success'))
        <span>{{session('success')}}</span>        
    @endif
   
    <form wire:submit="newUser" enctype="multipart/form-data" class="max-w-sm mx-auto">
         {{-- signupForm.name is used to validate data in the form validate file which is signup_form defined in livewire folder --}}
         <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Your Name</label>
            <input type="name" id="name"  placeholder="name" wire:model='signupForm.name' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
          </div>
        @error('signupForm.name')
        <span class="text-red-500 sm-text">{{$message}}</span>
        @enderror

        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Your email</label>
            <input type="email" id="email"  placeholder="email" wire:model='signupForm.email' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
          </div>
        @error('signupForm.email')
        <span class="text-red-500 sm-text">{{$message}}</span>
        @enderror

        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Type Password</label>
            <input type="password" id="password"  placeholder="password" wire:model='signupForm.password' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
          </div>
        @error('signupForm.password')
            <span class="text-red-500 sm-text">{{$message}}</span>
        @enderror

        <label class="block mb-2 text-sm font-medium text-gray-900 " for="user_avatar">Upload file</label>
  <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 py-1 px-1" aria-describedby="user_avatar_help" accept="image/png, image/jpg" id="image" wire:model='images' multiple type="file">

        @error('signupForm.images')
            <span class="text-red-500 sm-text">{{$message}}</span>
        @enderror
        
       
        <div class="flex w-full space-x-3 my-1">
            @if ($images)
                @foreach ($images as $image)
                    <img class="w-20 h-20 rounded-2xl object-fill-cover" src="{{$image->temporaryUrl()}}" alt="">
                @endforeach
            @endif
        </div>
        <span wire:loading wire:target='image' class="text-sm text-green-800">Uploading...</span>
        <button class="px-3 py-2 my-2 rounded bg-blue-600 text-white block" >Submit</button>
        <span wire:loading class="text-sm text-green-300">Saving...</span>
    </form>

    @foreach ($users as $user)
        <h2>{{$user->name}}</h2>   
    @endforeach

    {{$users->links()}}
</div>
