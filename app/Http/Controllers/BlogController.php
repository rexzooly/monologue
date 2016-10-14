<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\User;
use App\Tag;

class BlogController extends Controller
{
    /**
     * Show the most recent published posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index', [
            'feed' => action('RSSController@index'),
            'posts' => Post::whereNotNull('published_at')
                    ->orderBy('published_at', 'desc')
                    ->paginate(env('POSTS_PER_PAGE'))
        ]);
    }

    /**
     * Queries the post list by specified tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function byTag(Tag $tag)
    {
        return view('blog.index', [
            'tag' => $tag,
            'feed' => action('RSSController@byTag', [$tag->slug]),
            'posts' => $tag->posts()
                    ->whereNotNull('published_at')
                    ->orderBy('published_at', 'desc')
                    ->paginate(env('POSTS_PER_PAGE'))
        ]);
    }

    /**
     * Queries the post list by specified user.
     *
     * @return \Illuminate\Http\Response
     */
    public function byUser(User $user)
    {
        return view('blog.index', [
            'user' => $user,
            'feed' => action('RSSController@byUser', [$user->name]),
            'posts' => $user->posts()
                    ->whereNotNull('published_at')
                    ->orderBy('published_at', 'desc')
                    ->paginate(env('POSTS_PER_PAGE'))
        ]);
    }

    /**
     * Queries the post list by specified year.
     *
     * @return \Illuminate\Http\Response
     */
    public function byYear($year)
    {
        return view('blog.index', [
            'feed' => action('RSSController@byYear', [$year]),
            'posts' => Post::whereNotNull('published_at')
                    ->whereYear('published_at', '=', $year)
                    ->orderBy('published_at', 'desc')
                    ->paginate(env('POSTS_PER_PAGE'))
        ]);
    }

    /**
     * Queries the post list by specified year and month.
     *
     * @return \Illuminate\Http\Response
     */
    public function byMonth($year, $month)
    {
        return view('blog.index', [
            'feed' => action('RSSController@byMonth', [$year, $month]),
            'posts' => Post::whereNotNull('published_at')
                    ->whereYear('published_at', '=', $year)
                    ->whereMonth('published_at', '=', $month)
                    ->orderBy('published_at', 'desc')
                    ->paginate(env('POSTS_PER_PAGE'))
        ]);
    }
}
