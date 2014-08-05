<?

use App\Models\OauthClient;
use App\Models\OauthClientEndpoint;

class AdminController extends BaseController {

	public function index()
	{
		$user = Sentry::getUser();

		$clients = OauthClient::all();

		return View::make('admin.index', array('user' => $user, 'clients' => $clients));
	}
}