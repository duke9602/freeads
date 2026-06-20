@extends('admin.layout')

@section('content')

  <div class="flex justify-between items-center mb6">
    <h2 class="text-lg font-semibold">Categories</h2>
    <a href="{{ route('categories.create') }}" class="text-white bg-teal-700 px-4 py-2 rounded text-sm">
        + New Category</a>
  </div>

 <div class="overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 whitespace-nowrap">
          <tr>
            <th class="p-4 text-left text-sm font-medium text-white">
              ID
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Name
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Actions
            </th>
          </tr>
        </thead>

        <tbody class="whitespace-nowrap">
            @foreach ($categories as $category )

          <tr class="even:bg-blue-50">
            <td class="p-4 text-[15px] text-slate-900 font-medium">
              {{ $category->id }}
            </td>
            <td class="p-4 text-[15px] text-slate-600 font-medium">
              {{ $category->name }}
            </td>
            
            <td class="p-4 text-[15px] text-slate-900 font-medium">
              <a href="{{ route('categories.edit', $category->id) }}"
              class="bg-blue-500 text-white px-2 py-1 rounded text-sm float-right ">
                  Edit</a>
                  <form method="POST" action="{{ route("categories.destroy", $category->id) }}">
                    @csrf
                    @method('DELETE')
                    <button title="Delete" class="cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                    <path
                      d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                      data-original="#000000" />
                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                      data-original="#000000" />
                  </svg>
                </button>
                  </form>
            </td>
          </tr>
              @endforeach

        </tbody>
      </table>
       {{ $categories->links() }}
    </div>

@endsection