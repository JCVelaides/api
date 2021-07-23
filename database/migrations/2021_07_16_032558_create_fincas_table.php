<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFincasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fincas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreFinca');
            $table->string('procedencia');
            $table->string('departamento');
            $table->integer('verificado')->default(0);
            $table->date('fechaVerificado')->nullable(true);
            $table->string('nombreVerificado')->nullable(true);
            $table->text('observacionVerificado')->nullable(true);
            $table->integer('estado')->default(0);
            //$table->foreignId('id_usuario')->constrained('usuarios')->onDelete('set null');
            $table->unsignedBigInteger('id_usuario')->nullable(true);


            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('set null');

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
        Schema::dropIfExists('fincas');
    }
}
