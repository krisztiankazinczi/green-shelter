@extends('layouts.admin')

@section('content')
<div class="mt-5 container-fluid">
    <h2>{{ $title }}</h2>

    @include('partials.admin.adoption_info_boxes', [
      'firstBoxText' => 'Utolsó 7 napban',
      'secondBoxText' => 'Utolsó 30 napban',
      'thirdBoxText' => 'Utolsó 365 napban',
      'fourthBoxText' => 'Összes',
      'last7DaysCount' => $last7DaysCount,
      'last30DaysCount' => $last30DaysCount,
      'last365DaysCount' => $last365DaysCount,
      'allCount' => $allCount,
    ])

  <div class="table-responsive" style="margin-top: 30px;">
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
</div>
@endsection