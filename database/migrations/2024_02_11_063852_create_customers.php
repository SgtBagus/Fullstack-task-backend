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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->enum('status', ['true', 'false'])->default('true');
            $table->bigInteger('package_id');
            $table->string('ktpImage');
            $table->string('houseImage');
            $table->bigInteger('created_by');
            $table->timestamps();
        });

        $defaultCustomersRows = [
            [
                'name'          => 'Orang satu',
                'phone'         => '0923909128989',
                'address'       => 'disini',
                'status'        => 'false',
                'package_id'    => 1,
                'ktpImage'      => 'https://wallpaperwaifu.com/wp-content/uploads/2023/03/hayase-yuuka-sportswear-blue-archive-thumb.jpg',
                'houseImage'    => 'https://wallpaperwaifu.com/wp-content/uploads/2023/03/hayase-yuuka-sportswear-blue-archive-thumb.jpg',
                'created_by'    => 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Orang Dua',
                'phone'         => '0923909128989',
                'address'       => 'disini sana',
                'status'        => 'true',
                'package_id'    => 2,
                'ktpImage'      => 'https://wallpaperwaifu.com/wp-content/uploads/2023/03/hayase-yuuka-sportswear-blue-archive-thumb.jpg',
                'houseImage'    => 'https://wallpaperwaifu.com/wp-content/uploads/2023/03/hayase-yuuka-sportswear-blue-archive-thumb.jpg',
                'created_by'    => 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Orang tiga',
                'phone'         => '0923909128989',
                'address'       => 'disini sana dan sini',
                'status'        => 'false',
                'package_id'    => 3,
                'ktpImage'      => 'https://wallpaperwaifu.com/wp-content/uploads/2023/03/hayase-yuuka-sportswear-blue-archive-thumb.jpg',
                'houseImage'    => 'https://wallpaperwaifu.com/wp-content/uploads/2023/03/hayase-yuuka-sportswear-blue-archive-thumb.jpg',
                'created_by'    => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('customers')->insert($defaultCustomersRows);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
