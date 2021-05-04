@extends('layouts.index')

@section('title', 'Kezdőlap')

@section('content')
  <div class="jumbotron jumbotron-fluid" style="background: url({{ URL::to('/') . '/images/home_banner.jpg' }}) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 90vh;">
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
            <div class="w-50">
              <h1 class="text-center">Üdvözöljük!</h1>
              <h3><p>Alapítványunk 1993-ban alakult. Legfőbb feladatunk a menhely fenntartása és működtetése. 
              Kb 300 - 320 kutya és 60 - 80 cica napi ellátásáról (etetés, állatorvos, oltások) gondoskodunk. 
              A körzetben jelentős a szerepünk. Nyilvántartást vezetünk a talált és az elveszett állatokról.
              Legfőbb nehézségeink a kutyák gazdához kihelyezése és az anyagiak megteremtése. 
              Folyamatosan frissítjük az oldalunkat, mégis a személyes látogatást javasoljuk a felelősségteljes kiválasztáshoz.
              Nagyon szeretnénk, ha a kutyáink sorsa jóra fordulna és szerető családra találnának.<br></p></h3>
              <h4>
              <p><b>Keresünk aktivistákat</b> kétkezi munkára, állatvédő feladatokra, az örökbe adott kutyusok meglátogatására, 
              ivartalanítás ellenőrzésére és gazdit kereső rendezvényekre!<br></p>

              <p><b>Hálásan köszönjük</b>, ha állatorvosok jelentkeznek orvosi munkák elvégzésére. Szeretnénk az ivartalanító műtétek
               számát optimális szintre emelni.<br></p>

              <p><b>Szívesen fogadunk</b> száraz kenyeret, állateledelt, faforgácsot, tisztítószert, tisztítóeszközöket, gumikesztyűt,
               építőanyagot a menhely támogatására.<br></p>
              </h4>
              <a href="http://localhost:8000/images/rendelkezo.pdf" target="_blank">
              <img src="http://localhost:8000/images/ado_1_szazalek.jpg">
              </a>
              <p></p>
              <iframe src="http://www.youtube.com/embed/-e2Mdq7ucYg" width="560" height="315" frameborder="0"></iframe>
              <p></p>
                <img title="Támogassa a bővítést" src="http://localhost:8000/images/kerites-plakat.jpg" alt="Támogassa a bővítést" width="530" height="750">

            </div>
        </div>
    </div>
@endsection