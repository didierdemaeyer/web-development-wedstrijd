<h1>Winner for period {{ $period->period_number }}</h1>

<table>
  <tr>
    <td>Name</td>
    <td>{{ $winning_photo->user->firstname }} {{ $winning_photo->user->lastname }}</td>
  </tr>
  <tr>
    <td>Email address</td>
    <td>{{ $winning_photo->user->email }}</td>
  </tr>
  <tr>
    <td>Address</td>
    <td>{{ $winning_photo->user->address }}</td>
  </tr>
  <tr>
    <td>City</td>
    <td>{{ $winning_photo->user->city }}</td>
  </tr>
  <tr>
    <td>Postcode</td>
    <td>{{ $winning_photo->user->postcode }}</td>
  </tr>
  <tr>
    <td>Country</td>
    <td>{{ $winning_photo->user->country->name }}</td>
  </tr>
</table>

<p>Won with {{ count($winning_photo->likes) }} likes: <a href="{{ route('entries.show', $winning_photo->id) }}">Link to photo</a></p>