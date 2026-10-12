
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aspirations', function (Blueprint $table) {
            $table->string('location')->nullable();
            $table->string('evidence_photo')->nullable();
            $table->string('edit_token')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('aspirations', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'evidence_photo',
                'edit_token',
            ]);
        });
    }
};
