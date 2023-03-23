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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('unit_no');
            $table->date('active_date')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('unitmodel_id')->nullable();
            $table->foreignId('asset_category_id')->nullable(); // Mayor / minor / or anything else
            $table->foreignId('plant_type_id')->nullable(); // digger or hauler or anything else
            $table->foreignId('plant_group_id')->nullable(); // lighting tower, welding, etc
            $table->foreignId('unitstatus_id')->nullable();
            $table->foreignId('current_project_id')->nullable(); //lokasi alat saat ini
            $table->string('serial_no')->nullable();
            $table->string('chasis_no')->nullable(); // nomor rangka
            $table->string('engine_model')->nullable(); //  model engine
            $table->string('machine_no')->nullable(); //  nomor mesin
            $table->string('nomor_polisi')->nullable(); // nomor plat kendaraan
            $table->string('bahan_bakar')->nullable(); //solar atau Premium/Pertalite
            $table->string('warna')->nullable(); //warna kendaraan
            $table->string('unit_pic')->nullable();
            $table->string('cart_flag')->nullable(); // cart pada saat transaksi perpindahan alat (IPA)
            $table->decimal('capacity')->nullable();
            $table->foreignId('assign_to')->nullable(); //pemegang alat
            $table->text('remarks')->nullable(); // catatan lain yg belum tercantum dalam field2
            $table->foreignId('created_by')->nullable(); // created_by
            $table->foreignId('updated_by')->nullable(); // updated_by
            $table->softDeletes();
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
        Schema::dropIfExists('equipments');
    }
};
