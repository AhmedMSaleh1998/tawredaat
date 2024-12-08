<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddingKeysToOauthAccessTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('oauth_access_tokens')) {
            // primary key
            if (Schema::hasColumn('oauth_access_tokens', 'id')) {
                $primary_key_exists = DB::select(
                    DB::raw(
                        'SHOW KEYS
        FROM oauth_access_tokens
        WHERE Key_name="PRIMARY"'
                    )
                );
                if (!$primary_key_exists) {
                    DB::statement('ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`);');

                }
            }
        }

        // user_id
        if (Schema::hasColumn('oauth_access_tokens', 'user_id')) {
            $user_id_fk_key_exists = DB::select(
                DB::raw(
                    'SHOW KEYS
        FROM oauth_access_tokens
        WHERE Key_name="oauth_access_tokens_user_id_index"'
                )
            );
            if (!$user_id_fk_key_exists) {
                DB::statement('ALTER TABLE `oauth_access_tokens`
                      ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);');

            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            //
        });
    }
}