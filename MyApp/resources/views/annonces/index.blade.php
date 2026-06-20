
@extends('annonces.layout')
   
  
@section('content')
     <!-- bare de recherche-->
           <form method="GET" action="{{ route('annonces.index') }}">
            <div class="max-w-md mx-auto relative mt-6">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search adds" 
                    class="w-full px-4 py-3 rounded-full text-gray-800 focus:outline-none"
                >
                <button class="absolute right-2 top-2 bg-yellow-500 text-black px-4 py-1 rounded-full">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            </form>
        </div>
    </section>
    <section class="container mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row gap-6">
    <h4 class="text-gray-500 text-xs uppercase font-semibold">Filter by</h4>
          <form method="GET" action="{{ route('annonces.index') }}">
    <select name="category_id" class="w-full border-b border-gray-300 pb-2 bg-white appearance-none pr-10 text-sm">
        <option>All categories</option>

        @foreach ($categories as $category)

         <option value="{{ $category->id }}">{{ $category->name }}</option>

         @endforeach
    </select>

    <select name="location" class="w-full border-b border-gray-300 pb-2 bg-white appearance-none pr-10 text-sm">
        <option>all location</option>

        @foreach ($locations as $location )

         <option value="{{ $location }}">{{ $location }}</option>
        
        @endforeach
    </select>

    
        <div class="w-full  bg-white  p-4 space-y-2">
        <h4 class=""> Price Range</h4>
        <div class="flex justify-between text-gray">
            <span>$<span id="minValue">0</span></span>
            <span>$<span id="maxValue">1000</span></span>
        </div>

        <!-- pour que laravel puisse lire donnees envoyées -->
         <input type="hidden" name="min_price" id="minPrice" value="0">
          <input type="hidden" name="max_price" id="maxPrice" value="1000">

         <div class="flex">
        <input type="range" id="minRange" min="0" max="1000" value="0" class="w-full cursor-pointer"
        oninput="document.getElementById('minValue').textContent = this.value"
        oninput="document.getElementById('minPrice').value = this.value"
        
        >
        
        <input type="range" id="maxRange" min="0" max="1000" value="1000" class="w-full cursor-pointer"
        oninput="document.getElementById('maxValue').textContent = this.value"
        oninput="document.getElementById('maxPrice').value = this.value"
        >
    </div>
      <button type="submit" class="px-3 py-1 text-xm bg-slate-800 hover:bg-slate-900 font-medium text-white cursor-pointer">
                    Filter
                  </button>
</form>
    </div>
    </section>

    <!-- Featured Listings -->

        <section class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8 text-center">Featured Listings</h2>
        <div class="grid grid-cols-1 gap-6">

            <!-- Movie Card 1 -->
             @foreach ($annonces as $annonce )
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow flex flex-col md:flex-row">
            
            @if ($annonce->photos->count() > 0)
            <img class="h-48" src="{{ asset('storage/' . $annonce->photos->first()->path) }}" alt="{{ $annonce->title }}"
            class="w-full md:w-1/3 h-auto object-cover">
            
             @else
            <img src="https://via.placeholder.com/300x450" alt="no image" class="w-full md:w-1/3 h-auto object-cover">
               
              @endif
            <div class="p-4 flex-1">
                    <h3 class="font-bold text-lg mb-1">{{ $annonce->title }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $annonce->category->name }}</p>
                    <p class="text-gray-600 text-sm mb-2">{{ $annonce->location }}</p>
                    <p class="text-gray-600 text-sm mb-2">published by {{ $annonce->user->name }}</p>
                   
                    <div class="flex justify-between items-center mt-auto">
                        <span class="font-bold">{{ $annonce->price }}</span>
                       <a href="{{ route('annonces.show', $annonce->id) }}">
                        <button class="bg-black text-white px-3 py-1 rounded-md text-sm ">
                            See More
                        </button>
                        </a>
                    </div>
                </div>
            </div>
             @endforeach


              {{ $annonces->links() }}
              
    <!-- Footer -->
    
@endsection
    
