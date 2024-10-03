<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->decimal('Price', 10, 2);
            $table->boolean('IsNew')->default(true);
            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
           // $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null'); // Make it nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
