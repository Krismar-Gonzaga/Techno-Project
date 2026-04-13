<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kits', function (Blueprint $table) {
            $table->id();
            $table->string('kit_code')->unique();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->json('ordered_tests');
            $table->enum('status', ['pending', 'partial', 'complete', 'released'])->default('pending');
            $table->date('collection_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kits');
    }
};