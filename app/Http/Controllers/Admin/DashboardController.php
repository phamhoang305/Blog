<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Analytics;
use Spatie\Analytics\Period;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Contact\ContactRepository;
use DB;
class DashboardController extends Controller
{

    public function index(Request $request)
    {
        SEOTools::setTitle("Bảng điều khiển");
        SEOTools::opengraph()->setUrl(\URL::current());
        $rpuser = new UsersRepository();
        $users = $rpuser->getListUserDasboard(8);
        $rpcontact = new ContactRepository();
        $contacts = $rpcontact->getListContractDasboard(6);
        // dd(config('analytics'));
        // $pages = Analytics::fetchMostVisitedPages(Period::days(1));
        $sessions = DB::table('sessions')->limit(10)->get();
        return view("admin.pages.dashboard.index",['users'=>$users,'contacts'=>$contacts,'sessions'=>$sessions]);
    }
}
