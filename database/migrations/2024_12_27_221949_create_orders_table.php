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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->index();
            $table->string("payment_method");
            $table->string("payment_status")->default("pending");
            $table->string("shipping_method");
            $table->string("shipping_status")->default("not_shipped");
            $table->string("shipping_address");
            $table->string("billing_address");
            $table->decimal("shipping_cost", 10, 2)->default(0.00);
            $table->decimal("discount", 10, 2)->default(0.00);
            $table->decimal("total_price", 10, 2);
            $table->string("verification_code")->unique();
            $table->string("status")->default("pending");
            $table->softDeletes();
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
