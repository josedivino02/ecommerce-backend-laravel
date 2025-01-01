<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_costs_id')->after('shipping_method');
            $table->foreign('shipping_costs_id')->references('id')->on('shipping_costs')->onDelete('set null');

            $table->dropColumn('shipping_cost');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('shipping_cost', 10, 2)->default(0.00)->after('shipping_method');
            $table->dropForeign(['shipping_costs_id']);
            $table->dropColumn('shipping_costs_id');
        });
    }
};
