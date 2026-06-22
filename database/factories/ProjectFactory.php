<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Realistic project names paired with a matching description, so demo data
     * reads like real product/engineering projects instead of buzzword mashups.
     *
     * @var array<int, array{name: string, description: string}>
     */
    private static array $samples = [
        ['name' => 'Customer Portal Redesign', 'description' => 'Refresh the customer-facing portal with a new design system, improved navigation, and faster page loads.'],
        ['name' => 'Mobile App Rewrite', 'description' => 'Rebuild the mobile app on a modern cross-platform framework to fix long-standing performance and stability issues.'],
        ['name' => 'Billing System Migration', 'description' => 'Move billing and invoicing off the legacy provider onto the new payment platform with minimal customer disruption.'],
        ['name' => 'Internal Admin Dashboard', 'description' => 'Build an internal tool for support staff to view customer accounts, resolve tickets, and manage subscriptions.'],
        ['name' => 'API v2 Rollout', 'description' => 'Design and ship the next major version of the public API, including better pagination, filtering, and webhooks.'],
        ['name' => 'Onboarding Flow Improvements', 'description' => 'Reduce drop-off during signup by simplifying the onboarding steps and adding inline guidance for new users.'],
        ['name' => 'Notification System Overhaul', 'description' => 'Consolidate email, SMS, and in-app notifications into a single configurable preference center for users.'],
        ['name' => 'Performance Optimization Sprint', 'description' => 'Cross-team effort to reduce page load times and database query counts across the highest-traffic pages.'],
        ['name' => 'Search Infrastructure Upgrade', 'description' => 'Replace the current search backend with a faster, more relevant full-text search engine.'],
        ['name' => 'Accessibility Compliance Project', 'description' => 'Audit and fix accessibility issues across the app to meet WCAG 2.1 AA standards.'],
        ['name' => 'Self-Service Reporting Tool', 'description' => 'Give customers the ability to build and export their own usage reports without contacting support.'],
        ['name' => 'Authentication & SSO Support', 'description' => 'Add single sign-on support for enterprise customers, including SAML and OAuth-based identity providers.'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sample = fake()->randomElement(self::$samples);

        return [
            'user_id' => User::factory(),
            'name' => $sample['name'],
            'description' => $sample['description'],
            'start_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'deadline' => fake()->dateTimeBetween('now', '+3 months'),
        ];
    }
}
