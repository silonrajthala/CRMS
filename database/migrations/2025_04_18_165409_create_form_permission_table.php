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
        Schema::create('form_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->string('formname');
            $table->string('slug');
            $table->char('isinsert',1)->default('N');
            $table->char('isupdate',1)->default('N');
            $table->char('isedit',1)->default('N');
            $table->char('isdelete',1)->default('N');
            $table->integer('usertypeid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_permission');
    }
};
