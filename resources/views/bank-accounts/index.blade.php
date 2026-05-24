@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Danh Sách Tài Khoản</h1>
        <a href="{{ route('bank-accounts.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
            + Thêm Mới
        </a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <form action="{{ route('bank-accounts.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tìm kiếm</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tên, Email, SĐT..." class="w-full border-gray-300 rounded-md shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Số dư tối thiểu (VNĐ)</label>
                <input type="number" name="min_balance" value="{{ request('min_balance') }}" placeholder="VD: 10000000" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Từ ngày</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Đến ngày</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
            </div>

            <div class="md:col-span-4 flex justify-end gap-2 mt-2">
                <a href="{{ route('bank-accounts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded shadow">Reset</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow">Lọc dữ liệu</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số TK</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chủ Tài Khoản</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Liên hệ</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số dư (VNĐ)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse($accounts as $account)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $account->account_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $account->full_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div>{{ $account->email }}</div>
                        <div class="text-xs">{{ $account->phone }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-semibold">
                        {{ number_format($account->balance, 0, ',', '.') }} đ
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($account->status == 'active')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Hoạt động</span>
                        @elseif($account->status == 'inactive')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Tạm khóa</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Bị cấm</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $account->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Không tìm thấy dữ liệu phù hợp.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $accounts->links() }}
        </div>
    </div>
@endsection
