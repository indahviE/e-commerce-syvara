    @props([
        // component bisa diisi beberapa nilai seperti :
        'title' => null,
        'deskripsi' => null,
        'columns' => [],
        'rows' => collect(),
        'createLabel' => null,
        'createUrl' => null,
        'update_page_route_name' => null,
        'delete_action_route_name' => null,
        'action_data' => false,
        'deleteAction' => false,
        'updateAction' => false,
        'searchPlaceholder' => 'Search...',
        'image_key' => null,
    ])

    <div>
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">{{ $title }}</h3>
                <p class="text-slate-500">{{ $deskripsi }}</p>
            </div>
            <div class="ml-3 flex gap-4 w-4/12">
                @if ($createUrl)
                    <a class="border-2 w-100px text-sm bg-white px-2 flex items-center justify-center py-1 font-semibold text-black shadow-[4px_4px_0_0] shadow-gray-300 border-gray-400 outline-gray-500 ring-gray-500 hover:translate-1 focus:outline-0"
                        href="{{ $createUrl }}">
                        {{ $createLabel ?? 'Create+' }}
                    </a>
                @endif
                <div class="w-full max-w-sm min-w-120px relative">
                    <form method="GET" class="relative">
                        <input
                            class="bg-white w-full pr-11 h-10 pl-3 py-2  placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="{{ $searchPlaceholder }}" name="s" />
                        <button class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="currentColor" class="w-8 h-8 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                </div>
            </div>


        </div>


    </div>

    <div
        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="p-4 border-b border-slate-300 bg-slate-50">
                        <p class="block text-sm font-normal leading-none text-slate-500">
                            #
                        </p>
                    </th>
                    @foreach ($columns as $data)
                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                {{ $data }}
                            </p>
                        </th>
                    @endforeach

                    @if ($image_key != null)
                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                            Foto
                            {{-- <img src="{{$image_key}}" alt=""> --}}
                        </th>
                    @endif

                    @if ($action_data == 'true')
                        <th class="p-4 border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500 text-end px-4">
                                Actions
                            </p>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 border-b border-slate-200">
                            {{ $loop->iteration }}
                        </td>
                        @foreach ($columns as $key => $label)
                            <td class="p-4 border-b border-slate-200">
                                {{ data_get($row, $key, '-') }}
                            </td>
                        @endforeach

                        @if ($image_key != null)
                            <th class="p-4 border-b border-slate-200 ">
                                <div class=" bg-center bg-cover w-20 h-20" alt=""
                                style="background-image: url('{{ data_get($row, $image_key) }}');"> </div>
                            </th>
                        @endif

                        @if ($action_data == 'true')
                            <td class="p-4 border-b border-slate-200 flex flex-nowrap justify-end gap-3">
                                @if ($updateAction == 'true')
                                    <a href="{{ route($update_page_route_name, $row->id) }}" type="button"
                                        class="flex items-center gap-2.5 border border-gray-500/30 px-3 py-1 text-sm text-gray-800 rounded bg-white hover:text-orange-500/70 hover:bg-pink-500/20 hover:border-pink-500/30 active:scale-95 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M18.58 2.944a2 2 0 0 0-2.828 0L14.107 4.59l5.303 5.303l1.645-1.644a2 2 0 0 0 0-2.829zm-.584 8.363l-5.303-5.303l-8.835 8.835l-1.076 6.38l6.38-1.077z" />
                                        </svg>
                                        Edit
                                    </a>
                                @endif

                                <form action="{{ route($delete_action_route_name, $row->id) }}" method="post">
                                    @csrf
                                    @if ($deleteAction == 'true')
                                        <button type="submit"
                                            class="flex items-center gap-2.5 border border-gray-500/30 px-3 py-1 text-sm text-gray-800 rounded bg-white hover:text-pink-500/70 hover:bg-pink-500/10 hover:border-pink-500/30 active:scale-95 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16">
                                                <path fill="currentColor"
                                                    d="M7 3h2a1 1 0 0 0-2 0M6 3a2 2 0 1 1 4 0h4a.5.5 0 0 1 0 1h-.564l-1.205 8.838A2.5 2.5 0 0 1 9.754 15H6.246a2.5 2.5 0 0 1-2.477-2.162L2.564 4H2a.5.5 0 0 1 0-1zm1 3.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0zM9.5 6a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 1 0v-5a.5.5 0 0 0-.5-.5" />
                                            </svg>
                                            Delete
                                        </button>
                                    @endif
                                </form>


                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="p-6 text-center text-gray-500">
                            Data kosong
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>


    {{-- // exampple call / use it.
    <x-tables-data
    title="Books terdaftar"
    deskripsi="Cari dan Manage data buku Kita."
    :columns="[
        'name' => 'Nama',
        'deskripsi' => 'Deskripsi',
        'category' => 'Category',
        'penerbit' => 'Penerbit',
        'tebal_buku' => 'Tebal Buku',
        'berat_buku' => 'Berat Buku',
        ]"
    :rows="$books" // kirim array of data ke component
    image_key="cover_book" // jika table ada image masukan key dalam column
    update_page_route_name="book_modify_view" // nama route aksi redirect modify page
    delete_action_route_name="book_delete" // nama route aksi delete book
    action_data="true" // data bisa di action (delet, modif)?
    deleteAction="true"
    updateAction="true"
    createUrl="{{ route('book_create_view') }}" // link ke halaman create book
    createLabel="Create+"

    /> --}}
