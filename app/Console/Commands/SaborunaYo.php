<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Interfaces\Services\YoServiceInterface as YoService;

class SaborunaYo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saborunayo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Yo to user who is "sabotteru"';

    /** @var YoService */
    protected $yoService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(YoService $yoService)
    {
        parent::__construct();
        $this->yoService = $yoService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->yoService->sendYo();
    }
}
