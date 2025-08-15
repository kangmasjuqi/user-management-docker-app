<?php
// database/migrations/2024_01_01_000002_create_user_educations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('level', ['elementary', 'middle_school', 'high_school', 'diploma', 'bachelor', 'master', 'doctorate']);
            $table->integer('year');
            $table->string('institution');
            $table->string('major')->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_educations');
    }
};