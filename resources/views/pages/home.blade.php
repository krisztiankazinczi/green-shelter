@extends('layouts.index')

@section('title', 'Kezdőlap')

@section('content')
  <div class="jumbotron jumbotron-fluid" style="background: url({{ URL::to('/') . '/images/home_banner.jpg' }}) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 70vh;">
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
            <div class="w-50">
              <h1 class="display-3">Zöld Menedék Állatvédő Alapítvány</h1>
              <h5>Kiemelten Közhasznú szervezet</h5>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center gray-bg-color">
    
      <div class="home-timeline-container">
        <div class="timeline">
          <div class="timeline-container primary">
            <div class="timeline-icon bg-primary">
                <i class="fas fa-search"></i>
            </div>
            <div class="timeline-body bg-dark">
                <h4 class="timeline-title"><span class="p-1 text-white rounded bg-primary badge">1. Böngészés az oldalon</span></h4>
                <p class="text-justify timeline-text">A gazdira váró állatok menüponton belül 5 különböző almenüben lehet a hirdetések között keresgélni. Ha szeretnétek gazdit találni egy kisállatnak, feladhattok hirdetéseket magatok is. Ehhez be kell jelentkeznetek az oldalra és a menüben látni fogjátok hol adhattok fel hirdetést. Ha az állatfajta még nem létezik az oldalunkon, kérünk írjatok nekünk és hozzáadjuk a rendszerhez. </p>
            </div>
        </div>
      </div>




        <a href="http://localhost:8000/images/rendelkezo.pdf" target="_blank">
        <img src="http://localhost:8000/images/ado_1_szazalek.jpg">
        </a>
        <p></p>
        <iframe src="http://www.youtube.com/embed/-e2Mdq7ucYg" width="560" height="315" frameborder="0"></iframe>
        <p></p>
          <img title="Támogassa a bővítést" src="http://localhost:8000/images/kerites-plakat.jpg" alt="Támogassa a bővítést" width="530" height="750">
    </div>

@endsection