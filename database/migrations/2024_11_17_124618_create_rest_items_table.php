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
        Schema::create('rest_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('customers_id')->constrained()->cascadeOnDelete();
            $table->string('company_email');
            $table->string('phone_number');
            $table->enum('category', ['cafeteria', 'resturant', 'desserts', 'pizza']);
            $table->string('wilaya');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rest_items');
    }
};
