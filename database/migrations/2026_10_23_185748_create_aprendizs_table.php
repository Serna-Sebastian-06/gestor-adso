<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('aprendices', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->string('documento', 40)->unique();
            $table->string('correo', 120)->unique();
            $table->unsignedBigInteger('ficha_id')->nullable()->unique(); 
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('aprendices');
    }
};