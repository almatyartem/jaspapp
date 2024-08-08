<?php

namespace Tests\Feature;

use Exception;
use Faker\Generator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\TestResponse;
use Tests\Feature\Actions\Action;
use Tests\Feature\Actions\Auth\ConfirmEmail;
use Tests\Feature\Actions\Auth\Login;
use Tests\Feature\Actions\Auth\Registration;
use Tests\SteF\Bridge;
use Tests\SteF\Models\BaseResponseDto;
use Tests\SteF\Models\BaseScenario;
use Tests\TestCase;

abstract class ScenarioTest extends TestCase
{
    protected Bridge $bridge;

    protected BaseScenario $scenario;

    protected array $tokensByEmails = [];

    const ADMIN_EMAIL = 'admin@ad.min';

    const ADMIN_PSWD = 'password';

    const MAIN_USER_EMAIL = 'user@us.er';

    const MAIN_USER_PSWD = 'A1password';

    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $pdo = new \PDO(
            'pgsql:host=localhost;port='.config('database.connections.pgsql.port'),
            config('database.connections.pgsql.username'),
            config('database.connections.pgsql.password')
        );
        //$pdo->query('DROP DATABASE IF EXISTS '.config('database.connections.pgsql.database'));
        //$pdo->query('CREATE DATABASE '.config('database.connections.pgsql.database'));
        Artisan::call('migrate:fresh');
        $this->seed();
    }

    protected function rd(string $actionClass, ?string $id = null): ?BaseResponseDto
    {
        return $this->scenario->getResponseDto($actionClass, $id);
    }

    protected function prepare()
    {
        $this->setUp();
        app()->singleton(BaseScenario::class, Scenario::class);

        $this->bridge = new Bridge($this, app());
        //WordService::convertMarkDownToDocx('','');
        $this->setUpFaker();
        $this->scenario = new Scenario($this->bridge);
        $this->scenario->setHeader(
            'Accept',
            'application/json'
        )->setResponseHandlers([
            function (TestResponse $response, Action $action) {
                dump([
                    'Class' => get_class($action),
                    'Code' => $response->getStatusCode(),
                    'Request' => $action->getRequestDto()->data(),
                    'Response' => $action->getResponseDto()->data(),
                ]);
                if ($response->getStatusCode() >= 400) {
                    die('Status code: '.$response->getStatusCode());
                }
            },
        ])->setDefaultResponseDataExtactor(function (TestResponse $response): array {
            try {
                return $response->decodeResponseJson()['data'] ?? [];
            } catch (Exception $exception) {
                return [];
            }
        });
    }

    protected function fullRegistration(bool $mainUser = true): self
    {
        $authData = [
            'name' => $this->getFaker()->name(),
            'email' => $mainUser ? self::MAIN_USER_EMAIL : $this->getFaker()->email(),
            'password' => $mainUser ? self::MAIN_USER_PSWD : 'Aa1'.$this->getFaker()->password(8),
        ];
        $this->scenario
            ->action(Registration::class, $authData)
            ->perform(function () {
                return $this->switchToGuest();
            })
            ->action(ConfirmEmail::class, [
                'user' => $this->rd(Registration::class)?->id,
                'hash' => sha1($this->rd(Registration::class)?->email),
            ])
            ->perform(function () use ($authData) {
                return $this->loginAsUser($authData['email'], $authData['password']);
            });

        return $this;
    }

    protected function loginAsAdmin(): self
    {
        return $this->loginAsUser(self::ADMIN_EMAIL, self::ADMIN_PSWD);
    }

    /**
     * @throws Exception
     */
    protected function loginAsUser(string $email, string $password): self
    {
        $this->scenario
            ->action(Login::class, [
                'email' => $email,
                'password' => $password,
            ]);

        $token = $this->rd(Login::class)?->token;
        if (! $token) {
            throw new Exception('Error while logging in');
        }
        $this->tokensByEmails[$email] = $token;

        return $this->switchToUser($email);
    }

    /**
     * @throws Exception
     */
    protected function switchToUser(string $email): self
    {
        if (! $token = $this->tokensByEmails[$email] ?? null) {
            throw new Exception($email.' => before switch you should login under this user');
        }

        $this->scenario->setAuthToken($token);

        return $this;
    }

    protected function switchToGuest(): self
    {
        $this->scenario->unsetHeader('Authorization');

        return $this;
    }

    protected function switchToSuperAdmin(): self
    {
        if (! ($this->tokensByEmails[self::ADMIN_EMAIL] ?? null)) {
            $this->loginAsAdmin();
        }

        return $this->switchToUser(self::ADMIN_EMAIL);
    }

    /**
     * @throws Exception
     */
    protected function switchToUserAdmin(): self
    {
        if (! ($this->tokensByEmails[self::MAIN_USER_EMAIL] ?? null)) {
            return $this->loginAsUser(self::MAIN_USER_EMAIL, self::MAIN_USER_PSWD);
        }

        return $this->switchToUser(self::MAIN_USER_EMAIL);
    }

    public function getFaker(): Generator
    {
        return $this->faker ? $this->faker() : $this->makeFaker();
    }
}
