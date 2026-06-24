<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('nominees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nominee_name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();

            $table->string('mobile_number', 20);
            $table->string('relation')->nullable();
            $table->string('nid_number')->nullable();
            $table->text('address')->nullable();

            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('document_file')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('nominees');
    }
};
