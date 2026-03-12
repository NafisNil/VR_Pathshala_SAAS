<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Benefit;
use App\Models\FeatureTopic;
use App\Models\Objective;
use App\Models\Mission;
use App\Models\Vision;
use App\Models\QuestLink;
use App\Models\Contact;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
class FrontendController extends Controller
{
    //
    public function index()
    {
        $data['sliders'] = Slider::latest()->first();
        $data['benefits'] = Benefit::latest()->get();
        $data['feature_topics'] = FeatureTopic::latest()->limit(6)->get();
        $data['objectives'] = Objective::latest()->first();
        $data['missions'] = Mission::latest()->first();
        $data['quest_links'] = QuestLink::latest()->first();
        $data['subscription'] = Subscription::where('user_id', Auth::id())->latest()->first();
        $data['plan'] = Plan::get();
        return view('frontend.index', $data);
    }

    public function featureTopics()
    {
        $data['feature_topics'] = FeatureTopic::latest()->get();
        $data['objectives'] = Objective::latest()->first();
        return view('frontend.feature_topics', $data);
    }

    public function abouts()
    {
        $data['objectives'] = Objective::latest()->first();
        $data['missions'] = Mission::latest()->first();
        $data['visions'] = Vision::latest()->first();
        return view('frontend.abouts', $data);
    }

    public function contact()
    {
         $data['objectives'] = Objective::latest()->first();
        $data['contacts'] = Contact::latest()->first();
        return view('frontend.contact', $data);
    }
}
