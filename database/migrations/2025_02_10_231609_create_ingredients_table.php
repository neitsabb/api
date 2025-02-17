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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();

            $table->string('image')->nullable()
                ->default('https://placehold.co/32x32');
            $table->string('name');
            $table->float('price');
            $table->enum(
                'unit',
                ['g', 'kg', 'ml', 'cl', 'l', 'unit']
            )->default('unit');
            $table->integer('stock_quantity')
                ->default(0);
            $table->integer('critical_stock')
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
