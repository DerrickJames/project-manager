<?php 

namespace App\Http\Controllers\Api\V1;

use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use GrahamCampbell\GitHub\Facades\GitHub;
use GrahamCampbell\GitHub\GitHubManager;

class SyncController extends Controller
{
	protected $github;

	public function __construct(GitHubManager $github)
	{
		$this->github = $github;
		$this->middleware('jwt.auth');
	}

	public function getAllRepos()
	{
		$repos = $this->github->api('user')->repositories(Auth::user()->nickname);

		return response()->json(compact('repos'));
	}
}
