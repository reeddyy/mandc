<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_status')->nullable();
            $table->string('member_reference')->unique();
            $table->string('member_class')->nullable();
            $table->string('member_name')->nullable();
            $table->date('date_awarded')->nullable();
            $table->date('membership_validity')->nullable();
            $table->string('awarding_body')->nullable();
            $table->string('training_credits')->nullable();
            $table->string('support_funds')->nullable();
            $table->string('digital_member_card')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
