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
         Schema::create('loan_ups', function (Blueprint $table) {
                $table->id();

                // Relations
                $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
                $table->foreignId('member_id')->constrained()->cascadeOnDelete();
                $table->foreignId('loan_up_category_id')->constrained('loan_up_categories')->cascadeOnDelete();

                // Loan Info
                $table->decimal('loan_amount', 12, 2);
                $table->decimal('interest_rate', 5, 2)->nullable();
                $table->string('interest_type')->nullable();

                $table->integer('duration');
                $table->string('duration_type')->default('Month');

                $table->string('installment_type')->default('Monthly');

                // Calculations
                $table->decimal('total_interest', 12, 2)->default(0);
                $table->decimal('total_payable', 12, 2)->default(0);
                $table->decimal('emi_amount', 12, 2)->default(0);

                // Dates
                $table->date('start_date')->nullable();
                $table->date('approval_date')->nullable();
                $table->date('disbursement_date')->nullable();

                // Status
                $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Disbursed'])
                    ->default('Pending');

                $table->text('note')->nullable();

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_ups');
    }
};
