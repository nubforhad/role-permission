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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();

            $table->string('member_code')->unique()->nullable();

            $table->string('email')->nullable();
            $table->string('father_name')->nullable();
            $table->string('member_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->date('opening_date')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->decimal('share_amount', 12, 2)->default(0);
            $table->string('referred_by')->nullable();

            $table->string('nid_number')->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->string('blood_group', 10)->nullable();

            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();

            $table->string('religion')->nullable();
            $table->date('dob')->nullable();

            $table->decimal('monthly_income', 12, 2)->default(0);

            $table->string('profession')->nullable();

            $table->decimal('admission_fee', 12, 2)->default(0);
            $table->decimal('passbook_fee', 12, 2)->default(0);

            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('document_file')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
