<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Aloha\Twilio\TwilioInterface;
use App\Interfaces\Services\GitHubServiceInterface as GitHubService;
use App\Interfaces\Services\UserServiceInterface   as UserService;

class CallToLazyDeveloper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saborunayo:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call to lazy developers.';

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
     * @param TwilioInterface  $twilio
     * @param GitHubService    $gitHubService
     * @param UserService      $userService
     * @return mixed
     */
    public function handle(
        TwilioInterface $twilio,
        GitHubService   $gitHubService,
        UserService     $userService
    ) {
        $users = $userService->getUsers();
        foreach ($users as $user) {
            if (
                !$gitHubService->checkContribution($user->name) &&
                $user->phone_number !== 'tmp' || true
            ) {
                $twilio->call($user->phone_number, function ($message) {
                    $num = rand(1, 2) === 1 ?: 2;
                    $message->play(
                      'http://saborunayo.sota1235.net/sounds/shinchoku'.$num.'.mp3',
                      ['loop' => 2]
                    );
                    sleep(1);
                });
            }
        }
    }
}
