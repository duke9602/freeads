@extends('admin.layout')

@section('content')

<div class="flex justify-between items-center mb6">
    <h2 class="text-lg font-semibold">New Category</h2>
    <a href="{{ route('categories.index') }}" class="text-white bg-teal-700 px-4 py-2 rounded text-sm">
        Back</a>
  </div>

  <div>
    <form class="space-y-6 max-w-md mx-auto p-4" method="POST" action="{{ route('categories.store') }}">
      @csrf
    <div class="flex items-center">
        <label class="text-slate-400 font-medium w-36 text-sm">Category name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Category name"
          class="px-2 py-2 w-full border-b border-gray-300 focus:border-slate-900 outline-none text-sm bg-white" />
         <!-- si le nom ne respecte pas les restrictions données dans le controller une erreur sera affiché -->
          @error('name')
          <p class="text-red">{{ $message }}</p>
          @enderror
    </div>

      <button type="submit"
        class="!mt-12 px-6 py-2 w-full bg-slate-800 hover:bg-slate-900 text-sm font-medium text-white mx-auto block cursor-pointer">Create</button>
    </form>
  </div>

@endsection