<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_u_installments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('loan_up_id')->constrained()->onDelete('cascade');

            $table->integer('installment_no');

            $table->decimal('amount', 12, 2);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('due_amount', 12, 2)->default(0);

            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();

            $table->enum('status', ['Pending', 'Partial', 'Paid'])->default('Pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_u_installments');
    }
};