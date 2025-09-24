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
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->nullable()->default(null)->change();
            $table->integer('stock')->default(0)->change();
            $table->boolean('track_quantity')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->change();
            $table->integer('stock')->nullable()->default(null)->change();
            $table->boolean('track_quantity')->default(true)->change();
        });
    }
};
