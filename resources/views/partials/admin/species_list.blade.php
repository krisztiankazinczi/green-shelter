<div class="mt-5 container-fluid">
    <h2>Regisztrált állatfajták az oldalon</h2>
    <table class="table mt-3">
        <thead>
            <tr>
              <th scope="col">Kép</th>
              <th scope="col">Fajta</th>
              <th scope="col">Leírás</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($animal_types as $type)
            <tr>
                <td>
                <div class="d-flex justify-content-center">
                  <img src="/images/{{ $type->image_uri }}" alt="{{ $type->name }}-fajta" style="height: 100px; max-width: 200px;" />
                </div>
                </td>
                <td>{{ $type->name }}</td>
                <td>{!! $type->description !!}</td>
                <td>
                  <div class="d-flex flex-column">
                    <a href="/type/{{ $type->id }}" class="text-decoration-none">
                      <button class="mb-2 btn btn-primary btn-sm btn-block">
                        Megtekintés
                      </button>
                    </a>
                    <a href="/type/{{ $type->id }}/edit" class="text-decoration-none">
                      <button class="mb-2 btn btn-success btn-sm btn-block">
                        Szerkesztés
                      </button>
                    </a>
                    <button 
                      class="mb-2 btn btn-danger btn-sm" 
                      data-toggle="modal" 
                      data-target="#{{ $type->id . '-revert-rejection' }}"
                    >
                      Törlés
                    </button>
                    {{-- @include(
                    'partials.modal_confirm', 
                    [
                      'id' => $request->id . '-revert-rejection',
                      'question' => 'Biztosan visszavonod az adoptálás elutasítását? - ' . $request->animal->title,
                      'route' => 'revert.adoption.rejection',
                      'method' => 'PUT',
                      'route_params' => [$request->id],
                      'action_button_text' => 'Elutasítás visszavonása',
                      'action_button_class' => 'btn btn-danger'
                    ])     --}}
                  </div>
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