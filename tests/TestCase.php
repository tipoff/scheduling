<?php

declare(strict_types=1);

namespace Tipoff\Scheduler\Tests;

use DrewRoberts\Blog\BlogServiceProvider;
use DrewRoberts\Media\MediaServiceProvider;
use Laravel\Nova\NovaCoreServiceProvider;
use Livewire\LivewireServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Bookings\BookingsServiceProvider;
use Tipoff\EscapeRoom\EscapeRoomServiceProvider;
use Tipoff\Locations\LocationsServiceProvider;
use Tipoff\Scheduler\SchedulerServiceProvider;
use Tipoff\Seo\SeoServiceProvider;
use Tipoff\Statuses\StatusesServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;
use Tipoff\TestSupport\Providers\NovaPackageServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
            SupportServiceProvider::class,
            PermissionServiceProvider::class,
            AuthorizationServiceProvider::class,
            LivewireServiceProvider::class,
            AddressesServiceProvider::class,
            MediaServiceProvider::class,
            SeoServiceProvider::class,
            BlogServiceProvider::class,
            LocationsServiceProvider::class,
            EscapeRoomServiceProvider::class,
            BookingsServiceProvider::class,
            StatusesServiceProvider::class,
            BookingsServiceProvider::class,
            SchedulerServiceProvider::class,
        ];
    }
}
