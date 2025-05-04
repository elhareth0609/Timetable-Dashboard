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
        Schema::create('teaching_reliefs', function (Blueprint $table) {
            $table->id();
            $table->string('role_id'); //
            $table->string('role_name');
            $table->string('role_name_ar');
            $table->integer('hours_reduction');
            $table->text('notes')->nullable();        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_reliefs');
    }
};
