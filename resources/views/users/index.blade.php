@extends('layouts.app')

@section('content')
<div class="container"><table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">set admin</th>
            <th scope="col">set moderator</th>
            <th scope="col">delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            @if (Auth::id() !== $user->id)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="admin" value="1">
                            @if ($user->hasRole('admin'))
                                <button type="submit" class="btn btn-warning">unset admin</button>
                            @else
                                <button type="submit" class="btn btn-primary">set admin</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="moderator" value="1">
                            @if ($user->hasRole('moderator'))
                                <button type="submit" class="btn btn-warning">unset moderator</button>
                            @else
                                <button type="submit" class="btn btn-primary">set moderator</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="admin">
                            <button type="submit" class="btn btn-danger">delete user</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table></div>
@endsection
