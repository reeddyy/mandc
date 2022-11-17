<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAdasTable extends Migration
{
    public function up()
    {
        Schema::table('adas', function (Blueprint $table) {
            $table->unsignedBigInteger('member_name_id')->nullable();
            $table->foreign('member_name_id', 'member_name_fk_7628606')->references('id')->on('memberships');
        });
    }
}
