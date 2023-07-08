<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->integer('room_number')->unique();
                $table->enum('type', ['regular', 'middle', 'luxury']);
                $table->decimal('price');
                $table->enum('status', ['Kosong', 'Disewa'])->default('kosong');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
