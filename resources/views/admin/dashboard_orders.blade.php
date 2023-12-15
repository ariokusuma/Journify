@extends('admin.adminlayout.mainadmin')

@section('title', 'Daftar Pengguna')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Daftar Peminjam</title>
</head>

    <body >
    <div class="p-4 md:ml-64 h-auto pt-20">


        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
            <div class="mx-auto max-w-screen px-0">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <a href="{{ route('add_order') }}" class="flex items-center justify-center text-white bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
                            {{-- Table Header --}}
                            <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Nama Peminjam</th>
                                    <th scope="col" class="px-4 py-3">Barang</th>
                                    <th scope="col" class="px-4 py-3">Kategori</th>
                                    <th scope="col" class="px-4 py-3">Total Harga Sewa</th>
                                    <th scope="col" class="px-4 py-3">Durasi</th>
                                    <th scope="col" class="px-4 py-3">Sisa Waktu</th>
                                    <th scope="col" class="px-4 py-3">Bukti TF</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>

                            {{-- data --}}
                            <tbody>
                                @foreach ($AllUserData as $data)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $data->user->name }}</td>
                                    <td class="px-4 py-3">{{ $data->item->item_name }}</td>
                                    <td class="px-4 py-3">{{ $data->categories->category_name }}</td>
                                    <td class="px-4 py-3">Rp{{ $data->finalPrice }}</td>
                                    <td class="px-4 py-3">{{ $data->rentDuration }}</td>
                                    <td class="px-4 py-3">{{ $data->remainingTime }}</td>
                                    <td class="px-4 py-3">
                                        @if($data->payment_evidence)
                                        <img class="w-24 h-24" src="{{asset('bukti_transfer/' . $data->payment_evidence )}}" alt="evidence">
                                        @else
                                        <img class="w-24 h-24" src="{{ asset('storage/default_profile.png') }}" alt="default_pfp">
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($data->status == 1)
                                            <div class="">
                                                <p class="flex items-center text-center justify-center bg-red text-white rounded ">Belum Kirim Bukti</p>
                                            </div>
                                        @elseif($data->status == 0)
                                            <div class=" ">
                                                <p class="flex items-center justify-center bg-green-500 text-white rounded ">Disetujui</p>
                                            </div>
                                        @elseif($data->status == 2)
                                            <div class=" ">
                                                <p class="flex items-center  text-center justify-center bg-yellow-500 text-white rounded ">Bukti Terkirim - Menunggu Verifikasi</p>
                                            </div>
                                        @elseif($data->status == 3)
                                            <div class=" ">
                                                <p class="flex items-center  text-center justify-center bg-red text-gray-800 rounded ">Ditolak</p>
                                            </div>
                                        @elseif($data->status == 4)
                                            <div class=" ">
                                                <p class="flex items-center  text-center justify-center bg-red text-gray-800 rounded ">Meminta Pengembalian</p>
                                            </div>
                                        @elseif($data->status == 5)
                                            <div class=" ">
                                                <p class="flex items-center  text-center justify-center bg-green-500  text-gray-800 rounded ">Pengembalian Diterima</p>
                                            </div>
                                        @elseif($data->status == 6)
                                        <div class=" ">
                                            <p class="flex items-center  text-center justify-center bg-red text-white rounded "> Telat - Denda</p>
                                        </div>
                                        @endif
                                        {{-- {{ $data->status }} --}}
                                    </td>



                                    <td class="w-36">
                                        {{-- Start of Edit --}}
                                            {{-- Button Toggle --}}
                                            <div class="flex justify-center items-center pb-2">
                                                <button id="editItemData" data-modal-toggle="editItemData-{{ $data->id }}" class="w-[103px] bg-primary text-white inline-flex items-center hover:text-white border border-cyan hover:bg-turqoise focus:ring-4 focus:outline-none focus:ring-cyanoutline font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">
                                                    <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                                                    </svg>
                                                    Tinjau
                                                </button>
                                            </div>



                                            <!-- Pop-Up Edit -->
                                            <div id="editItemData-{{ $data->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                    {{-- Isi Modal Edit --}}
                                                    <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                                        <!-- Header Modal Edit -->
                                                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                            <h3 class="text-lg font-semibold text-gray-900">
                                                                Tinjau Data Penyewaan
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editItemData-{{ $data->id }}">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                <span class="sr-only">Tutup modal</span>
                                                            </button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form action="{{ route('update_item', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="pb-8 grid gap-4 mb-4 sm:grid-cols-3">
                                                                {{-- Nama Barang --}}
                                                                <div>
                                                                    <label for="item_name" class="block mb-2 text-base text-start font-medium text-gray-900 ">Nama Penyewa</label>
                                                                    <input value="{{ $data->user->name }}" required type="text" name="item_name" id="item_name" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="BMX PRO Series">
                                                                </div>
                                                                {{-- No Hp --}}
                                                                <div>
                                                                    <label for="item_name" class="block mb-2 text-base text-start font-medium text-gray-900 ">No Hp Penyewa</label>
                                                                    <input value="{{ $data->user->nohp }}" required type="text" name="item_name" id="item_name" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="BMX PRO Series" >
                                                                </div>
                                                                {{-- Email --}}
                                                                <div>
                                                                    <label for="item_name" class="block mb-2 text-base text-start font-medium text-gray-900 ">Email Penyewa</label>
                                                                    <input value="{{ $data->user->email }}" required type="text" name="item_name" id="item_name" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="BMX PRO Series">
                                                                </div>
                                                                {{-- Nama Barang --}}
                                                                <div >
                                                                    <label for="item_name" class="block mb-2  mt-4 text-base text-start font-medium text-gray-900 ">Nama Barang</label>
                                                                    <input value="{{ $data->item->item_name }}" required type="text" name="item_name" id="item_name" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="BMX PRO s">
                                                                </div>

                                                                {{-- Kategori --}}
                                                                <div >
                                                                    <label for="category" class="block mb-2 mt-4 text-base text-start font-medium text-gray-900 ">Kategori Barang</label>
                                                                    <input value="{{ $data->categories->category_name }}" required type="text" name="item_name" id="item_name" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="BMX PRO s">
                                                                </div>
                                                                    {{-- Harga --}}
                                                                    <div>
                                                                        <label for="price" class="block mb-2 mt-4 text-base text-start font-medium text-gray-900 ">Harga</label>
                                                                        <input value="Rp{{ $data->finalPrice }}" type="text" name="price" id="price" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="asep@mail.com" required="">
                                                                    </div>
                                                                    {{-- Durasi --}}
                                                                    <div>
                                                                        <label for="price" class="block mb-2 mt-4 text-base text-start font-medium text-gray-900 ">Durasi Pinjam</label>
                                                                        <input value="{{ $data->rentDuration }}" type="text" name="price" id="price" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="asep@mail.com" required="">
                                                                    </div>
                                                                    {{-- Sisa Durasi --}}
                                                                    <div class="sm:col-span-2">
                                                                        <label for="price" class="block mb-2 mt-4 text-base text-start font-medium text-gray-900 ">Sisa Durasi Pinjam</label>
                                                                        <input value="{{ $data->remainingTime }}" type="text" name="price" id="price" disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-turqoise focus:border-turqoise block w-full p-2.5 " placeholder="asep@mail.com" required="">
                                                                    </div>
                                                                {{-- Photo --}}
                                                                <div class="sm:col-span-2">
                                                                    <label for="item_name" class="block mb-2 mt-4 text-base text-start font-medium text-gray-900 ">Bukti Bayar</label>
                                                                    <img class=" h-[400px] items-center" src="{{asset('bukti_transfer/' . $data->payment_evidence )}}" alt="evidence">
                                                                </div>
                                                                {{-- Status --}}
                                                                {{-- <div class="sm:col-span-3">
                                                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                                                    <input value="{{ $data->status }}" type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="asep@mail.com" required="">
                                                                </div> --}}
                                                                <div class="sm:col-span-3">
                                                                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                                                    <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                        <option selected="{{ $data->status }}">
                                                                            {{-- {{ $data->status }} --}}
                                                                            @if($data->status == 1)
                                                                            <div class="">
                                                                                <p class="flex items-center text-center justify-center bg-red text-white rounded ">Belum Kirim Bukti</p>
                                                                            </div>
                                                                            @elseif($data->status == 0)
                                                                                <div class=" ">
                                                                                    <p class="flex items-center justify-center bg-green-500 text-white rounded ">Disetujui</p>
                                                                                </div>
                                                                            @elseif($data->status == 2)
                                                                                <div class=" ">
                                                                                    <p class="flex items-center  text-center justify-center bg-yellow-300 text-gray-800 rounded ">Bukti Terkirim - Menunggu Verifikasi</p>
                                                                                </div>
                                                                            @elseif($data->status == 3)
                                                                                <div class=" ">
                                                                                    <p class="flex items-center  text-center justify-center bg-red text-gray-800 rounded ">Tolak</p>
                                                                                </div>
                                                                            @elseif($data->status == 5)
                                                                                <div class=" ">
                                                                                    <p class="flex items-center  text-center justify-center bg-green-500  text-gray-800 rounded ">Acc Pengembalian                                                                                    </p>
                                                                                </div>
                                                                            @elseif($data->status == 6)
                                                                                <div class=" ">
                                                                                    <p class="flex items-center  text-center justify-center bg-green-500  text-gray-800 rounded ">Telat - Denda</p>
                                                                                </div>
                                                                            @endif
                                                                        </option>

                                                                        <option value="0">Setujui</option>
                                                                        <option value="1">PC</option>
                                                                        <option value="2">Gaming/Console</option>
                                                                        <option value="3">Phones</option>
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            {{-- CTA Buttons --}}
                                                            <div class="flex justify-center items-center space-x-4">
                                                                <button type="submit" class="text-white bg-primary hover:bg-primary2 focus:ring-4 focus:outline-cyanoutline focus:ring-cyanoutline font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                                                    Ubah Data
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- End of Edit --}}


                                </td>







                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            Showing
                            <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                            of
                            <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                        </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            <li>
                                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">1</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">2</a>
                            </li>
                            <li>
                                <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">...</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">100</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            </section>






    </div>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    </body>


@endsection
</html>
