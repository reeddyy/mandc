<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdasTable extends Migration
{
    public function up()
    {
        Schema::create('adas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('award_name')->nullable();
            $table->date('date_awarded')->nullable();
            $table->date('award_validity')->nullable();
            $table->string('awarding_body')->nullable();
            $table->string('award_status')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
