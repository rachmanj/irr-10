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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id');
            $table->foreignId('document_type_id'); // BPKB/STNK/POLIS/PO
            $table->string('document_no')->nullable();
            $table->date('document_date');
            $table->foreignId('supplier_id')->nullable(); // nama instansi
            $table->bigInteger('amount')->nullable(); //biaya yg dikeluarkan utk pengurusan, incl vat (if any)
            $table->date('due_date')->nullable(); // expire date
            $table->string('remarks')->nullable();
            $table->foreignId('extended_doc_id')->nullable();
            $table->foreignId('user_id'); //created by
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
        Schema::dropIfExists('documents');
    }
};
