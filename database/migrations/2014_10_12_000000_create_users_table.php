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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $defaultUserRows = [
            [
                'name'          => 'Admin',
                'email'         => 'admin@admin.com',
                'image'         => 'https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg',
                'role'          => 'admin',
                'password'      => Hash::make('12345678'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Sales',
                'email'         => 'sales@sales.com',
                'image'         => 'https://www.shutterstock.com/image-vector/default-image-icon-vector-missing-600nw-2079504220.jpg',
                'role'          => 'sales',
                'password'      => Hash::make('12345678'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('users')->insert($defaultUserRows);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
