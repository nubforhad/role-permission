<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposit_withdraws', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('branch_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('deposit_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('withdraw_no')->unique();

            $table->date('withdraw_date');

            $table->decimal('withdraw_amount', 12, 2);

            $table->enum('payment_method', [
                'cash',
                'bkash',
                'nagad',
                'rocket',
                'bank'
            ])->default('cash');

            $table->enum('status', [
                'pending',
                'completed',
                'cancelled'
            ])->default('completed');

            $table->text('remark')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposit_withdraws');
    }
};