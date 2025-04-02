<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReply;
use App\Models\Plant;
use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        if (auth()->user()->email !== 'louisreynard919@gmail.com' && auth()->user()->email !== 'matdinville@gmail.com') {
            return view('dashboard');
        }

        $usersCount = User::count();
        $plantsCount = Plant::count();
        $tasksCount = Task::count();
        $forumPostsCount = ForumPost::count();
        $repliesCount = ForumReply::count();

        return view('admin.index', [
            'users' => User::latest()->paginate(10), // pagination ici
            'usersCount' => $usersCount,
            'plantsCount' => $plantsCount,
            'tasksCount' => $tasksCount,
            'forumPostsCount' => $forumPostsCount,
            'repliesCount' => $repliesCount,
        ]);
    }
}
