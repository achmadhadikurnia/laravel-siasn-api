<?php

namespace Kanekescom\Siasn\Api\Commands;

use Illuminate\Console\Command;
use Kanekescom\Siasn\Api\Credentials\Sso;
use Kanekescom\Siasn\Api\Credentials\Token;

class GenerateSsoTokenCommand extends Command
{
    protected $signature = 'siasn:sso-token
                            {--fresh : Always request new token}';

    protected $description = 'Generate SSO Token';

    public function handle(): int
    {
        if ($this->option('fresh')) {
            $token = Sso::getToken()->object();
        } else {
            $token = Token::getSsoToken();
        }

        $this->info(json_encode($token, JSON_PRETTY_PRINT));

        return self::SUCCESS;
    }
}
