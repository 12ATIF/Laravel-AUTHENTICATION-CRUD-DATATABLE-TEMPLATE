<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->integer('age');
            $table->string('image')->nullable(); // Menambahkan kolom untuk image
            $table->timestamps();
            $table->softDeletes();
        });

        // Menambahkan data awal
        DB::table('customers')->insert(
            [
                [
                    'email' => 'dinda@email.com',
                    'name' => 'Dinda',
                    'address' => 'Palembang',
                    'age' => 23,
                    'image' => 'default.png', // Nama file gambar default jika ada
                ],
                [
                    'email' => 'dandi@email.com',
                    'name' => 'Dandi',
                    'address' => 'Pekanbaru',
                    'age' => 20,
                    'image' => 'default.png', // Nama file gambar default jika ada
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
