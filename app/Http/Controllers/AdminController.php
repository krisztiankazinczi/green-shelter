<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;
use App\Models\AnimalType;
use App\Models\ContactForm;
use Jenssegers\Date\Date;

class AdminController extends Controller
{
    protected $adoption;

    public function __construct()
    {
        Date::setLocale('hu');
        $this->adoption = new Adoption();
    }

    public function index() {
        return view('pages/admin');
    }

    public function adoptions($type) {
        if ($type != 'requested' && $type != 'adopted' && $type != 'rejected') {
            return redirect('home')->with('error', 'Nem megfelelő típus');
        }
        $requests = Adoption::with('animal', 'user')->where('status', $type)->get();
        return view('pages/admin', compact('requests'));
    }

    public function adoptionRequests() {
        $adoption = new Adoption();
        $requestedAdoptionsLast7Days = $adoption->requestedAdoptionsLastWeek();
        $requestedAdoptionsLast30Days = $adoption->requestedAdoptionsLastMonth();
        $requestedAdoptionsLast365Days = $adoption->requestedAdoptionsLastYear();
        $allRequestedAdoptions = $adoption->requestedAdoptionsAllTime();
        $requests = Adoption::with('animal', 'user')->where('status', 'requested')->get();
        return view('pages.admin.adoption_requests', compact(
            'requests', 
            'requestedAdoptionsLast7Days', 
            'requestedAdoptionsLast30Days', 
            'requestedAdoptionsLast365Days', 
            'allRequestedAdoptions'
        ));
    }

    public function adoptedAnimals() {
        $adoption = new Adoption();
        $adoptionsLast7Days = $adoption->adoptionsLastWeek();
        $adoptionsLast30Days = $adoption->adoptionsLastMonth();
        $adoptionsLast365Days = $adoption->adoptionsLastYear();
        $allAdoptions = $adoption->adoptionsAllTime();
        $requests = Adoption::with('animal', 'user')->where('status', 'adopted')->get();
        return view('pages.admin.adopted_requests', compact(
            'requests', 
            'adoptionsLast7Days', 
            'adoptionsLast30Days', 
            'adoptionsLast365Days', 
            'allAdoptions'
        ));
    }

    public function rejectedAdoptionRequests() {
        $adoption = new Adoption();
        $rejectedAdoptionsLast7Days = $adoption->rejectedAdoptionsLastWeek();
        $rejectedAdoptionsLast30Days = $adoption->rejectedAdoptionsLastMonth();
        $rejectedAdoptionsLast365Days = $adoption->rejectedAdoptionsLastYear();
        $allRejectedAdoptions = $adoption->rejectedAdoptionsAllTime();
        $requests = Adoption::with('animal', 'user')->where('status', 'rejected')->get();
        return view('pages.admin.rejected_requests', compact(
            'requests', 
            'rejectedAdoptionsLast7Days', 
            'rejectedAdoptionsLast30Days', 
            'rejectedAdoptionsLast365Days', 
            'allRejectedAdoptions'
        ));
    }

    public function createSpecies() {
        return view('pages/admin');
    }

    public function animalTypes() {
        $animal_types = AnimalType::all();
        return view('pages/admin', compact('animal_types'));
    }

    public function contactMessages() {
        $contact_messages = ContactForm::orderBy('created_at', 'DESC')->get();
        return view('pages/admin', compact('contact_messages'));
    }
}
