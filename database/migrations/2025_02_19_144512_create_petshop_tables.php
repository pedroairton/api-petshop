<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Tabela ADMIN (Médico)
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Cria coluna 'id' como unsignedBigInteger auto-increment
            $table->string('usuario')->unique();
            $table->string('senha');
            $table->string('status', 50)->nullable();
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
        });

        // 2. Tabela USUARIOS (Donos)
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('endereco')->nullable();
            $table->string('email')->unique();
            $table->string('telefone', 20)->nullable();
            $table->string('senha');
            $table->timestamps();
        });

        // 3. Tabela PETS
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            // 'id_dono' referencia a tabela 'usuarios'
            $table->foreignId('id_dono')
                  ->constrained('usuarios')
                  ->onDelete('cascade')
                  ->nullable();
            $table->string('nome');
            $table->string('genero', 10)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('tipo_animal', 50)->nullable();
            $table->string('raca', 50)->nullable();
            $table->timestamps();
        });

        // 4. Tabela SERVICOS
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            // 'id_medico' referencia a tabela 'admins'
            $table->foreignId('id_medico')
                  ->constrained('admins')
                  ->onDelete('cascade')
                  ->nullable();
            $table->string('nome_servico');
            $table->decimal('valor_servico', 8, 2)->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });

        // 5. Tabela AGENDAMENTOS
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            // 'id_servico' referencia 'servicos'
            $table->foreignId('id_servico')
                  ->constrained('servicos')
                  ->onDelete('cascade');
            // 'id_pet' referencia 'pets'
            $table->foreignId('id_pet')
                  ->constrained('pets')
                  ->onDelete('cascade');
            $table->date('data_agendamento')->nullable();
            $table->time('hora_agendamento')->nullable();
            $table->text('descricao')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });

        // 6. Tabela VACINAS
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id();
            // 'id_medico' referencia a tabela 'admins'
            $table->foreignId('id_medico')
                  ->constrained('admins')
                  ->onDelete('cascade')
                  ->nullable();
            $table->string('nome_vacina');
            $table->date('data_aplicacao')->nullable();
            $table->date('proxima_dose')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vacinas');
        Schema::dropIfExists('agendamentos');
        Schema::dropIfExists('servicos');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('admins');
    }
};
