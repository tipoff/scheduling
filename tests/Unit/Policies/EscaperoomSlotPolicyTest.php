<?php

declare(strict_types=1);

namespace Tipoff\Scheduler\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Scheduler\Models\EscaperoomSlot;
use Tipoff\Scheduler\Tests\TestCase;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscaperoomSlotPolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        $user = self::createPermissionedUser('view escape room slots', true);
        $this->assertTrue($user->can('viewAny', EscaperoomSlot::class));

        $user = self::createPermissionedUser('view escape room slots', false);
        $this->assertFalse($user->can('viewAny', EscaperoomSlot::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $slot = EscaperoomSlot::factory()->make([
            'creator_id' => $user,
        ]);

        $this->assertEquals($expected, $user->can($permission, $slot));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => [ 'view', self::createPermissionedUser('view escape room slots', true), true ],
            'view-false' => [ 'view', self::createPermissionedUser('view escape room slots', false), false ],
            'create-true' => [ 'create', self::createPermissionedUser('create escape room slots', true), true ],
            'create-false' => [ 'create', self::createPermissionedUser('create escape room slots', false), false ],
            'update-true' => [ 'update', self::createPermissionedUser('update escape room slots', true), true ],
            'update-false' => [ 'update', self::createPermissionedUser('update escape room slots', false), false ],
            'delete-true' => [ 'delete', self::createPermissionedUser('delete escape room slots', true), true ],
            'delete-false' => [ 'delete', self::createPermissionedUser('delete escape room slots', false), false ],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $slot = EscaperoomSlot::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $slot));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
