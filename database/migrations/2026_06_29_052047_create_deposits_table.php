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
        Schema::create('deposits', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('member_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('deposit_category_id')->nullable()->constrained()->nullOnDelete();

            $table->string('deposit_no')->unique();
            $table->string('member_code');

            $table->decimal('deposit_amount',12,2);

            $table->decimal('interest_rate',5,2)->default(0);

            $table->decimal('interest_amount',12,2)->default(0);

            $table->decimal('total_amount',12,2)->default(0);

            $table->decimal('paid_amount',12,2)->default(0);

            $table->decimal('due_amount',12,2)->default(0);

            $table->date('start_date');

            $table->date('maturity_date')->nullable();

            $table->enum('status',[
                'running',
                'completed',
                'closed',
                'cancelled'
            ])->default('running');

            $table->text('remark')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};