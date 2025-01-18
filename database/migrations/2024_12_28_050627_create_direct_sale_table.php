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
        Schema::create('direct_sale', function (Blueprint $table) {
            $table->id();
            $table->string('direct_sale_code')->unique();
            $table->foreignId('contact_id')->nullable()->constrained('contact');
            $table->dateTime('direct_sale_date');
            $table->foreignId('validated_by')->nullable()->constrained('users');
            $table->dateTime('validated_at')->nullable();
            $table->decimal('direct_sale_amount',19,2)->default(0);
            $table->enum('direct_sale_stats',['NEW','VALIDATED','TERMINATED'])->default('NEW');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_sale');
    }
};
