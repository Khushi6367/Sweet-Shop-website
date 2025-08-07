@extends('layouts.admin')

@section('content')
    <form action="/product/{{ $info->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="container border p-4">
            <div class="text-danger h3 text-center text-decoration-underline">
                Edit Product
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $info->name) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="flavour">Product Flavour</label>
                <input type="text" name="flavour" id="flavour" value="{{ old('flavour', $info->flavour) }}"
                    class="form-control" list="sug">
                <datalist id="sug">
                    <option value="Almond & Pistachio">
                    <option value="Chocolate">
                    <option value="Coconut">
                    <option value="Elaichi">
                    <option value="Orange">
                    <option value="Regular">
                    <option value="Rose">
                </datalist>
            </div>

            <div id="main">
                @foreach ($info->price as $index => $price)
                    <div class="row mb-3" id="child_{{ $index + 1 }}">
                        <div class="col-md-6 col-lg-3">
                            <label for="madewith">Made With</label>
                            <select class="form-select" name="price[madewith][]">
                                <option {{ $price['madewith'] == 'Vegetable Oil' ? 'selected' : '' }}>Edible Vegetable Oil
                                    (Refined Palmolein Oil)
                                </option>
                                <option {{ $price['madewith'] == 'Desi Ghee' ? 'selected' : '' }}>Clarified Butter (Desi
                                    Ghee)</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label for="ingredients">Ingredients</label>
                            <select class="form-select" name="price[ingredients][]" id="ingredients">
                                <option
                                    value="Sugar, Edible Vegetable Oil (Palmoein Oil), Refined Wheat Flour, Gram Flour, Liquid Glucose, Cardamom Powder etc."
                                    {{ $price['ingredients'] == 'Sugar, Edible Vegetable Oil (Palmoein Oil), Refined Wheat Flour, Gram Flour, Liquid Glucose, Cardamom Powder etc.' ? 'selected' : '' }}>
                                    Sugar, Edible Vegetable Oil (Palmoein Oil), Refined Wheat Flour, Gram Flour, Liquid
                                    Glucose, Cardamom Powder etc.
                                </option>

                                <option
                                    value="Sugar, Clarified Butter (Desi Ghee), Refined Wheat Flour, Gram Flour, Liquid Glucose, Almonds, Pistachio and Cardamom."
                                    {{ $price['ingredients'] == 'Sugar, Clarified Butter (Desi Ghee), Refined Wheat Flour, Gram Flour, Liquid Glucose, Almonds, Pistachio and Cardamom.' ? 'selected' : '' }}>
                                    Sugar, Clarified Butter (Desi Ghee), Refined Wheat Flour, Gram Flour, Liquid Glucose,
                                    Almonds, Pistachio and Cardamom.
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label for="shelflife">Shelf Life</label>
                            <select class="form-select" name="price[shelflife][]">
                                <option {{ $price['shelflife'] == '3 months' ? 'selected' : '' }}>3 months</option>
                                <option {{ $price['shelflife'] == '6 months' ? 'selected' : '' }}>6 months</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label for="availability">Availability</label>
                            <select class="form-select" name="availability">
                                <option {{ $info->status == 'In Stock' ? 'selected' : '' }}>In Stock</option>
                                <option {{ $info->status == 'Out Of Stock' ? 'selected' : '' }}>Out Of Stock</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label for="weight">Weight</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="price[weight][]"
                                    value="{{ $price['weight'] }}">
                                <select class="btn btn-outline-secondary" name="price[weight_type][]">
                                    <option {{ $price['weight_type'] == 'gm' ? 'selected' : '' }}>gm</option>
                                    <option {{ $price['weight_type'] == 'kg' ? 'selected' : '' }}>kg</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label for="price">Price</label>
                            <div class="input-group mb-3">
                                <input type="number" name="price[price][]" value="{{ $price['price'] }}"
                                    class="form-control">
                                <span class="input-group-text">₹</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label for="finalprice">Final Price</label>
                            <div class="input-group mb-3">
                                <input type="number" name="price[finalprice][]" value="{{ $price['finalprice'] }}"
                                    class="form-control">
                                <span class="input-group-text">₹</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="main_image">Main Image</label>
                <input type="file" class="form-control" name="main_image">
                <img src="/images/{{ $info->main_image }}" alt="Product Image" width="100" class="mt-2">
            </div>

            <div class="mb-3">
                <label for="other_image">Other Images/Videos</label>
                <input type="file" class="form-control" multiple name="other_image[]" accept="image/*,video/*">
            </div>

            <div class="mb-3">
                <label for="description">Product Description</label>
                <textarea name="description" class="form-control" rows="6">{{ old('description', $info->description) }}</textarea>
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-dark">Update</button>
            </div>
        </div>
    </form>
@endsection
