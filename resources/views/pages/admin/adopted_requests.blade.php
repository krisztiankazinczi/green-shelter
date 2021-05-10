@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Befogadások</h2>

     <div class="row" style="margin-top: 20px;">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Befogadások utolsó 7 napban</span>
              <span class="info-box-number">{{ $adoptionsLast7Days }}</span>
            </div> 
          </div> 
        </div> 
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"></span>
            <div class="info-box-content">
              <span class="info-box-text">Befogadások utolsó 30 napban</span>
              <span class="info-box-number">{{ $adoptionsLast30Days }}</span>
            </div> 
          </div> 
        </div> 
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"></span>
            <div class="info-box-content">
              <span class="info-box-text">Befogadások az elmúlt évben</span>
              <span class="info-box-number">{{ $adoptionsLast365Days }}</span>
            </div> 
          </div> 
        </div> 
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"></span>
            <div class="info-box-content">
              <span class="info-box-text">Összes befogadás</span>
              <span class="info-box-number">{{ $allAdoptions }}</span>
            </div> 
          </div> 
        </div> 
    </div>

<div class="table-responsive">
    <table class="table mt-3 table-striped">
        <thead>
            <tr>
              <th scope="col">Hirdetés címe</th>
              <th scope="col">Felhasználó név</th>
              <th scope="col">Email</th>
              <th scope="col">Befogadás időpontja</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
            <tr>
                <td>{{ $request->animal->title }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->user->email }}</td>
                <td>{{ $request->updated_at }}</td>
                <td>
                  <p 
                    class="mr-3 btn btn-link" 
                    data-toggle="modal" 
                    data-target="#{{ $request->id . '-adoption-revert' }}"
                  >
                    Befogadás visszavonása
                  </p>
                  @include(
                  'partials.modal_confirm', 
                  [
                    'id' => $request->id . '-adoption-revert',
                    'question' => 'Biztosan visszavonod a következő állat befogadását? - ' . $request->animal->title,
                    'route' => 'revert.adoption',
                    'method' => 'PUT',
                    'route_params' => [$request->id],
                    'action_button_text' => 'Befogadás visszavonása',
                    'action_button_class' => 'btn btn-danger'
                  ])    
                </td>
            </tr>
            @endforeach            
        </tbody>
    </table>
  </div>
</div>
@endsection