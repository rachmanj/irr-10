<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id');
            $table->string('serial_no')->nullable();
            $table->string('chasis_no')->nullable(); // nomor rangka
            $table->string('machine_no')->nullable(); //  nomor mesin
            $table->string('nomor_polisi')->nullable(); // nomor plat kendaraan
            $table->string('bahan_bakar')->nullable(); //solar atau Premium/Pertalite
            $table->string('warna')->nullable(); //warna kendaraan
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
        Schema::dropIfExists('equipment_details');
    }
};
