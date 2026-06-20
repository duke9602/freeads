@extends('admin.layout')

@section('content')

    <!-- annonces -->

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 whitespace-nowrap">
          <tr>
            <th class="p-4 text-left text-sm font-medium text-white">
              ID
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Title
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Price
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              User
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Category
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Date
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Actions
            </th>
          </tr>
        </thead>

        <tbody class="whitespace-nowrap">
            @foreach ($annonces as $annonce )

          <tr class="even:bg-blue-50">
            <td class="p-4 text-[15px] text-slate-900 font-medium">
              {{ $annonce->id }}
            </td>
            <td class="p-4 text-[15px] text-slate-600 font-medium">
              {{ $annonce->title }}
            </td>
            <td class="p-4 text-[15px] text-slate-600 font-medium">
              {{ $annonce->price }}$
            </td>
            <td class="p-4 text-[15px] text-slate-600 font-medium">
              {{ $annonce->user->name }}
            </td>
            <td class="p-4 text-[15px] text-slate-900 font-medium">
              {{ $annonce->category->name }}
            </td>
            <td class="p-4 text-[15px] text-slate-900 font-medium">
              {{ $annonce->create_at?->format('d/m/y') ?? 'N/A' }}
            </td>
            <td class="p-4 text-[15px] text-slate-900 font-medium">
              <a href="{{ route('annonces.show', $annonce->id) }}"
              class="bg-black-500 text-white px-2 py-1 rounded text-sm ">
                  Voir</a>
                  <form method="POST" action="{{ route("admin.destroyAnnonce", $annonce->id) }}">
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
       {{ $annonces->links() }}
    </div>

@endsection