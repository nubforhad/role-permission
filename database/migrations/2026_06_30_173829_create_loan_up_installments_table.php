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
        Schema::create('loan_up_installments', function (Blueprint $table) {
            $table->id();

            // 🔗 relation
            $table->foreignId('loan_up_id')
                ->constrained('loan_ups')
                ->cascadeOnDelete();

            // installment info
            $table->integer('installment_no');
            $table->decimal('amount', 12, 2);

            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('due_amount', 12, 2)->default(0);

            $table->date('due_date');

            // status tracking
            $table->enum('status', ['Pending', 'Paid', 'Partial'])
                ->default('Pending');

            $table->date('paid_date')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_up_installments');
    }
};
