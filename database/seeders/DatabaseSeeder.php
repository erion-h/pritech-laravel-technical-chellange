<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $alice = User::factory()->create([
            'name' => 'Alice Owner',
            'email' => 'alice@example.com',
            'password' => bcrypt('password'),
        ]);

        $bob = User::factory()->create([
            'name' => 'Bob Owner',
            'email' => 'bob@example.com',
            'password' => bcrypt('password'),
        ]);

        $members = User::factory(6)->create();
        $allUsers = $members->push($alice, $bob);

        $tags = collect(['bug', 'feature', 'enhancement', 'urgent', 'docs', 'wontfix'])
            ->map(fn (string $name) => Tag::factory()->create(['name' => $name]));

        $statuses = ['open', 'in_progress', 'closed'];
        $priorities = ['low', 'medium', 'high'];

        foreach ([$alice, $bob] as $owner) {
            Project::factory(3)->create(['user_id' => $owner->id])->each(function (Project $project) use ($tags, $allUsers, $statuses, $priorities) {
                foreach ($statuses as $status) {
                    foreach ($priorities as $priority) {
                        $issue = Issue::factory()->create([
                            'project_id' => $project->id,
                            'status' => $status,
                            'priority' => $priority,
                        ]);

                        $issue->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
                        $issue->members()->attach($allUsers->random(rand(0, 3))->pluck('id'));
                        Comment::factory(rand(0, 4))->create(['issue_id' => $issue->id]);
                    }
                }

                Issue::factory(3)->create(['project_id' => $project->id])->each(function (Issue $issue) use ($tags, $allUsers) {
                    $issue->tags()->attach($tags->random(rand(0, 2))->pluck('id'));
                    $issue->members()->attach($allUsers->random(rand(0, 2))->pluck('id'));
                    Comment::factory(rand(0, 3))->create(['issue_id' => $issue->id]);
                });
            });
        }
    }
}
