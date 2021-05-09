@extends('layouts.admin')

@section('content')
<div class="mt-5 container-fluid">
    <h2>Elutasított befogadási kérések</h2>
    <table class="table mt-3 table-striped">
        <thead>
            <tr>
              <th scope="col">Hirdetés címe</th>
              <th scope="col">Felhasználó név</th>
              <th scope="col">Email</th>
              <th scope="col">Befogadási kérelem időpontja</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
            <tr>
                <td>{{ $request->animal->title }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->user->email }}</td>
                <td>{{ $request->created_at }}</td>
                <td>
                  <button 
                    class="mr-3 btn btn-danger" 
                    data-toggle="modal" 
                    data-target="#{{ $request->id . '-revert-rejection' }}"
                  >
                    Elutasítás visszavonása
                  </button>
                  @include(
                  'partials.modal_confirm', 
                  [
                    'id' => $request->id . '-revert-rejection',
                    'question' => 'Biztosan visszavonod az adoptálás elutasítását? - ' . $request->animal->title,
                    'route' => 'revert.adoption.rejection',
                    'method' => 'PUT',
                    'route_params' => [$request->id],
                    'action_button_text' => 'Elutasítás visszavonása',
                    'action_button_class' => 'btn btn-danger'
                  ])    
                </td>
            </tr>
            @endforeach            
        </tbody>
    </table>
  </div>
  @endsection