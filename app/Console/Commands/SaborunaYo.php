<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Interfaces\Services\YoServiceInterface     as YoService;
use App\Interfaces\Services\UserServiceInterface   as UserService;
use App\Interfaces\Services\GitHubServiceInterface as GitHubService;

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

    /** @var UserService */
    protected $userService;

    /** @var GitHubService */
    protected $gitHubService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(YoService $yoService, UserService $userService, GitHubService $gitHubService)
    {
        parent::__construct();
        $this->yoService     = $yoService;
        $this->userService   = $userService;
        $this->gitHubService = $gitHubService;
   }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->userService->getUsers();
        foreach ($users as $user) {
            echo 'GitHub name: '.$user->github_name." checking\n";
            if (!$this->gitHubService->checkContribution($user->github_name)) {
                $this->yoService->sendYo($user->yo_name);
                \Log::info('GitHub name: '.$user->github_name.' is lazy person');
            }
        }
    }
}
