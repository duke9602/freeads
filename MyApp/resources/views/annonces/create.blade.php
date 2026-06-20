@extends('annonces.layout')

@section('content')

         <h1>Create an ad</h1>

<form method="POST" action="{{ route('annonces.store') }}" class="space-y-4" 
enctype="multipart/form-data">

           @csrf
      
         
      <div>
      <label class="mb-2 text-sm text-slate-900 font-medium block">title</label>
      <div class="relative flex items-center">
        <input type="name" name="title" value="{{ old('title') }}"
          class="px-4 py-3 pr-10 bg-[#f0f1f2] focus:bg-transparent w-full text-sm border border-gray-200 focus:border-black outline-0 rounded-md transition-all" />
             @error('title')
             <p class="text-red-500">{{ $message }}</p>
             @enderror
        
      </div>
      </div>


      <div>
      <label class="mb-2 text-sm text-slate-900 font-medium block">Description</label>
      <div class="relative flex items-center">
        <textarea name="description" rows="5"
          class="px-4 py-3 pr-10 bg-[#f0f1f2] focus:bg-transparent w-full text-sm border border-gray-200 focus:border-black outline-0 rounded-md transition-all" >
            {{ old('description') }}
          </textarea>

          @error('description')
          <p class="text-red-500">{{ $message }}</p>
          @enderror
        
      </div>
      </div>

      <div>
      <label class="mb-2 text-sm text-slate-900 font-medium block">Price</label>
      <div class="relative flex items-center">
        <input type="name" name="price" value="{{ old('price') }}"
          class="px-4 py-3 pr-10 bg-[#f0f1f2] focus:bg-transparent w-full text-sm border border-gray-200 focus:border-black outline-0 rounded-md transition-all" />
             @error('price')
             <p class="text-red-500">{{ $message }}</p>
             @enderror
        
      </div>
      </div>


       <div>
      <label class="mb-2 text-sm text-slate-900 font-medium block">Location</label>
      <div class="relative flex items-center">
        <input type="name" name="location" value="{{ old('location') }}"
          class="px-4 py-3 pr-10 bg-[#f0f1f2] focus:bg-transparent w-full text-sm border border-gray-200 focus:border-black outline-0 rounded-md transition-all" />
             @error('location')
             <p class="text-red-500">{{ $message }}</p>
             @enderror
        
      </div>
      </div>

 <div>
      <label class="mb-2 text-sm text-slate-900 font-medium block">Condition</label>
      <div class="relative flex items-center">
        <select type="name" name="condition"
          class="px-4 py-3 pr-10 bg-[#f0f1f2] focus:bg-transparent w-full text-sm border border-gray-200 focus:border-black outline-0 rounded-md transition-all">
           
          <option value="nouveau" {{ old('condition')=='nouveau' ? 'selected': '' }}>Nouveau</option>
          <option value="quasi-neuf" {{ old('condition')=='quasi-neuf' ? 'selected': '' }}>quasi-neuf</option>
           <option value="utilise"  {{ old('condition')=='utilise' ? 'selected': '' }} >utilisé</option>
         </select>
          @error('condition')
             <p class="text-red-500">{{ $message }}</p>
             @enderror
        
      </div>
      </div>


      <div>
      <label class="mb-2 text-sm text-slate-900 font-medium block">Category</label>
      <div class="relative flex items-center">
        <select  name="category_id"
          class="px-4 py-3 pr-10 bg-[#f0f1f2] focus:bg-transparent w-full text-sm border border-gray-200 focus:border-black outline-0 rounded-md transition-all">
           
          <option value="">Choose a category</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id')== $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
          
          @endforeach   
           </select>

          @error('category_id')
             <p class="text-red-500">{{ $message }}</p>
             @enderror
        
      </div>
      </div>

      <div>
      <label class="mb-2 text-sm text-slate-900 font-medium block">Photos</label>
      <div class="relative flex items-center">
        <input type="file" name="photos[]" multiple accept="image/*"
          class="px-4 py-3 pr-10 bg-[#f0f1f2] focus:bg-transparent w-full text-sm border border-gray-200 focus:border-black outline-0 rounded-md transition-all" />
            
          @error('photos')
             <p class="text-red-500">{{ $message }}</p>
             @enderror
        
      </div>
      </div>


      <button type="submit"
        class="px-5 py-2.5 w-full cursor-pointer !mt-4 text-[15px] font-medium bg-black hover:bg-[#111] text-white rounded-md">
        Published ad
    </button>
    </form>
    

@endsection