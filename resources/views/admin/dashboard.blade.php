@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        My Camps
                    </div>
                    <div class="card-body">
                        @include('components.alert')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Camp</th>
                                    <th>Price</th>
                                    <th>Register Data</th>
                                    <th>Paid Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($checkouts as $checkout)
                                    <tr>
                                        <td>{{ $checkout->user->name}}</td>
                                        <td>{{ $checkout->camp->title}}</td>
                                        <td>{{ $checkout->camp->price}}</td>
                                        <td>{{ $checkout->created_at->format('d M Y')}}</td>
                                        <td>
                                            @if ($checkout->is_paid)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Waiting</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$checkout->is_paid) 
                                                <form action="{{ route('admin.checkout.update', $checkout->id)}}" method="POST">
                                                    @csrf  
                                                    <button class="btn btn-success btn-sm">Set to Paid</button>
                                                </form> 
                                            @endif
                                        </td>
                                    </tr>                               
                                @empty
                                    <tr>
                                        <td>No camps registered</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection