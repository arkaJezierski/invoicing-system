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
            $table->char('currency_code', 3);
            $table->date('effective_date');
            $table->decimal('mid', 15, 6)->nullable();
            $table->decimal('bid', 15, 6)->nullable();
            $table->decimal('ask', 15, 6)->nullable();
            $table->timestamps();

            $table->unique(['currency_code', 'effective_date']);
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
