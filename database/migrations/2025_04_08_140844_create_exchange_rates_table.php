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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code', 3);
            $table->decimal('rate', 15, 6);
            $table->date('effective_date');
            $table->enum('table_type', ['A', 'B', 'C']);
            $table->timestamps();

            $table->unique(['currency_code', 'effective_date', 'table_type'], 'exchange_rate_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
