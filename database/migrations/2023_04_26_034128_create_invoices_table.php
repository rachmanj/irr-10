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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('invoice_date');
            $table->foreignId('vendor_id')->nullable();
            $table->string('vendor_branch')->nullable();
            $table->date('receive_date')->nullable();
            $table->string('receive_branch', 10)->nullable();
            $table->string('payment_branch', 10)->nullable();
            $table->string('currency', 5)->nullable();
            $table->string('po_no', 20)->nullable();
            $table->string('cost_project', 10)->nullable();
            $table->double('amount')->nullable();
            $table->date('payment_date')->nullable();
            $table->foreignId('spis_id')->nullable();
            $table->text('remark')->nullable();
            $table->string('filename')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
