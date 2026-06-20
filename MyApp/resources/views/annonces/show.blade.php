@extends('annonces.layout')

@section('content')

    <!-- show view -->

 <div class="bg-gray-100">
  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
     
    <!-- Product Images -->
      <div class="w-full md:w-1/2 px-4 mb-8">

      @auth

      @if (auth()->user()->id == $annonce->user_id)
      <a href="{{ route('annonces.edit', $annonce->id) }}" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600">
        Edit
      </a>
      
      @endif

      @endauth
       
      @if($annonce->photos->count() > 0)
      
      <img src="{{ asset('storage/' . $annonce->photos->first()->path) }}" alt="{{ $annonce->title }}"
                    class="w-full h-auto rounded-lg shadow-md mb-4" id="mainImage">
        <div class="flex gap-4 py-4 justify-center overflow-x-auto">
          
        @else
          <img src="https://via.placeholder.com/300x450" alt="Noimage"
                        class="w-full md:w-1/3 h-auto object-cover">

        @endif

        @if($annonce->photos->count() > 1)

        <div class="flex gap-4 py-4 justify-center overflow-x-auto">

             @foreach($annonce->photos as $photo)
          <img src="{{ asset('storage/' . $photo->path) }}" alt="photo"
                        class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                        onclick="changeImage('{{ asset('storage/' . $photo->path) }}')">

             @endforeach
            </div>
            @endif
           
         
        </div>
      </div>

      <!-- Product Details -->
      <div class="w-full md:w-1/2 px-4">
        <h2 class="text-3xl font-bold mb-2">{{ $annonce->title }}</h2>
         <p class="text-gray-600 text-sm mb-2">published by {{ $annonce->user->name }}</p>

        <div class="mb-4">
          <span class="text-2xl font-bold text-green-600">{{ $annonce->price }} $</span>
        </div>
       
        <div class="mb-4">
          <span class="text-2xl font-bold text-green-600">Condition: {{ $annonce->condition }}</span>
        </div>

          <p class="text-gray-700 mb-6">{{ $annonce->description }}</p>


    
        
        </div>
        
      </div>
    </div>
    
   <a href="{{ route('annonces.index') }}" 
   class="inline_block mt-4 px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-00">
 Back
</a> 
    
  </div>

  <script>
    function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }
  </script>
</div>

@endsection