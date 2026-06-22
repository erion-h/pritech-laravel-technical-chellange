<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Realistic comment bodies, so demo data reads like real issue discussion
     * instead of lorem-ipsum text.
     *
     * @var array<int, string>
     */
    private static array $samples = [
        "I can reproduce this on my end too. Happens consistently after the second click.",
        "Looked into this — looks like it's related to the recent dependency update. Investigating further.",
        "This is blocking the release, can we bump the priority?",
        "Fixed in the latest deploy to staging, can someone confirm?",
        "Confirmed fixed on staging, thanks for the quick turnaround!",
        "Adding a screenshot from the affected environment for reference.",
        "Same issue reported by another customer this morning, definitely not isolated.",
        "Should we close this or keep it open until the related PR merges?",
        "I think this might be a duplicate of an older ticket, let me check.",
        "Tested on the latest build, no longer reproducible. Closing.",
        "Can someone with access to production logs check the error rate for this?",
        "This only happens on Safari for me, Chrome and Firefox are fine.",
        "Reassigning to the backend team since this looks like an API issue.",
        "Good catch, I'll have a fix up for review by end of day.",
        "Linked the related pull request above, ready for review.",
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'issue_id' => Issue::factory(),
            'author_name' => fake()->name(),
            'body' => fake()->randomElement(self::$samples),
        ];
    }
}
