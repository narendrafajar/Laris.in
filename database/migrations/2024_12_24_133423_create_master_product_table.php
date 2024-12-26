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
        Schema::create('master_product', function (Blueprint $table) {
            $table->id();
            $table->string('product_company_id')->constrained('master_type_company');
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->enum('product_vol',['PCS','KG','GRAM','PACKAGE'])->default('PCS');
            $table->decimal('product_price',19,2)->default(0);
            $table->decimal('product_sale_price',19,2)->default(0);
            $table->enum('product_stats',['ACTIVE', 'INACTIVE','EXPIRED'])->default('ACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_product');
    }
};
