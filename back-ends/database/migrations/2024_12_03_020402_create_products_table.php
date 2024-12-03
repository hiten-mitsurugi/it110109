<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('starting_price', 10, 2);
            $table->decimal('current_price', 10, 2)->nullable();
            $table->foreignId('admin_id')->constrained('users');
            $table->timestamp('bidding_ends_at')->nullable();
            $table->enum('status', ['active', 'sold'])->default('active');
            $table->string('image')->nullable(); // Column for storing image path
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::dropIfExists('products');       // Then drop the products table
    }

};
