<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendMailToLazyDeveloper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saborunayo:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to lazy developer.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'saborunayo:mail';
        // TODO: send mail to user
    }
}
