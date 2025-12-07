@extends('layout')
@section('content')
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="divide-y divide-gray-200">
                            @foreach($cart as $item)
                                <div class="p-6 flex flex-col md:flex-row items-center gap-4">
                                    <img src="{{ $item['image'] ?: 'https://dummyimage.com/150x150' }}" 
                                         alt="{{ $item['product_name'] }}" 
                                         class="w-24 h-24 object-cover rounded">
                                    
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item['product_name'] }}</h3>
                                        <p class="text-gray-600 mb-2">Rp. {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500">Jumlah: 1</p>
                                    </div>
                                    
                                    <div class="flex items-center gap-4">
                                        <form action="{{ route('cart.remove') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Kosongkan Keranjang</button>
                        </form>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jumlah Item</span>
                                <span class="text-gray-900 font-medium">{{ count($cart) }} item</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900 font-medium">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-2 mt-2">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-gray-900">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('home') }}" class="block text-center text-indigo-500 hover:text-indigo-700 mb-4">Lanjut Belanja</a>
                        
                        <a href="{{ route('order.checkout') }}" class="block w-full bg-indigo-500 text-white py-3 px-6 rounded-lg hover:bg-indigo-600 font-medium text-center">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mt-4 mb-2">Keranjang Anda Kosong</h2>
                <p class="text-gray-600 mb-6">Mulai belanja dan tambahkan produk ke keranjang Anda</p>
                <a href="{{ route('home') }}" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</section>
@endsection