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
        if (!Schema::hasTable('product_variant_option_inventories')) {
            Schema::create('product_variant_option_inventories', function (Blueprint $table) {
                $table->id();
                $table->integer('stock');
                $table->foreignId('product_id')->index('pvo_inventory_product_id_idx');
                $table->foreignId('product_variant_option_id')->index('pvo_inventory_variant_id_idx');
                $table->timestamps();
                $table->foreign('product_variant_option_id', 'pvo_inventory_variant_id_fk')
                    ->references('id')
                    ->on('product_variant_options')
                    ->onDelete('cascade');
                $table->foreign('product_id', 'pvo_inventory_product_id_fk')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
            });
        }        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_option_inventories');
    }
};
