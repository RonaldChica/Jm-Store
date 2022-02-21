<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecargasSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recargas', function (Blueprint $table) {
            $table->id();
            $table->string('playerId');

            // Relationships
            $table->foreignIdFor(Product::class)
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();
            $table->foreignIdFor(User::class)
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();

            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->string('diamantes');
            $table->string('bonus');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->decimal('saldo');
            $table->dropColumn('google_token');
            $table->dropColumn('google_refresh_token');
            $table->dropColumn('google_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recargas');
        Schema::dropIfExists('products');
    }
}
