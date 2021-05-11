@extends('layouts.admin')

@section('content')
<div class="container-fluid">
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