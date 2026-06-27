<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_collections', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('loan_section_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained('users')->onDelete('set null');

            // MEMBER CODE (for fast selection/search UI)
            $table->string('member_code')->index();

            // Installment details
            $table->decimal('installment_amount', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('penalty_charge', 12, 2)->default(0);

            // Dates
            $table->date('installment_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->date('expire_date')->nullable();

            // Status
            $table->enum('status', ['pending', 'paid', 'partial', 'late'])->default('pending');

            // Optional remark
            $table->text('remark')->nullable();

            $table->timestamps();

            $table->index(['loan_section_id', 'member_id', 'member_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_collections');
    }
};