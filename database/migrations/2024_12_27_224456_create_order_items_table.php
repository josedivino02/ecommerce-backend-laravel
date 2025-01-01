<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId("order_id")->index();
            $table->foreignId("product_id")->index();
            $table->integer("quantity")->default(1);
            $table->decimal("unit_price", 8, 2)->default(0);
            $table->decimal("total_price", 8, 2)->default(0);
            $table->string("tracking");
            $table->string("status");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
