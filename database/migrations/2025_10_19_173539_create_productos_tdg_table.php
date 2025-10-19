<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Tabla padre primero
        Schema::create('categorias_tdg', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_producto', 100);
            $table->unsignedSmallInteger('pasillo')->nullable();
            $table->timestamps();
        });

        // 2) Luego la hija con la FK
        Schema::create('productos_tdg', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('descripcion', 255);
            $table->decimal('precio', 12, 2)->unsigned();
            $table->integer('stock')->default(0);

            $table->string('plu', 20)->nullable()->unique();
            $table->string('ean', 20)->nullable()->unique();

            $table->decimal('peso', 8, 3)->nullable();

            $table->foreignId('categoria_id')
                ->constrained('categorias_tdg')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos_tdg');
        Schema::dropIfExists('categorias_tdg');
    }
};
