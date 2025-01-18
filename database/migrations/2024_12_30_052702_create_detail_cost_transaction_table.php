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
        Schema::create('detail_cost_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cost_id')->constrained('cost_transaction');
            $table->string('items_name');
            $table->enum('items_type',['BAHAN','LAINNYA'])->default('LAINNYA');
            $table->decimal('items_amount',19,2)->default(0);
            $table->enum('items_volume',['PCS', 'KG', 'GRAM','PACK'])->default('PCS');
            $table->decimal('items_price',19,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_cost_transaction');
    }
};
