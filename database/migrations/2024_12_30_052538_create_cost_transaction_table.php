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
        Schema::create('cost_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('cost_code')->unique();
            $table->dateTime('cost_date');
            $table->string('vendor_name');
            $table->decimal('cost_total_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_transaction');
    }
};
