<div class="mt-5 container-fluid">
    <h2>Megkeresések az oldalról</h2>
    <div class="table-responsive-sm">
        <table class="table mt-3 table-striped">
            <thead>
                <tr>
                <th scope="col">Név</th>
                <th scope="col">Email cím</th>
                <th scope="col">Tárgy</th>
                <th scope="col">Üzenet</th>
                <th scope="col">Időpont</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact_messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ Date::parse($message->created_at)->format('Y F j H:i') }}</td>
                </tr>
                @endforeach            
            </tbody>
        </table>
    </div>
  </div>