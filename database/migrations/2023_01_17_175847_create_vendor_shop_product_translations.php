<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorShopProductTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_shop_product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('vendor_shop_product_id')->unsigned();

            $table->string('locale')->index();

            $table->unique(['vendor_shop_product_id', 'locale'],
                'vendor_shop_product_id_unique_local_trans');

            $table->foreign('vendor_shop_product_id',
                'vendor_product_id_fk')->references('id')
                ->on('vendor_shop_products')->onDelete('cascade');

            $table->string('name')->nullable();

            $table->string('title')->nullable();

            $table->string('alt')->nullable();

            $table->longtext('description')->nullable();

            $table->longtext('description_meta')->nullable();

            $table->longtext('keywords')->nullable();

            $table->longtext('keywords_meta')->nullable();

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
        Schema::dropIfExists('vendor_shop_product_translations');
    }
}