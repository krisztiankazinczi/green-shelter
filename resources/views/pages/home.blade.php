@extends('layouts.index')

@section('title', 'Kezdőlap')

@section('content')
  <div class="jumbotron jumbotron-fluid home-jumbotron" style="margin-bottom: 0; background: url({{ URL::to('/') . '/images/home_banner.jpg' }}) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 80vh;">
        <div class="d-flex justify-content-center align-items-center position-relative">
            <div class="p-3 w-50 home-jumbotron-text" style="transform: skew(15deg);">
              <h1 class="text-white display-3 pl-3" style="transform: skew(-15deg);">Zöld Menedék Állatvédő Alapítvány</h1>
              <h5 class="text-white pl-3" style="transform: skew(-15deg);">Kiemelten Közhasznú szervezet</h5>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center gray-bg-color">
    
      <h1 class="mb-4 text-center display-4 home-main-titles">Az örökbefogadás menete az oldalon</h1>

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

          <div class="timeline-container primary">
            <div class="timeline-icon bg-secondary">
                <i class="far fa-envelope"></i>
            </div>
            <div class="timeline-body bg-dark">
                <h4 class="timeline-title"><span class="p-1 text-white rounded bg-secondary badge">2. Felvenni a kapcsolatot a hirdetővel</span></h4>
                <p class="text-justify timeline-text">Ha találtatok egy szimpatikus kisállatot, jelentkezzetek be az oldalra. Ezután minden egyes hirdetésen megjelenik egy üzenetküldő ikon. Arra kattintva írhattok üzenetet a hirdetés feladójának, vagy nekünk abban az esetben ha mi tettük fel a hirdetést.</p>
            </div>
          </div>

          <div class="timeline-container primary">
            <div class="timeline-icon bg-info">
                <i class="fas fa-mail-bulk"></i>
            </div>
            <div class="timeline-body bg-dark">
                <h4 class="timeline-title"><span class="p-1 text-white rounded bg-info badge">3. Kérdések megvitatása</span></h4>
                <p class="text-justify timeline-text">A hirdetés feladója válaszolni fog az üzenetre, amit megkapsz az oldal levelező rendszerében, amiről email értesítést is küld a rendszer automatikusan. Az oldal levelező rendszerén keresztül, vagy akár más módon is megbeszélhetitek az összes felmerülő kérdést.</p>
            </div>
          </div>

          <div class="timeline-container primary">
            <div class="timeline-icon bg-danger">
                <i class="far fa-thumbs-up"></i>
            </div>
            <div class="timeline-body bg-dark">
                <h4 class="timeline-title"><span class="p-1 text-white rounded bg-danger badge">4. Örökbefogadás kérvényezése</span></h4>
                <p class="text-justify timeline-text">Ha minden kérdésre megkaptad a választ és örökbe szeretnéd fogadni az állatot, kérvényezned kell az örökbefogadást az oldalon. Nyisd meg az adott hirdetést és kattints a befogadás gombra. Ekkor értesítést kapunk a rendszertől. Abban az esetben ha mi tettük fel a hirdetést, akkor tudni fogunk a részletekről. Ha viszont egy magánszemély hirdetéséről vann szó, akkor keresni fogunk mindkettőtöket és megbeszéljük a részleteket. </p>
            </div>
          </div>

          <div class="timeline-container primary">
            <div class="timeline-icon bg-success">
                <i class="far fa-check-circle"></i>
            </div>
            <div class="timeline-body bg-dark">
                <h4 class="timeline-title"><span class="p-1 text-white rounded bg-success badge">5. Örökbefogadás jóváhagyása</span></h4>
                <p class="text-justify timeline-text">Ha minden állami előírásnak megfelsz, akkor jóváhagyjuk az örökbefogadást és elkezdjük az ügyintézést. Ezután jogosulttá válsz, hogy írj rólunk véleményt, amiért nagyon hálásak lennénk.</p>
            </div>
          </div>

        </div>
      </div>
  </div>
      <h1 class="mb-5 text-center display-4 home-main-titles">Fontos információk</h1>

      <div class="mb-5 d-flex justify-content-around poster-container">
        <a href="/images/rendelkezo.pdf" target="_blank">
          <img src="/images/ado_1_szazalek.jpg">
        </a>
        <img title="Támogassa a bővítést" src="/images/kerites-plakat.jpg" alt="Támogassa a bővítést">
      </div>

      <div class="pt-1 gray-bg-color">
        <h1 class="mb-5 text-center display-4 home-main-titles">Örökbefogadás előtt nézd meg</h1>
        <div class="pb-5 d-flex justify-content-around">
          <iframe src="http://www.youtube.com/embed/-e2Mdq7ucYg" width="560" height="315" frameborder="0"></iframe>
        </div>
      </div>
    
@endsection