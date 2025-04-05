<?php

namespace Tests\Unit;

use App\Events\UserSaved;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveUserBackgroundInformationTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;
    protected $listener;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->createMock(UserService::class);
        $this->listener = new \App\Listeners\SaveUserBackgroundInformation($this->userService);
    }

    /** @test */
    public function it_calls_user_service_to_save_details()
    {
        $user = User::factory()->create();

        $this->userService->expects($this->once())
            ->method('saveUserDetails')
            ->with($user);

        $event = new UserSaved($user);
        $this->listener->handle($event);
    }
}
