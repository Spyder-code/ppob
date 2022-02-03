<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePaketData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_paket_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained('users');
            $table->string('nomor_hp');
            $table->string('id_paket_data');
            $table->string('id_provider');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_paket_data');
    }
}
