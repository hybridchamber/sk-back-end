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
        Schema::create('demographic', function (Blueprint $table) {
            $table->id('demo_id'); // Use $table->id() for an auto-incrementing primary key
            $table->enum('sex', ['male', 'female']);
            $table->integer('age');
            $table->date('birthday');
            $table->string('civilStatus');
            $table->string('youthclassification');
            $table->string('schoolattainment');
            $table->string('pdw');
            $table->string('specialneeds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demographic');
    }
};
