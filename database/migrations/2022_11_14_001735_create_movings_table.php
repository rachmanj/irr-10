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
        Schema::create('movings', function (Blueprint $table) {
            $table->id();
            $table->date('ipa_date');
            $table->string('ipa_no');
            $table->foreignId('from_project_id');
            $table->foreignId('to_project_id');
            $table->string('tujuan_row_1')->nullable();
            $table->string('tujuan_row_2')->nullable();
            $table->string('cc_row_1')->nullable();
            $table->string('cc_row_2')->nullable();
            $table->string('cc_row_3')->nullable();
            $table->text('remarks')->nullable();
            $table->string('flag')->nullable();
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
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
        Schema::dropIfExists('movings');
    }
};
