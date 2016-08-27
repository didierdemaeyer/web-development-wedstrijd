@extends('layouts.master')

@section('title', 'Entries overview')

@section('content')
  <div id="admin-container">

    <h1 class="big">Manage entries</h1>

    <div class="select-period">
      Select period:
      @foreach($periods as $period)
        @if($period->id == $selectedPeriod)
          <a class="active" href="{{ route('admin.entries', $period->id) }}">
            {{ $period->period_number }}
            <span>({{ $period->startdate->format('d/m') }} - {{ $period->enddate->format('d/m') }})</span>
          </a>
        @else
          <a href="{{ route('admin.entries', $period->id) }}">
            {{ $period->period_number }}
            <span>({{ $period->startdate->format('d/m') }} - {{ $period->enddate->format('d/m') }})</span>
          </a>
        @endif
      @endforeach
    </div>

    <div class="table-wrapper">
      <table id="entries-table" class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th>
              Likes
              <div class="sort">
                <a {{ ($sort == 'likes' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=likes&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'likes' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=likes&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            <th>
              Date
              <div class="sort">
                <a {{ ($sort == 'date' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=date&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'date' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=date&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            </th>
            <th>
              IP address
              <div class="sort">
                <a {{ ($sort == 'ip_address' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=ip_address&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'ip_address' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=ip_address&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            </th>
            <th>
              Name
              <div class="sort">
                <a {{ ($sort == 'name' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=name&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'name' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=name&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            </th>
            <th>
              Email
              <div class="sort">
                <a {{ ($sort == 'email' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=email&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'email' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=email&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            </th>
            <th>
              Address
              <div class="sort">
                <a {{ ($sort == 'address' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=address&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'address' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=address&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            </th>
            <th>
              City/Postcode
              <div class="sort">
                <a {{ ($sort == 'city' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=city&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'city' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=city&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            </th>
            <th>
              Country
              <div class="sort">
                <a {{ ($sort == 'country' && $order == 'asc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=country&order=asc" title="Ascending">
                  <i class="fa fa-chevron-up"></i>
                </a>
                <a {{ ($sort == 'country' && $order == 'desc') ? 'class=active' : '' }} href="{{ route('admin.entries', $selectedPeriod) }}?sort=country&order=desc" title="Descending">
                  <i class="fa fa-chevron-down"></i>
                </a>
              </div>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @forelse($photos as $photo)
            <tr>
              <td><a class="fancybox" rel="group" href="{{ asset($photo->url) }}"><div class="photo" style="display: block; width: 100px; height: 100px; background-position: center center; background-size: cover; background-image: url({{ $photo->url }});"></div></a></td>
              <td>{{ count($photo->likes) }}</td>
              <td>{{ $photo->created_at->format('Y/m/d H:i:s') }}</td>
              <td>{{ $photo->ip_address }}</td>
              <td>{{ $photo->user->firstname }} {{ $photo->user->lastname }}</td>
              <td>{{ $photo->user->email }}</td>
              <td>{{ $photo->user->address }}</td>
              <td>{{ $photo->user->city }} {{ $photo->user->postcode }}</td>
              <td>{{ $photo->user->country->name }}</td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-sm dropdown-toggle btn-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Actions <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a class="delete-photo-button" href="#" data-delete-photo-url="{{ route('admin.delete-photo', $photo->id) }}">Delete photo</a></li>
                    <li><a class="disqualify-user-button" href="#" data-disqualify-user-url="{{ route('admin.disqualify-user', $photo->user->id) }}">Disqualify user</a></li>
                  </ul>
                </div></td>
            </tr>
          @empty
            <tr>
              <td colspan="10">There are no entries in this period.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-wrapper">
      {{ $photos->appends(['sort' => $sort, 'order' => $order])->links() }}
    </div>

  </div>
@stop

@section('scripts')
  <script>
    (function () {
      TNF.addDeletePhotoClickListeners();
      TNF.addDisqualifyUserClickListeners();
      $(".fancybox").fancybox();
    })();
  </script>
@stop