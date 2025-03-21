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
        Schema::create('shipping_costs', function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->decimal('cost', 10, 2)->default(0.00);
            $table->string('status')->default("active");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_costs');
    }
};
