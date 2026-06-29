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
        Schema::table('deposit_categories', function (Blueprint $table) {
             $table->foreignId('installment_type_id')
              ->nullable()
              ->after('user_id')
              ->constrained()
              ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deposit_categories', function (Blueprint $table) {
            //
        });
    }
};
