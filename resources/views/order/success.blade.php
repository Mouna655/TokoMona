@extends('layout')
@section('content')
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="max-w-2xl mx-auto text-center">
            <div class="mb-8">
                <svg class="mx-auto h-24 w-24 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Pesanan Berhasil!</h1>
            <p class="text-gray-600 mb-8">Terima kasih atas pesanan Anda. Kami akan segera memproses pesanan Anda.</p>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-6 mb-6 text-left">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Detail Pesanan</h2>
                
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nomor Pesanan</span>
                        <span class="font-semibold text-gray-900">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nama Pemesan</span>
                        <span class="font-semibold text-gray-900">{{ $order->customer_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email</span>
                        <span class="font-semibold text-gray-900">{{ $order->customer_email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Telepon</span>
                        <span class="font-semibold text-gray-900">{{ $order->customer_phone }}</span>
                    </div>
                    @if($order->customer_address)
                    <div>
                        <span class="text-gray-600">Alamat</span>
                        <p class="font-semibold text-gray-900 mt-1">{{ $order->customer_address }}</p>
                    </div>
                    @endif
                    <div class="flex justify-between pt-3 border-t border-gray-200">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-lg font-bold text-gray-900">Rp. {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'completed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            @if($order->status == 'pending') Menunggu
                            @elseif($order->status == 'processing') Diproses
                            @elseif($order->status == 'completed') Selesai
                            @else Dibatalkan
                            @endif
                        </span>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Item Pesanan</h3>
                    <div class="space-y-2">
                        @foreach($order->orderItems as $item)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $item->product_name }}</h4>
                                        <p class="text-sm text-gray-500">Rp. {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <span class="font-semibold text-gray-900">Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex gap-4 justify-center">
                <a href="{{ route('home') }}" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
@endsection