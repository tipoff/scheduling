<?php

declare(strict_types=1);

namespace Tipoff\Scheduler;

use Tipoff\Scheduler\Models\Block;
use Tipoff\Scheduler\Models\Game;
use Tipoff\Scheduler\Models\RecurringSchedule;
use Tipoff\Scheduler\Models\ScheduleEraser;
use Tipoff\Scheduler\Models\Slot;
use Tipoff\Scheduler\Policies\BlockPolicy;
use Tipoff\Scheduler\Policies\GamePolicy;
use Tipoff\Scheduler\Policies\RecurringSchedulePolicy;
use Tipoff\Scheduler\Policies\ScheduleEraserPolicy;
use Tipoff\Scheduler\Policies\SlotPolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class SchedulerServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Block::class => BlockPolicy::class,
                Game::class => GamePolicy::class,
                RecurringSchedule::class => RecurringSchedulePolicy::class,
                ScheduleEraser::class => ScheduleEraserPolicy::class,
                Slot::class => SlotPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\Scheduler\Nova\Block::class,
                \Tipoff\Scheduler\Nova\Game::class,
                \Tipoff\Scheduler\Nova\RecurringSchedule::class,
                \Tipoff\Scheduler\Nova\ScheduleEraser::class,
                \Tipoff\Scheduler\Nova\Slot::class,
            ])
            ->name('scheduler')
            ->hasConfigFile();
    }
}
