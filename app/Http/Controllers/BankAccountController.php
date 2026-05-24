<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index(Request $request)
    {
        $query = BankAccount::query();

        $query->when($request->search, function($q) use ($request) {
            $q->where(function($query) use ($request) {
                $query->where('full_name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            });
        });

        $query->when($request->min_balance, function($q) use ($request) {
            $q->where('balance', '>=', $request->min_balance);
        });

        $query->when($request->from_date, function($q) use ($request) {
            $q->whereDate('created_at', '>=', $request->from_date);
        });

        $query->when($request->to_date, function($q) use ($request) {
            $q->whereDate('created_at', '<=', $request->to_date);
        });

        $accounts = $query->latest()->paginate(10)->withQueryString();

        return view('bank-accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('bank-accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'account_number' => 'required|numeric|digits:10|unique:bank_accounts,account_number',
            'email' => 'required|email|unique:bank_accounts,email',
            'phone' => 'required|string|max:20',
            'balance' => 'nullable|numeric|min:0',
        ], [
            'required' => 'Trường này không được để trống.',
            'account_number.digits' => 'Số tài khoản phải có đúng 10 chữ số.',
            'account_number.unique' => 'Số tài khoản này đã tồn tại trong hệ thống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'balance.min' => 'Số dư phải lớn hơn hoặc bằng 0.',
            'numeric' => 'Vui lòng nhập số.'
        ]);

        $validated['status'] = 'active';
        $validated['balance'] = $validated['balance'] ?? 0;

        BankAccount::create($validated);

        return redirect()->route('bank-accounts.index')->with('success', 'Thêm mới tài khoản thành công!');
    }
}
