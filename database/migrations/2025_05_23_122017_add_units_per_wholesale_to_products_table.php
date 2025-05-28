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
    Schema::table('products', function (Blueprint $table) {
        $table->integer('units_per_wholesale')->nullable()->after('wholesale_price'); // أو غير الموقع حسب ما يلزمك
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('units_per_wholesale');
    });
}
};
