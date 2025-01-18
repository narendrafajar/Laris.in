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
        Schema::create('consignors_sale', function (Blueprint $table) {
            $table->id();
            $table->string('consignor_code')->unique();
            $table->foreignId('contact_id')->constrained('contact');
            $table->dateTime('consignor_date_store');
            $table->dateTime('consignor_date_pickup')->nullable();
            $table->decimal('consignor_item_total',19,2)->default(0);
            $table->decimal('consignor_total_amount',19,2)->default(0);
            $table->enum('consignor_stats',['START','CLEAR','TERMINATED'])->default('START');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignors_sale');
    }
};
