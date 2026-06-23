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
        Schema::create('loan_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('installment_type_id')->constrained('installment_types')->onDelete('cascade');
            $table->foreignId('loan_category_id')->constrained('loan_categories')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');

            $table->decimal('loan_amount', 12, 2);
            $table->string('loan_status')->default('pending');
            $table->string('upline_status')->nullable();

            $table->decimal('interest', 5, 2)->default(0);
            $table->integer('total_installment')->default(0);
            $table->decimal('paid_per_installment', 5, 2)->default(0);
            $table->decimal('total_amount', 12, 2);

            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_sections');
    }
};
