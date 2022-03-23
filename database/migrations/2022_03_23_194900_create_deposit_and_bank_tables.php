<?php

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositAndBankTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->float('valor');
            $table->string('numeroComprobante');
            $table->string('imagenComprobante');

            // Relationships
            $table->foreignIdFor(Bank::class)
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();
            $table->foreignIdFor(User::class)
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
        Schema::dropIfExists('deposits');
    }
}
