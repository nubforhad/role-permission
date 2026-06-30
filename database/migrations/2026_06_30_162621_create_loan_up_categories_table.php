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
         Schema::create('loan_up_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->decimal('interest_rate',8,2)->default(0);

            $table->enum('interest_type',[
                'Flat',
                'Reducing'
            ])->default('Flat');

            $table->integer('duration');

            $table->enum('duration_type',[
                'Day',
                'Week',
                'Month',
                'Year'
            ])->default('Month');

            $table->enum('installment_type',[
                'Daily',
                'Weekly',
                'Monthly',
                'Quarterly',
                'Yearly'
            ])->default('Monthly');

            $table->decimal('processing_fee',10,2)->default(0);

            $table->decimal('late_fee',10,2)->default(0);

            $table->decimal('minimum_amount',12,2)->default(0);

            $table->decimal('maximum_amount',12,2)->default(0);

            $table->boolean('status')->default(1);

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_up_categories');
    }
};
