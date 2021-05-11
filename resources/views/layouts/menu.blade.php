<li>
    <a href="{{ route('admin.adoption', ['type' => 'requested', 'days' => 7])}}"><i class="fa fa-th-list"></i><span>Befogadási kérések</span></a>
</li>
<li>
    <a href="{{ route('admin.adoption', ['type' => 'rejected', 'days' => 7])}}"><i class="fa fa-user-times"></i><span>Elutasított kérések</span></a>
</li>
<li>
    <a href="{{ route('admin.adoption', ['type' => 'adopted', 'days' => 7])}}"><i class="fa fa-th-list"></i><span>Befogadások</span></a>
</li>