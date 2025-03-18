<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->decimal('quantity', 10, 2)->change();
            $table->decimal('PriceSalse', 10, 2)->change();
            $table->decimal('PriceBuy', 10, 2)->change();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    
    
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable();

            $table->string('quantity')->change();
            $table->string('PriceSales')->change();
            $table->string('PriceBuy')->change();

            $table->dropForeign(['category_id']);
        });
    }
}
