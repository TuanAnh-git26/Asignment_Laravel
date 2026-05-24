@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('bank-accounts.index') }}" class="text-blue-600 hover:text-blue-800 mr-4 font-bold">&larr; Quay lại</a>
            <h1 class="text-2xl font-bold text-gray-700">Thêm Mới Tài Khoản</h1>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('bank-accounts.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full border @error('full_name') border-red-500 @else border-gray-300 @enderror rounded-md p-2">
                    @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Số tài khoản (10 số) *</label>
                    <input type="text" name="account_number" value="{{ old('account_number') }}" class="w-full border @error('account_number') border-red-500 @else border-gray-300 @enderror rounded-md p-2">
                    @error('account_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md p-2">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-md p-2">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Số dư ban đầu (VNĐ)</label>
                    <input type="number" name="balance" value="{{ old('balance', 0) }}" min="0" class="w-full border @error('balance') border-red-500 @else border-gray-300 @enderror rounded-md p-2">
                    @error('balance') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                        Lưu Tài Khoản
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
