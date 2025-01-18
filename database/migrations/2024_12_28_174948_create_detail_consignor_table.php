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
        Schema::create('detail_consignor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consignor_id')->constrained('consignors_sale');
            $table->foreignId('product_id')->constrained('master_product');
            $table->decimal('qty',19,2)->default(0);
            $table->decimal('sold',19,2)->default(0);
            $table->decimal('remaining',19,2)->default(0);
            $table->decimal('price',19,2)->default(0);
            $table->decimal('subtotal',19,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_consignor');
    }
};
