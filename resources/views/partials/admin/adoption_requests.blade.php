<div class="mt-5 container-fluid">
    <h2>{{ $title }}</h2>
    <table class="table mt-3">
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
                    class="mr-3 btn btn-success" 
                    data-toggle="modal" 
                    data-target="#{{ $request->id . '-adoption-request' }}"
                  >
                    Jóváhagyás
                  </button>
                  @include(
                  'partials.modal_confirm', 
                  [
                    'id' => $request->id . '-adoption-request',
                    'question' => 'Erősítsd meg, hogy befogadták ay ebben a hirdetesben szereplő állatot: ' . $request->animal->title,
                    'route' => 'approve.adoption',
                    'method' => 'PUT',
                    'route_params' => [$request->id],
                    'action_button_text' => 'Jóváhagyom',
                    'action_button_class' => 'btn btn-success'
                  ])  

                  <button 
                    class="mr-3 btn btn-danger" 
                    data-toggle="modal" 
                    data-target="#{{ $request->id . '-reject-request' }}"
                  >
                    Elutasítás
                  </button>
                  @include(
                  'partials.modal_confirm', 
                  [
                    'id' => $request->id . '-reject-request',
                    'question' => 'Biztosan elutasítod a befogadási kérelmet? ' . $request->animal->title,
                    'route' => 'reject.adoption',
                    'method' => 'PUT',
                    'route_params' => [$request->id],
                    'action_button_text' => 'Elutasítom',
                    'action_button_class' => 'btn btn-danger'
                  ])      
                </td>
            </tr>
            @endforeach            
        </tbody>
    </table>
    @if(!empty(Session::get('success')))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
    @endif
    @if(!empty(Session::get('error')))
        <div class="alert alert-danger"> {{ Session::get('error') }}</div>
    @endif
  </div>