<?php

namespace Database\Factories;

use App\Models\Issue;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Realistic issue titles paired with a matching description, so the demo data
     * reads like real bug reports/feature requests instead of lorem-ipsum text.
     *
     * @var array<int, array{title: string, description: string}>
     */
    private static array $samples = [
        ['title' => 'Login button unresponsive on mobile Safari', 'description' => 'Tapping the login button on iOS Safari does nothing on the first tap. Works fine on the second tap. Likely a touch event handling issue.'],
        ['title' => 'Add dark mode toggle to settings page', 'description' => 'Users have requested a dark mode option. Add a toggle in account settings that persists the preference across sessions.'],
        ['title' => 'Password reset email never arrives', 'description' => 'Several users reported never receiving the password reset email. Need to check the mail queue and spam filtering rules.'],
        ['title' => 'Dashboard chart fails to render on Firefox', 'description' => 'The analytics chart on the dashboard throws a console error and renders blank in Firefox, but works correctly in Chrome.'],
        ['title' => 'Export to CSV truncates long descriptions', 'description' => 'When exporting issues to CSV, any description longer than 255 characters gets cut off. The export should not truncate field values.'],
        ['title' => 'Add pagination to the activity log', 'description' => 'The activity log currently loads every entry at once, which is slow for projects with a long history. Add pagination or infinite scroll.'],
        ['title' => 'Duplicate notifications sent for the same comment', 'description' => 'Users are getting two email notifications for a single new comment. Looks like the notification listener might be registered twice.'],
        ['title' => 'Improve error message when uploading oversized files', 'description' => 'Right now uploading a file over the size limit just fails silently. Show a clear error message stating the max allowed file size.'],
        ['title' => 'Search does not match partial words', 'description' => 'Searching for "log" does not return issues containing "login" or "logging". Search should support partial word matches.'],
        ['title' => 'Timezone mismatch on due dates', 'description' => 'Due dates are displayed in UTC instead of the user\'s local timezone, causing confusion about actual deadlines.'],
        ['title' => 'Add bulk status update for selected issues', 'description' => 'Allow selecting multiple issues from the list and updating their status in one action instead of editing each individually.'],
        ['title' => 'Broken layout on tablet screen sizes', 'description' => 'The sidebar overlaps the main content area on tablet-sized viewports between 768px and 1024px wide.'],
        ['title' => 'API rate limiting returns unclear error', 'description' => 'When the API rate limit is hit, the response body is empty. It should include a clear message and a Retry-After header.'],
        ['title' => 'Slow query on the issues index page', 'description' => 'The issues list takes over 3 seconds to load once a project has more than a few hundred issues. Likely missing an index or N+1 query.'],
        ['title' => 'Allow attaching multiple tags at once', 'description' => 'Currently tags can only be attached one at a time. Add a multi-select option to attach several tags in a single action.'],
        ['title' => 'Comment timestamps show wrong relative time', 'description' => 'A comment posted seconds ago shows as "5 hours ago" until the page is refreshed. The relative time is not updating correctly.'],
        ['title' => 'Add keyboard shortcut to create a new issue', 'description' => 'Power users have asked for a keyboard shortcut (e.g. "c") to quickly open the new issue form from anywhere in the app.'],
        ['title' => 'Project deletion does not confirm cascading deletes', 'description' => 'Deleting a project silently removes all of its issues and comments. The confirmation dialog should mention this explicitly.'],
        ['title' => 'Inconsistent button styles across pages', 'description' => 'Primary action buttons use different colors and padding on the projects page versus the issues page. Needs a consistent style.'],
        ['title' => 'Member assignment dropdown is not searchable', 'description' => 'Projects with many team members have a long, unsearchable dropdown when assigning members to an issue. Add a search/filter input.'],
        ['title' => 'Due date picker allows selecting past dates', 'description' => 'The due date field accepts dates in the past without any warning, which does not make sense for an open issue.'],
        ['title' => 'Tag colors are hard to read with light text', 'description' => 'Some tag background colors are too light, making the tag name difficult to read. Need better contrast or auto text color.'],
        ['title' => 'Add a "my issues" filter for assigned member', 'description' => 'Members would like a quick filter to see only the issues currently assigned to them across all projects.'],
        ['title' => 'Session expires unexpectedly during long edits', 'description' => 'Users editing a long issue description sometimes get logged out mid-edit and lose their unsaved changes.'],
        ['title' => 'Add issue priority icons next to title', 'description' => 'It is hard to scan priority at a glance in the list view. Add a small icon or color indicator next to high priority issue titles.'],
        ['title' => 'Closed issues still appear in default filter', 'description' => 'The default issues list still shows closed issues mixed in with open ones, making it harder to see what needs attention.'],
        ['title' => 'Comment box loses focus after submitting', 'description' => 'After posting a comment, focus moves away from the textarea, requiring an extra click to write a follow-up comment.'],
        ['title' => 'Add support for markdown in comments', 'description' => 'Comments are plain text only. Basic markdown support (bold, lists, code blocks) would make technical discussions easier to follow.'],
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
            'project_id' => Project::factory(),
            'title' => $sample['title'],
            'description' => $sample['description'],
            'status' => fake()->randomElement(['open', 'in_progress', 'closed']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'due_date' => fake()->optional(0.7)->dateTimeBetween('now', '+2 months'),
        ];
    }
}
