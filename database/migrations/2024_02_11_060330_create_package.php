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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc');
            $table->double('price', 100, 2);
            $table->enum('status', ['true', 'false'])->default('true');
            $table->timestamps();
        });

        $defaultPackageRows = [
            [
                'name'          => 'Home 1',
                'desc'          => 'Paket Home 1',
                'price'         => '100000',
                'status'        => 'true',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Home 2',
                'desc'          => 'Paket Home 2',
                'price'         => '150000',
                'status'        => 'true',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Home 3',
                'desc'          => 'Paket Home 3',
                'price'         => '200000',
                'status'        => 'true',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('packages')->insert($defaultPackageRows);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
