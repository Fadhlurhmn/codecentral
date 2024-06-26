
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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id('id_pengumuman');
            $table->unsignedBigInteger('id_user')->index();
            $table->string('judul_pengumuman', 100);
            $table->Longtext('deskripsi');
            $table->string('thumbnail');
            $table->string('status_pengumuman', 20);
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
