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
        Schema::table('ordersdetails', function (Blueprint $table) {
            $table->enum('type', ['retail', 'wholesale'])->default('wholesale')->after('quantity');
        });
    }

    public function down()
    {
        Schema::table('ordersdetails', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};

