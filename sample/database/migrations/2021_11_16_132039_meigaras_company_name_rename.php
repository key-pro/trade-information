<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MeigarasCompanyNameRename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meigaras', function (Blueprint $table) {
            $table->renameColumn('company_name','meigara_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meigaras', function (Blueprint $table) {
            $table->renameColumn('meigara_name','company_name');
        });
    }
}
