<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number', 10)->unique();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->decimal('balance', 15, 0)->default(0);
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
