@extends('admin.layout')

@section('content')

  <!-- Users -->

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 whitespace-nowrap">
          <tr>
            <th class="p-4 text-left text-sm font-medium text-white">
              ID
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Login
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Email
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Register date
            </th>
            <th class="p-4 text-left text-sm font-medium text-white">
              Actions
            </th>
        </thead>

        <tbody class="whitespace-nowrap">
            @foreach ($users as $user )

          <tr class="even:bg-blue-50">
            <td class="p-4 text-[15px] text-slate-900 font-medium">
              {{ $user->id }}
            </td>
            <td class="p-4 text-[15px] text-slate-600 font-medium">
              {{ $user->name }}
            </td>
            <td class="p-4 text-[15px] text-slate-600 font-medium">
              {{ $user->email }}
            </td>
            <td class="p-4 text-[15px] text-slate-600 font-medium">
              {{ $user->created_at->format('d/m/y') }}
            </td>
            
            <td class="p-4 flex text-[15px] text-slate-900 items-center font-medium gap-2">
                 <form method="POST" action="{{ route('admin.removeAdmin', $user->id) }}">
                  @csrf
                  @method('PUT')

                  <button type="submit" class="px-3 py-1 text-xs bg-slate-800 hover:bg-slate-900 font-medium text-white cursor-pointer">
                    Remove Admin
                  </button>
                </form>
            
            <form method="POST" action="{{ route('admin.makeAdmin', $user->id) }}">
                  @csrf
                  @method('PUT')

                  <button type="submit" class="px-3 py-1 text-xs bg-slate-800 hover:bg-slate-900 font-medium text-white cursor-pointer">
                    Make Admin
                  </button>
                </form>
                  <form method="POST" action="{{ route("admin.destroyUser", $user->id) }}">
                    @csrf
                    @method('DELETE')
                <div class="flex items-center">
                <button title="Delete" class="cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                    <path
                      d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                      data-original="#000000" />
                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                      data-original="#000000" />
                  </svg>
                </button>
              </div>
                  </form>
            </td>
          </tr>
              @endforeach

        </tbody>
      </table>
      {{ $users->links() }}
    </div>

@endsection