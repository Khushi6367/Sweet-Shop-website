@extends('layouts.admin')

@section('content')
<div class="col-md-12 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark">Product List</h2>
        <a href="/product/create" class="btn btn-dark">Add New Product</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-gold">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Flavor</th>
                    <th scope="col">Made With</th>
                    <th scope="col">Shelf Life</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Price</th>
                    <th scope="col">Final Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Availability</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $info)
                    @foreach ($info['price'] as $price)
                        <tr>
                            <td>
                                <img src="/images/{{ $info->main_image }}" alt="Product Image"
                                    width="60" height="60" class="rounded shadow-sm img-fluid">
                            </td>
                            <td class="text-wrap">{{ $info->name }}</td>
                            <td class="text-wrap">{{ $info->flavour }}</td>
                            <td class="text-wrap">{{ $price['madewith'] }}</td>
                            <td>{{ $price['shelflife'] }}</td>
                            <td>{{ $price['weight'] }} {{ $price['weight_type'] }}</td>
                            <td>₹{{ number_format($price['price'], 2) }}</td>
                            <td>₹{{ number_format($price['finalprice'], 2) }}</td>
                            <td class="text-success">
                                {{ round((($price['price'] - $price['finalprice']) / $price['price']) * 100, 2) }}% off
                            </td>
                            <td>{{ $price['availability'] }}</td>
                            <td>
                                <a href="/product/{{ $info->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
