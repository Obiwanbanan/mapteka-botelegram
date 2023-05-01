<?php

use App\Models\City;
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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region');
            $table->string('district')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });

        $file = fopen(database_path('cities/cities_ru.csv'), 'r');
        fgetcsv($file, 0, ';'); // пропускаем первую строку с заголовками
        while (($line = fgetcsv($file, 0, ';')) !== false) {
            $data = explode(",", $line[0]);
            $city = new City();
            $city->name = $data[0];
            $city->region = $data[1];
            $city->district = $data[2];
            $city->latitude = $data[3];
            $city->longitude = $data[4];
            $city->save();
        }
        fclose($file);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
