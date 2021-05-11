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

    public function adoptions($type, $days) {
        $acceptable_types = array('requested', 'rejected', 'adopted');
        if (!in_array($type, $acceptable_types)) {
            return redirect('home')->with('error', 'Nem megfelelő típus');
        }
        $last7DaysCount = $this->adoption->filteredAdoptionsByDays($type, 7);
        $last30DaysCount = $this->adoption->filteredAdoptionsByDays($type, 30);
        $last365DaysCount = $this->adoption->filteredAdoptionsByDays($type, 365);
        $allCount = $this->adoption->allAdoptionsByType($type);
        $requests = Adoption::with('animal', 'user')->where('status', $type)->get();
        $title = $type == 'requested' ? 'Befogadási Kérések' : $type == 'adopted' ? 'Befogadások' : 'Elutasított befogadási kérések';
        $page = $type == 'requested' ? 'pages.admin.adoption_requests' : $type == 'adopted' ? 'pages.admin.adopted_requests' : 'pages.admin.rejected_requests';
        return view($page, compact(
            'requests', 
            'last7DaysCount', 
            'last30DaysCount', 
            'last365DaysCount', 
            'allCount',
            'title'
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
