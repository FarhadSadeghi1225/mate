<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->string('apikey');
            $table->string('channel')->nullable();
            $table->smallInteger('encoding_type')->nullable()->default(0);
            $table->string('charset')->nullable();
            $table->string('from_name')->nullable();
            $table->string('subject')->nullable();
            $table->boolean('track_clicks')->nullable()->default(1);
            $table->boolean('track_opens')->nullable()->default(1);
            $table->boolean('is_transactional')->default(1);
            $table->string('template')->nullable();
            $table->longText('body_html')->nullable();
            $table->text('body_text')->nullable();
            $table->string('file_name')->nullable();
            $table->string('transaction_id');
            $table->string('message_id');
            $table->string('status_name')->nullable();
            $table->smallInteger('status')->nullable();
            $table->datetime('date')->nullable();
            $table->datetime('date_clicked')->nullable();
            $table->datetime('date_opened')->nullable();
            $table->datetime('status_change_date')->nullable();
            $table->datetime('date_sent')->nullable();
            $table->string('error_message')->nullable();
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
        Schema::dropIfExists('emails');
    }
}
