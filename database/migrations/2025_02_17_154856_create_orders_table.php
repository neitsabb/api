<?php

use App\Enums\OrderStatusEnum;
use App\Enums\OrderTypeEnum;

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->enum(
                'type',
                array_column(OrderTypeEnum::cases(), 'value')
            );
            $table->string('customer');
            $table->integer('guests')->nullable();
            $table->float('total_amount')->default(0);
            $table->enum(
                'status',
                array_column(OrderStatusEnum::cases(), 'value')
            )
                ->default(OrderStatusEnum::PENDING->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
