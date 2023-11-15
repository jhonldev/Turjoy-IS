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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->date('reservation_date');
            $table->integer('quantity_seats');
            $table->dateTime('purchase_date');
            $table->integer('payment');
            $table->string('uri')->nullable();
            $table->string('pdf_name')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('idroute');
            $table->foreign('idroute')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
