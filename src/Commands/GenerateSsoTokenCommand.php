<?php

namespace Kanekescom\Siasn\Api\Commands;

use Exception;
use Illuminate\Console\Command;
use Kanekescom\Siasn\Api\Credentials\Token;

class GenerateSsoTokenCommand extends Command
{
    protected $signature = 'siasn:sso-token
                            {--fresh : Always request a new token}';

    protected $description = 'Generate an SSO Token';

    public function handle(): int
    {
        try {
            $token = $this->option('fresh') ? Token::getNewSsoToken() : Token::getSsoToken();
            $this->info(json_encode($token, JSON_PRETTY_PRINT));

            return self::SUCCESS;
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
