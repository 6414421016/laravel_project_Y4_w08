<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('program_th');
            $table->string('program_en');
            $table->string('grad_year');
            $table->foreignId('prg_fac_id')->constrained('faculties');
            //prg_fac_id เป็น foreign key ที่อ้างอิงไปยังคอลัมน์ id ของตาราง faculties
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
        Schema::dropIfExists('programs');
    }
}
