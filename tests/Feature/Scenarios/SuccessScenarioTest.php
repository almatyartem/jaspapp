<?php

namespace Tests\Feature\Scenarios;

use Tests\Feature\ScenarioTest;

class SuccessScenarioTest extends ScenarioTest
{
    public function testScenario()
    {
        $this->prepare();

        $this
            ->loginAsAdmin()
            ->typesCrud()
            ->fullRegistration();

        $this->assertTrue(true);
    }

    public function typesCrud()
    {
        $this->scenario;

        return $this;
    }
}
